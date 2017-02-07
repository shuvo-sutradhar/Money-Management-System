<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/validation.php"); ?>
<?php confirm_logged_in(); ?>
<?php

if(isset($_POST["editEarnSub"])) {
  $id = $_POST['eid'];
  $editEarnItem = mysql_prep($_POST['editEarnItem']);
  $editEarnAmont = (int) $_POST['editEarnAmont'];
  $EditearnSource = mysql_prep($_POST['EditearnSource']);
  $editEarnCat = $_POST['editEarnCat'];


  // validations
  $required_fields = array("editEarnItem", "editEarnAmont", "EditearnSource", "editEarnCat");
  validate_presences($required_fields);


  if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    redirect_to("save.php");
  }

  $query = "UPDATE earn SET earnitem = '{$editEarnItem}', earnamount = {$editEarnAmont}, earnsource = '{$EditearnSource}', deleted = {$editEarnCat} WHERE id = {$id}";
  $result = mysqli_query($connection, $query);
  if($result){
    $_SESSION['message'] = "Thank You . Your Item change successfully.";
    redirect_to("save.php");
  } else {
    $_SESSION['message'] = "Thank You . Your Item not Change successfully.";
    redirect_to("save.php");
  }
} else {
  echo "Something is wrong";
}