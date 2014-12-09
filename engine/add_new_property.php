<?php

session_start();
// Security
// NB: Exit() after each condition

if(!isset($_POST['action']) or $_POST['action'] !== 'AddNewProperty' or $_SESSION['type'] == 3){
	echo "Not allowed" ;
	exit();
}

// Load Functions ///
require_once("config/connect.php");  
require_once("fn/lib.php");
require_once("fn/fn.php"); 
require_once("fn/simpleimage.php"); 

$_POST = sanitize($_POST);

///####      IMAGE HANDLING      #####///

$max_size = 3145728 ; /// 3MB
$valid_formats = array("png", "gif", "jpg" , "jpeg") ; /// valid formats
$path = '../property_images/' ;

$uploadedImages = array();
$i = 0 ;

/// Loop through
foreach($_FILES as $imgArr){  /// star of main loop

if(isset($imgArr['name']) and !empty($imgArr['name'])){    
	$name =  $imgArr['name']  ;
	$size =  $imgArr['size']  ;
	$tmp_name =  $imgArr['tmp_name']  ;
	
	// Check if file is an image
	list($txt, $ext) = explode(".", $name);
	$ext = strtolower($ext) ; 
	if(!in_array($ext,$valid_formats)){
    echo "<script>alert('The file $name is not an image file');history.go(-1);</script>" ;
	exit();
	}
	
	// Check if image exceeds file size
	if($size > $max_size){
  echo "<script>alert('The image $name exceeded the file size limit'));history.go(-1);</script>" ;
	exit();
	}
	
	$name = $txt.'.'.$ext ;  // Join name back with extension to lowercase
	
	/// Upload Images
	$doUpload = Upload_image( $name , $size , $tmp_name , $path) ;
	if($doUpload !== false){  // If image upload was successful
	
	//// Compress image
   $compImg = new SimpleImage();
   $compImg->load($path.$doUpload);
   $compImg->resizeToWidth(100);  /// compression rate
   $compImg->save($path.$doUpload);
   
   // If image upload was successful
   $i++;
   $uploadedImages[$i] = $doUpload ;
   }
   else{ 
   // If image upload fails for an entry, delete all former uploaded ones
   if(!empty($uploadedImages)){
	   foreach($uploadedImages as $pic){
		   unlink($path.$pic) ;  /// Delete other images
	   }
   }
   echo "<script>alert('Uploading of $name Failed');history.go(-1);</script>" ;
   exit();  
   }
	
}
} /// End of main loop

///####  END OF IMAGE HANDLING  #####///

$imageFileNames = implode("|",$uploadedImages);  // Names of uploaded images

$_POST = sanitize($_POST);  /// clean inputs 

$address = $_POST['address'] ;
$proptype = $_POST['propertytype'] ;
$price_int = get_numeric_price($_POST['price']) ;
$price = $_POST['price'] ;
$openhouse = $_POST['openhouse'] ;
$leastype = $_POST['for'] ;
$beds = $_POST['beds'] ;
$baths = $_POST['baths'] ;
$description = $_POST['description'] ;
$token = get_random();

/// Form Queries
$q = "INSERT INTO prp_listings SET token='$token', address='$address', property_type='$proptype', price_int='$price_int', price='$price', open_house='$openhouse', lease_type='$leastype', beds='$beds', baths='$baths', description='$description', images='$imageFileNames'" ;

if(mysql_query($q)){
   echo "<script> window.location='.././view-property?token=$token'; </script>" ;
   exit();
}
else{
	   // If insert fails for an entry, delete all former uploaded ones
   if(!empty($uploadedImages)){
	   foreach($uploadedImages as $pic){
		   unlink($path.$pic) ;  /// Delete other images
	   }
   }
   echo "<script>alert('Error occured while adding property');history.go(-1);</script>" ;
	
}





?>