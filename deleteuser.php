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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <body>
        <?php include "nav.php" ?>
        <?php
            require_once "config.php";
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $id = $_GET['id'];
                $sql = "DELETE FROM users WHERE id=$id";
                echo $sql;
                if($stmt = mysqli_prepare($link, $sql)){
                    mysqli_stmt_execute($stmt);
                    header('Location: /lanotte/users.php');
                };
            }
        ?>
        <div class="container">
                <div class="row py-5">
                    <div class="col-md-8 mx-auto">
                        <div class="row">
                            <h3 class="pb-1 pb-4"><b>Are you sure you want to delete the user: <?php echo $_GET['fname']." ".$_GET['lname']; ?>?</b></h3>
                            <form class="d-flex justify-content-center" method="POST">
                                <button class="btn btn-danger" type="submit">Delete User</button>
                            </form>
                            <a href="users.php" class="col-md-2 mx-auto mt-3 btn btn-warning">Cancel</a>
                        </div>
                    </div>
                </div>
            <br><br><br>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>