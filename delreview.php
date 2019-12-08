<?php
  include "android/connect.php";
  require('android/jwt.php');
  if(isset($_COOKIE['admin']))
  {
    $token=$_COOKIE['admin'];
    try{
        $auth=JWT::decode($token, "truong pham", true);
    } catch(Exception $e){}

    if($auth=='admin')
    {
        $idreview=$_GET['id'];
        $sql="DELETE FROM rate_table WHERE idreview='$idreview'";
        $conn->query($sql);
        $sql="DELETE FROM save_table WHERE idreview='$idreview'";
        $conn->query($sql);
        $name_hinhanh=$idreview.'.jpg';
        $link='android/hinhanh/'.$name_hinhanh;
        unlink($link);
        $sql="DELETE FROM review_table WHERE id='$idreview'";
        if($conn->query($sql)===TRUE)
        {
            header("Location: index.php?del=1");
        }
        else{
            header("Location: index.php?del=0");
        }
    }
  } else 
  {
    header("Location: login.php");
  };
?>