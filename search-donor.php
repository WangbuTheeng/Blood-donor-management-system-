<?php
//error_reporting(0);
include('includes/config.php');

// Define BloodDonor class to represent donor data
class BloodDonor {
    public $id;
    public $fullName;
    public $bloodGroup;
    public $address;
    public $gender;
    public $mobileNumber;
    public $emailId;
    public $age;
    public $message;
    public $approved;
    
    public function __construct($data) {
        $this->id = $data->id;
        $this->fullName = $data->FullName;
        $this->bloodGroup = $data->BloodGroup;
        $this->address = $data->Address;
        $this->gender = $data->Gender;
        $this->mobileNumber = $data->MobileNumber;
        $this->emailId = $data->EmailId;
        $this->age = $data->Age;
        $this->message = $data->Message;
        $this->approved = $data->approved;
    }
}

function flexibleLinearSearchDonors($donors, $searchCriteria) {
    $matchingDonors = array();
    $requiredBloodGroup = $searchCriteria['bloodgroup'];
    $optionalLocation = $searchCriteria['location'];
    $approvedStatus = 1;
    
    foreach ($donors as $donor) {
        $donorObj = new BloodDonor($donor);
        
        // Check if donor is approved and blood group matches
        $bloodGroupMatch = ($donorObj->bloodGroup === $requiredBloodGroup);
        
        // Location check is optional
        $locationMatch = empty($optionalLocation) || 
            (stripos(strtolower(trim($donorObj->address)), strtolower(trim($optionalLocation))) !== false);
        
        // Check if donor meets criteria
        if ($donorObj->approved == $approvedStatus && 
            $bloodGroupMatch && 
            $locationMatch) {
            $matchingDonors[] = $donorObj;
        }
    }
    
    return $matchingDonors;
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Blood Donor Management System | Flexible Donor Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/fontawesome-all.css">
    
    <!-- Web Fonts -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
</head>

<body>
    <?php include('includes/header.php');?>

    <!-- search form -->
    <div class="agileits-contact py-5">
        <div class="py-xl-5 py-lg-3">
            <form name="donar" method="post" style="padding-left: 30px;">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="font-italic">Blood Group<span style="color:red">*</span></div>
                        <div>
                            <select name="bloodgroup" class="form-control" required>
                                <option value="">Select Blood Group</option>
                                <?php
                                $sql = "SELECT * from tblbloodgroup";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                        ?>
                                        <option value="<?php echo htmlentities($result->BloodGroup);?>">
                                            <?php echo htmlentities($result->BloodGroup);?>
                                        </option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="font-italic">Location (Optional)</div>
                        <div>
                            <input type="text" class="form-control" name="location" placeholder="Enter location (optional)">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div>
                            <input type="submit" name="sub" class="btn btn-primary" value="Search Donors" style="cursor:pointer">
                        </div>
                    </div>
                </div>
            </form>

            <!-- Search Results -->
            <div class="agileits-contact py-5">
                <div class="py-xl-5 py-lg-3">
                    <?php
                    if (isset($_POST['sub'])) {
                        // Validate blood group is selected
                        if (empty($_POST['bloodgroup'])) {
                            echo "<div class='alert alert-danger text-center'>
                                    <strong>Error:</strong> Please select a Blood Group.
                                  </div>";
                            exit;
                        }

                        try {
                            // Fetch all donors
                            $sql = "SELECT * from tblblooddonars WHERE approved = 1";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $allDonors = $query->fetchAll(PDO::FETCH_OBJ);
                            
                            // Prepare search criteria
                            $searchCriteria = array(
                                'bloodgroup' => $_POST['bloodgroup'],
                                'location' => $_POST['location'] ?? ''
                            );
                            
                            // Perform flexible linear search
                            $results = flexibleLinearSearchDonors($allDonors, $searchCriteria);
                            
                            if (count($results) > 0) {
                                ?>
                                <div class="w3ls-titles text-center mb-5">
                                    <h3 class="title">Donor Search Results</h3>
                                    <p class="text-muted">
                                        Showing donors with Blood Group: 
                                        <strong><?php echo htmlentities($_POST['bloodgroup']); ?></strong>
                                        <?php 
                                        if (!empty($_POST['location'])) {
                                            echo "and Location: <strong>" . htmlentities($_POST['location']) . "</strong>";
                                        }
                                        ?>
                                    </p>
                                    <span><i class="fas fa-user-md"></i></span>
                                </div>

                                <div class="container">
                                    <div class="row">
                                        <?php
                                        foreach ($results as $result) {
                                            ?>
                                            <div class="col-md-6 mb-4">
                                                <div class="card">
                                                    <div class="card-header bg-primary text-white">
                                                        <h5 class="card-title mb-0"><?php echo htmlentities($result->fullName);?></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-borderless">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Blood Group</th>
                                                                    <td><?php echo htmlentities($result->bloodGroup);?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Location</th>
                                                                    <td><?php echo htmlentities($result->address);?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Contact</th>
                                                                    <td><?php echo htmlentities($result->mobileNumber);?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="card-footer">
                                                        <a href="contact-blood.php?cid=<?php echo $result->id;?>" class="btn btn-outline-primary btn-sm">
                                                            Request Donation
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            } else {
                                echo "<div class='alert alert-warning text-center'>
                                        <strong>No Donors Found!</strong> 
                                        No donors match the selected criteria. Try adjusting your search.
                                      </div>";
                            }
                        } catch (PDOException $e) {
                            echo "<div class='alert alert-danger text-center'>
                                    <strong>Error:</strong> " . htmlentities($e->getMessage()) . "
                                  </div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php');?>

    <!-- JavaScript Files -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>