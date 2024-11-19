<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0) {	
    header('location:index.php');
} else {
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>BBDMS | Donor List</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">

	<style>
		.errorWrap {
		    padding: 10px;
		    margin: 0 0 20px 0;
		    background: #fff;
		    border-left: 4px solid #dd3d36;
		    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
		.succWrap {
		    padding: 10px;
		    margin: 0 0 20px 0;
		    background: #fff;
		    border-left: 4px solid #5cb85c;
		    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
	</style>
</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>

		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="col-md-12">
					<h3>Blood Requests Received</h3>
					<hr />

					<!-- Search Form -->
					<div class="panel-body">
						<form method="post" name="search" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4 control-label">Search by Donor Name, Donor Contact, Requirer Name, Requirer Mobile, Requirer Email</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="searchdata" id="searchdata" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-4">
									<button class="btn btn-primary" name="search" type="submit">Search</button>
								</div>
							</div>
						</form>
					</div>

					<!-- Table to Display Data -->
					<div class="panel panel-default">
						<div class="panel-heading">Blood Info</div>
						<div class="panel-body">
							<table border="1" class="table table-responsive">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Name of Donor</th>
										<th>Contact Number of Donor</th>
										<th>Name of Requirer</th>
										<th>Mobile Number of Requirer</th>
										<th>Email of Requirer</th>
										<th>Blood Required For</th>
										<th>Message of Requirer</th>
										<th>Apply Date</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(isset($_POST['search'])) {
										$sdata = $_POST['searchdata'];

										// Modify SQL to include conditions for all fields
										$sql = "SELECT tblbloodrequirer.BloodDonarID, tblbloodrequirer.name, tblbloodrequirer.EmailId, tblbloodrequirer.ContactNumber, tblbloodrequirer.BloodRequirefor, tblbloodrequirer.Message, tblbloodrequirer.ApplyDate, tblblooddonars.id as donid, tblblooddonars.FullName, tblblooddonars.MobileNumber 
												FROM tblbloodrequirer 
												JOIN tblblooddonars ON tblblooddonars.id = tblbloodrequirer.BloodDonarID
												WHERE tblblooddonars.FullName LIKE :searchdata
												OR tblblooddonars.MobileNumber LIKE :searchdata
												OR tblbloodrequirer.name LIKE :searchdata
												OR tblbloodrequirer.ContactNumber LIKE :searchdata
												OR tblbloodrequirer.EmailId LIKE :searchdata
												OR tblbloodrequirer.BloodRequirefor LIKE :searchdata
												OR tblbloodrequirer.Message LIKE :searchdata";

										$query = $dbh->prepare($sql);
										$searchdata = "%".$sdata."%";  // Prepare for search pattern
										$query->bindParam(':searchdata', $searchdata, PDO::PARAM_STR);
										$query->execute();
										$results = $query->fetchAll(PDO::FETCH_OBJ);
										$cnt = 1;

										if($query->rowCount() > 0) {
											foreach($results as $row) {
									?>
									<tr>
										<td><?php echo htmlentities($cnt); ?></td>
										<td><?php echo htmlentities($row->FullName); ?></td>
										<td><?php echo htmlentities($row->MobileNumber); ?></td>
										<td><?php echo htmlentities($row->name); ?></td>
										<td><?php echo htmlentities($row->ContactNumber); ?></td>
										<td><?php echo htmlentities($row->EmailId); ?></td>
										<td><?php echo htmlentities($row->BloodRequirefor); ?></td>
										<td><?php echo htmlentities($row->Message); ?></td>
										<td><?php echo htmlentities($row->ApplyDate); ?></td>
									</tr>
									<?php
												$cnt++;
											}
										} else {
									?>
										<tr>
											<td colspan="9" style="color:red;">No records found</td>
										</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>

<?php } ?>
