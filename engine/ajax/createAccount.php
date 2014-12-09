<?php

session_start();
// Security

if(!isset($_POST['action']) or $_POST['action'] !== 'createNewAccount' or $_SESSION['type'] !== '1'){
		echo "$(function(){ alert('Not allowed'); });" ;
	exit();
}

// Load Functions ///
require_once("../config/connect.php"); 
require_once("../fn/lib.php"); 
require_once("../fn/fn.php"); 

$fullname = sanitize($_POST['fullname']) ;
$username = strtolower(sanitize($_POST['username'])) ; // change to lower case :: IMPORTANT
$acctype = sanitize($_POST['acctype']) ;
$password = sha1(sanitize($_POST['password'])) ; // encrypt
$token = get_random() ; /// create validation token

/// Recheck if username is valid
$check = check_username($username) ;
if($check == 1){
	$ret = "alert(\"the username '$username' has just be taken, try another one.\");" ;
}
else{
	
$q = "INSERT INTO prp_users SET fullname = '$fullname', username = '$username', type = '$acctype', password = '$password', token = '$token' " ;

if(mysql_query($q)){
	$ret = "alert('Account has been sucessfully created'); 
	        $('#crNewUseracc').dialog('close');
			Load_Users() ;" ;
}
else{
	$ret = "alert('Unable to create account')" ;
}

}

	echo "$(function(){ ".$ret." });" ;
	exit(); 

?>