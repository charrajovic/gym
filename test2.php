<?php
// $agent = $_SERVER["HTTP_USER_AGENT"];
// echo $agent;

// if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
//   echo "You're using Internet Explorer";
// } else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
//   echo "You're using Chrome";
// } else if (preg_match('/Edge\/\d+/', $agent) ) {
//   echo "You're using Edge";
// } else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
//   echo "You're using Firefox";
// } else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
//   echo "You're using Opera";
// } else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
//   echo "You're using Safari";
// }

// $useragent = $_SERVER['HTTP_USER_AGENT'];
// $info = get_browser($useragent);
// echo $useragent;
// echo $info;

include('Browser.php');
$browser = new Browser();
echo $browser->getBrowser();
echo $browser->getVersion();
echo $browser->isMobile();
echo $browser->__toString();
echo gethostbyaddr($_SERVER['REMOTE_ADDR']);
    if( $browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() >= 8 ) 
        {
            echo "Your browser is Internet explorer version 8";                                                                                                                                    
    }
?>