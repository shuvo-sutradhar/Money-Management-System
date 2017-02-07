<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/validation.php"); ?>
<?php confirm_logged_in(); ?>

<?php
//excel.php

$output = '';
if (isset($_POST['export_excel'])) {
		if(isset($_POST['genarate'])) {
	    $startDate = $_POST['startdate'];
	    $endDate = $_POST['enddate'];
	    $userid = $_SESSION['user_id'];
	    $match = "false";

	    $genarateReport = find_earn_item_date($userid, $startDate, $endDate);
	    print_r($genarateReport);
	    die();
	}
}
else {
	echo "dfg";
}

header('Content-Type: application/xls');
header('Content-disposition: attachment; filename='.rand().'.excl');
print_r($_GET['data']);
die();
