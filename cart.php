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
                        $role = 'User';
                    }
                    }
                    if($role=='User')
                    {
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cart</title>
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
    input, textarea{
        background:white !important;
        margin-bottom:5px;
        color:black !important;
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
                    <!-- <?php if($role=='User'){ ?>
                    <a href="reviews" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Reviews</a>
                    <?php } ?> -->
                    <?php if($role=='Admin'){ ?>
                    <a href="mails" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Mails manage</a>
                    <?php } ?>
                    <?php if($role=='Admin'){ ?>
                    <a href="activity" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Last activities</a>
                    <?php } ?>
                    <?php if($role=='User'){ ?>
                    <a href="found" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Add found</a>
                    <?php } ?>
                    <?php if($role=='User'){ ?>
                    <a href="store" class="nav-item nav-link active"><i class="fa fa-chart-bar me-2"></i>Store</a>
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
                    <div class="nav-item">
                        <a href="cart" class="nav-link" style="font-weight:bold">
                            <i><span id="number"><?php 
                            $idu = $_SESSION["user"]->get_id();
                            $sql = "SELECT count(*) as number,sum(price*quantity) as prices
                            FROM cart
                            INNER JOIN users ON users.id = cart.user_id
                            INNER JOIN gigs ON gigs.id = cart.gigs_id WHERE user_id=$idu";
                            $result = mysqli_query($conn, $sql);
                            if($row = mysqli_fetch_assoc($result)) {
                                echo $row['number'];
                                 ?></span>
                        <i class="fas fa-shopping-cart"> </i>
                        
                            </i>
                            <span class="d-none d-lg-inline-flex" style="color: cadetblue;" id="price"><?php echo $row['prices']." $";
                            } ?></span>
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
        <div class="row" style="margin-top:21px;padding:0 30px">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header" style="background: #fcd703;color: black;"><i class="fas fa-shopping-cart"></i><b>Cart</b></div>
                <div class="card-body" style="background:black">
                <table class="table" style="width:100%;color:white;font-weight:bold">
                    <thead>
                        <tr>
                        <th scope="col" style="width:10%">#</th>
                        <th scope="col" style="width:20%"></th>
                        <th scope="col" style="width:20%">Gigs</th>
                        <th scope="col" style="width:20%">Prix</th>
                        <th scope="col" style="width:10%">Quantité</th>
                        <th scope="col" style="width:20%">Sous totale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $idu = $_SESSION["user"]->get_id();
                            $sql = "SELECT cart.id as id,path,gigs.name as name,price,quantity
                            FROM cart
                            INNER JOIN users ON users.id = cart.user_id
                            INNER JOIN gigs ON gigs.id = cart.gigs_id WHERE user_id=$idu";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr class="cart_items">
                                    <th scope="row"><i class="fa fa-trash" aria-hidden="true" style="color:red;cursor:pointer" onclick="delete_cart(this,<?php echo $row['id']; ?>)"></i></th>
                                    <td scope="row" style="background-image:url(<?php echo $row['path']; ?>);background-size: 100% 100%;"></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><span><?php echo $row['price']; ?></span>$</td>
                                    <td><div class="row">
                                            <div class="col-2" style="padding:0;margin-top:5px;">
                                                <i class="fa fa-minus" style="color:red;cursor:pointer" onclick="moinsq(this,<?php echo $row['id']; ?>)"></i>
                                            </div>
                                            <div class="col-8" style="padding-left: 0;padding-right: 5px;">
                                                <input type="number" name="" id="" min="1" max="10" class="form-control" disabled value="<?php echo $row["quantity"]; ?>" style="background: black !important;    box-shadow: 2px 2px white;color: white !important;border: 1px solid;">
                                            </div>
                                            <div class="col-2" style="padding:0;margin-top:5px;">
                                                <i class="fa fa-plus" style="color:green;cursor:pointer" onclick="plusq(this,<?php echo $row['id']; ?>)"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="prices"><?php echo $row['price']*$row['quantity']; ?></span> $</td>
                                </tr>
                                <?php
                            }

                        ?>
                    </tbody>
                    </table>
                </div> 
                <div class="card-footer" style="background: black;border: 1px solid white;">
                        <div class="row">
                            <div class="col-md-6">
                            <button class="btn btn-info form-control" style="background:#fcd703;border: none;font-weight:bold" onclick='pay()' id="pay">Pay</button>
                            </div>
                            <div class="col-md-6">
                            <button class="btn btn-info form-control" style="    background: #FF2900;border: none;color: black;font-weight: bold;" onclick='trash()'><i class="fa fa-trash" aria-hidden="true"></i> Clear cart</button>
                            </div>
                        </div>
                </div>
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

        function delete_cart(yy,id)
        {
            var A = yy;
            console.log(A.parentElement.parentElement)
            console.log(id)
            var result = confirm("Want to delete?");
            if (result) {
                $.post('controller', {service:'deletecart',idc:id, type:'<?php echo $role; ?>'}).done(function(response){
                console.log(response)
                if(response != 'error' && response != "error2")
                {
                    A.parentElement.parentElement.remove();
                    var aa = response.split(":");
                    if(aa[1] == '')
                    {
                        aa[1] = 0;
                    }
                    document.getElementById("number").textContent = aa[0];
                    document.getElementById("price").textContent = aa[1]+" $";
                    document.getElementById("pay").textContent = "Pay with "+aa[1]+" $";
                }
                        });
            }
        }

        function plusq(yy,id)
        {
            var pr = yy.parentElement.parentElement.parentElement.previousElementSibling.children[0].textContent;
            // var nx = yy.parentElement.parentElement.parentElement.nextElementSibling.children[0].textContent;
            var A = yy;
            $.post('controller', {service:'plusq',idc:id, type:'<?php echo $role; ?>'}).done(function(response){
                console.log(response)
                if(response != 'error' && response != "error2")
                {
                    yy.parentElement.parentElement.children[1].children[0].value = Number(yy.parentElement.parentElement.children[1].children[0].value) + Number(1);
                    var aa = response.split(":");
                    if(aa[1] == '')
                    {
                        aa[1] = 0;
                    }
                    document.getElementById("number").textContent = aa[0];
                    document.getElementById("price").textContent = aa[1]+" $";
                    document.getElementById("pay").textContent = "Pay with "+aa[1]+" $";
                    yy.parentElement.parentElement.parentElement.nextElementSibling.children[0].textContent = Number(pr) * yy.parentElement.parentElement.children[1].children[0].value;
                }
                        });
        }
        function moinsq(yy,id)
        {
            var pr = yy.parentElement.parentElement.parentElement.previousElementSibling.children[0].textContent;
            console.log(Number(yy.parentElement.parentElement.children[1].children[0].value) + Number(1))
            var A = yy;
            $.post('controller', {service:'moinsq',idc:id, type:'<?php echo $role; ?>'}).done(function(response){
                console.log(response)
                if(response != 'error' && response != "error2")
                {
                    if(Number(yy.parentElement.parentElement.children[1].children[0].value)>1)
                    {
                    yy.parentElement.parentElement.children[1].children[0].value = Number(yy.parentElement.parentElement.children[1].children[0].value) - Number(1);
                    }
                    var aa = response.split(":");
                    if(aa[1] == '')
                    {
                        aa[1] = 0;
                    }
                    document.getElementById("number").textContent = aa[0];
                    document.getElementById("price").textContent = aa[1]+" $";
                    document.getElementById("pay").textContent = "Pay with "+aa[1]+" $";
                    
                    yy.parentElement.parentElement.parentElement.nextElementSibling.children[0].textContent = Number(pr) * yy.parentElement.parentElement.children[1].children[0].value;
                }
                        });
        }

        function trash()
        {
            $.post('controller', {service:'trash', type:'<?php echo $role; ?>'}).done(function(response){
                console.log(response)
                if(response != 'error' && response != "error2")
                {
                    var cc = document.getElementsByClassName('cart_items');
                    console.log(cc)
                    
                    for (let i = 0; i < cc.length; i++) {
                        console.log(cc[i])
                        cc[i].remove();
                        i--;
                    }
                    var aa = response.split(":");
                    if(aa[1] == '')
                    {
                        aa[1] = 0;
                    }
                    document.getElementById("number").textContent = aa[0];
                    document.getElementById("price").textContent = aa[1]+" $";
                    document.getElementById("pay").textContent = "Pay with "+aa[1]+" $";
                }
                        });
        }

        function pay()
        {
            var domain = document.getElementById("domain").value;
            var service = document.getElementById("service").value;
            var email = document.getElementById("email").value;
            var message = document.getElementById("message").value;
            console.log(domain+service+email+message);
        }

        function cart()
        {
            var domain = document.getElementById("domain").value;
            var service = document.getElementById("service").value;
            var email = document.getElementById("email").value;
            var message = document.getElementById("message").value;
            $.post('controller', {adouna:'walo',service:document.getElementById("service").value,email:document.getElementById("email").value,message:document.getElementById("message").value}).done(function(response){
                if(response!='no' && response!='error')
                {
                    document.getElementById("domain").value = '';
                    document.getElementById("service").innerHTML = '<option value="" disabled selected>-</option>';
                    document.getElementById("email").value = '';
                    document.getElementById("message").value = "";
                    var aa = response.split(":");
                    document.getElementById("number").textContent = aa[0];
                    document.getElementById("price").textContent = aa[1]+" $";
                    document.getElementById("pay").textContent = "Pay with " + aa[1]+" $";
                }
            
});
        }

        function chnge()
        {
            document.getElementById("service").innerHTML = "";
            $.post('controller', {adouna:'walo',domain:document.getElementById("domain").value}).done(function(response){
                console.log(response)
                obj = JSON.parse(response);
                for (let i = 0; i < obj.length; i++) {
                    document.getElementById("service").innerHTML += "<option value='"+obj[i].id+"'>"+obj[i].name+" per "+obj[i].price+"</option>";
                }
            
            
});
        }

        function sendmail()
        {
            var A = document.getElementById("bton");
            document.getElementById("bton").disabled = true;
            $.post('controller', {adouna:'walo',name:document.getElementById('name').value,email:document.getElementById('email').value,subject:document.getElementById('subject').value,message:document.getElementById('message').value}).done(function(response){
            console.log(response);
            if(response=="the mail was sended successfly")
            {
                A.disabled = false;
                document.getElementById('name').value='';
                document.getElementById('email').value='';
                document.getElementById('subject').value='';
                document.getElementById('message').value='';
                document.getElementById('uploaded').textContent=response;
                document.getElementById('uploaded').style.display='block';
                setTimeout(function(){ document.getElementById('uploaded').style.display='none'; }, 10000);
            }
            
});
        }
//         function user()
//         {
//             document.getElementById('users').innerHTML="";
//             $.post('controller', {service:'users', type:'<?php echo $role; ?>'}).done(function(response){
//             obj = JSON.parse(response);
//             for (let i = 0; i < obj.length; i++) {
//                 var rol="User";
//                 if(obj[i].roles.includes('ROLE_ADMIN'))
//                 {
//                     rol = 'Admin';
//                 }
//                 document.getElementById('users').innerHTML+='<tr><th scope="row">'+obj[i].id+'</th> <td>'+obj[i].name+'</td><td>'+obj[i].last+'</td><td>'+obj[i].email+'</td><td>'+rol+'</td></tr>'
//             }
// });
//         }
        window.onload = function()
        {
            var bb = document.getElementsByClassName('prices');
            var n = 0;
            for (let i = 0; i < bb.length; i++) {
                n += Number(bb[i].textContent);
                
            }
            document.getElementById('pay').textContent = "Pay with "+Number(n)+' $';
        }
    </script>
</body>

</html>
<?php
                    }
            }
            ?>