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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3" style="text-align: center;">
                <img src="./assets/images/logo.png" alt="" style="width: 300px;height: inherit;text-align: center;">
                <form  action="controller.php" method="post">
                <div class="card">
      <div class="card-body" style="text-align:left">
        
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control">
        
      </div>
      <div class="card-footer">
        <input type="submit" value="login" class="btn btn-success">
      </div>
      <div class="card-footer">
        <a href="register" class="btn btn-info">REGISTER</a>
      </div>
    </div>
    </form>
            </div>
        
        </div>
    </div>
</body>
</html>