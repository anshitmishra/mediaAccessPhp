<?php
require_once "./php/dbcon.php";
$message = '';
if (isset($_POST['name'])) {
    if ($_POST['name'] != '' && $_POST['email'] != '' && $_POST['password'] != '') {
        $name = $connection->real_escape_string($_POST['name']);
        $email = $connection->real_escape_string($_POST['email']);
        $password = $connection->real_escape_string($_POST['password']);

        $checkEmail = $connection->query("SELECT * FROM `user` WHERE email = '$email'");
        if (mysqli_num_rows($checkEmail) > 0) {
            $message = "email already exits";
        } else {
            $time = time();
            $token = md5($time . 'dasds' . rand(00000, 99999));
            $mediaCode = md5($time . 'asdasd' . rand(00000, 99999));
            $sql = "INSERT INTO `user`(`name`, `email`, `password`, `time`, `token`, `mediaCode`) VALUES ('" . $name . "','" . $email . "','" . $password . "','" . $time . "','" . $token . "','" . $mediaCode . "')";

            if ($connection->query($sql) === TRUE) {
                $message =  "account created";
                $cookie_name = "token";
                $cookie_value = $token;
                if (setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/")) {
                    header("location: ./dashboard.php");
                } else {
                    $message = "system error";
                }
            } else {
                $message = "error";
            }
        }
    } else {
        $message = "name email and password are not correct check again";
    }
} else {
    // echo "name email and password are not correct check again";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/login.css">
</head>

<body>
    <div class="main">
        <?php if($message != ''){
           echo  '<div class="message">'.$message.'</div>';
        } ?>
        <form action="<?php $_PHP_SELF ?>" method="post">
            <div class="mainHolder">
                <div class="mainHolderItem">
                    <h1>Anshit Mishra</h1>
                </div>
                <div class="mainHolderItem">
                    <label for="Name">Name</label>
                    <input type="text" name="name" id="Name">
                </div>
                <div class="mainHolderItem">
                    <label for="Email">Email</label>
                    <input type="email" name="email" id="Email">
                </div>
                <div class="mainHolderItem">
                    <label for="Password">Password</label>
                    <input type="password" name="password" id="Password">
                </div>
                <div class="mainHolderItem">
                    <button type="submit">Signup</button>
                </div>
                <div class="mainHolderItem">
                    <p>already have account? <a href="./login.php">login</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>