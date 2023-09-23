<?php
            include 'user.php';
            include 'connection.php';
            session_start();
            if(isset($_SESSION["user"]))
            {
                $role='User';
                foreach ($_SESSION["user"]->get_roles() as $value) {
                    if($value == 'ROLE_ADMIN')
                    {
                        $role = 'Admin';
                    }
                    }
                    if($role=='Admin')
                    {
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User management</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/logo.png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        input,select{
            background:white !important;
            margin-top:20px;
            color:black !important;
        }
        button{
            margin-top:20px;
        }
        ::-webkit-scrollbar {
    width: 0;  /* Remove scrollbar space */
    background: transparent;  /* Optional: just make scrollbar invisible */
}
/* Optional: show position indicator in red */
::-webkit-scrollbar-thumb {
    background: black;
}
    </style>
</head>

<body style="overflow-x:hidden">
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
            <a href="home" class="navbar-brand mx-4 mb-3" style="display: block;text-align: center;width: 100%;">
                    <img src="assets/images/logo.png" alt="logo" style="width: 73px;">
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/unknown.png" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION["user"]->get_name()." ".$_SESSION["user"]->get_last(); ?></h6>
                        <span><?php foreach ($_SESSION["user"]->get_roles() as $value) {
                        if($value == 'ROLE_ADMIN')
                        {
                            $role = 'Admin';
                        }
                        } echo $role; ?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="home" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <?php if($role=='Admin'){ ?>
                    <div class="nav-item ">
                        <a href="users" class="nav-item nav-link active"><i class="fa fa-laptop me-2"></i>Users</a>
                        <!-- <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div> -->
                    </div>
                    <?php } ?>
                    <?php if($role=='Admin'){ ?>
                    <a href="exercices" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Exercices</a>
                    <?php } ?>
                    <?php if($role=='Admin'){ ?>
                    <a href="diet" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Diets</a>
                    <?php } ?>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div> -->
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="home" class="navbar-brand d-flex d-lg-none me-4" style="display: block;text-align: center;width: 100%;">
                <img src="assets/images/logo.png" alt="logo" style='width: 45px;'>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                    
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/unknown.png" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION["user"]->get_name()." ".$_SESSION["user"]->get_last(); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="logout" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="row" style="padding-left: 10px;">
                <div class="offset-md-2 col-md-8" style="margin-top:50px;margin-bottom:50px;box-shadow: 0 0 10px #eee;padding:5px;overflow:auto">
                <div class="row">
                    <div class="offset-1 col-10">
                        <h2 style='text-align:center;' onclick="user()">users management:</h2>
                        
                    </div> 
                    <div class="col-1" style="margin:auto">
                    <!-- <i class="fa fa-plus" aria-hidden="true" onclick='add_user()' style="color:green;cursor:pointer"></i> -->
                    </div>
                </div>
                <div class="row" style="margin-bottom:30px">
                    <div class="offset-md-1 col-md-10"><input type="text" class="form-control" onkeyup="search(this)"/><input type="checkbox" onclick="accp(this)" /> Accepted only</div>
                    
                </div>
                <table class="table" style='border: 2px solid white;margin-bottom:0'>
  <thead class="thead-dark" style='border: 2px solid white;'>
    <tr>
      <th scope="col">id</th>
      <th scope="col">FirstName</th>
      <th scope="col">LastName</th>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody id="users" style="    border-style: none !important;">
    
  </tbody>
</table>

                </div>
            </div>
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <div id="full" style="position:fixed;top:0;left:0;width:100%;height:100%;background:red;    background: rgba(120,120,120,0.5);z-index: 9999;display:none;    overflow: auto;">
            <div class="row" style="margin-top:20px">
                <div class="offset-md-2 col-md-8">
                    <div class="row" style="margin-bottom:25px">
                        <div class="offset-1 col-10">
                        <h2 style="text-align:center;border:2px solid">Show user</h2>
                        </div>
                        <div class="col-1" style="margin:auto">
                        <p onclick="exit()" style="color:white;font-weight:bold;cursor:pointer">X</p>
                        </div>
                    </div>
                
                
                    <div class="row">
                        <div class="col-md-6">
                        <label style="color:white; margin-top: 10px">name</label>
                            <input style='margin-top:0' type="text" name="email" id="name_s" placeholder="Name" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                        <label style="color:white; margin-top: 10px">lastname</label>
                        <input style='margin-top:0' type="text" name="email" id="last_s" placeholder="Lastname" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <label style="color:white; margin-top: 10px">email</label>
                            <input style='margin-top:0' type="text" id="email_s" name="name" placeholder="Email" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4">
                    <label style="color:white; margin-top: 10px">taille</label>
                            <input style='margin-top:0' type="text" id="taille_s" name="lastname" placeholder="Taille" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                        <label style="color:white; margin-top: 10px">age</label>
                            <input style='margin-top:0' type="text" id="age_s" name="lastname" placeholder="Age" class="form-control" disabled>
                        </div>
                        <div class="col-md-4">
                        <label style="color:white; margin-top: 10px">poids</label>
                            <input style='margin-top:0' type="text" id="poids_s" name="lastname" placeholder="Poids" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <label style="color:white; margin-top: 10px">gender</label>
                            <input style='margin-top:0' type="text" id="gender_s" name="lastname" placeholder="Gender" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                        <label style="color:white; margin-top: 10px">blessure</label>
                            <input style='margin-top:0' type="text" id="blessure_s" name="lastname" placeholder="Blessure" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <label style="color:white; margin-top: 10px">objectif</label>
                            <input style='margin-top:0' type="text" id="objectif_s" name="password" placeholder="Password" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                        <label style="color:white; margin-top: 10px">created_at</label>
                            <input style='margin-top:0' type="text" id="created_s" name="password" placeholder="Created_at" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <label style="color:white; margin-top: 10px">updated_at</label>
                    <input style='margin-top:0' type="text" id="updated_s" name="password" placeholder="Updated_at" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <label style="color:white; margin-top: 10px">status</label>
                            <input style='margin-top:0' type="text" id="status_s" name="lastname" placeholder="Status" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                        <label style="color:white; margin-top: 10px">type</label>
                            <input style='margin-top:0' type="text" id="type_s" name="lastname" placeholder="Type" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="fully" style="position:fixed;top:0;left:0;width:100%;height:100%;background:red;    background: rgba(120,120,120,0.5);z-index: 9999;display:none;    overflow: auto;">
        <div onclick="exit()" style="text-align:right;color:white;font-weight:bold;cursor:pointer">X</div>
            <div class="row" style="margin-top:20px">
                <div class="offset-md-1 col-md-4">
                    <div class="row" style="margin-bottom:25px">
                        <div class="card">
                            <div class="card-body">
                                <h5 style="color:black">Liste of exercices:</h5>
                                <input type="text" class="form-control" onkeyup="filter(this)"/>
                            <?php $sql = "SELECT `id`, `name`, `calories`, `equipments`, `duree`, `benefits`, `status`, `created_at`, `updated_at`, `description`, `image` FROM `exercice` order by created_at desc";
            
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<p class='namess'><b class='nmse'>".$row['name']."</b><b style='display: block;float: right;color:green;cursor:pointer' onclick=\"addLink('".$row['id']."')\">+</b></p>";
             } ?>
                            </div>
                        </div>
                    </div>
                </div>
  <div class="offset-md-2 col-md-4">
                    <div class="row" style="margin-bottom:25px">
                    <div class="card">
            <div class="card-body" id="idida">
                
            </div>
</div>
                    
                </div>
            </div>
        </div>
        </div>

        <div id="fullp" style="position:fixed;top:0;left:0;width:100%;height:100%;background:red;    background: rgba(120,120,120,0.5);z-index: 9999;display:none;    overflow: auto;">
        <div onclick="exit()" style="text-align:right;color:white;font-weight:bold;cursor:pointer">X</div>
            <div class="row" style="margin-top:20px">
                <div class="offset-md-1 col-md-4">
                    <div class="row" style="margin-bottom:25px">
                        <div class="card">
                            <div class="card-body">
                                <h5 style="color:black">Liste of diets:</h5>
                                <input type="text" class="form-control" onkeyup="filter(this)"/>
                            <?php $sql = "SELECT `id`, `name`, `description`, `recipe`, `calories`, `protein`, `fat`, `ingredients`, `image`, `status`, `created_at`, `updated_at` FROM `diet` WHERE 1";
            
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<p class='namess'><b>".$row['name']."</b><b style='display: block;float: right;color:green;cursor:pointer' onclick=\"addLinkDiet('".$row['id']."')\">+</b></p>";
             } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="offset-md-2 col-md-4">
                                    <div class="row" style="margin-bottom:25px">
                                    <div class="card">
                            <div class="card-body" id="idida2">
                                
                            </div>
                </div>
                    
                </div>
            </div>
        </div>
        </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        let id_i = null;
        let id_u = null;

             function accp(e) {
                if(e.checked) {
                    const A = document.getElementsByClassName('names');
                    for (let i = 0; i < A.length; i++) {
                        if(A[i].parentElement.children[4].children[0].textContent != 'Accepted') {
                            A[i].parentElement.style.display = 'none'
                        }
                        else {
                            A[i].parentElement.style.display = 'table-row'
                        }
                    }
                }
                else {
                    const A = document.getElementsByClassName('names');
                    for (let i = 0; i < A.length; i++) {
                            A[i].parentElement.style.display = 'table-row'
                        
                    }
                }
                
             }

        function search(e)
        {
            const A = document.getElementsByClassName('names');
            for (let i = 0; i < A.length; i++) {
                if(A[i].textContent.toLocaleUpperCase().includes(e.value.toLocaleUpperCase()))
                {
                    A[i].parentElement.style.display = 'table-row'
                }
                else {
                    A[i].parentElement.style.display = 'none'
                }
            }
        }

        function user()
        {
            var A = document.getElementsByClassName('nmse')
            var B = document.getElementsByClassName('nmss')
            
            for (let i = 0; i < A.length; i++) {
                for (let j = 0; j < B.length; j++) {
                    if(A[i].textContent == B[j].textContent) {
                        A[i].parentElement.children[1].style.color = 'gray'
                    }
                }
                
            }
            document.getElementById('users').innerHTML="";
            $.post('controller', {service:'users', type:'<?php echo $role; ?>'}).done(function(response){
            obj = JSON.parse(response);
            for (let i = 0; i < obj.length; i++) {
                var rol="User";
                let stats = 'pending'
                let color = 'orange'
                if(obj[i].status == 1)
                {
                    stats = 'Pending'
                    color = 'orange'
                }
                else if(obj[i].status == 2) {
                    stats = 'Accepted'
                    color = 'green'
                }
                else {
                    stats = 'Refused'
                    color = 'red'
                }
                document.getElementById('users').innerHTML+='<tr><th scope="row">'+obj[i].id+'</th> <td class="names">'+obj[i].name+'</td><td>'+obj[i].last+'</td><td>'+obj[i].email+'</td><td><p style="color:'+color+'">'+stats+'</p><b style="cursor:pointer;color:green" onclick="accept(\''+obj[i].id+'\', this)">✓</b><b style="cursor:pointer;color:red" onclick="rejet(\''+obj[i].id+'\', this)">X</b></td><td><i class="fa fa-eye" style="color:white;cursor:pointer" onclick="add_user(\''+obj[i].name+'\',\''+obj[i].last+'\',\''+obj[i].email+'\',\''+obj[i].poids+'\',\''+obj[i].taille+'\',\''+obj[i].blessure+'\',\''+obj[i].objectif+'\',\''+obj[i].created_at+'\',\''+obj[i].updated_at+'\',\''+obj[i].status+'\',\''+obj[i].gender+'\',\''+obj[i].age+'\',\''+obj[i].type+'\')"></i><div><i class="fas fa-running" style="color:blue;cursor:pointer" onclick="add_exercice(\''+obj[i].id+'\',\''+obj[i].name+'\',\''+obj[i].last+'\',\''+obj[i].email+'\',\''+obj[i].poids+'\',\''+obj[i].taille+'\',\''+obj[i].blessure+'\',\''+obj[i].objectif+'\',\''+obj[i].created_at+'\',\''+obj[i].updated_at+'\',\''+obj[i].status+'\',\''+obj[i].gender+'\',\''+obj[i].age+'\',\''+obj[i].type+'\')"></i></div><div><i class="fas fa-hamburger" style="color:brown;cursor:pointer" onclick="unlocked(\''+obj[i].id+'\',\''+obj[i].name+'\',\''+obj[i].last+'\',\''+obj[i].email+'\',\''+obj[i].poids+'\',\''+obj[i].taille+'\',\''+obj[i].blessure+'\',\''+obj[i].objectif+'\',\''+obj[i].created_at+'\',\''+obj[i].updated_at+'\',\''+obj[i].status+'\',\''+obj[i].gender+'\',\''+obj[i].age+'\',\''+obj[i].type+'\')"></i></div></td></tr>'
            }
});
        }

        function unlocked(id) {
            id_u = id
            document.getElementById('idida2').innerHTML = '<h5 style="color:black">Diets affected:</h5>';
            $.post('controller', {service:'links',ide: id, type:'<?php echo $role; ?>'}).done(function(response){
            
                obj = JSON.parse(response);
            for (let i = 0; i < obj.length; i++) {
                document.getElementById('idida2').innerHTML += '<p><span class="nmss">'+obj[i].name+'</span><b style="display: block;float: right;color:red;cursor:pointer" onclick=\"deleteLinkDiet(\''+obj[i].usi+'\')\">x</b></p>'
            }
});
var A = document.getElementsByClassName('nmse')
            var B = document.getElementsByClassName('nmss')
            
            for (let i = 0; i < A.length; i++) {
                for (let j = 0; j < B.length; j++) {
                    if(A[i].textContent == B[j].textContent) {
                        A[i].parentElement.children[1].style.color = 'gray'
                    }
                }
                
            }
            document.getElementById('fullp').style.display = 'block'
        }

        function accept(id, e) {
            $.post('controller', {service:'statususers',ide: id,to: 2, type:'<?php echo $role; ?>'}).done(function(response){
            if(response == 'done')
            {
                e.parentElement.children[0].textContent = 'Accepted'
                e.parentElement.children[0].style.color = 'green'
            }
            
});
        }

        function rejet(id, e) {
            $.post('controller', {service:'statususers',ide: id,to: 0, type:'<?php echo $role; ?>'}).done(function(response){
            if(response == 'done')
            {
                e.parentElement.children[0].textContent = 'Rejeted'
                e.parentElement.children[0].style.color = 'red'
            }
            
});
        }

        function add_user(name,lastname,email,poids,taille,blessure,objectif,created_at,updated_at,status,gender,age,type)
        {
            document.getElementById('name_s').value=name;
                    document.getElementById('email_s').value=email;
                    document.getElementById('last_s').value=lastname;
                    document.getElementById('taille_s').value=taille;
                    document.getElementById('blessure_s').value=blessure;
                    document.getElementById('objectif_s').value=objectif;
                    document.getElementById('poids_s').value=poids;
                    document.getElementById('status_s').value=status;
                    document.getElementById('gender_s').value=gender;
                    document.getElementById('age_s').value=age;
                    document.getElementById('type_s').value=type;
                    document.getElementById('created_s').value=created_at;
                    document.getElementById('updated_s').value=updated_at;
            document.getElementById('full').style.display = "block";
        }

        function addLink(id) {
            $.post('controller', {service:'linkAdd',ide: id,idu: id_i, type:'<?php echo $role; ?>'}).done(function(response){
           
                if(response == 'done') {
                add_exercice(id_i)
            }
});
        }

        function addLinkDiet(id) {
            $.post('controller', {service:'linkAddDiet',ide: id,idu: id_u, type:'<?php echo $role; ?>'}).done(function(response){
           
                if(response == 'done') {
                    unlocked(id_u)
            }
});
        }

        function deleteLink(id) {
            $.post('controller', {service:'dislink',ide: id, type:'<?php echo $role; ?>'}).done(function(response){
            if(response == 'done') {
                add_exercice(id_i)
            }
});
        }

        function deleteLinkDiet(id) {
            $.post('controller', {service:'dislinkdiet',ide: id, type:'<?php echo $role; ?>'}).done(function(response){
            if(response == 'done') {
                unlocked(id_u)
            }
});
        }

        function add_exercice(id)
        {
            id_i = id;
            document.getElementById('idida').innerHTML = '<h5 style="color:black">Exercices affected:</h5>';
            $.post('controller', {service:'link',ide: id, type:'<?php echo $role; ?>'}).done(function(response){
            obj = JSON.parse(response);
            for (let i = 0; i < obj.length; i++) {
                document.getElementById('idida').innerHTML += '<p><span class="hihi">'+obj[i].name+'</span><b style="display: block;float: right;color:red;cursor:pointer" onclick=\"deleteLink(\''+obj[i].usi+'\')\">x</b></p>'
            }
            document.getElementById('fully').style.display = "block";
            var A = document.getElementsByClassName('nmse')
            var B = document.getElementsByClassName('hihi')
            
            for (let i = 0; i < A.length; i++) {
                for (let j = 0; j < B.length; j++) {
                    console.log(B[j].textContent + ' ' + A[i].textContent)
                    if(A[i].textContent == B[j].textContent) {
                        A[i].parentElement.children[1].style.color = 'gray'
                        break;
                    }
                    else {
                        A[i].parentElement.children[1].style.color = 'green'
                    }
                }
                
            }
});
            
        }

        function filter(a)
        {
            const A = document.getElementsByClassName('namess')
            for (let i = 0; i < A.length; i++) {
                if(!(A[i].children[0].textContent.toLocaleUpperCase().includes(a.value.toLocaleUpperCase()))) {
                    A[i].style.display = 'none'
                }
                else {
                    A[i].style.display = 'block' 
                }
            }
        }

        function exit()
        {
            document.getElementById('full').style.display = "none";
            document.getElementById('fully').style.display = "none";
            document.getElementById('fullp').style.display = "none";
        }

        function upload()
        {
            var form_data = new FormData();
            form_data.append("first", document.getElementById('name').value);
            form_data.append("email", document.getElementById('email').value);
            form_data.append("last", document.getElementById('lastname').value);
            form_data.append("password", document.getElementById('password').value);
            form_data.append("typeu", document.getElementById('type').value);
            $.ajax({
                url:"controller",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    document.getElementById('uploaded_image').style.display = 'block';
                $('#uploaded_image').html("<label class='text-success'>User Added...</label>");
                },   
                success:function(response)
                {
                    document.getElementById('uploaded_image').style.display = 'none';
                    document.getElementById('name').value='';
                    document.getElementById('email').value='';
                    document.getElementById('lastname').value='';
                    document.getElementById('password').value='';
                    document.getElementById('type').value='User';
                exit();
                user();
                }
            });
        }

        window.onload = function()
        {
            user();
        }
    </script>
</body>

</html>
<?php
                    }
            }
            ?>