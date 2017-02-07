<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php confirm_logged_in(); ?>

<?php
$earnid = $_POST["id"];

$query = "DELETE FROM earn WHERE id = {$earnid}";
$result = mysqli_query($connection, $query);
if(!$result) {
  echo "Error";
} else {
  echo "Success";
}
?>