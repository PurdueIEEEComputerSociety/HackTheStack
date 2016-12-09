<!DOCTYPE html>

<?php
    if (isset($_GET['email']) && isset($_GET['password'])) {
        $email = $_GET['email'];
        $password = $_GET['password'];

        $db = mysqli_connect("localhost", "root", "password1", "sql_inj");

        if (!$db) {
            die('<p class="error">Connect Error ('.mysqli_connect_errno().') '. mysqli_connect_error()."</p>");
        }

        $query = "SELECT * FROM `users` WHERE email='$email' AND password='$password'";

        $results = $db->query($query);

        if ($results->num_rows != 0) {
            session_start();
            $_SESSION['user'] = $_GET['email'];
            Header("Location: loggedin.php");
        } else {
            session_start();
            $_SESSION['user'] = NULL;
            echo "<p class='alert alert-danger'>";
            echo "Password or Email incorrect!";
            echo "</p>";
        }
    }
?>


<html lang="en">
<head>
    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title></title>

    <!-- Set Mobile Scaling to Device Width
    ––––––––––––––––––––––––––––––––––––––––––––––––––  -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- No Mobile Scaling (Uncomment if needed)
    ––––––––––––––––––––––––––––––––––––––––––––––––––
    <meta name="viewport" content="width=device-width, user-scalable=no"> -->

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,600,900" rel="stylesheet">

    <!-- Scripts
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="/favicon.png" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <style type="text/css">
        /* Remove padding and force height to 100% */
        *, html, body {
            padding: 0;
            margin: 0;
        }
        html, body {
            height: 100%;
        }

        body {
            /* Some fonts and nice colors */
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 18px;
            color: #444;

            background-color: #fefefe;

            /* Keep things in middle, small padding on top/bottom */
            margin: 40px auto;
            max-width: 650px;
            padding: 0 10px;
        }
    </style>

    <body>
        <div class="row">
            <div class="col-4-md col-off-4-md">
                <div class="well">
                    <?php
                        if ($_GET['error']) {
                            echo "<p class='alert alert-danger'>";
                            echo $_GET['error'];
                            echo "</p>";
                        }
                    ?>

                    <form method="get" action="index.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
