<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/validation.php"); ?>
<?php confirm_logged_in(); ?>
<?php

date_default_timezone_set("Asia/Dhaka");
if(isset($_POST["submit"])) {
  $earnItem = mysql_prep($_POST['earnItem']);
  $earnAmont = (int) $_POST['earnAmont'];
  $earnSource = mysql_prep($_POST['earnSource']);
  $date = strftime("%d/%m/%Y");
  $month = strftime("%m");
  $userid = $_SESSION['user_id'];
  $earncat = $_POST['earncat'];


  // validations
  $required_fields = array("earnItem", "earnAmont", "earnSource", "earncat");
  validate_presences($required_fields);


  if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    redirect_to("save.php");
  }

  $query =  "INSERT INTO earn(";
  $query .= " user_id, earnitem, earnamount, earnsource, earndate, earnmonth, deleted";
  $query .= " ) VALUES(";
  $query .= " {$userid}, '{$earnItem}', {$earnAmont}, '{$earnSource}', '{$date}','{$month}', {$earncat})";


  $result = mysqli_query($connection, $query);
  if($result){
    $_SESSION['message'] = "Thank You . Your Item save successfully.";
    redirect_to("save.php");
  } else {
    $_SESSION['message'] = "Thank You . Your Item not save successfully.";
    redirect_to("save.php");
  }
} else {
  echo "Something is wrong";
}