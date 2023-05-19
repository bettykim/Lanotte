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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #F7D8E8, #E2D1E7, #CFCCE6, #BDC6E5, #ACC1E4);
        }
    </style>
</head>

<body>
<?php
// Include config file
require_once "config.php";
$name = $email = $comment = "";
$nameerr = $emailerr = $commenterr = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Validate name
    if (empty(trim($_POST["name"]))){
        $nameerr = "Please enter the name";
    } else {
        $name = $_POST["name"];
    }
    //Validate email
    if (empty(trim($_POST["email"]))){
        $emailerr = "Please enter the email";
    } else {
        $email = $_POST["email"];
    }
    //Validate comment
    if (empty(trim($_POST["comment"]))){
        $commenterr = "Please enter the comment";
    } else {
        $comment = $_POST["comment"];
    }
    if(empty($nameerr) && empty($emaileerr) && empty($commenterr)){
        $sql = "INSERT INTO reviews (name, email, comment) VALUES (?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_comment);
            $param_name= $name;
            $param_email = $email;
            $param_comment = $comment;
            if(mysqli_stmt_execute($stmt)){
                // Redirect to home page
            }   else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>
    <?php include 'nav.php' ?>
    <h1 class="text-center pt-3">Contact Us</h1>
    <h4 class="text-center pt-3">Phone: +25477889933</h4>                        
    <h4 class="text-center pt-3">Leave us a message on Facebook @lanotte</h4>
    <h2 class="text-center pt-3">Hours</h2>
    <h5 class="text-center pt-3">MONDAY-FRIDAY 9:30 AM TO 7:00 PM</h5>
    <h5 class="text-center pt-3">SATURDAY 9:30 AM TO 6:00 PM</h5>
    <h5 class="text-center pt-3">SUNDAY CLOSED</h5>

    <div class="container py-5">
        <h3 class="text-center">Leave us a review</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="row py-5">
                <div class="col-md-8 mx-auto">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Comment</label>
                        <textarea name="comment" rows="5" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
        <h2 class="text-center">FAQs</h2>
        <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <span style="font-weight:bold">1. What services do you offer?</span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            
                        At our online nail parlor, we offer a range of services such as manicures, pedicures, gel nails, acrylic nails, nail art, and more.
                            
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span style="font-weight:bold">2. How do I book an appointment?</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            
                        You can book an appointment by visiting our website . Select the service you want, choose the attendant you want, and provide your contact information.
                            
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <span style="font-weight:bold">3. What should I expect during my appointment?</span>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            
                        During your appointment, you can expect to be greeted by our friendly nail technicians who will consult with you on the service you want. You can relax and enjoy the pampering as our technicians work their magic on your nails.
                            
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <span style="font-weight:bold">4. How long does a typical appointment last?</span>
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            
                        The duration of your appointment will depend on the service you choose. A basic manicure or pedicure can take about 30 minutes, while a more complex service like gel nails or nail art may take up to an hour or more.
                            
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <span style="font-weight:bold">5. What type of products do you use?</span>
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            
                        We use high-quality and safe products from reputable brands in the industry. Our nail technicians are trained to use these products to ensure that you receive the best possible service.
                        
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <span style="font-weight:bold">6. How often should I get my nails done?</span>
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                
                            This will depend on the type of service you choose and how quickly your nails grow. Generally, manicures and pedicures should be done every 2-3 weeks, while gel nails can last up to 4 weeks or more.
                                
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            <span style="font-weight:bold">7. What precautions are you taking to ensure the safety of customers during the pandemic?</span>
                        </button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>
                                
                            We follow strict sanitation protocols to ensure the safety of our customers and staff during the pandemic. Our nail technicians wear masks and gloves, and we disinfect all equipment and surfaces between appointments. We also limit the number of customers in our salon to maintain social distancing.
                                
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
        <div class="py-4 bg-light">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-center">
                <img src="https://img.icons8.com/material-sharp/24/null/facebook-new.png"/> Facebook
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                <img src="https://img.icons8.com/material-outlined/24/null/instagram-new--v1.png"/> Instagram
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                <img src="https://img.icons8.com/ios-filled/30/null/tiktok--v1.png"/> Tiktok
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
<html