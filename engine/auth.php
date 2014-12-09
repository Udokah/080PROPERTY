<?php
if(!isset($_SESSION['username'])){
setcookie("ref", CURRENTPAGE, time()+150);  
header("location: ./login");
exit();
}

$key = $_SESSION['key'] ; // get current key
$username  = $_SESSION['username'] ; /// get username

require_once("config/connect.php") ;  // connect to DB
$q = mysql_query("SELECT username,token FROM prp_users WHERE username = '$username' AND blocked = '0'");

$r = mysql_fetch_array($q);
if(!isset($r['username'])){	
setcookie("ref", CURRENTPAGE, time()+150);  
header("location: ./login");

unset($key,$username,$q,$r) ;
exit();
}
else{
	/// If username is set and key does not match
if(sha1($r['token']) !== $key){
	setcookie("ref", CURRENTPAGE, time()+150);  
header("location: ./login");

unset($key,$username,$q,$r) ;
exit();
}
	
}

/// RESTRICT USERS FROM SPECIFIC PAGES
$message =  "<center><h2>You not allowed to view this page</h2><br>
          <a href='#' onclick='history.go(-2)'>Click here to go back</a></center>" ;
		  
if(CURRENTPAGE == './manage-users'){

if($_SESSION['type'] !== '1'){
	echo $message ;
	exit();
}
	
}
elseif(CURRENTPAGE == './add-new-property'){
	
	if($_SESSION['type'] == '3'){
	echo $message ;
	exit();
}
}





?>
