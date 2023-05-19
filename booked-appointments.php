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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#btnPrint").on("click", function () {
                    var divContents = $(".potato").html();
                    var printWindow = window.open('', '', 'height=400,width=1200');
                    printWindow.document.write(divContents);
                    printWindow.document.close();
                    printWindow.print();
                });
            })

            function download_table_as_csv(table_id, separator = ',') {
                // Select rows from table_id
                var rows = document.querySelectorAll('table#' + table_id + ' tr');
                // Construct csv
                var csv = [];
                for (var i = 0; i < rows.length; i++) {
                    var row = [], cols = rows[i].querySelectorAll('td, th');
                    for (var j = 0; j < cols.length; j++) {
                        // Clean innertext to remove multiple spaces and jumpline (break csv)
                        var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
                        // Escape double-quote with double-double-quote (see https://stackoverflow.com/questions/17808511/properly-escape-a-double-quote-in-csv)
                        data = data.replace(/"/g, '""');
                        // Push escaped string
                        row.push('"' + data + '"');
                    }
                    csv.push(row.join(separator));
                }
                var csv_string = csv.join('\n');
                // Download it
                var filename = 'export_' + table_id + '_' + new Date().toLocaleDateString() + '.csv';
                var link = document.createElement('a');
                link.style.display = 'none';
                link.setAttribute('target', '_blank');
                link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
                link.setAttribute('download', filename);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        </script>
    </head>
    <body>
        <?php include "nav.php" ?>
        <div class="row">
            <div class="col-md-4 mx-auto d-flex justify-content-center">
                <div class="py-4">
                    <button class="btn btn-success mr-4" href="#" onclick="download_table_as_csv('potatotable');">Download as CSV</button>
                    <button id="btnPrint" class="btn btn-primary">Generate PDF Report</button>
                </div>
            </div>
        </div>
        
        <div class="container potato">
            <h1 class="text-center py-5">Booked Appointments</h1>
            <table class="table" id="potatotable">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Attendant</th>
                    <th scope="col">Service</th>
                    <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once "config.php";
                        $sql = "SELECT * FROM booking_appointments";
                        $result = mysqli_query($link, $sql);
                        $nn = 1;
                        if(mysqli_num_rows($result) > 0) {
                            $data_array = array();
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$nn++."</td>";
                                echo "<td>".$row['name']."</td>";
                                echo "<td>".$row['email']."</td>";
                                echo "<td>".$row['phone_number']."</td>";
                                echo "<td>".$row['attendant']."</td>";
                                echo "<td>".$row['service']."</td>";
                                echo "<td>".$row['date']."</td>";
                                echo "</tr>";
                            }
                        };
                    ?>
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
</html>