<?php

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$url = $_SERVER["REQUEST_URI"];
$url = explode("/",$url);

if(is_int((int)end($url)))
{
    $id = (int)end($url);
    
    if($id > 0)
    {
        include 'portfolio-details.php';
    }
    else
    {
        include 'gigshow.php';
    }
}
else
{
    echo "walo";
}

?>