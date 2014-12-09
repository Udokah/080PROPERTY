<?php
session_start();
define("CURRENTPAGE", "deleteListing.php");
require_once("auth.php") ; 

if(!isset($_GET['token'])){
	echo "Not allowed" ;
	exit();
}

if($_SESSION['type'] == 3){
    echo "Not allowed" ;
	exit();
}

require_once("fn/lib.php") ; 
$token = sanitize($_GET['token']);

if(mysql_query("DELETE FROM prp_listings WHERE token = '$token'")){
$msg = "<script>alert('Property has been deleted'); 
         window.location = '.././manage-properties';
		 </script>" ;
		 
// Delete all images
if(!empty($_GET['images'])){
$IMG = explode("|",$_GET['images']) ; // get all images
foreach($IMG as $pic){
	$pic = '../property_images/'.$pic ;
	if(file_exists($pic)){
	unlink($pic);
	}
  }
}
		
}
else{
	$msg = "<script>alert('Unable to delete property'); 
         history.go(-1);
		 </script>" ;
}


echo $msg ;
exit();

?>