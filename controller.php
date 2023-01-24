<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'connect.php';
include 'user.php';

//SELECT count(*),DATE_FORMAT(`created`,'%d %M %Y') as created FROM `mails` GROUP BY day(`created`)


if(isset($_REQUEST['first']) && isset($_REQUEST['last']) && isset($_REQUEST['email']) && isset($_REQUEST['password']) && !isset($_REQUEST['typeu']))
{
    session_start();
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
            $sql2 = "INSERT INTO `users_role`(`user_id`, `id_role`) VALUES ($usr,1)";
            // echo $sql2;
            if ($conn->query($sql2) === TRUE) {
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
                header("Location: home");
            }
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
else if(!isset($_REQUEST['first']) && !isset($_REQUEST['last']) && isset($_REQUEST['email']) && isset($_REQUEST['password']))
{
    session_start();
    $email =  $_REQUEST['email'];
    $password =  $_REQUEST['password'];
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
    header("Location: home");
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
            $sql = "SELECT users.id,users.name,users.lastname,users.email,GROUP_CONCAT(role.role_name SEPARATOR ' ') as roles
            FROM users
            INNER JOIN users_role ON users.id = users_role.user_id
            INNER JOIN role ON role.role_id = users_role.id_role
            group by users.id";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $name = $row["name"];
                $lastname = $row["lastname"];
                $email = $row["email"];
                $roles = $row["roles"];
                $resp.="{\"id\":\"$id\",\"name\":\"$name\",\"last\":\"$lastname\",\"email\":\"$email\",\"roles\":\"$roles\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            echo $resp;
            }
            else if($_REQUEST['service'] == "gigs")
            {
                $resp="[";
            $email = $_SESSION['user']->get_email();
            $sql = "SELECT `id`,`name`,`path`,`domaine`,`updated`,DATE_FORMAT(`created`,'%d %M %Y at %T') as created FROM `gigs` order by created";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $name = $row["name"];
                $path = $row["path"];
                $domain = $row["domaine"];
                $created = $row["created"];
                $resp.="{\"id\":\"$id\",\"name\":\"$name\",\"path\":\"$path\",\"domain\":\"$domain\",\"created\":\"$created\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
            echo $resp;
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
                $lastname = $row["lastname"];
                $status = $row["status"];
                $created = $row["created"];
                $resp.="{\"id\":\"$id\",\"name\":\"$name\",\"lastname\":\"$lastname\",\"status\":\"$status\",\"created\":\"$created\"},";
            }
            $resp = rtrim($resp,',');
            $resp.=']';
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
            echo $resp;
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

    if(isset($_SESSION["user"]))
    {
        $idu = $_SESSION["user"]->get_id();
        $sql2 = "INSERT INTO `mails`(`name`,`user`, `email`, `subject`, `message`) VALUES ('$name',$idu,'$email','$subject','$message')";
    }
    else{
        $sql2 = "INSERT INTO `mails`(`name`, `email`, `subject`, `message`) VALUES ('$name','$email','$subject','$message')";
    }

    if ($conn->query($sql2) === TRUE) {
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


$conn->close();

?>