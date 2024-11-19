<?php
// Suppress warnings
error_reporting(0);

// Include database configuration
include('includes/config.php');

// Handle donor registration
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobileno'];
    $email = $_POST['emailid'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $bloodgroup = $_POST['bloodgroup'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $weight = $_POST['weight'];
    $status = 0; // Set status to 0 for pending approval
    $password = md5($_POST['password']);
    $diseases = $_POST['diseases'];

    // Fetch all donor records for linear search
    $sql = "SELECT EmailId FROM tblblooddonars";
    $query = $dbh->prepare($sql);
    $query->execute();
    $allDonors = $query->fetchAll(PDO::FETCH_ASSOC);

    // Perform a linear search for the email
    $emailExists = false;
    foreach ($allDonors as $donor) {
        if ($donor['EmailId'] === $email) {
            $emailExists = true;
            break;
        }
    }

    // Validation and insertion
    if (!$emailExists && $age >= 18 && $weight >= 50) {
        $sql = "INSERT INTO tblblooddonars (FullName, MobileNumber, EmailId, Age, Gender, BloodGroup, Address, Message, status, Password, Diseases, Weight)
                VALUES (:fullname, :mobile, :email, :age, :gender, :bloodgroup, :address, :message, :status, :password, :diseases, :weight)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':diseases', $diseases, PDO::PARAM_STR);
        $query->bindParam(':weight', $weight, PDO::PARAM_STR);
        $query->execute();

        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId) {
            echo "<script>alert('Your registration is successful. It is now pending admin approval.');</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    } else {
        if ($emailExists) {
            echo "<script>alert('Email-ID already exists. Please try again.');</script>";
        } elseif ($age < 18) {
            echo "<script>alert('Age must be at least 18 years.');</script>";
        } elseif ($weight < 50) {
            echo "<script>alert('Minimum weight must be 50 kg.');</script>";
        }
    }
}

// Fetch only approved donors
$approved = 1;
$sql = "SELECT * FROM tblblooddonars WHERE approved=:approved";
$query = $dbh->prepare($sql);
$query->bindParam(':approved', $approved, PDO::PARAM_INT);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blood Donor Management System | Approved Donor List</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/fontawesome-all.css">
</head>
<body>
    <!-- Include header -->
    <?php include('includes/header.php'); ?>

    <!-- Page Banner -->
    <div class="inner-banner-w3ls">
        <div class="container">
            <h2 class="text-center text-white">Approved Donors</h2>
        </div>
    </div>

    <!-- Donor List -->
    <div class="agileits-contact py-5">
        <div class="container py-xl-5 py-lg-3">
            <div class="w3ls-titles text-center mb-5">
                <h3 class="title">Blood Donor List</h3>
                <span><i class="fas fa-user-md"></i></span>
            </div>
            <div class="row">
                <?php
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/blood-donor.jpg" alt="Blood Donor" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlentities($result->FullName); ?></h5>
                            <p><strong>Gender:</strong> <?php echo htmlentities($result->Gender); ?></p>
                            <p><strong>Blood Group:</strong> <?php echo htmlentities($result->BloodGroup); ?></p>
                            <p><strong>Mobile:</strong> <?php echo htmlentities($result->MobileNumber); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlentities($result->EmailId); ?></p>
                            <p><strong>Age:</strong> <?php echo htmlentities($result->Age); ?></p>
                            <p><strong>Address:</strong> <?php echo htmlentities($result->Address); ?></p>
                            <p><strong>Message:</strong> <?php echo htmlentities($result->Message); ?></p>
                            <a href="contact-blood.php?cid=<?php echo $result->id; ?>" class="btn btn-primary">Request</a>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                } else {
                    echo "<p class='text-center'>No approved donors found.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Include footer -->
    <?php include('includes/footer.php'); ?>

    <!-- JS Scripts -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
