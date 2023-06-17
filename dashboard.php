<?php
require_once "./php/dbcon.php";
if (isset($_COOKIE['token'])) {
    if (($_FILES['file']['name'] ?? null)) {
        // Where the file is going to be stored
        $target_dir = "upload/";
        $file = $_FILES['file']['name'];
        $path = pathinfo($file);
        $filename = md5(time() . '' . rand(0000, 9999)) . '' . $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['file']['tmp_name'];
        $path_filename_ext = $target_dir . $filename . "." . $ext;

        // Check if file already exists
        if (file_exists($path_filename_ext)) {
            echo "Sorry, file already exists.";
        } else {
            move_uploaded_file($temp_name, $path_filename_ext);
            $tokenImage = md5(time() . '' . rand(0000, 9999));
            $mimitype = mime_content_type($path_filename_ext); 
            $size =  filesize($path_filename_ext);
            $type= $_POST['allow'];
            $sql = "INSERT INTO `images`(`image`, `userCode`, `allowtype`, `token`, `mime_type`, `file_size`) VALUES ('" . $path_filename_ext . "','" . $_COOKIE['token'] . "','" . $type . "','" . $tokenImage . "','" . $mimitype. "','" . $size . "')";
            if ($connection->query($sql) === TRUE) {
                echo "Congratulations! File Uploaded Successfully.";
            }
        }
    }
} else {
    header("location: ./login.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/dashboard.css">
</head>

<body>
    <div class="main">
        <div class="mainHeader">
            <h1>Anshit Mishra</h1>
            <a href="./logout.php"><p>Logout</p>
            </a>
        </div>
        <div class="mainHolder">
            <form action="<?php $_PHP_SELF ?>" method="post" name="form" enctype="multipart/form-data">
                <input type="file" name="file" id="images" accept="image/*">
                <select name="allow" id="">
                    <option value="a">allow to all</option>
                    <option value="n">not allow</option>
                </select>
                <button type="submit">save</button>
            </form>
        </div>


        <div class="mainHolderTwo">

            <div class="mainList">
                <h2>Images List</h2>
                <div class="mainListItem">
                    <div class="mainListItemCol">
                        <p>Image</p>
                    </div>
                    <div class="mainListItemCol">
                        <p>Author</p>
                    </div>
                    <div class="mainListItemCol">
                        <p>Access</p>
                    </div>
                    <div class="mainListItemCol">
                        <p>Details</p>
                    </div>
                </div>

                <?php
                if (isset($_COOKIE['token'])) {
                    $token = $_COOKIE['token'];
                    $sqlSelect = $connection->query("SELECT * FROM `images` WHERE userCode = '$token'");
                    $d = '';
                    if (mysqli_num_rows($sqlSelect) > 0) {
                        while ($data = $sqlSelect->fetch_assoc()) {
                            $userCode = $data['userCode'];
                            $checkEmail = $connection->query("SELECT * FROM `user` WHERE token = '$userCode'");
                            $ldata = $checkEmail->fetch_assoc();

                            $d .= '<div class="mainListItem">
                           <div class="mainListItemCol">
                               <img src="./' . $data['image'] . '" alt="image" >
                           </div>
                           <div class="mainListItemCol">
                               <p>'.$ldata['name'].'</p>
                           </div>
                           <div class="mainListItemCol">
                               <p>'.$data['allowtype'].'</p>
       
                           </div>
                           <div class="mainListItemCol">
                               <a href="./singleImage.php?id='.$data['token'].'"><button>details</button></a>
                           </div>
                       </div>';
                        }
                    }else {

                    }
                    echo $d;
                } else {
                }
                ?>
            </div>
                <img src="http://localhost/php/college/singleImage.php?id=c0c69de363c97ea1a99faa4220ead72a"  alt="">

        </div>
    </div>
</body>

</html>