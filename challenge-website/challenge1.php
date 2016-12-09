<!DOCTYPE html>

<?php
    $password = "challenge1";
    session_start();
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

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,600,900" rel="stylesheet">

    <!-- Scripts
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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

            background-color: #131f25;

            /* Keep things in middle, small padding on top/bottom */
            margin: 40px auto;
            max-width: 1000px;
            padding: 0 10px;
        }
    </style>

    <body>
        <div class="row">
            <div class="col-12-md">
                <div class="well">
                    <p><a href="index.php">&lt; Back to Challenge Page</a></p>
                    <?php if ($_POST['password'] == $password || $_SESSION['challenge1'] == true) { ?>
                        <?php $_SESSION['challenge1'] = true; ?>

                        <h1>SQL Injections</h1>

                        <p>Welcome to the first challenge! There is a website located on your webserver
                        at http://yourseverip/sql_inj/, with a basic form login. Unfortunately, the person
                        that programmed it doesn't know SQL very well.. </p>

                        <p>You have an account set up as bobby_t@csociety.org with the password as password5.
                        However, in order to receive the secret code you need to login as admin@csociety.org</p>

                        <p>Good luck!</p>

                        <p><a href="challenge2.php">&gt; Move on to Challenge 2</a></p>

                    <?php } else { ?>
                        <form method="post" action="challenge1.php">
                            <div class="form-group">
                                <label>Challenge 1 Password</label>
                                <input type="text" class="form-control" placeholder="Password" name="password">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>
