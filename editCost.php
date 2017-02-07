<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/validation.php"); ?>
<?php confirm_logged_in(); ?>
<?php

if(isset($_POST["editCostSub"])) {
  $id = $_POST['cid'];
  $costItem = mysql_prep($_POST['editCostItem']);
  $costAmont = (int) $_POST['editCostAmont'];
  $costcat = $_POST['editCostCat'];


  // validations
  $required_fields = array("editCostItem", "editCostAmont",  "editCostCat");
  validate_presences($required_fields);


  if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    redirect_to("cost.php");
  }

  $query = "UPDATE cost SET costitem = '{$costItem}', costnamount = {$costAmont}, deleted = {$costcat} WHERE id = {$id}";
  $result = mysqli_query($connection, $query);
  if($result){
    $_SESSION['message'] = "Thank You . Your Item change successfully.";
    redirect_to("cost.php");
  } else {
    $_SESSION['message'] = "Thank You . Your Item not Change successfully.";
    redirect_to("cost.php");
  }
} else {
  echo "Something is wrong";
}