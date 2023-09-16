<?php
//upload.php
session_start();
include("connect.php");
include("connection.php");
function format_uuidv4($data)
{
  assert(strlen($data) == 16);

  $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
  $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    
  return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
if(isset($_FILES["file"]))
{
    if($_FILES["file"]["name"] != '')
{
    
    $test = explode('.', $_FILES["file"]["name"]);
    $ext = end($test);
    $name = "2".rand(1, 9999999) . '.' . $ext;
    if(strtolower($ext) == 'mp4')
    {
        $location = './assets/images/' . $name;  
        move_uploaded_file($_FILES["file"]["tmp_name"], $location);
        
        $ide = $_REQUEST['ide'];
        $data = openssl_random_pseudo_bytes(16, $strong);
        assert($data !== false && $strong);
        $idd = format_uuidv4($data);
        if(!isset($_REQUEST['ided']))
        {
            $spl="UPDATE `exercice` SET `video`='$location' WHERE id = '$ide'";
            echo $spl;
            $res=mysqli_query($con,$spl);
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
            $spl="UPDATE `gigs` SET `name`='$name',`path`='$location',`domaine`='$domain',`price`=$price,`description`='$description' WHERE id=$ide";
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
            $price = $_REQUEST['price'];
            $description = $_REQUEST['description'];
            $spl="UPDATE `gigs` SET `name`='$name',`domaine`='$domain',`price`=$price,`description`='$description' WHERE id=$ide";
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