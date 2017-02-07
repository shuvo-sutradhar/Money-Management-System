<?php require_once("include/seassion.php"); ?>
<?php require_once("include/function.php"); ?>

<?php
  // v1: simple logout
  // session_start();
  $_SESSION["user_id"] = null;
  $_SESSION["username"] = null;
  $_SESSION["useremail"] = null;
  session_destroy(); 
  redirect_to("login.php");
?>