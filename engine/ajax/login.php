<?php
session_start();
// Security

if(!isset($_POST['action']) and $_POST['action'] !== 'Login'){
	echo "Not allowed" ;
	exit();
}

// Load Functions ///
require_once("../config/connect.php"); 
require_once("../fn/lib.php"); 
require_once("../fn/fn.php"); 

$action = sanitize($_POST['action']) ;
$username = strtolower(sanitize($_POST['username']));
$password = sanitize($_POST['password']);
$status = $goto = '' ; // Initialise variables 

$login = User_Login($username , $password) ;

if($login == true ){
	
	$_SESSION['key'] = sha1($_SESSION['token']); /// set key for checking
	/// For referrals
	
	/// Update lastlogin time
	$time = date('Y-m-d H:i:s') ;
mysql_query("UPDATE prp_users SET lastlogin = '$time' WHERE username = '$username'");
	
	if(isset($_COOKIE['ref'])){
		$goto = $_COOKIE['ref'] ;
	}
	else{
		$goto = './dashboard' ;
	}
	
	$status = "$('.login').html('Login successful');window.location = '$goto'" ;
}
elseif($login == false){
	$status = "alert('Invalid username or password');" ;
}
elseif($login == 'error'){
	$status = "alert('An error occured');" ;
}

echo '$(function() { '.$status.'}) ;' ;
?>