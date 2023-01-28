<!DOCTYPE html>
<html>
<body>

<?php
include('Browser.php');
$browser = new Browser();
echo GetClientMac()['ip'];
echo GetClientMac()['mac'];

function GetClientMac(){
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    $macCommandString   =   "arp " . $ipaddress . " | awk 'BEGIN{ i=1; } { i++; if(i==3) print $3 }'";

    $mac = exec($macCommandString);

    return ['ip' => $ipaddress, 'mac' => $mac];
}


    echo '\n';
    // $ip = $_SERVER['REMOTE_ADDR'];
    $ip = getHostByName(getHostName());
    // $locationArray = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . GetClientMac()['ip']));
    $locationArray = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . '160.179.52.193'));
    echo '<pre>';
    print_r($locationArray);
    $city = $locationArray['geoplugin_city'];
    $region = $locationArray['geoplugin_region'];
    $country = $locationArray['geoplugin_countryName'];
    $continent = $locationArray['geoplugin_continentName'];
    $timezone = $locationArray['geoplugin_timezone'];
    $currency_code = $locationArray['geoplugin_currencyCode'];
    $currency_symbol = $locationArray['geoplugin_currencySymbol'];
    $country = $locationArray['geoplugin_countryName'];
    $country = $locationArray['geoplugin_countryName'];
    $platform = $browser->getPlatform();
    $browserr = $browser->getBrowser();
    $version = $browser->getVersion();

    
?>

</body>
</html>