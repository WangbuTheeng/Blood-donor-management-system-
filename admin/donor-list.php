<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    // Handle hiding donor details
    if (isset($_REQUEST['hidden'])) {
        $eid = intval($_GET['hidden']);
        $status = 0;
        $sql = "UPDATE tblblooddonars SET Status=:status WHERE id=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Donor details hidden successfully";
    }

    // Handle publicizing donor details
    if (isset($_REQUEST['public'])) {
        $aeid = intval($_GET['public']);
        $status = 1;
        $sql = "UPDATE tblblooddonars SET Status=:status WHERE id=:aeid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Donor details made public";
    }

    // Handle approving donors
    if (isset($_REQUEST['approve'])) {
        $aid = intval($_GET['approve']);
        $status = 1;
        $sql = "UPDATE tblblooddonars SET approved=:status WHERE id=:aid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':aid', $aid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Donor approved successfully";
    }

    // Handle rejecting donors
    if (isset($_REQUEST['reject'])) {
        $rid = intval($_GET['reject']);
        $status = 0;
        $sql = "UPDATE tblblooddonars SET approved=:status WHERE id=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Donor rejected successfully";
    }

    // Handle deleting donor
    if (isset($_REQUEST['del'])) {
        $did = intval($_GET['del']);
        $sql = "DELETE FROM tblblooddonars WHERE id=:did";
        $query = $dbh->prepare($sql);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        $query->execute();
        $msg = "Record deleted successfully";
    }

    // Advanced search functionality
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $sql = "";
    if ($search) {
        // Split search query into words
        $searchTerms = explode(" ", $search);
        $sqlParts = [];
        foreach ($searchTerms as $term) {
            $sqlParts[] = "(FullName LIKE :search OR MobileNumber LIKE :search OR EmailId LIKE :search OR Age LIKE :search OR BloodGroup LIKE :search OR Gender LIKE :search OR Weight LIKE :search OR Diseases LIKE :search)";
        }

        // Combine parts into a single SQL query
        $sql = "SELECT * FROM tblblooddonars WHERE " . implode(" AND ", $sqlParts);
    } else {
        // Default: show all donors
        $sql = "SELECT * FROM tblblooddonars";
    }

    $query = $dbh->prepare($sql);
    if ($search) {
        // Bind the same search parameter for each part of the search query
        $searchParam = "%" . $search . "%";
        for ($i = 0; $i < count($searchTerms); $i++) {
            $query->bindParam(':search', $searchParam, PDO::PARAM_STR);
        }
    }
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>BBDMS | Donor List</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Donors List</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Donors Info</div>
                            <div class="d-flex justify-content-between mb-3">
                                <a href="download-records.php" class="btn btn-info">Download Donor List</a>
                                <?php if ($error) { ?>
                                    <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div>
                                <?php } else if ($msg) { ?>
                                    <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                                <?php } ?>
                            </div>
                            <div class="panel-body">
                                <!-- Search form -->
                                <form method="POST" class="form-inline mb-3">
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search (e.g., Name, Mobile, Email, Blood Group, Weight)" value="<?php echo htmlentities($search); ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>

                                <table id="zctb" class="display table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Mobile No</th>
                                            <th>Email</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Blood Group</th>
                                            <th>Weight</th>
                                            <th>Diseases</th>
                                            <th>Approval Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($result->FullName); ?></td>
                                                    <td><?php echo htmlentities($result->MobileNumber); ?></td>
                                                    <td><?php echo htmlentities($result->EmailId); ?></td>
                                                    <td><?php echo htmlentities($result->Age); ?></td>
                                                    <td><?php echo htmlentities($result->Gender); ?></td>
                                                    <td><?php echo htmlentities($result->BloodGroup); ?></td>
                                                    <td><?php echo htmlentities($result->Weight); ?></td>
                                                    <td><?php echo htmlentities($result->Diseases); ?></td>
                                                    <td>
                                                        <?php
                                                        if (is_null($result->approved)) {
                                                            echo "Pending Approval";
                                                        } elseif ($result->approved == 1) {
                                                            echo "Approved";
                                                        } else {
                                                            echo "Rejected";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if (is_null($result->approved) || $result->approved == 0) { ?>
                                                            <a href="donor-list.php?approve=<?php echo htmlentities($result->id); ?>" class="btn btn-success">Approve</a>
                                                        <?php } ?>
                                                        <?php if (is_null($result->approved) || $result->approved == 1) { ?>
                                                            <a href="donor-list.php?reject=<?php echo htmlentities($result->id); ?>" class="btn btn-danger">Reject</a>
                                                        <?php } ?>
                                                        <a href="donor-list.php?del=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you want to delete this record?');" class="btn btn-warning">Delete</a>
                                                    </td>
                                                </tr>
                                        <?php $cnt++;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
