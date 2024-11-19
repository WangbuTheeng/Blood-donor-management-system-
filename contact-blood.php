<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['send']))
{
    $cid = $_GET['cid'];
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $brf = $_POST['brf'];
    $message = $_POST['message'];

    // Inserting into the database
    $sql = "INSERT INTO tblbloodrequirer(BloodDonarID, name, EmailId, ContactNumber, BloodRequirefor, Message) 
            VALUES(:cid, :name, :email, :contactno, :brf, :message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':cid', $cid, PDO::PARAM_STR);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
    $query->bindParam(':brf', $brf, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        echo '<script>alert("Request has been sent. We will contact you shortly.")</script>';
    }
    else 
    {
        echo "<script>alert('Something went wrong. Please try again.');</script>";  
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Blood Donar Management System | Blood Requirer</title>
    <script>
        // Client-side validation for phone number
        function validatePhoneNumber() {
            var phone = document.getElementById("phone").value;
            var phonePattern = /^[0-9]{10}$/; // Validates a 10-digit phone number

            if (!phonePattern.test(phone)) {
                alert("Please enter a valid 10-digit phone number.");
                return false;
            }
            return true;
        }
    </script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/fontawesome-all.css">
</head>

<body>
    <?php include('includes/header.php');?>

    <!-- contact -->
    <div class="agileits-contact py-5">
        <div class="py-xl-5 py-lg-3">
            <div class="w3ls-titles text-center mb-5">
                <h3 class="title">Contact For Blood</h3>
                <span>
                    <i class="fas fa-user-md"></i>
                </span>
            </div>
            <div class="d-flex">
                <div class="col-lg-5 w3_agileits-contact-left">
                </div>
                <div class="col-lg-7 contact-right-w3l">
                    <h5 class="title-w3 text-center mb-5">Fill following form for blood</h5>
                    <form action="#" method="post" onsubmit="return validatePhoneNumber()">
                        <div class="d-flex space-d-flex">
                            <div class="form-group grid-inputs">
                                <label for="recipient-name" class="col-form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" name="fullname" placeholder="Please enter your name." required>
                            </div>
                            <div class="form-group grid-inputs">
                                <label for="recipient-name" class="col-form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="contactno" placeholder="Please enter your phone number." required>
                            </div>
                        </div>

                        <div class="d-flex space-d-flex">
                            <div class="form-group grid-inputs">
                                <label for="recipient-name" class="col-form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="Please enter your email address.">
                            </div>
                            <div class="form-group grid-inputs">
                                <label for="recipient-name" class="col-form-label">Blood Require For</label>
                                <select class="form-control" id="phone" name="brf" required>
                                    <option value="">Blood Require For</option>
                                    <option value="Father">Father</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Message</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" name="message" placeholder="Please enter your message" maxlength="999" style="resize:none" required></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Send Message" name="send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //contact -->

    <?php include('includes/footer.php');?>

    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>
