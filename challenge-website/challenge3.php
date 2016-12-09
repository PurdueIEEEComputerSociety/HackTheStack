<!DOCTYPE html>

<?php
    $password = "mimemimemime";
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
                    <?php if ($_POST['password'] == $password || $_SESSION['challenge3'] == true) { ?>
                        <?php $_SESSION['challenge3'] = true; ?>

                        <h1>Bad Authentication</h1>

                        <p>This challenge is for you to login as an admin for one of the hottest forum
                        sites to come out since Yahoo! Answers. In the developers' haste to get the product
                        out, they missed some vital code to keep some nasty ne'er-do-wells from getting access
                        to their site.</p>

                        <p>However, the creators aren't completely forgetful, there are some roadblocks in the way
                        to do this. Don't be discouraged! Most of them are still insecure if you stretch the limits.</p>

                        <p>There's a rumor that one of the admins have been logging in quite often. Login as them and
                        extract a super-secret admin code that they use for everything. Seriously. They never took ECE 404/CS 426.</p>

                        <p>Good Luck!</p>

                        <p><a href="challenge4.php">&gt; Move on to Challenge 4</a></p>

                    <?php } else { ?>
                        <form method="post" action="challenge3.php">
                            <div class="form-group">
                                <label>Challenge 3 Password</label>
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
