<?php
            include 'user.php';
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
    <title>Gigs management</title>
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
                    <a href="gigs" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>Gigs</a>
                    <?php } ?>
                    <?php if($role=='User'){ ?>
                    <a href="contact" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Contact</a>
                    <?php } ?>
                    <?php if($role=='User'){ ?>
                    <a href="reviews" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Reviews</a>
                    <?php } ?>
                    <?php if($role=='Admin'){ ?>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Reviews Manage</a>
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
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
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
                <div class="offset-md-2 col-md-8" style="margin-top:50px;margin-bottom:50px;    box-shadow: 0 0 10px #eee;padding:5px;">
                <div class="row" style="margin-bottom:30px">
                    <div class="offset-md-1 col-md-10">
                        <h2 style='text-align:center;' onclick="user()">gigs management:</h2>
                        
                    </div> 
                    <div class="col-md-1" style="margin:auto">
                    <i class="fa fa-plus" aria-hidden="true" onclick='add_gigs()' style="color:green;cursor:pointer"></i>
                    </div>
                </div>
                
                
                <table id="users" style="width:100% !important;text-align:center">
                <tr>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Domain</th>
                    <th>Created at</th>
                </tr>  
                </table>

                </div>
            </div>
        </div>
        <!-- Content End -->
        


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <div id="full" style="position:absolute;top:0;left:0;width:100%;height:100%;background:red;    background: rgba(120,120,120,0.5);z-index: 9999;display:none">
            <div class="row" style="margin-top:20px">
                <div class="offset-md-2 col-md-8">
                    <div class="row" style="margin-bottom:25px">
                        <div class="offset-1 col-10">
                        <h2 style="text-align:center;border:2px solid">Add gigs:</h2>
                        </div>
                        <div class="col-1" style="margin:auto">
                        <p onclick="exit()" style="color:white;font-weight:bold;cursor:pointer">X</p>
                        </div>
                    </div>
                
                
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <select name="domain" id="domain" class="form-control">
                                <option value="Web Development">Web Development</option>
                                <option value="Graphic Design">Graphic Design</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Data Analysis">Data Analysis</option>
                                <option value="Other">Other</option>
                            </select>
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
                    
                    <div class="form-btn text-center">
                            <button class="btn btn-success" onclick='upload()' type="button">Add gigs</button>
                            <p id="form-message"></p>
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
        function user()
        {
            document.getElementById('users').innerHTML="<tr><th>Thumbnail</th><th>Name</th> <th>Domain</th><th>Created at</th></tr> ";
            $.post('controller', {service:'gigs', type:'<?php echo $role; ?>'}).done(function(response){
                console.log(response)
            obj = JSON.parse(response);
            for (let i = 0; i < obj.length; i++) {
                var rol="User";
                
                document.getElementById('users').innerHTML+='<tr style="height:70px"><th scope="row" style="background-image:url(\''+obj[i].path+'\');background-size: 100% 100%;"></th> <td>'+obj[i].name+'</td><td>'+obj[i].domain+'</td><td>'+obj[i].created+'</td></tr>'
            }
});
        }
        function add_gigs()
        {
            console.log('hole')
            document.getElementById('full').style.display = "block";
        }
        function exit()
        {
            document.getElementById('full').style.display = "none";
        }
        function upload()
        {
            var form_data = new FormData();
            form_data.append("file", document.getElementById('file').files[0]);
            form_data.append("name", document.getElementById('name').value);
            form_data.append("domain", document.getElementById('domain').value);
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
                    document.getElementById('name').value='';
                    document.getElementById('file').value='';
                    document.getElementById('domain').value='Web Development';
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