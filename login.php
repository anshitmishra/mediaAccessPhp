<?php
require_once "./php/dbcon.php";
$message = '';
if (isset($_POST['email'])) {
    if ($_POST['email'] != '' && $_POST['password'] != '') {
        $email = $connection->real_escape_string($_POST['email']);
        $password = $connection->real_escape_string($_POST['password']);

        $checkEmail = $connection->query("SELECT * FROM `user` WHERE email = '$email'");
        if (mysqli_num_rows($checkEmail) > 0) {
            $data = $checkEmail->fetch_assoc();
            if ($data['password'] == $password) {
                $cookie_name = "token";
                $cookie_value = $data['token'];
                if (setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/")) {
                    header("location: ./dashboard.php");
                } else {
                    $message = "system error";
                }
            } else {
                $message = "email/password not matching";
            }
        } else {
            $message = "email not found";
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
        <?php if ($message != '') {
            echo  '<div class="message">' . $message . '</div>';
        } ?>
        <form action="<?php $_PHP_SELF ?>" method="post">

            <div class="mainHolder">
                <div class="mainHolderItem">
                    <h1>Anshit Mishra</h1>
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
                    <button type="submit">Login</button>
                </div>
                <div class="mainHolderItem">
                    <p>don't have account? <a href="./signup.php">create account</a></p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>