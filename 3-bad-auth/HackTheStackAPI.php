<?php 

class HackTheStackAPI {
    private static $db;
    public static $response = [];

    public static function process() {
        if (isset($_POST['command'])) {
            $command = $_POST['command'];
            switch ($command) {
                case 'login':
                    if (isset($_POST['authToken'])) {
                        if (!empty($_POST['authToken'])) {
                            self::login('', '', $_POST['authToken']);
                        } else {
                            self::$response['message'] = 'Need a valid authToken';
                        }
                    } else if (isset($_POST['username']) && isset($_POST['password'])) {
                        if (!empty($_POST['username']) && !empty($_POST['password'])) {
                            self::login($_POST['username'], $_POST['password']);
                        } else {
                            self::$response['message'] = 'Username/password format invalid.';
                        }
                    } else {
                        self::$response['message'] = 'Provide the username or authToken';
                    }
                    break;
                case 'get_recent':
                    self::$response['list'] = self::getRecentUsers();
                    break;
                case 'create_user':
                    if (!isset($_POST['username'])) {
                        self::$response['message'] = 'Need a username';
                    } else if (!isset($_POST['password'])) {
                        self::$response['message'] = 'Need a password';
                    } else if (!isset($_POST['handle'])) {
                        self::$response['message'] = 'Need a handle';
                    } else {
                        if (($message = self::createUser($_POST['username'], $_POST['password'], $_POST['handle'])) === true) {
                            self::$response['message'] = 'User Successfully Created!';
                        } else {
                            self::$response['message'] = $message;
                        }
                    }
                    break;
                default:
                    self::$response['message'] = 'Please define a correct command.';
            }
        } else {
            self::$response['message'] = 'Please define a command';
        }
    }

    function __construct() {
        self::$db = self::newConnection();
    }

    public static function getRecentUsers() {
        $sql = 'SELECT handle FROM login WHERE username != "TheBestAdmin" ORDER BY created DESC LIMIT 10';
        $result = self::query($sql);
        $handles = [];
        while ($row = $result->fetch_assoc()) {
            $row['handle'] = trim($row['handle']);
            $handles[] = $row;
        }
        return $handles;
    }


    public static function createUser($user, $password, $handle) {
        try {
            self::sanitizeInput($user);
            self::sanitizeInput($handle, false);
            $hash = crypt($password, '$2y$10$1291392930123120932109$');
            $sql = 'SELECT username FROM login WHERE username = "'.$user.'";';
            $result = self::query($sql);
            $row = $result->fetch_assoc();
            if (!is_null($row)) throw new Exception('Username already exists');
            $sql = 'INSERT INTO `login`(`username`, `password`, `authToken`, `handle`, `created`) VALUES ("'.$user.'","'.$hash.'","","'.$handle.'",NOW());';
            $result = self::query($sql);
            return true;       
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    private static function newConnection() {
        $db = new mysqli('localhost', 'login', 'Password1', 'challenge');
        if ($db->connect_errno > 0) die('Unable to connect to db [' . $db->connect_error . ']');
        return $db;
    }    


    public static function sanitizeInput(&$input, $lowercase = true) {
        $input = ($lowercase) ? strtolower($input) : $input;

        if (strpos($input, '<script>') !== false) {
            throw new Exception('XSS detected. Refused request.');
        }

        $input = self::$db->real_escape_string($input);
    }

    public static function query($sql) {
        if (!$result = self::$db->query($sql)) die ('Query failed. -> '.self::$db->error);
        return $result;
    }

    public static function login($user, $password = '', $authToken = '', $isAdminPage = false) {
        try {
            self::sanitizeInput($user);
            self::sanitizeInput($authToken);

            if (!empty($user) && !empty($password)) {
                $hash = crypt($password, '$2y$10$1291392930123120932109$');
                $sql = 'SELECT * FROM login WHERE username = "'.$user.'" AND password = "'.$hash.'";';
            } else if (!empty($authToken)) {
                $sql = 'SELECT * FROM login WHERE authToken = "'.$authToken.'";';
            } else {
                throw new Exception('Somehow user password AND authToken aren\'t defined...');
            }
            $result = self::query($sql);
            $row = $result->fetch_assoc();
            if (is_null($row)) throw new Exception('Invalid username/password combination');

            $isAdmin = $row['username'] == 'thebestadmin';

            if (!$isAdminPage) {
                $newAuthToken = md5(uniqid(rand(), true));
                self::$response['authToken'] = $newAuthToken;
                $sql = 'UPDATE login SET authToken="'.$newAuthToken.'" WHERE username="'.$row['username'].'";';
                self::$response['debug'] = $row;
                $result = self::query($sql);

                if ($isAdmin) {
                    $tokenFile = fopen("authTokenStorage.txt", "w") or die("Unable to open file!");
                    fwrite($tokenFile, $newAuthToken);
                    fclose($tokenFile);
                }
            }

            if ($isAdmin) {
                self::$response['message'] = 'Successfully logged in as an admin!';
                self::$response['url'] = 'adminsecretpage.php';
                return true;
            } else {
                self::$response['message'] = 'Successfully logged in as '.htmlentities($row['username']);
            }
        } catch (Exception $e) {
            self::$response['message'] = $e->getMessage();
        }
        return false;
    }
}