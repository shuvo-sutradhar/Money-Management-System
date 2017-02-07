<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/validation.php"); ?>


<?php
//$username = "";

if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("userEmail", "uPassword");
  validate_presences($required_fields);
  
  if (empty($errors)) {
    // Attempt Login

    $userEmail = $_POST['userEmail'];
    $uPassword = $_POST['uPassword'];

        
    $found_admin = attempt_login($userEmail, $uPassword);

    if ($found_admin) {
        // Success
        // Mark user as logged in
        $_SESSION["user_id"] = $found_admin["id"];
        $_SESSION["username"] = $found_admin["userName"];
        $_SESSION["useremail"] = $found_admin["uemail"];
        redirect_to("index.php");
    } else {
      // Failure
      $_SESSION["message"] = "Username/password not found.";
    }
  }
} else {
  // This is probably a GET request
} // end: if (isset($_POST['submit']))

?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body style="background:#20A19D">
        <section class="login">
            <div class="col-md-offset-4 col-md-4">
                <div class="loginHeader">
                    Money Management System
                </div><!-- login header -->
                <div class="loginMessagge">
                    <?php echo message(); ?>
                    <?php echo form_errors($errors); ?>
                 </div>
                <form action="login.php" method="post" class="loginForm">
                      <input class="form-control form-controlcust" type="email" placeholder="UserEmail" name="userEmail" required>
                      <input class="form-control form-controlcust" type="password" placeholder="Password" name="uPassword" required>
                      <input class="form-control loginsubmit" type="submit" name="submit">
                </form>
            </div> 
        </section><!-- /. login -->

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="assets/js/bootstrap.min.js"></script>       
        <script src="assets/js/plugins.js"></script>
    </body>
</html>    

