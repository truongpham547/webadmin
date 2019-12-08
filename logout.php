<?php
    if(isset($_COOKIE['admin']))
    {
        setcookie('admin', null, time() + 0);
    }
    header("Location: login.php");
 ?>