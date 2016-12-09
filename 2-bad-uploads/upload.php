<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["uploadedfile"]["name"]);

if(isset($_FILES["uploadedfile"])) {

    // Check if file already exists
    if (file_exists($target_file)) {
        echo("Sorry, file already exists.");
        exit();
    }
    // Check file size, just because
    if ($_FILES["uploadedfile"]["size"] > 500000) {
        echo("Sorry, file is too large.");
        exit();
    }

    // Allow certain file formats
    // The bad: File extension can be anywhere in string
    if (!strpos($_FILES['uploadedfile']['name'], "png") &&
        !strpos($_FILES['uploadedfile']['name'], "jpg") &&
        !strpos($_FILES['uploadedfile']['name'], "jpeg") &&
        !strpos($_FILES['uploadedfile']['name'], "gif")) {
        echo("Sorry, only JPG, JPEG, PNG & GIF extensions are allowed.");
        exit();
    }

    // Check the mime type
    // The bad: This can be faked with curl
    if (substr($_FILES["uploadedfile"]["type"], 0, 5) != "image") {
        echo("Sorry, the file is not of type image.");
        exit();
    }


    //Move the actual file
    if (move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["uploadedfile"]["name"]). " has been uploaded.";
    } else {
        echo("Sorry, there was a problem uploading your file");
        exit();
    }
}
?>
