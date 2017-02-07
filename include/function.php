<?php 
function redirect_to($new_location){
	header("Location: ". $new_location);
	exit();
}


//scape string 
function mysql_prep($string) {
	global $connection;
	
	$escaped_string = mysqli_real_escape_string($connection, $string);
	return $escaped_string;
}

//confirm query 
function confirm_query($result_set){
	if (!$result_set) {
		die("Database query faild");
	}
}

//for check error message
function form_errors($errors=array()) {
	$output = "";
	if (!empty($errors)) {
	  $output .= "<div class=\"error\">";
	  $output .= "Please fix the following errors:";
	  $output .= "<ul>";
	  foreach ($errors as $key => $error) {
	    $output .= "<li>";
			$output .= htmlentities($error);
			$output .= "</li>";
	  }
	  $output .= "</ul>";
	  $output .= "</div>";
	}
	return $output;
}





//find all earn status 
function find_earn_item($userId){
	global $connection;

	$query = "SELECT * FROM earn WHERE user_id = {$userId} ORDER BY id DESC";
	$earnItem = mysqli_query($connection,$query);
	confirm_query($earnItem);
	return $earnItem;
}

//find all save item by date
function find_earn_item_date($userId, $startDate, $endDate){
	global $connection;

	if($startDate && $endDate){
		$query = "SELECT * FROM earn WHERE user_id = {$userId} AND earndate >= '{$startDate}' AND earndate <= '{$endDate}' ORDER BY id DESC";
		
	} else {
		$query = "SELECT * FROM earn WHERE user_id = {$userId} AND earndate = '{$startDate}' ORDER BY id DESC";
   }


	$earnItem = mysqli_query($connection,$query);
	confirm_query($earnItem);
	return $earnItem;
}


//find all cost item by date
function find_cost_item_date($userId, $startDate, $endDate){
	global $connection;

	if($startDate && $endDate){
		$query = "SELECT * FROM cost WHERE user_id = {$userId} AND costdate >= '{$startDate}' AND costdate <= '{$endDate}' ORDER BY id DESC";
	} else {
		$query = "SELECT * FROM cost WHERE user_id = {$userId} AND costdate = '{$startDate}' ORDER BY id DESC";
   }
	$costItem = mysqli_query($connection, $query);
	confirm_query($costItem);
	return $costItem;
}


//total saving amount
function monthly_saving_amount($uid) {
	global $connection;

	//$query = "SELECT SUM(earnamount) AS monthly_value_sum FROM earn GROUP BY earnmonth";
	$query = "SELECT earnamount, SUM (earnamount) FROM earn GROUP BY earnmonth";
	$sss = mysqli_query($connection, $query);
	confirm_query($sss);

	$monthlysave = mysqli_fetch_assoc($sss);
	return $monthlysave;
}

//total saving amount
function total_saving_account() {
	global $connection;

	$query = "SELECT SUM(earnamount) AS save_value_sum FROM earn";
	$totalsave = mysqli_query($connection, $query);
	confirm_query($totalsave);

	$gettotalSave = mysqli_fetch_assoc($totalsave);
	return $gettotalSave;
}


//total costing amount
function total_costing_account() {
	global $connection;

	$query = "SELECT SUM(costnamount) AS cost_value_sum FROM cost";
	$totalcost = mysqli_query($connection, $query);
	confirm_query($totalcost);

	$gettotalCost = mysqli_fetch_assoc($totalcost);
	return $gettotalCost;
}

//devit amount
// function devit_amount() {
// 	global $connection;
// 	$total = "";

// 	$tsave = total_saving_account();
// 	$tcost = total_costing_account();	

// 	$total = $tsave['save_value_sum'] - $tcost['cost_value_sum'];
// 	return $total;
// }
function devit_amount() {
	global $connection;
	$total = "";

	$tsave = total_saving_account();
	$tcost = total_costing_account();	

	$total = $tsave['save_value_sum'] - $tcost['cost_value_sum'];
	return $total;
}


//find all earn status 
function find_cost_item($userId){
	global $connection;

	$query = "SELECT * FROM cost WHERE user_id = {$userId} ORDER BY id DESC";
	$costItem = mysqli_query($connection,$query);
	confirm_query($costItem);
	return $costItem;
}


//find all users 
function find_user_by_email($useremail) {
	global $connection;

	$safe_useremail = mysqli_real_escape_string($connection, $useremail);

	$query  = "SELECT * ";
	$query .= "FROM user ";
	$query .= "WHERE uemail = '{$safe_useremail}' ";
	$query .= "AND active = 1 ";
	$query .= "LIMIT 1";

    $user_set = mysqli_query($connection, $query);
    confirm_query($user_set);
	if($user = mysqli_fetch_assoc($user_set)) {
		return $user;
	} else {
		return null;
	}
}


function password_encrypt($password) {
  $hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
  $salt = generate_salt($salt_length);
  $format_and_salt = $hash_format . $salt;
  $hash = crypt($password, $format_and_salt);
  return $hash;
}


function generate_salt($length) {
  // Not 100% unique, not 100% random, but good enough for a salt
  // MD5 returns 32 characters
  $unique_random_string = md5(uniqid(mt_rand(), true));
  
  // Valid characters for a salt are [a-zA-Z0-9./]
  $base64_string = base64_encode($unique_random_string);
  
  // But not '+' which is valid in base64 encoding
  $modified_base64_string = str_replace('+', '.', $base64_string);
  
  // Truncate string to the correct length
  $salt = substr($modified_base64_string, 0, $length);
  
	return $salt;
}

function password_check($password, $existing_hash) {
	// existing hash contains format and salt at start
  $hash = crypt($password, $existing_hash);
  if ($hash === $existing_hash) {
    return true;
  } else {
    return false;
  }
}

function attempt_login($useremail, $password) {
	$user = find_user_by_email($useremail);
	if ($user) {
		// found user, now check password
		if (password_check($password, $user["hashed_password"])) {
			// password matches
			return $user;
		} else {
			// password does not match
			return false;
		}
	} else {
		// user not found
		return false;
	}
}

function logged_in() {
	return isset($_SESSION['user_id']);
}

function confirm_logged_in() {
	if (!logged_in()) {
		redirect_to("login.php");
	}
}


//login process

