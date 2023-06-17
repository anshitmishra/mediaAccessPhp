<?php
require_once "./php/dbcon.php";
$imageId = $_GET['id'];

$checkImage = $connection->query("SELECT * FROM `images` WHERE token = '$imageId'");

if (mysqli_num_rows($checkImage) > 0) {
    $image = $checkImage->fetch_assoc();

    if ($image['allowtype'] === 'a') {
        header('Content-Type: ' . $image['mime_type']);
        header('Content-Length: ' . $image['file_size']);
        readfile($image['image']);
        // echo $image['image'];
        // echo '<html style="height: 100%;"><link type="text/css" rel="stylesheet" id="dark-mode-custom-link"><link type="text/css" rel="stylesheet" id="dark-mode-general-link"><style lang="en" type="text/css" id="dark-mode-custom-style"></style><style lang="en" type="text/css" id="dark-mode-native-style"></style><style lang="en" type="text/css" id="dark-mode-native-sheet"></style><head><meta name="viewport" content="width=device-width, minimum-scale=0.1"><title>
        // '.$image['image'].'</title></head><body style="margin: 0px; background: #0e0e0e; height: 100%">
        // <img style="width:auto;height:auto;max-height: 100%;display: block;-webkit-user-select: none;margin: auto;cursor: zoom-in;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" 
        // src="http://localhost/php/college/'..'"  /></body></html>';
    } else {
        header('HTTP/1.1 403 Forbidden');
        echo 'Access denied.';
    }
} else {
    header('HTTP/1.1 404 Not Found');
    echo 'Image not found.';
}
?>
