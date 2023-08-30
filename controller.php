<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'connect.php';
include 'connection.php';
include 'user.php';
include('Browser.php');
$browser = new Browser();

function format_uuidv4($data)
{
  assert(strlen($data) == 16);

  $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
  $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    
  return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

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
$locationArray = null;
$ip = GetClientMac()['ip'];
$city = null;
$region = null;
$country = null;
$continent = null;
$timezone = null;
$currency_code = null;
$currency_symbol = null;
$country = null;
$platform = null;
$browserr = null;
$version = null;

function create_action($messages,$ida)
{
    $ip = $GLOBALS["ip"];
    $city = $GLOBALS["city"];
    $region = $GLOBALS["region"];
    $country = $GLOBALS["country"];
    $continent = $GLOBALS["continent"];
    $timezone = $GLOBALS["timezone"];
    $currency_code = $GLOBALS["currency_code"];
    $currency_symbol = $GLOBALS["currency_symbol"];
    $country = $GLOBALS["country"];
    $platform = $GLOBALS["platform"];
    $browserr = $GLOBALS["browserr"];
    $version = $GLOBALS["version"];
    echo $ida;
    if(empty($ida))
    {
    $sql2 = "INSERT INTO `actions`(`adresse_ip`, `city`, `region`, `country`, `continent`, `timezone`, `currency_code`, `currency_symbol`, `browser_name`, `browser_version`, `plateform`, `action`) VALUES ('$ip','$city','$region','$country','$continent','$timezone','$currency_code','$currency_symbol','$browserr','$version','$platform','$messages')";
    }
    else
    {   
    $sql2 = "INSERT INTO `actions`(`user_id`,`adresse_ip`, `city`, `region`, `country`, `continent`, `timezone`, `currency_code`, `currency_symbol`, `browser_name`, `browser_version`, `plateform`, `action`) VALUES ($ida,'$ip','$city','$region','$country','$continent','$timezone','$currency_code','$currency_symbol','$browserr','$version','$platform','$messages')";
    }
                // echo $sql2;
                if ($GLOBALS["conn"]->query($sql2) === TRUE) {

                }
}
//SELECT count(*),DATE_FORMAT(`created`,'%d %M %Y') as created FROM `mails` GROUP BY day(`created`)


if(isset($_REQUEST['first']) && isset($_REQUEST['last']) && isset($_REQUEST['email']) && isset($_REQUEST['password']) && !isset($_REQUEST['typeu']))
{
    session_start();
    $user = new User($_REQUEST['first'],$_REQUEST['last'],$_REQUEST['email'],$_REQUEST['password']);
    $_SESSION['prov'] = new User($_REQUEST['first'],$_REQUEST['last'],$_REQUEST['email'],$_REQUEST['password']);
    $_SESSION['username'] = $_REQUEST['username'];

    if($user->check())
    {
        
        $name = $_REQUEST['first'];
        $last = $_REQUEST['last'];
        $email =  $_REQUEST['email'];
        $password =  $_REQUEST['password'];
        $username =  $_REQUEST['username'];
        
        if(strlen($username)<3)
        {
            header("Location: register?username");
        }

        $sql8 = "SELECT *
                FROM users where email = '$email'";
        $result8 = mysqli_query($conn, $sql8);
        $sql9 = "SELECT *
                FROM users where username = '$username'";
        $result9 = mysqli_query($conn, $sql9);
        
        if (mysqli_num_rows($result8) < 1) {
            if (mysqli_num_rows($result9) < 1) {
        $sql = "INSERT INTO `users`(`username`,`name`, `lastname`, `email`, `password`) VALUES ('$username','$name','$last','$email','$password')";

        if ($res = $conn->query($sql) === TRUE) {
            $usr = $conn->insert_id;
            $sql2 = "INSERT INTO `users_role`(`user_id`, `id_role`) VALUES ($usr,1)";
            // echo $sql2;
            if ($conn->query($sql2) === TRUE) {
                create_action('create account with id '.$usr,null);
                $sql = "SELECT *
                FROM users
                INNER JOIN users_role ON users.id = users_role.user_id
                INNER JOIN role ON role.role_id = users_role.id_role where users.email='$email' and users.password='$password'";
                $result = mysqli_query($conn, $sql);
                // echo mysqli_num_rows($result);
                $roles = array();
                $name = null;
                $last = null;
                $mail = null;
                $id = null;

                if (mysqli_num_rows($result) > 0) {
                // output data of each row
                // while($row = mysqli_fetch_assoc($result)) {
                //     echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["lastname"]. "<br>";
                // }
                while($row = mysqli_fetch_assoc($result)) {
                    // $user = new User($row["name"],$row["lastname"],$row["email"],null);
                    // $_SESSION["user"] = $user;
                    // echo $user->to_string();
                    array_push($roles,$row["role_name"]);
                    print_r($row);
                    echo $row["id"];
                    if(is_null($id))
                    {
                        $id = $row["id"];
                    }
                    if(is_null($name))
                    {
                        $name = $row["name"];
                    }
                    if(is_null($last))
                    {
                        $last = $row["lastname"];
                    }
                    if(is_null($mail))
                    {
                        $mail = $row["email"];
                    }
                }
                // print_r($roles);
                $user = new User($name,$last,$mail,null);
                $user->set_id($id);
                $user->set_roles($roles);
                // echo count($user->get_roles());
                $_SESSION["user"] = $user;
                create_action('login to account with id '.$id,$id);
                header("Location: home");
            }
        
        }
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        echo 'yes';
    }
    else{
        header("Location: register?us");
    }
    }else{
        header("Location: register?email");
    }
    }
    else{
        header("Location: register?error");
    }
}
else if(!isset($_REQUEST['first']) && !isset($_REQUEST['last']) && isset($_REQUEST['email']) && isset($_REQUEST['password']))
{
    session_start();
    $email =  $_REQUEST['email'];
    $password =  $_REQUEST['password'];
    $sql = "SELECT *
    FROM users
    INNER JOIN users_role ON users.id = users_role.user_id
    INNER JOIN role ON role.role_id = users_role.id_role where users.email='$email' and users.password='$password' OR users.username='$email' and users.password='$password'";
    $result = mysqli_query($conn, $sql);
    // echo mysqli_num_rows($result);
    $roles = array();
    $name = null;
    $last = null;
    $mail = null;
    $id = null;

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    // while($row = mysqli_fetch_assoc($result)) {
    //     echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["lastname"]. "<br>";
    // }
    while($row = mysqli_fetch_assoc($result)) {
        // $user = new User($row["name"],$row["lastname"],$row["email"],null);
        // $_SESSION["user"] = $user;
        // echo $user->to_string();
        array_push($roles,$row["role_name"]);
        print_r($row);
        echo $row["id"];
        if(is_null($id))
        {
            $id = $row["id"];
        }
        if(is_null($name))
        {
            $name = $row["name"];
        }
        if(is_null($last))
        {
            $last = $row["lastname"];
        }
        if(is_null($mail))
        {
            $mail = $row["email"];
        }
    }
    // print_r($roles);
    $user = new User($name,$last,$mail,null);
    $user->set_id($id);
    $user->set_roles($roles);
    // echo count($user->get_roles());
    $_SESSION["user"] = $user;
    create_action('login to account with id '.$id,$id);
    header("Location: home");
    }
    else
    {
        header("Location: login?error");
    }
    
    // echo $_SESSION["user"]->get_roles()[1];
    
}
else if(isset($_REQUEST['service']) && isset($_REQUEST['type']))
{
    
    if($_REQUEST['type'] == "Admin")
    {
        
        session_start();
        
        if(isset($_SESSION['user']))
        {
            if($_REQUEST['service'] == "users")
            {
                $resp="[";
            $email = $_SESSION['user']->get_email();
            $sql = "SELECT `id`,`name`,`lastname`,`email`,`poids`, `taille`, `blessure`, `objectif`, `created_at`, `updated_at`, `status`, `gender`, `age`, `type` FROM `user`";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $name = $row["name"];
                $lastname = $row["lastname"];
                $email = $row["email"];
                $poids = $row["poids"];
                $taille = $row["taille"];
                $blessure = $row["blessure"];
                $objectif = $row["objectif"];
                $created_at = $row["created_at"];
                $updated_at = $row["updated_at"];
                $status = $row["status"];
                $gender = $row["gender"];
                $age = $row["age"];
                $type = $row["type"];
                $resp.="{\"id\":\"$id\",\"name\":\"$name\",\"last\":\"$lastname\",\"email\":\"$email\",\"poids\":\"$poids\",\"taille\":\"$taille\",\"blessure\":\"$blessure\",\"objectif\":\"$objectif\",\"created_at\":\"$created_at\",\"updated_at\":\"$updated_at\",\"status\":\"$status\",\"gender\":\"$gender\",\"age\":\"$age\",\"type\":\"$type\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            // create_action('view users as a admin');
            echo $resp;
            }
            else if($_REQUEST['service'] == "linkAdd")
            {
                $resp="[";
                $ide = $_REQUEST['ide'];
                $idu = $_REQUEST['idu'];
            // $email = $_SESSION['user']->get_email();
            $data = openssl_random_pseudo_bytes(16, $strong);
        assert($data !== false && $strong);
        $idd = format_uuidv4($data);
            $sql = "INSERT INTO `user_exercice`(`id`,`user_id`, `exercice_id`) VALUES ('$idd','$idu','$ide')";
            if ($res = $con->query($sql) === TRUE) {
                echo 'done';
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
            }
            else if($_REQUEST['service'] == "linkAddDiet")
            {
                $resp="[";
                $ide = $_REQUEST['ide'];
                $idu = $_REQUEST['idu'];
            // $email = $_SESSION['user']->get_email();
            $data = openssl_random_pseudo_bytes(16, $strong);
        assert($data !== false && $strong);
        $idd = format_uuidv4($data);
            $sql = "INSERT INTO `user_diet`(`id`,`user_id`, `diet_id`) VALUES ('$idd','$idu','$ide')";
            if ($res = $con->query($sql) === TRUE) {
                echo 'done';
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
            }
            else if($_REQUEST['service'] == "adding")
            {
                $resp="[";
                $ide = $_REQUEST['ide'];
                $name = $_REQUEST['name'];
                $duree = $_REQUEST['duree'];
            // $email = $_SESSION['user']->get_email();
            $data = openssl_random_pseudo_bytes(16, $strong);
        assert($data !== false && $strong);
        $idd = format_uuidv4($data);
            $sql = "INSERT INTO `sessions`(`id`, `duree`, `name`,`exercice_id`) VALUES ('$idd','$duree','$name','$ide')";
            if ($res = $con->query($sql) === TRUE) {
                echo 'done';
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
            }
            else if($_REQUEST['service'] == "dislink")
            {
                $resp="[";
                $ide = $_REQUEST['ide'];
            $sql = "DELETE FROM `user_exercice` where id = '$ide'";
            if ($res = $con->query($sql) === TRUE) {
                echo 'done';
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
            }
            else if($_REQUEST['service'] == "dislinkdiet")
            {
                $resp="[";
                $ide = $_REQUEST['ide'];
            $sql = "DELETE FROM `user_diet` where id = '$ide'";
            if ($res = $con->query($sql) === TRUE) {
                echo 'done';
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
            }
            else if($_REQUEST['service'] == "statususers")
            {
                $resp="[";
                $ide = $_REQUEST['ide'];
                $to = $_REQUEST['to'];
            $sql = "UPDATE user set status = $to where id = '$ide'";
            if ($res = $con->query($sql) === TRUE) {
                echo 'done';
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
            }
            else if($_REQUEST['service'] == "deleteExercice")
            {
                $resp="[";
                $ide = $_REQUEST['ide'];
            $sql = "DELETE FROM `exercice` where id = '$ide'";
            if ($res = $con->query($sql) === TRUE) {
                echo 'done';
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
            }
            else if($_REQUEST['service'] == "link")
            {
                $resp="[";
                $ide = $_REQUEST['ide'];
            // $email = $_SESSION['user']->get_email();
            $sql = "SELECT us.*, e.*, u.id as usId FROM `user_exercice` u, exercice e, user us WHERE u.exercice_id = e.id and u.user_id = us.id and u.user_id = '$ide' order by u.created_at desc";
            
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $usi = $row["usId"];
                $name = $row["name"];
                $path = $row["image"];
                $calories = $row["calories"];
                $equipments = $row["equipments"];
                $duree = $row["duree"];
                $resp.="{\"usi\":\"$usi\",\"id\":\"$id\",\"duree\":\"$duree\",\"name\":\"$name\",\"path\":\"$path\",\"calories\":\"$calories\",\"equipments\":\"$equipments\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            // create_action('view gigs as a admin');
            echo $resp;
            }
            else if($_REQUEST['service'] == "links")
            {
                $resp="[";
                $ide = $_REQUEST['ide'];
            // $email = $_SESSION['user']->get_email();
            $sql = "SELECT us.*, e.*, u.id as usId FROM `user_diet` u, diet e, user us WHERE u.diet_id = e.id and u.user_id = us.id and u.user_id = '$ide' order by u.created_at desc";
            
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $usi = $row["usId"];
                $name = $row["name"];
                $path = $row["image"];
                $calories = $row["calories"];
                $resp.="{\"usi\":\"$usi\",\"id\":\"$id\",\"name\":\"$name\",\"path\":\"$path\",\"calories\":\"$calories\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            // create_action('view gigs as a admin');
            echo $resp;
            }
            else if($_REQUEST['service'] == "view_exercices")
            {
                $resp="[";
                $ide = $_REQUEST['ide'];
            // $email = $_SESSION['user']->get_email();
            $sql = "SELECT e.name, e.image, e.calories, e.equipments, e.duree,e.benefits,e.description, sessions.name as namee, sessions.duree as dure FROM `exercice` e LEFT JOIN sessions
            ON e.id = sessions.exercice_id WHERE e.id='$ide'";
            // echo $sql;
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $name = $row["name"];
                $names = $row["namee"];
                $path = $row["image"];
                $calories = $row["calories"];
                $equipments = $row["equipments"];
                $description = $row["description"];
                $duree = $row["duree"];
                $benefits = $row["benefits"];
                $durees = $row["dure"];
                $resp.="{\"duree\":\"$duree\",\"name\":\"$name\",\"names\":\"$names\",\"path\":\"$path\",\"calories\":\"$calories\",\"equipments\":\"$equipments\",\"durees\":\"$durees\",\"benefits\":\"$benefits\",\"description\":\"$description\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            // create_action('view gigs as a admin');
            echo $resp;
            }
            else if($_REQUEST['service'] == "gigs")
            {
                $resp="[";
            // $email = $_SESSION['user']->get_email();
            $sql = "SELECT `id`, `name`, `calories`, `equipments`, `duree`, `benefits`, `status`, `created_at`, `updated_at`, `description`, `image` FROM `exercice` order by created_at desc";
            
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $name = $row["name"];
                $path = $row["image"];
                $calories = $row["calories"];
                $equipments = $row["equipments"];
                $duree = $row["duree"];
                $resp.="{\"id\":\"$id\",\"duree\":\"$duree\",\"name\":\"$name\",\"path\":\"$path\",\"calories\":\"$calories\",\"equipments\":\"$equipments\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            // create_action('view gigs as a admin');
            echo $resp;
            }
            else if($_REQUEST['service'] == "diet")
            {
                $resp="[";
            // $email = $_SESSION['user']->get_email();
            $sql = "SELECT `id`, `name`, `description`, `recipe`, `calories`, `protein`, `fat`, `ingredients`, `image`, `status`, `created_at`, `updated_at` FROM `diet` WHERE 1";
            
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $name = $row["name"];
                $path = $row["image"];
                $calories = $row["calories"];
                $recipe = $row["recipe"];
                $protein = $row["protein"];
                $fat = $row["fat"];
                $ingredients = $row["ingredients"];
                $resp.="{\"id\":\"$id\",\"fat\":\"$fat\",\"ingredients\":\"$ingredients\",\"protein\":\"$protein\",\"name\":\"$name\",\"path\":\"$path\",\"calories\":\"$calories\",\"recipe\":\"$recipe\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            // create_action('view gigs as a admin');
            echo $resp;
            }
            else if($_REQUEST['service'] == "category")
            {
                $resp="[";
            // $email = $_SESSION['user']->get_email();
            $sql = "SELECT `id`,`domaine`,DATE_FORMAT(`created`,'%d %M %Y at %T') as created FROM `category` order by category.`created` desc";
            
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $domain = $row["domaine"];
                $created = $row["created"];
                $resp.="{\"id\":\"$id\",\"domain\":\"$domain\",\"created\":\"$created\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            // create_action('view gigs as a admin');
            echo $resp;
            }
            else if($_REQUEST['service'] == "addc")
            {
                $dom = $_REQUEST['domain'];
            $sql = "INSERT INTO `category`(`domaine`) VALUES ('$dom')";
            
            if ($res = $conn->query($sql) === TRUE) {
                echo 'done';
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            else if($_REQUEST['service'] == "deletecat")
            {
                $idg = $_REQUEST['idg'];
                $sql = "DELETE from category where id=$idg";

                if ($res = $conn->query($sql) === TRUE) {
                    echo 'done';
                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    create_action('delete a gig as a admin',null);
            }
            else if($_REQUEST['service'] == "deletegigs")
            {
                $idg = $_REQUEST['idg'];
                $sql = "DELETE from gigs where id=$idg";

                if ($res = $conn->query($sql) === TRUE) {
                    echo 'done';
                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    create_action('delete a gig as a admin',null);
            }
            
            else if($_REQUEST['service'] == "getgig")
            {
                $idg = $_REQUEST['ide'];
                $resp="[";
                $sql = "SELECT * from gigs where id=$idg";
                $result = mysqli_query($conn, $sql);
                if($row = mysqli_fetch_assoc($result)) {
                    $id = $row["id"];
                    $name = $row['name'];
                    $path = $row['path'];
                    $domaine = $row['domaine'];
                    $created = $row["created"];
                    $price = $row["price"];
                    $description = $row["description"];
                    $resp.="{\"id\":\"$id\",\"price\":\"$price\",\"name\":\"$name\",\"path\":\"$path\",\"domaine\":\"$domaine\",\"created\":\"$created\",\"description\":\"$description\"},";
                }
                        
                $resp = rtrim($resp,',');
                $resp.=']';
                create_action('edit a gig as a admin',null);
                echo $resp;
            }
            else if($_REQUEST['service'] == "activity")
            {
                $resp="[";
            $email = $_SESSION['user']->get_email();
            $sql = "SELECT * FROM 
            ( SELECT id,name,lastname,status,DATE_FORMAT(`created`,'%d %M %Y at %T') as created FROM users u 
             UNION 
             SELECT id,name,path,domaine,DATE_FORMAT(`created`,'%d %M %Y at %T') as created FROM gigs g 
            UNION
            SELECT id_mail,name,user,message,DATE_FORMAT(`created`,'%d %M %Y at %T') as created FROM mails m
            ) as lly order by created desc limit 10";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $name = $row["name"];
                $name = trim(preg_replace('/\s\s+/', ' ', $name));
                $lastname = $row["lastname"];
                $lastname = trim(preg_replace('/\s\s+/', ' ', $lastname));
                $status = $row["status"];
                $status = trim(preg_replace('/\s\s+/', ' ', $status));
                $created = $row["created"];
                $resp.="{\"id\":\"$id\",\"name\":\"$name\",\"lastname\":\"$lastname\",\"status\":\"$status\",\"created\":\"$created\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            // create_action('view last activities as a admin');
            echo $resp;
            }
            else if($_REQUEST['service'] == "mailsm")
            {
                $arr = array();
                $resp="[";
            $email = $_SESSION['user']->get_email();
            $sql = "SELECT users.name,users.lastname,users.id,mails.id_mail as idm,mails.name as mail_name,mails.email as mail_email,mails.subject,mails.message,DATE_FORMAT(mails.created,'%d %M %Y at %T') as created FROM `mails`,users WHERE user=users.id";
            $result = mysqli_query($conn, $sql);
            
            while($row = mysqli_fetch_assoc($result)) {
                $idd = $row['idm'];
                $id = $row["id"];
                $arr[$idd]=$id.':'.$row["name"].' '.$row["lastname"];
                // $id = $row["id"];
                // $name = $row["name"].' '.$row["lastname"];
                // $mailn = $row["mail_name"];
                // $email = $row["mail_email"];
                // $subject = $row["subject"];
                // $message = $row["message"];
                // $created = $row["created"];
                // $resp.="{\"id\":\"$id\",\"name\":\"$name\",\"mailn\":\"$mailn\",\"email\":\"$email\",\"subject\":\"$subject\",\"message\":\"$message\",\"created\":\"$created\"},";
            }
            
            $sql = "SELECT id_mail,name,user,email,subject,message,DATE_FORMAT(created,'%d %M %Y at %T') as created FROM `mails` order by created desc";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                if(is_null($row["user"]))
                {
                    $mailn = $row["name"];
                    $email = $row["email"];
                    $subject = $row["subject"];
                    $message = $row["message"];
                    $message = trim(preg_replace('/\s\s+/', ' ', $message));
                    $created = $row["created"];
                    $resp.="{\"mailn\":\"$mailn\",\"email\":\"$email\",\"subject\":\"$subject\",\"message\":\"$message\",\"created\":\"$created\"},";
            
                }
                else
                {
                    foreach($arr as $x=>$x_value)
                    {
                        if($row['id_mail'] == $x)
                        {
                            $name = $x_value;
                            $mailn = $row["name"];
                            $email = $row["email"];
                            $subject = $row["subject"];
                            $message = $row["message"];
                            $created = $row["created"];
                            $resp.="{\"name\":\"$name\",\"mailn\":\"$mailn\",\"email\":\"$email\",\"subject\":\"$subject\",\"message\":\"$message\",\"created\":\"$created\"},";
                            break;
                        }
                    }
                }
                }
            $resp = rtrim($resp,',');
            $resp.=']';
            // create_action('view mails received as a admin');
            echo $resp;
            }
            
        }
        
    }
    else
    {
        if($_REQUEST['service'] == "deletecart")
        {
            session_start();
            $idg = $_REQUEST['idc'];
            $sql = "DELETE from cart where id=$idg";

            if ($res = $conn->query($sql) === TRUE) {
                $idu = $_SESSION["user"]->get_id();
                $sql = "SELECT count(*) as number,sum(price*quantity) as prices
                FROM cart
                INNER JOIN users ON users.id = cart.user_id
                INNER JOIN gigs ON gigs.id = cart.gigs_id WHERE user_id=$idu";
                $result = mysqli_query($conn, $sql);
                if($row = mysqli_fetch_assoc($result)) {
                    echo $row['number'].':'.$row['prices'];
                }
                else
                {
                    echo 'error2';
                }
                } else {
                echo "error";
                }
                
        }
        else if($_REQUEST['service'] == "gigs")
            {
                $resp="[";
            // $email = $_SESSION['user']->get_email();
            $sql = "SELECT `id`,`name`,`path`,`domaine`,`price`,`updated`,DATE_FORMAT(`created`,'%d %M %Y at %T') as created FROM `gigs` order by created";
            
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $name = $row["name"];
                $path = $row["path"];
                $domain = $row["domaine"];
                $created = $row["created"];
                $price = $row["price"];
                $resp.="{\"id\":\"$id\",\"price\":\"$price\",\"name\":\"$name\",\"path\":\"$path\",\"domain\":\"$domain\",\"created\":\"$created\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            // create_action('view gigs as a admin');
            echo $resp;
            }
        else if($_REQUEST['service'] == "trash")
        {
            session_start();
            $idu = $_SESSION["user"]->get_id();
            $sql = "DELETE from cart where user_id=$idu";

            if ($res = $conn->query($sql) === TRUE) {
                $sql = "SELECT count(*) as number,sum(price*quantity) as prices
                FROM cart
                INNER JOIN users ON users.id = cart.user_id
                INNER JOIN gigs ON gigs.id = cart.gigs_id WHERE user_id=$idu";
                $result = mysqli_query($conn, $sql);
                if($row = mysqli_fetch_assoc($result)) {
                    echo $row['number'].':'.$row['prices'];
                }
                else
                {
                    echo 'error2';
                }
                } else {
                echo "error";
                }
                
        }
        else if($_REQUEST['service'] == "plusq")
        {
            session_start();
            $idg = $_REQUEST['idc'];
            $sql = "UPDATE cart
            SET quantity = quantity + 1
            WHERE id = $idg";

            if ($res = $conn->query($sql) === TRUE) {
                $idu = $_SESSION["user"]->get_id();
                $sql = "SELECT count(*) as number,sum(price*quantity) as prices
                FROM cart
                INNER JOIN users ON users.id = cart.user_id
                INNER JOIN gigs ON gigs.id = cart.gigs_id WHERE user_id=$idu";
                $result = mysqli_query($conn, $sql);
                if($row = mysqli_fetch_assoc($result)) {
                    echo $row['number'].':'.$row['prices'];
                }
                else
                {
                    echo 'error2';
                }
                } else {
                echo "error";
                }
                
        }
        else if($_REQUEST['service'] == "moinsq")
        {
            session_start();
            $idg = $_REQUEST['idc'];
            $sql = "UPDATE cart
            SET quantity = quantity - 1
            WHERE id = $idg  and quantity > 1  ";

            if ($res = $conn->query($sql) === TRUE) {
                $idu = $_SESSION["user"]->get_id();
                $sql = "SELECT count(*) as number,sum(price*quantity) as prices
                FROM cart
                INNER JOIN users ON users.id = cart.user_id
                INNER JOIN gigs ON gigs.id = cart.gigs_id WHERE user_id=$idu";
                $result = mysqli_query($conn, $sql);
                if($row = mysqli_fetch_assoc($result)) {
                    echo $row['number'].':'.$row['prices'];
                }
                else
                {
                    echo 'error2';
                }
                } else {
                echo "error";
                }
                
        }
    }
}
else if(isset($_REQUEST['name']) && isset($_REQUEST['subject']) && isset($_REQUEST['email']) && isset($_REQUEST['message']) && isset($_REQUEST['adouna']))
{
    

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    session_start();

    $email = $_REQUEST['email'];
    $subject = $_REQUEST['subject'];
    $name = $_REQUEST['name'];
    $message = $_REQUEST['message'];
    $idu = NULL;
    $ik=NULL;

    if(isset($_SESSION["user"]))
    {
        $idu = $_SESSION["user"]->get_id();
        $sql2 = "INSERT INTO `mails`(`name`,`user`, `email`, `subject`, `message`) VALUES ('$name',$idu,'$email','$subject','$message')";
    }
    else{
        $sql2 = "INSERT INTO `mails`(`name`, `email`, `subject`, `message`) VALUES ('$name','$email','$subject','$message')";
    }

    if ($conn->query($sql2) === TRUE) {
        $usr = $conn->insert_id;
        if(empty($ik))
        {
            create_action('send a mail with id '.$usr.' as unknown',null);
        }
        else
        {
            create_action('send a mail with id '.$usr.' as '.$ik,null);
        }
        
        if($_REQUEST['adouna'] == "index")
        {
            echo "the mail was sended successfly";
            $mail = new PHPMailer(true);
    
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'digital.itservices2023@gmail.com';
            $mail->Password = 'qapqkfqqogxdwrwt';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('digital.itservices2023@gmail.com','digital itservices');

            $mail->addAddress($email);
            
            $mail->isHTML(true);

            $mail->Subject = $_REQUEST['subject'];
            $mail->Body = $_REQUEST['message'];

            $mail->send();
        }
        else{
            echo 'the mail was sended successfly'; 
        }
        
    } else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
    }

    

    
    
    
    

}
else if(isset($_REQUEST['adouna']) && isset($_REQUEST['domain']))
{
    $resp="[";
    $domain = $_REQUEST['domain'];
    $sql = "SELECT `id`, `name`, `path`, `domaine`, `price`, `created`, `updated` FROM `gigs` WHERE domaine like '$domain'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $name = $row["name"];
        $path = $row["path"];
        $domain = $row["domaine"];
        $created = $row["created"];
        $price = $row["price"];
        $resp.="{\"id\":\"$id\",\"price\":\"$price\",\"name\":\"$name\",\"path\":\"$path\",\"domain\":\"$domain\",\"created\":\"$created\"},";
    }
    $resp = rtrim($resp,',');
    $resp.=']';
    // create_action('view users as a admin');
    echo $resp;
}
else if(isset($_REQUEST['adouna']) && isset($_REQUEST['service']) && isset($_REQUEST['email']) && isset($_REQUEST['message']))
{
    session_start();
    $idu = $_SESSION["user"]->get_id();
    $service = $_REQUEST['service'];
    $email = $_REQUEST['email'];
    $message = $_REQUEST['message'];

    $sql2 = "INSERT INTO `cart`(`user_id`, `gigs_id`, `email`, `message`) VALUES ($idu,$service,'$email','$message')";

    if ($conn->query($sql2) === TRUE) {
        $sql = "SELECT count(*) as number,sum(price*quantity) as prices
        FROM cart
        INNER JOIN users ON users.id = cart.user_id
        INNER JOIN gigs ON gigs.id = cart.gigs_id WHERE user_id=$idu and cart.status is null";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($result)) {
            echo $row['number'].':'.$row['prices'];
        }
        else
        {
            echo 'error';
        }
    }
    else
    {
        echo 'no';
    }

}
else if(isset($_REQUEST['typeu']))
{
    $user = new User($_REQUEST['first'],$_REQUEST['last'],$_REQUEST['email'],$_REQUEST['password']);

    if($user->check())
    {
        $name = $_REQUEST['first'];
        $last = $_REQUEST['last'];
        $email =  $_REQUEST['email'];
        $password =  $_REQUEST['password'];

        $sql = "INSERT INTO `users`(`name`, `lastname`, `email`, `password`) VALUES ('$name','$last','$email','$password')";

        if ($res = $conn->query($sql) === TRUE) {
            $usr = $conn->insert_id;
            if($_REQUEST['typeu']=='Admin')
            {
                $sql2 = "INSERT INTO `users_role`(`user_id`, `id_role`) VALUES ($usr,1),($usr,2)";
            }
            else{
                $sql2 = "INSERT INTO `users_role`(`user_id`, `id_role`) VALUES ($usr,1)";
            }
            
            // echo $sql2;
            if ($conn->query($sql2) === TRUE) {

            }
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        echo 'yes';
    }
    else{
        echo 'no';
    }
}
else if(isset($_FILES["fille"]))
{
    session_start();
    if($_FILES["fille"]["name"] != '')
    {
        echo $_FILES["fille"]["name"];
        $email = $_REQUEST['email'];
        $method = $_REQUEST['methode'];
        $ip = $GLOBALS["ip"];
        $id =  $_SESSION['user']->get_id();
        $test = explode('.', $_FILES["fille"]["name"]);
        $ext = end($test);
        $name = "2".rand(1, 9999999) . '.' . $ext;
        $location = './assets/images/' . $name;  
        move_uploaded_file($_FILES["fille"]["tmp_name"], $location);
        
        $sql = "INSERT INTO `pay`(`amount`, `email`, `method`, `image`, `adresse_ip`) VALUES ((SELECT sum(price*quantity) as prices
        FROM cart
        INNER JOIN users ON users.id = cart.user_id
        INNER JOIN gigs ON gigs.id = cart.gigs_id WHERE user_id=$id and cart.status is null),'$email','$method','$location','$ip')";
        echo $location;
        if ($conn->query($sql) === TRUE) {
            $usr = $conn->insert_id;
            $sql = "INSERT INTO `pay_cart`(`pay`,`cart`) select $usr,id from cart where user_id=$id and cart.status is null";
            if ($conn->multi_query($sql) === TRUE) {
                $sqll = "UPDATE `cart` SET `status`=1 WHERE `user_id` = $id and status is null";
        if ($conn->query($sqll) === TRUE) {
                try {
                    require 'phpmailer/src/Exception.php';
                    require 'phpmailer/src/PHPMailer.php';
                    require 'phpmailer/src/SMTP.php';
                    $mail = new PHPMailer(true);
    
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'digital.itservices2023@gmail.com';
                    $mail->Password = 'qapqkfqqogxdwrwt';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('digital.itservices2023@gmail.com','digital itservices');

                    $mail->addAddress($email);
                    
                    $mail->isHTML(true);

                    $mail->Subject = 'Payment check';
                    $mail->Body = '<b>Proof of payment has been sent to the administrator it can take up to 24 hours to respond</b><a href="https://digitalit.services/login">Go to the siteweb</a>';

                    $mail->send();
                    header("Location: pay?message=success");
                } catch (\Throwable $th) {
                    header("Location: pay?message=success");
                }
                header("Location: pay?message=success");
            }} else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            
        }
    }
    }
    
}


$conn->close();

?>