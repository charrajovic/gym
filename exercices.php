<?php
            include 'user.php';
            session_start();
            include 'connect.php';
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
    <title>Exercices management</title>
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
    <style>
        input{
            background:white !important;
            margin-bottom:15px
        }
    </style>
    <style>
        input,select,textarea{
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
label {
    color: white
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
                        <a href="users" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>Users</a>
                        <!-- <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div> -->
                    </div>
                    <?php } ?>
                    <?php if($role=='Admin'){ ?>
                    <a href="exercices" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>Exercices</a>
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
            <div class="row">
                <div class="col-md-12" style="padding:0">
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
                </div>
            </div>
            
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="row" style='padding-left: 18px;padding-right: 5px;'>
                <div class="offset-md-2 col-md-8" style="margin-top:50px;margin-bottom:50px;    box-shadow: 0 0 10px #eee;padding:5px;overflow:auto">
                <div class="row" style="margin-bottom:30px">
                    <div class="offset-md-1 col-md-10">
                        <h2 style='text-align:center;' onclick="user()">Exercices management:</h2>
                        
                    </div> 
                    <div class="col-md-1" style="margin:auto">
                    <i class="fa fa-plus" aria-hidden="true" onclick='add_gigs()' style="color:green;cursor:pointer"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" placeholder="Search" id="search" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <select name="domain" id="domain" class="form-control">
                            <option value="all">All</option>
                        </select>
                    </div>
                </div>
                
                
                <table id="users" style="width:100% !important;text-align:center">
                <tr>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Calories</th>
                    <th>Equipments</th>
                    <th>Duree</th>
                    <th></th>
                </tr>  
                </table>
                <nav aria-label="..." style="float:right">
                <ul class="pagination" style="    margin-top: 20px;margin-bottom: 0;">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    
                    <p id="pagi" style="display: contents;">

                    </p>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
                </nav>
                </div>
                
            </div>
        </div>
        <!-- Content End -->
        


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <div id="full" style="position:fixed;top:0;left:0;width:100%;height:100%;background:red;    background: rgba(120,120,120,0.5);z-index: 9999;display:none;overflow:auto">
            <div class="row" style="margin-top:20px">
                <div class="offset-md-2 col-md-8">
                    <div class="row" style="margin-bottom:25px">
                        <div class="offset-1 col-10">
                        <h2 style="text-align:center;border:2px solid">Add exercice:</h2>
                        </div>
                        <div class="col-1" style="margin:auto">
                        <p onclick="exit()" style="color:white;font-weight:bold;cursor:pointer;;text-align:center">X</p>
                        </div>
                    </div>
                
                
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                        </div>
                        <div class="col-md-6">
                        <input type="number" id="calories" name="calories" placeholder="calories" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <input type="file" id="file" name="imge" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <p id="uploaded_image" style="display:none"></p>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <input type="number" id="duree" name="duree" placeholder="duree" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <input type="text" id="benefits" name="benefits" placeholder="benefits" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <textarea id="equipments" name="equipments" placeholder="equipments" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <textarea id="description" name="description" placeholder="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-btn text-center">
                            <button class="btn btn-success" onclick='upload()' type="button">Add exercice</button>
                            <p id="form-message"></p>
                        </div>
                </div>
            </div>
        </div>
        <div id="full2" style="position:fixed;top:0;left:0;width:100%;height:100%;background:red;    background: rgba(120,120,120,0.5);z-index: 9999;display:none;overflow:auto">
            <div class="row" style="margin-top:20px">
                <div class="offset-md-2 col-md-8">
                    <div class="row" style="margin-bottom:25px">
                        <div class="offset-1 col-10">
                        <h2 style="text-align:center;border:2px solid">Edit gigs:</h2>
                        </div>
                        <div class="col-1" style="margin:auto">
                        <p onclick="exit()" style="color:white;font-weight:bold;cursor:pointer;text-align:center">X</p>
                        </div>
                    </div>
                
                
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" id="name2" placeholder="Name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <select name="domain" id="domain2" class="form-control">
                                <?php $sql = "SELECT `id`,`domaine`,DATE_FORMAT(`created`,'%d %M %Y at %T') as created FROM `category` order by category.`created` desc";
            
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row['domaine']; ?>"><?php echo $row['domaine']; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <input type="number" id="price2" name="price2" placeholder="Price" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <img src="" id="path2" style="width: inherit;    height: 300px;">
                        </div>
                    </div>
                    <div class="col-md-12">
                            <input type="file" id="file2" name="imge" class="form-control">
                        </div>
                    
                    <div class="row">
                    <div class="col-md-12">
                            <textarea id="description2" name="description" placeholder="Description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <p id="uploaded_image" style="display:none"></p>
                        </div>
                    </div>

                    
                    <div class="form-btn text-center">
                            <button class="btn btn-success" onclick='edit()' type="button" style="margin-top: 10px;">Modify</button>
                            <p id="form-message"></p>
                        </div>
                </div>
            </div>
        </div>

        <div id="fullm" style="position:fixed;top:0;left:0;width:100%;height:100%;background:red;    background: rgba(120,120,120,0.5);z-index: 9999;display:none;overflow:auto">
            <div class="row" style="margin-top:20px">
                <div class="offset-md-2 col-md-8">
                    <div class="row" style="margin-bottom:25px">
                        <div class="offset-1 col-10">
                        <h2 style="text-align:center;border:2px solid">Add session to exercice:</h2>
                        </div>
                        <div class="col-1" style="margin:auto">
                        <p onclick="exit()" style="color:white;font-weight:bold;cursor:pointer;text-align:center">X</p>
                        </div>
                    </div>
                
                
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" id="name3" placeholder="Name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type='number' name="duree" id='duree3'  placeholder="Duree" class="form-control"/>
                        </div>
                    </div>
                    
                    <div class="form-btn text-center">
                            <button class="btn btn-success" onclick='adding()' type="button" style="margin-top: 10px;">Add</button>
                            <p id="form-message"></p>
                        </div>
                </div>
            </div>
        </div>

        <div id="fullmd" style="position:fixed;top:0;left:0;width:100%;height:100%;background:red;    background: rgba(120,120,120,0.5);z-index: 9999;display:none;overflow:auto">
            <div class="row" style="margin-top:20px">
                <div class="offset-md-2 col-md-8">
                    <div class="row" style="margin-bottom:25px">
                        <div class="offset-1 col-10">
                        <h2 style="text-align:center;border:2px solid">Link video to exercice:</h2>
                        </div>
                        <div class="col-1" style="margin:auto">
                        <p onclick="exit()" style="color:white;font-weight:bold;cursor:pointer;text-align:center">X</p>
                        </div>
                    </div>
                
                
                    <div class="row">
                    <div class="row">
                    <div class="col-md-12">
                            <input type="file" id="filer" name="imger" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <p id="uploaded_image" style="display:none"></p>
                        </div>
                    </div>
                    </div>
                    
                    <div class="form-btn text-center">
                            <button class="btn btn-success" onclick='pass()' type="button" style="margin-top: 10px;">Add</button>
                            <p id="form-message"></p>
                        </div>
                </div>
            </div>
        </div>

        <div id="fulls" style="position:fixed;top:0;left:0;width:100%;height:100%;background:red;    background: rgba(120,120,120,0.5);z-index: 9999;display:none;overflow:auto">
        <div class="row" style="margin-top:20px">
                <div class="offset-md-2 col-md-8">
                    <div class="row" style="margin-bottom:25px">
                        <div class="offset-1 col-10">
                        <h2 style="text-align:center;border:2px solid">Show exercice:</h2>
                        </div>
                        <div class="col-1" style="margin:auto">
                        <p onclick="exit()" style="color:white;font-weight:bold;cursor:pointer;;text-align:center">X</p>
                        </div>
                    </div>
                
                
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name:</label>
                            <input type="text" name="name" id="namee" placeholder="Name" class="form-control" style="margin-top:0" readonly>
                        </div>
                        <div class="col-md-6">
                        <label>Calories:</label>
                        <input type="number" id="caloriese" name="caloriese" placeholder="calories" class="form-control" style="margin-top:0" readonly>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <img  id="filee" name="imgee" class="form-control" style="margin-top:0" readonly>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <label>Video:</label>
                    <video id="myVideo" class="form-control" controls>
  Your browser does not support the video tag.
</video>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <label>Duree:</label>
                            <input type="number" id="dureee" name="duree" placeholder="duree" class="form-control" style="margin-top:0" readonly>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <label>Benefits:</label>
                            <input type="text" id="benefitse" name="benefits" placeholder="benefits" class="form-control" style="margin-top:0" readonly>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <label>Equipments:</label>
                            <textarea id="equipmentse" name="equipments" placeholder="equipments" class="form-control" style="margin-top:0" readonly></textarea>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                    <label>Description:</label>
                            <textarea id="descriptione" name="description" placeholder="description" class="form-control" style="margin-top:0" readonly></textarea>
                        </div>
                    </div>
                    <div id="zidi">
                            
                </div>
                
            </div>
        </div>

        <div id="allf" style="position:fixed;top:0;left:0;width:100%;height:100%;background:red;    background: rgba(120,120,120,0.5);z-index: 9999;display:none">
        <p onclick="exit()" style="color:white;font-weight:bold;cursor:pointer;text-align:center;position: absolute;text-align: right;">X</p>
                    
                        <img src="" alt="" id="mokh" style="    width: inherit;;">
                    
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
        var ida;
        var idd;

        // function pagi(a)
        // {
        //     console.log(10*a.textContent)
        //     var A = document.getElementsByClassName('tbdomaine');
        //     console.log(10*a.textContent)
        //     console.log(10*a.textContent-10)
        //     for (let i = 0; i < A.length; i++) {
        //         if(i>10*a.textContent || i<=10*a.textContent-10)
        //         {
        //             A[i].parentElement.style.display = 'none'
        //         }
        //         else
        //         {
        //             A[i].parentElement.style.display = 'table-row'  
        //         }
        //     }
        //     var B = document.getElementsByClassName('page-item');
        //     for (let j = 0; j < B.length; j++) {
        //         B[j].classList.remove("active");
        //     }
        //     a.parentElement.classList.add("active");
        // }

        function allfull(a)
        {
            document.getElementById('allf').style.display = "block"
            document.getElementById('mokh').src = a.children[0].textContent;
        }

        function user()
        {
            document.getElementById('users').innerHTML="<tr><th>Thumbnail</th><th>Name</th> <th>Calories</th><th>Equipements</th><th>Duree</th><th></th></tr> ";
            $.post('controller', {service:'gigs', type:'<?php echo $role; ?>'}).done(function(response){
                console.log(response)
            obj = JSON.parse(response);
            for (let i = 0; i < obj.length; i++) {
                var rol="User";
                
                document.getElementById('users').innerHTML+='<tr style="height:70px"><th scope="row" style="background-image:url(\''+obj[i].path+'\');background-size: 100% 100%;" onclick="allfull(this)"><span style="display:none">'+obj[i].path+'</span></th> <td class="tbname">'+obj[i].name+'</td><td class="tbdomaine">'+obj[i].calories+'</td><td class="tbprice">'+obj[i].equipments+'</td><td class="tbcreated">'+obj[i].duree+'</td><td><i class="fa fa-link" style="color:brown;cursor:pointer" onclick="link(\''+obj[i].id+'\')" aria-hidden="true"></i><i class="fa fa-eye" style="color:brown;cursor:pointer" onclick="view_us(\''+obj[i].id+'\')" aria-hidden="true"></i><i class="fa fa-plus" style="color:green;cursor:pointer" onclick="edit_us(\''+obj[i].id+'\')" aria-hidden="true"></i><i class="fa fa-trash" style="color:red;cursor:pointer" onclick="delete_us(\''+obj[i].id+'\')" aria-hidden="true"></i></td></tr>'
            }
        //     var A = document.getElementsByClassName('tbdomaine');
        //     for (let i = 0; i < A.length; i++) {
        //         if(i>=10)
        //         {
        //             A[i].parentElement.style.display = 'none'
        //         }
        //     }
        // console.log(Math.floor(A.length/10))
        // var b = Math.floor(A.length/10);
        // var c = A.length % 10;
        // if(A.length % 10 != 0)
        // {
        //     b++;
        // }
        // console.log(b)
        // var t= '';
        // for (let i = 1; i <= b; i++) {
        //     if(i==1)
        //     {
        //         t='active';
        //     }
        //     else{
        //         t='';
        //     }
        //     document.getElementById('pagi').innerHTML += '<li class="page-item '+t+'"><a class="page-link" onclick="pagi(this)" style="cursor:pointer">'+i+'</a></li>'
        // }
        
});
        
        }

        function link(id) {
            idd = id
    document.getElementById('fullmd').style.display = 'block'


        }

        function edit_us(id)
        {
            ida = id;
//             $.post('controller', {service:'getgig',ide:id, type:'<?php echo $role; ?>'}).done(function(response){
//                 document.getElementById('full2').style.display = "block";
//                 console.log(response)
//                 obj = JSON.parse(response);
//                 for (let i = 0; i < obj.length; i++) {
//                     document.getElementById('name2').value = obj[i].name;
//                     document.getElementById('path2').src = obj[i].path;
//                     document.getElementById('domain2').value = obj[i].domaine;
//                     document.getElementById('price2').value = obj[i].price;
//                     document.getElementById('description2').value = obj[i].description;
//                 }
// });
    document.getElementById('fullm').style.display = 'block'
        }

        function adding() {
            const name = document.getElementById('name3').value;
            const duree = document.getElementById('duree3').value;
            $.post('controller', {service:'adding',ide: ida,name: name, duree: duree, type:'<?php echo $role; ?>'}).done(function(response){
                console.log(response)
                if(response == 'done') {
                    exit();
                    document.getElementById('name3').value = '';
                    document.getElementById('duree3').value = '';
                    user();
                    
                }
        })
    }

    function pass() {
        var form_data = new FormData();
            form_data.append("file", document.getElementById('filer').files[0]);
            form_data.append("ide", idd);
            $.ajax({
                url:"uploade",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    document.getElementById('uploaded_image').style.display = 'block';
                $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                },   
                success:function(response)
                {
                    // document.getElementById('name').value='';
                    // document.getElementById('file').value='';
                    // document.getElementById('price').value='';
                    // document.getElementById('description').value='';
                    // document.getElementById('domain').value='Web Development';
                console.log(response);
                exit();
                user();
                }
            });
    }

        function edit()
        {
            console.log(document.getElementById('file2').files[0]==null)
            var form_data = new FormData();
            form_data.append("ided", ida);
            if(document.getElementById('file2').files[0]!=null)
            {
                form_data.append("file", document.getElementById('file2').files[0]);
            }
            form_data.append("name", document.getElementById('name2').value);
            form_data.append("price", document.getElementById('price2').value);
            console.log(document.getElementById('price2').value)
            form_data.append("domain", document.getElementById('domain2').value);
            form_data.append("description", document.getElementById('description2').value);
            $.ajax({
                url:"upload",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    document.getElementById('uploaded_image').style.display = 'block';
                $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                },   
                success:function(response)
                {
                    console.log(response);
                    if(response == 'yes')
                    {
                        document.getElementById('name2').value='';
                        document.getElementById('file2').value='';
                        document.getElementById('price2').value='';
                        document.getElementById('domain2').value='Web Development';
                        console.log(response);
                        exit();
                        user();
                    }
                    
                }
            });
        }

        function view_us(id) {
            document.getElementById('fulls').style.display = 'block';
            $.post('controller', {service:'view_exercices',ide: id, type:'<?php echo $role; ?>'}).done(function(response){
                console.log(response)
            obj = JSON.parse(response);
            if(obj.length) {
                try{
                    document.getElementById('zidi').innerHTML = ''
                } catch(e) {
                    console.log(e)
                }
                document.getElementById('zidi').innerHTML = ''
                document.getElementById('namee').value = obj[0].name
                document.getElementById('dureee').value = obj[0].duree
                document.getElementById('descriptione').value = obj[0].description
                document.getElementById('benefitse').value = obj[0].benefits
                document.getElementById('caloriese').value = obj[0].calories
                document.getElementById('descriptione').value = obj[0].description
                document.getElementById('equipmentse').value = obj[0].equipments
                document.getElementById('filee').src = obj[0].path
                var video = document.getElementById("myVideo");
                var source = document.createElement("source");
                source.src = obj[0].video; // Set the video source URL
                source.type = "video/mp4"; // Set the MIME type of the video
                console.log(obj[0].video)
                // Remove any existing source elements (if any)
                while (video.firstChild) {
                    video.removeChild(video.firstChild);
                }
                if(source.src) {
                    video.appendChild(source);
                }
                // Append the new source element to the video element
                if(!obj[0].video) {
                    document.getElementById("myVideo").style.display = 'none';
                }
                else {
                    document.getElementById("myVideo").style.display = 'block';
                }

                document.getElementById('zidi').innerHTML += '<label>Sessions:</label><table id="yeap" class="table" style="background:white; color:black"><tr><th scope="col">Name</th><th scope="col">Duree</th></tr></table>'
            }
            for (let i = 0; i < obj.length; i++) {
                console.log(obj[i].names)
                try {
                    document.getElementById('yeap').innerHTML += '<tr><td>'+obj[i].names+'</td><td>'+obj[i].durees+'</td></tr>'
                }
                catch(e) {
                    console.log(e)
                }
            }
            console.log(id)
        })
    }

        function delete_us(id)
        {
            console.log(id)
            var result = confirm("Want to delete?");
            if (result) {
                $.post('controller', {service:'deleteExercice',ide:id, type:'<?php echo $role; ?>'}).done(function(response){
                console.log(response)
                if(response=='done')
                {
                    exit()
                    user();
                }
                        });
            }
        }
        function add_gigs()
        {
            console.log('hole')
            document.getElementById('full').style.display = "block";
        }
        function exit()
        {
            document.getElementById('full').style.display = "none";
            document.getElementById('fullm').style.display = "none";
            document.getElementById('fullmd').style.display = "none";
            document.getElementById('full2').style.display = "none";
            document.getElementById('allf').style.display = "none";
            document.getElementById('fulls').style.display = "none";
        }
        function upload()
        {
            var form_data = new FormData();
            form_data.append("file", document.getElementById('file').files[0]);
            form_data.append("name", document.getElementById('name').value);
            form_data.append("calories", document.getElementById('calories').value);
            form_data.append("equipments", document.getElementById('equipments').value);
            form_data.append("description", document.getElementById('description').value);
            form_data.append("duree", document.getElementById('duree').value);
            form_data.append("benefits", document.getElementById('benefits').value);
            $.ajax({
                url:"upload",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    document.getElementById('uploaded_image').style.display = 'block';
                $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                },   
                success:function(response)
                {
                    // document.getElementById('name').value='';
                    // document.getElementById('file').value='';
                    // document.getElementById('price').value='';
                    // document.getElementById('description').value='';
                    // document.getElementById('domain').value='Web Development';
                console.log(response);
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