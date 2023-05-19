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
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="fontawesome/css/all.min.css">
    </head>
    <body>
        <?php 
            require_once "config.php"; 
            include "nav.php"; 
        ?>
        <?php
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                // Get file information
                $firstname = $_POST['first_name'];
                $middlename = $_POST['middle_name'];
                $lastname = $_POST['last_name'];
                $phone_number = $_POST['phone_number'];
                $location = $_POST['location'];
                $gender = $_POST['gender'];
                $id = $_GET['id'];
                
                $sql = "UPDATE users SET first_name='$firstname', middle_name='$middlename', last_name='$lastname', phone_number='$phone_number', location='$location', gender='$gender' WHERE id=$id";
                echo $sql;
                if (mysqli_query($link, $sql)){
                    header('Location: /lanotte/users.php');
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
        ?>
        <div class="container">
            <h1 class="text-center py-5">Edit User</h1>
            <form method="POST">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $_GET['fname']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" value="<?php echo $_GET['mname']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $_GET['lname']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-4">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" value="<?php echo $_GET['location']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" value="<?php echo $_GET['phone_number']; ?>">
                    </div>
                    <div class="col-md-4">
                        <labe>Gender</label>
                        <select name="gender" class="form-select">
                            <?php
                                if ($_GET['gender'] == 'Male'){
                                    echo '<option value="'.$_GET['gender'].'" selected>'.$_GET['gender'].'></option>';
                                    echo '<option value="Female">Female</option>';
                                } else {
                                    echo '<option value="'.$_GET['gender'].'" selected>'.$_GET['gender'].'</option>';
                                    echo '<option value="Male">Male</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn-primary col-md-3 mx-auto mt-5" type="submit">Update</button>
                </div>
            </form>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>