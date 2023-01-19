<?php
//upload.php
session_start();
if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name = "2".rand(1, 9999999) . '.' . $ext;
 $location = './assets/images/' . $name;  
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 include("connect.php");
 $name = $_REQUEST['name'];
 $domain = $_REQUEST['domain'];
 $spl="INSERT INTO `gigs`(`name`, `path`, `domaine`) VALUES ('$name','$location','$domain')";
 $res=mysqli_query($conn,$spl);
 if($res==1)
 {
    
    echo $location;
 }
else
{
    echo 0;
}
 mysqli_close($conn);
}
?>