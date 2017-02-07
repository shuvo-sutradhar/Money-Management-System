<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$costid = $_POST["id"];

$query = "DELETE FROM cost WHERE id = {$costid}";
$result = mysqli_query($connection, $query);
if(!$result) {
  echo "Error";
} else {
  echo "Success";
}
?>