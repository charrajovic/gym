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
    <style>
        input,select{
            background:white !important;
            margin-top:20px;
            color:black !important;
        }
        button{
            margin-top:20px;
        }
        div#shange {
    border: 1px solid;
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
                    <a href="gigs" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Gigs</a>
                    <?php } ?>
                    <?php if($role=='User'){ ?>
                    <a href="contact" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Contact</a>
                    <?php } ?>
                    <?php if($role=='User'){ ?>
                    <a href="reviews" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Reviews</a>
                    <?php } ?>
                    <?php if($role=='Admin'){ ?>
                    <a href="mails" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Mails manage</a>
                    <?php } ?>
                    <?php if($role=='Admin'){ ?>
                    <a href="activity" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Last activities</a>
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
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="row" style="    width: 100%;padding-left: 10px;">
                <div class="offset-md-2 col-md-8" style="margin-top:40px;margin-bottom:0px;padding:5px">
                <div class="row" style="margin-bottom:30px">
                    <div class="offset-1 col-10">
                        <h2 style='text-align:center;' onclick="user()">Last activities:</h2>
                        
                    </div> 
                    <div class="col-1" style="margin:auto">
                    <i class="fa fa-plus" aria-hidden="true" onclick='add_user()' style="color:green;cursor:pointer"></i>
                    </div>
                </div>
                

                </div>
            </div>
            <div class="row" style="text-align:center">
                        <div class="offset-md-2 col-md-8" id="shange">
                        </div>
            </div>
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
            //document.getElementById('shange').innerHTML='<div class="offset-md-2 col-md-8" style="margin-top:50px;margin-bottom:50px;box-shadow: 0 0 10px #eee;padding:5px;overflow:auto"><div class="row" style="margin-bottom:30px"><div class="offset-1 col-10"><h2 style="text-align:center;" onclick="user()">Last activities:</h2></div><div class="col-1" style="margin:auto"><i class="fa fa-plus" aria-hidden="true" onclick="add_user()" style="color:green;cursor:pointer"></i></div></div>';
            //document.getElementById('shange').innerHTML = "";
            $.post('controller', {service:'activity', type:'<?php echo $role; ?>'}).done(function(response){
            obj = JSON.parse(response);
            for (let i = 0; i < obj.length; i++) {
                //console.log(!isNaN(parseInt(obj[i].lastname)))
                if(obj[i].lastname=='' || !isNaN(parseInt(obj[i].lastname)))
                {
                    if(obj[i].lastname=='')
                    {
                        document.getElementById('shange').innerHTML += "<div class='row' id='shange'><div class='col-md-12'><b style='color:red'>Unknown</b> sent a mail at "+obj[i].created+".</div></div>"
                    }
                    else
                    {
                        document.getElementById('shange').innerHTML += "<div class='row' id='shange'><div class='col-md-12'>The user with id <b style='color:red'>"+obj[i].lastname+"</b> sent a mail at "+obj[i].created+".</div></div>"
                    }
                }
                else if(obj[i].status == 1 || obj[i].status == 0)
                {
                    document.getElementById('shange').innerHTML += "<div class='row' id='shange'><div class='col-md-12'><b style='color:red'>"+obj[i].lastname+" "+obj[i].name+"</b> created an account at "+obj[i].created+".</div></div>"
                }
                else
                {
                    document.getElementById('shange').innerHTML += "<div class='row' id='shange'><div class='col-md-12'>The gig <b style='color:red'>"+obj[i].name+"</b> in class <b style='color:red'>"+obj[i].status+"</b> created at "+obj[i].created+".</div></div>"
                }
                //document.getElementById('shange').innerHTML+='<tr><th scope="row">'+obj[i].id+'</th> <td>'+obj[i].name+'</td><td>'+obj[i].lastname+'</td><td>'+obj[i].status+'</td><td>'+obj[i].created+'</td></tr>'
            }
});
        }
        function add_user()
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