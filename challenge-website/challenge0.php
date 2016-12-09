<!DOCTYPE html>

<?php
    $password = "challenge0";
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
                    <?php if ($_POST['password'] == $password || $_SESSION['challenge0'] == true) { ?>
                        <?php $_SESSION['challenge0'] = true; ?>
                        <h1>Password Challenge</h1>

                        <p>As a side competition, there is a hashed password list located <a href="password_list.txt">here</a> (warning, large file).
                        <p>Those that crack the most passwords will get extra points! Note: please make sure to save which line the password is on that you cracked.
                        Also, the length of the password precedes the hash, i.e. first line is the length of the original password, second line is the hash, and so on</p>

                        <p>Hint: password == 5f4dcc3b5aa765d61d8327deb882cf99</p>

                    <?php } else { ?>
                        <form method="post" action="challenge0.php">
                            <div class="form-group">
                                <label>Challenge 0 Password</label>
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
