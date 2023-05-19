<?php
//Including Database configuration file.
require_once "config.php";
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
    $Name = $_POST['search'];
//Search query.
    $Query = "SELECT * FROM users WHERE first_name LIKE '%$Name%' or middle_name LIKE '%$Name%' OR last_name LIKE '%$Name%' or username LIKE '%$Name%'";
//Query execution
    $ExecQuery = MySQLi_query($link, $Query);
    $nn = 1;
    //Fetching result from database.
    while ($row = mysqli_fetch_assoc($ExecQuery)) {
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
        if ($row['user_type_id'] == 1){
            echo "<td><button class='btn btn-primary'>Make Employee</button>&nbsp;&nbsp;<button class='btn btn-warning'>Make Admin</button></td>";
        } else if($row['user_type_id'] == 2) {
            echo "<td><button class='btn btn-success'>Make Normal User</button>&nbsp;&nbsp;<button class='btn btn-warning'>Make Admin</button></td>";
        } else {
            echo "<td><button class='btn btn-success'>Make Normal User</button>&nbsp;&nbsp;<button class='btn btn-primary'>Make Employee</button></td>";
        }
        echo "</tr>";
}}
?>