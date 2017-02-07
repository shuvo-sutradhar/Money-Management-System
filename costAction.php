<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/validation.php"); ?>
<?php confirm_logged_in(); ?>
<?php

date_default_timezone_set("Asia/Dhaka");
if(isset($_POST["submit"])) {
  $costItem = mysql_prep($_POST['costItem']);
  $costAmont = (int) $_POST['costAmont'];
  $date = strftime("%d/%m/%Y");
  $userid = $_SESSION['user_id'];
  $costcat = $_POST['costcat'];


  // validations
  $required_fields = array("costItem", "costAmont","costcat");
  validate_presences($required_fields);


  if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    redirect_to("cost.php");
  }

  $query =  "INSERT INTO cost(";
  $query .= " user_id, costitem, costnamount, costdate, deleted";
  $query .= " ) VALUES(";
  $query .= " {$userid}, '{$costItem}', {$costAmont}, '{$date}', {$costcat})";




  $result = mysqli_query($connection, $query);
  if($result){
    $_SESSION['message'] = "Thank You . Your Item save successfully.";
    redirect_to("cost.php");
  } else {
    $_SESSION['message'] = "Thank You . Your Item not save successfully.";
    redirect_to("cost.php");
  }
} else {
  echo "Something is wrong";
}