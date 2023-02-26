<?php
include 'user.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./ressources/bootstrap/css/bootstrap.css"/> 
    <link rel="stylesheet" href="./ressources/css/login.css"/>
    <script src="jquery.min.js"></script>
    <style>
        body{
            background-image: url('https://w0.peakpx.com/wallpaper/996/216/HD-wallpaper-rocket-on-a-blue-background-blue-lines-rocket-startup-blue-background-startup-concepts-rocket-neon-light-rocket.jpg');
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
        .card{
            background:transparent;
            color:white;
            padding:0;
        }
        .card-body{
            padding:0;
        }
        label{
            margin-top:10px
        }
        html{
            height: fit-content;
            min-height: -webkit-fill-available;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="text-align: center;">
                <img src="./assets/images/logo.png" alt="" style="width: 300px;height: inherit;text-align: center;">
                <form action="controller.php" method="post">
                <div class="card">
      <div class="card-body" style="text-align:left">
            <?php if(!isset($_REQUEST['email']) && !isset($_REQUEST['username']) && !isset($_REQUEST['error']) && !isset($_REQUEST['us'])){ ?>
            <div class="alert alert-info" role="alert">
            Account activation does not need to verify the email, you must remember the username to log in
            </div>
            <?php }else if(isset($_REQUEST['email'])){ ?>
                <div class="alert alert-danger" role="alert">
                    Email already exist
                </div>
                <?php }else if(isset($_REQUEST['us'])){ ?>
                <div class="alert alert-danger" role="alert">
                    Username already exist
                </div>
                <?php }else if(isset($_REQUEST['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                The value must be 3 or more characters long
                </div>
                <?php }else if(isset($_REQUEST['username'])){ ?>
                <div class="alert alert-danger" role="alert">
                    Username must be 3 or more characters long
                </div>
            <?php } ?>
            
            <label for="first">First name</label>
            <input type="text" name="first" class="form-control" value="<?php if(isset($_REQUEST['email']) || isset($_REQUEST['username']) || isset($_REQUEST['error']) || isset($_REQUEST['us'])){
             if(isset($_SESSION['prov']))
            {
                echo $_SESSION['prov']->get_name();
            }} ?>">
            <label for="last">Last name</label>
            <input type="text" name="last" class="form-control" value="<?php if(isset($_REQUEST['email']) || isset($_REQUEST['username']) || isset($_REQUEST['error']) || isset($_REQUEST['us'])){ if(isset($_SESSION['prov']))
            {
                echo $_SESSION['prov']->get_last();
            }} ?>">
            <label for="last">Username</label>
            <input type="text" name="username" class="form-control" value="<?php if(isset($_REQUEST['email']) || isset($_REQUEST['username']) || isset($_REQUEST['error']) || isset($_REQUEST['us'])){ if(isset($_SESSION['username']))
            {
                echo $_SESSION['username'];
            }} ?>">
            <label for="email">email</label>
            <input type="text" name="email" class="form-control" value="<?php if(isset($_REQUEST['email']) || isset($_REQUEST['username']) || isset($_REQUEST['error']) || isset($_REQUEST['us'])){ if(isset($_SESSION['prov']))
            {
                echo $_SESSION['prov']->get_email();
            }} ?>">
            <label for="password">password</label>
            <input type="password" name="password" class="form-control">
        
      </div>
      <div class="card-footer">
        <input type="submit" value="register" class="btn btn-success">
      </div>
    </div>
    </form>
            </div>
        
        </div>
    </div>
</body>
</html>