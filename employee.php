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
        <div class="container">
            <h3 class="text-center py-5">Add an Employee from the list of users below</h3>
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="row">
                            <h3 class="pb-1"><b>Search</b></h3>
                            <form class="d-flex justify-content-center" id="filter-form" role="search">
                                <div class="col-md-10">
                                    <input name="search" id="search" class="form-control me-2" type="search" aria-label="Search" placeholder="Enter First name, Middle name, Last name or Username">
                                </div>
                                <div class="col-md-2 mx-2">
                                    <button class="btn btn-danger" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <br><br><br>
            <table class="table pt-5">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Phone</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="default_users">
                    <?php
                        require_once "config.php";
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($link, $sql);
                        $nn = 1;
                        if(mysqli_num_rows($result) > 0) {
                            $data_array = array();
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$nn++."</td>";
                                echo "<td>".$row['first_name']." ".$row['middle_name']." ".$row['last_name']."</td>";
                                echo "<td>".$row['username']."</td>";
                                echo "<td>".$row['phone_number']."</td>";
                                if ($row['user_type_id'] == 1){
                                    echo "<td>Customer</td>";
                                } else if($row['user_type_id'] == 2) {
                                    echo "<td>Employee</td>";
                                } else {
                                    echo "<td>Admin</td>";
                                }
                                if ($_SESSION['username'] != $row['username']) {
                                    if ($row['user_type_id'] == 1){
                                        echo "<td>
                                        <a href='makeuseremployee.php?id=".$row['id']."&fname=".$row['first_name']."&lname=".$row['last_name']."'><button id='make_employee_user_id_".$row['id']."' class='btn btn-primary'>Make Employee</button></a>&nbsp;&nbsp;<a href='makeuseradmin.php?id=".$row['id']."&fname=".$row['first_name']."&lname=".$row['last_name']."'><button class='btn btn-warning' id='make_admin_user_id_".$row['id']."'>Make Admin</button></a></td>";
                                    } else if($row['user_type_id'] == 2) {
                                        echo "<td><a href='makenormaluser.php?id=".$row['id']."&fname=".$row['first_name']."&lname=".$row['last_name']."'><button class='btn btn-success' id='make_normal_user_id_".$row['id']."'>Make Normal User</button></a>&nbsp;&nbsp;<a href='makeuseradmin.php?id=".$row['id']."&fname=".$row['first_name']."&lname=".$row['last_name']."'><button class='btn btn-warning' id='make_admin_user_id_".$row['id']."'>Make Admin</button></a></td>";
                                    } else {
                                        echo "<td><a href='makenormaluser.php?id=".$row['id']."&fname=".$row['first_name']."&lname=".$row['last_name']."'><button class='btn btn-success' id='make_normal_user_id_".$row['id']."'>Make Normal User</button></a>&nbsp;&nbsp;<a href='makeuseremployee.php?id=".$row['id']."&fname=".$row['first_name']."&lname=".$row['last_name']."'><button class='btn btn-primary' id='make_employee_user_id_".$row['id']."'>Make Employee</button></a></td>";
                                    }
                                } else {
                                    echo '<td>Can\'t modify already logged in user</td>';
                                }
                                echo "</tr>";
                            }
                        };
                    ?>
                </tbody>
                <tbody id="display">
                </tbody>
            </table>
        </div>
        <script>
            function fill(Value) {
                //Assigning value to "search" div in "search.php" file.
                $('#search').val(Value);
                //Hiding "display" div in "search.php" file.
                $('#display').hide();
            }
            $(document).ready(function() {
            //On pressing a key on "Search box" in "search.php" file. This function will be called.
                $("#search").keyup(function() {
                    //Assigning search box value to javascript variable named as "name".
                    var name = $('#search').val();
                    //Validating, if "name" is empty.
                    if (name == "") {
                        //Assigning empty value to "display" div in "search.php" file.
                        $("#display").html("");
                        $("#default_users").show();
                    }
                    //If name is not empty.
                    else {
                        $("#default_users").hide();
                        //AJAX is called.
                        $.ajax({
                            //AJAX type is "Post".
                            type: "POST",
                            //Data will be sent to "ajax.php".
                            url: "./filter.php",
                            //Data, that will be sent to "ajax.php".
                            data: {
                                //Assigning value of "name" into "search" variable.
                                search: name
                            },
                            //If result found, this funtion will be called.
                            success: function(html) {
                                //Assigning result to "display" div in "search.php" file.
                                $("#display").html(html).show();
                            }
                        });
                    }
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>