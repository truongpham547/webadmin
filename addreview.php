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
      $username='admin';
      $tieude=$_POST['tieude'];
      $noidung=$_POST['noidung'];
      $diachi=$_POST['diachi'];

      $file_name = $_FILES['hinhanh']['name'];
      $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);

      $conn->query("INSERT INTO review_table (username,tieude,noidung,diachi) 
      VALUES ('$username','$tieude','$noidung','$diachi')");
      $sql="SELECT id FROM review_table order by id desc limit 1";
      $response=$conn->query($sql);
      $row=mysqli_fetch_assoc($response);
      $id=$row['id'];

      $name_hinhanh=$id.'.'.$file_extension;
      if(move_uploaded_file($_FILES['hinhanh']['tmp_name'],"android/hinhanh/".$name_hinhanh)&&
          $conn->query("UPDATE review_table set hinhanh='$name_hinhanh' where id='$id'"))
        {
          $response = 1;
        }
        else{
            $conn->query("DELETE FROM review_table where id='$id'");
            $response = 0;
        }
      echo $response;
    }
  } else 
  {
    header("Location: login.php");
  };
?>