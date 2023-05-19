<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>La Notte</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="fontawesome/css/all.min.css" style="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'nav.php' ?>
    <div class="container">
        <div class="py-5">
            <div class="row"> 
                <h3 class="text-center pb-3" style="font-weight:bold"><i class="fa fa-plus-circle"></i> Dashboard</h3>
                <div class="col-md-6">
                    <div style="background-color:#e1dfdf;border-radius: 10px;padding:25px;">
                        <a href="service.php" style="text-decoration:none">
                            <h5><i class="fa fa-plus-circle" style="font-size:17px;"></i>&nbsp;Add a Service</h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="background-color:#e1dfdf;border-radius: 10px;padding:25px;">
                        <a href="employee.php" style="text-decoration:none">
                            <h5><i class="fa fa-plus-circle" style="font-size:17px;"></i>&nbsp;Add an Employee</h5>
                        </a>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <div style="background-color:#e1dfdf;border-radius: 10px;padding:25px;">
                        <a href="product.php" style="text-decoration:none">
                            <h5><i class="fa fa-plus-circle" style="font-size:17px;"></i>&nbsp;Add a Product</h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="background-color:#e1dfdf;border-radius: 10px;padding:25px;">
                        <a href="booked-appointments.php" style="text-decoration:none">
                            <h5><i class="fa fa-eye" style="font-size:17px;"></i>&nbsp;View booked appointments</h5>
                        </a>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <div style="background-color:#e1dfdf;border-radius: 10px;padding:25px;">
                        <a href="users.php" style="text-decoration:none">
                            <h5><i class="fa fa-eye" style="font-size:17px;"></i>&nbsp;View all users</h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="background-color:#e1dfdf;border-radius: 10px;padding:25px;">
                        <a href="galleryphotos.php" style="text-decoration:none">
                            <h5><i class="fa fa-plus-circle" style="font-size:17px;"></i>&nbsp;Add Gallery Photos</h5>
                        </a>
                    </div>
                </div>
                
            </div>
            <br><br>
           <!-- <div class="row">
                <div class="col-md-6">
                    <div style="background-color:#e1dfdf;border-radius: 10px;padding:25px;">
                        <a href="reviews.php" style="text-decoration:none">
                            <h5><i class="fa fa-plus-circle" style="font-size:17px;"></i>&nbsp;View Customer Reviews</h5>
                        </a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</body>
<html