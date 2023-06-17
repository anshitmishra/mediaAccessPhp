<?php
if (isset($_COOKIE['token'])) {
    $cookie_name = "token";
    $cookie_value = '';
    if (setcookie($cookie_name, $cookie_value, time() - (86400 * 30), "/")) {
        header("location: ./login.php");
    } else {
       echo "system error";
    }
}

?>