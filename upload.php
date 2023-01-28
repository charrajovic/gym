<?php
//upload.php
session_start();
include("connect.php");
if(isset($_FILES["file"]))
{
    if($_FILES["file"]["name"] != '')
{
    
    $test = explode('.', $_FILES["file"]["name"]);
    $ext = end($test);
    $name = "2".rand(1, 9999999) . '.' . $ext;
    if(strtolower($ext) == 'png' || strtolower($ext) == 'jpg' || strtolower($ext) == 'jpeg')
    {
        $location = './assets/images/' . $name;  
        move_uploaded_file($_FILES["file"]["tmp_name"], $location);
        
        $name = $_REQUEST['name'];
        $domain = $_REQUEST['domain'];
        if(!isset($_REQUEST['ided']))
        {
            $spl="INSERT INTO `gigs`(`name`, `path`, `domaine`) VALUES ('$name','$location','$domain')";
            $res=mysqli_query($conn,$spl);
            if($res==1)
            {
                
                echo 'yes';
            }
            else
            {
                echo 0;
            }
        }
        else
        {
            $ide = $_REQUEST['ided'];
            $spl="UPDATE `gigs` SET `name`='$name',`path`='$location',`domaine`='$domain' WHERE id=$ide";
            $res=mysqli_query($conn,$spl);
            if($res==1)
            {
                
                echo 'yes';
            }
            else
            {
                echo 0;
            }
        }
        
    
}
else
{
    echo $ext . ' is invalid';
}
    }
}

    else
    {
        if(isset($_REQUEST['ided']) && isset($_REQUEST['name']) && isset($_REQUEST['domain']))
        {
            $ide = $_REQUEST['ided'];
            $name = $_REQUEST['name'];
            $domain = $_REQUEST['domain'];
            $spl="UPDATE `gigs` SET `name`='$name',`domaine`='$domain' WHERE id=$ide";
            $res=mysqli_query($conn,$spl);
            if($res==1)
            {
                echo "yes";
            }
            else
            {
                echo 0;
            }
        }
    }
    mysqli_close($conn);
?>