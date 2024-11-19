<?php 
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['submit']))
{
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobileno'];
    $email = $_POST['emailid'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blodgroup = $_POST['bloodgroup'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $weight = $_POST['weight']; // New field for weight
    $status = 1;
    $password = md5($_POST['password']);
    $diseases = $_POST['diseases'];

    $ret = "select EmailId from tblblooddonars where EmailId=:email";
    $query = $dbh->prepare($ret);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() == 0 && $age >= 18 && $weight >= 50)
    {
        $sql = "INSERT INTO tblblooddonars(FullName,MobileNumber,EmailId,Age,Gender,BloodGroup,Address,Message,status,Password,Diseases,Weight) VALUES(:fullname,:mobile,:email,:age,:gender,:blodgroup,:address,:message,:status,:password,:diseases,:weight)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':blodgroup', $blodgroup, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':diseases', $diseases, PDO::PARAM_STR);
        $query->bindParam(':weight', $weight, PDO::PARAM_STR); // Bind the "Weight" value
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId)
        {
            echo "<script>alert('You have signed up successfully.');</script>";
        }
        else
        {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
    else
    {
        if($age < 18)
        {
            echo "<script>alert('Age must be at least 18 years.');</script>";
        }
        elseif($weight < 50)
        {
            echo "<script>alert('Minimum weight must be 50 kg.');</script>";
        }
        else
        {
            echo "<script>alert('Email-ID already exist. Please try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Blood Donar Management System| About Us </title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">

    <script type="text/javascript">
        // Function to validate password
        function checkpass() {
            var password = document.signup.password.value;
            var errorMessage = "";

            // Check if password contains at least one number
            var regex = /\d/; // Regular expression to check for numbers
            if (!regex.test(password)) {
                errorMessage = "Password must contain at least one number.";
            }

            // If there's an error, show it
            if (errorMessage != "") {
                alert(errorMessage);
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include('includes/header.php');?>

    <div class="inner-banner-w3ls">
        <div class="container">
        </div>
    </div>

    <section class="about py-5">
        <div class="container py-xl-5 py-lg-3">
            <div class="login px-4 mx-auto mw-100">
                <h5 class="text-center mb-4">Register Now</h5>
                <form action="#" method="post" name="signup" onsubmit="return checkpass();">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" name="mobileno" id="mobileno" required="true" placeholder="Mobile Number" maxlength="10" pattern="[0-9]+">
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Email Id</label>
                        <input type="email" name="emailid" class="form-control" placeholder="Email Id">
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Age</label>
                        <input type="text" class="form-control" name="age" id="age" placeholder="Age" required="true">
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Blood Group</label>
                        <select name="bloodgroup" class="form-control" required>
                            <?php 
                            $sql = "SELECT * from  tblbloodgroup ";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach($results as $result)
                            {
                            ?>
                            <option value="<?php echo htmlentities($result->BloodGroup);?>"><?php echo htmlentities($result->BloodGroup);?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Diseases</label>
                        <select name="diseases" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Weight (Minimum 50 kg)</label>
                        <input type="text" class="form-control" name="weight" id="weight" required="true" placeholder="Weight">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" id="address" required="true" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="message" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" required="">
                    </div>
                    <button type="submit" class="btn btn-primary submit mb-4" name="submit">Register</button>
                    <p class="account-w3ls text-center pb-4" style="color:#000">Already Registered? <a href="login.php">Signin now</a></p>
                </form>
            </div>
        </div>
    </section>

    <?php include('includes/footer.php');?>

    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/responsiveslides.min.js"></script>
    <script src="js/fixed-nav.js"></script>
    <script src="js/SmoothScroll.min.js"></script>
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/medic.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
