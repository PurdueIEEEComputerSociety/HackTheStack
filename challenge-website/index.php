<!DOCTYPE html>
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
                    <h1>Welcome to HackTheStack!</h1>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Challenge</th>
                        <th>Time Released</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="challenge0.php">Password Challenge</a></td>
                            <td>6:20 PM</td>
                        </tr>
                        <tr>
                            <td><a href="challenge1.php">SQL Injection</a></td>
                            <td>6:20 PM</td>
                        </tr>
                        <tr>
                            <td><a href="challenge2.php">Bad Uploads</a></td>
                            <td>7:00 PM</td>
                        </tr>
                        <tr>
                            <td><a href="challenge3.php">Bad Authentication</a></td>
                            <td>7:40 PM</td>
                        </tr>
                        <tr>
                            <td><a href="challenge4.php">Buffer Overflow</a></td>
                            <td>8:20 PM</td>
                        </tr>
                        <!--
                        <tr>
                            <td><a href="challenge5.php">Metasploitable</a></td>
                            <td>9:00 PM</td>
                        </tr>
                        -->
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </body>
</html>
