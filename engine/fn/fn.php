<?php
$img_path = 'property_images/' ;

/// change Password
function change_password($username,$oldpassword,$newpassword){
	
	$check = User_Login($username , $oldpassword) ; // Validate old password
	if($check == true){
		$newpassword = sha1($newpassword); // encrypt password 
if(mysql_query("UPDATE prp_users SET password='$newpassword' WHERE username='$username'")){
	$status = true ;
		}
		else{
			$status = false ;
		}
	}
	else{
		$status = 'failed' ; // Validation failed
	}
	
	return $status ;
}

/// Change username
function change_username($oldname,$newname){
	$status = '' ;
if(mysql_query("UPDATE prp_users SET username = '$newname' WHERE username = '$oldname'")){
		$status = true ;
	}
	else{
		$status = false ;
	}
	
	return $status ;
}

// Update Properties

function Update_property($POST){

$address = $_POST['address'] ;
$propertytype = $_POST['propertytype'] ;
$price_int = get_numeric_price($_POST['price']) ;
$price = $_POST['price'] ;
$openhouse = $_POST['openhouse'] ;
$leastype = $_POST['leaseType'] ;
$beds = $_POST['beds'] ;
$baths = $_POST['baths'] ;
$description = $_POST['description'] ;
$token = $_POST['token'];

$q = "UPDATE prp_listings SET address='$address', property_type='$propertytype', price_int='$price_int', price='$price', open_house='$openhouse', lease_type='$leastype', beds='$beds', baths='$baths', description='$description' WHERE token='$token'" ;

if(mysql_query($q) or die(mysql_error())){
	$status = true ;
}
else{
	$status = false ;
}

return $status ;
}

// Seach Listings
function Search_Listings($PARAMS){
	extract($PARAMS); // extract all parameters
	
	global $MAX_REQ_SIZE ;
	global $img_path ;
	$get = $page * $MAX_REQ_SIZE ;
	
	$data = array(); /// Create array container for values
	$i = 0 ;	

// Set Search Conditions	
$Where = "WHERE address LIKE '%$location%'" ;

if(!empty($mnprice)){
	$mnprice = get_numeric_price($mnprice) ; // get numeric price
	$mnprice--; // remove 1 so that current price will be included
	$Where.= " AND price_int > '$mnprice'" ;
}

elseif(!empty($mxprice)){
	$mxprice = get_numeric_price($mxprice) ; // get numeric price
	$mxprice++ ; // add 1 so that current price will be included
	$Where.= " AND price_int < '$mxprice'" ;
}

elseif(!empty($openhouse) and $openhouse == 1){
	$Where.= " AND open_house = '1'" ;
}

elseif(!empty($proptype)){
	$Where.= " AND property_type = '$proptype'" ;
}

elseif(!empty($beds)){
	$Where.= " AND beds = '$beds'" ;
}

elseif(!empty($baths)){
	$Where.= " AND baths = '$baths'" ;
}

elseif(!empty($sale) and $sale == 1){
	$Where.= " AND lease_type = 'sale'" ;
}

elseif(!empty($rent) and $rent == 1){
	$Where.= " AND lease_type = 'rent'" ;
}

$q = "SELECT token, address, images, property_type, price, lease_type,beds, baths, description FROM prp_listings ".$Where." ORDER BY pid DESC LIMIT $get,$MAX_REQ_SIZE" ;

$qr = mysql_query($q) or die(mysql_error());

while($r = mysql_fetch_array($qr)){
	
	$token = $r['token'] ;
	$address = $r['address'] ;
	
	if(isset($r['images']) and !empty($r['images'])){
	$IMG = explode("|",$r['images']); 
	$image = $img_path.$IMG[0] ;  /// set path to image
	$image = "<img src='".$image."'alt=' ' />" ;
	}
	else{
		$image = '' ;
	}
	
	$proptype = $r['property_type'] ;
	$price = '&#x20a6;'.$r['price'] ;
	$for = $r['lease_type'] ;
	$beds = $r['beds'] ;
	$baths = $r['baths'] ;
	$description = htmlspecialchars_decode($r['description']);
	$shortDesc = substr($description, 0, 90); 
	
$data[$i] = "<fieldset><a href='./view-property?token=".$token."' class='address'>".$address."</a><div class='resultSet'><div class='imageFrame'>".$image."</div><div class='description'><h4>".$proptype."</h4><h3>".$price."</h3><span>For ".$for."</span><label>Beds: ".$beds."  Bath: ".$baths."</label><h5>Description: ".$shortDesc."...</h5></div><div class='clear'></div></div></fieldset>" ;
	
	$data[$i] = trim($data[$i]);
	
	$i++ ;
}

return $data ;
	
}

///Load Listings
function Load_Listings($page){
	global $MAX_REQ_SIZE ;
	global $img_path ;
	$get = $page * $MAX_REQ_SIZE ;
	
	$data = array(); /// Create array container for values
	$i = 0 ;
	
$q = mysql_query("SELECT token, address, images, property_type, price, lease_type,beds, baths, description FROM prp_listings ORDER BY pid DESC LIMIT $get,$MAX_REQ_SIZE") or die(mysql_error());

while($r = mysql_fetch_array($q)){
	
	$token = $r['token'] ;
	$address = $r['address'] ;
	$IMG = explode("|",$r['images']); 
	
	if(isset($r['images']) and !empty($r['images'])){
	$IMG = explode("|",$r['images']); 
	$image = $img_path.$IMG[0] ;  /// set path to image
	$image = "<img src='".$image."'alt=' ' />" ;
	}
	else{
		$image = '' ;
	}
	
	$proptype = $r['property_type'] ;
	$price = '&#x20a6;'.$r['price'] ;
	$for = $r['lease_type'] ;
	$beds = $r['beds'] ;
	$baths = $r['baths'] ;
	$description = htmlspecialchars_decode($r['description']);
	$shortDesc = substr($description, 0, 90); 
	
$data[$i] = "<fieldset><a href='./view-property?token=".$token."' class='address'>".$address."</a><div class='resultSet'><div class='imageFrame'>".$image."</div><div class='description'><h4>".$proptype."</h4><h3>".$price."</h3><span>For ".$for."</span><label>Beds: ".$beds."  Bath: ".$baths."</label><h5>Description: ".$shortDesc."...</h5></div><div class='clear'></div></div></fieldset>" ;
	
	$data[$i] = trim($data[$i]);
	
	$i++ ;
}

return $data ;
}

// function to get numeric price after removing the comma's
function get_numeric_price($price){
$int = preg_replace("/[^0-9,.]/", "", $price);
return $int;
}

// Check if username exitst
function check_username($username){
	$status = '' ;
	$q=mysql_query("SELECT username FROM prp_users WHERE username = '$username'");
	$r = mysql_fetch_array($q);
	
	if(isset($r['username']) and strtolower($r['username']) == $username){
		$status = 1 ;  // username exists
	}
	else{
		$status = 0 ;  // username does not exits
	}
	
	return $status ;
}

// Unblock user
function Remove_user($uid){
		$ret = '' ;
	if(mysql_query("DELETE FROM prp_users WHERE uid = '$uid'")){
		$ret = true ;
	}
	else{
		$ret = false ;
	}
	
	return $ret ;
}

// Unblock user
function Unblock_user($uid){
		$ret = '' ;
	if(mysql_query("UPDATE prp_users SET blocked = '0' WHERE uid = '$uid'")){
		$ret = true ;
	}
	else{
		$ret = false ;
	}
	
	return $ret ;
}

// Block User
function block_user($uid){
	$ret = '' ;
	if(mysql_query("UPDATE prp_users SET blocked = '1' WHERE uid = '$uid'")){
		$ret = true ;
	}
	else{
		$ret = false ;
	}
	
	return $ret ;
}

/// Load all users list
function Load_Users_List(){
	$data = $do = '' ;
	$q = mysql_query("SELECT * FROM prp_users ORDER BY uid DESC");
	while($r = mysql_fetch_array($q)){
		extract($r);
		$time = time_since ($lastlogin) ;
		$type = acc_type($type);
		if($blocked == '1'){
			$do = 'unblock' ;
		}
		else{
			$do = 'block' ;
		}
		$data.= "
		<tr>
<td>".$fullname."</td><td>".$username."</td><td>".$type."</td><td style='font-size:11px'>".$time."</td>
<td><span id='tl$uid' data-uid='".$uid."'><a href=\"#$do\" class=\"$do\">$do</a><a href=\"#remove\" class=\"remove\">remove</a></span></td>
</tr>  " ;
	}
	
	return $data ;
}

// Account type with names
function acc_type($type){
	$name = '' ;
	if($type == '1'){
		$name = 'Super Admin' ;
	}
	elseif($type == '2'){
		$name = 'Staff' ;
	}
	else{
		$name = 'Guest' ;
	}
	
	return $name ;
}

/// Get Last Login
function Get_last_login($username){
$q = mysql_query("SELECT lastlogin FROM prp_users WHERE username='$username'") or die(mysql_error());
$r = mysql_fetch_array($q);
$time = time_since($r['lastlogin']) ;
return $time ;
}

/// Authenticate user login
function User_Login($username , $password){

	$username = strtolower($username) ;
	$password = sha1($password); // Encrypt password
	
if($q = mysql_query("SELECT fullname,username,type,token FROM prp_users WHERE username = '$username' AND password = '$password' AND blocked = '0'")){
$r = mysql_fetch_array($q);

if(isset($r['username'])){
extract($r);
Set_Login_Params($type,$username,$fullname,$token) ; // Set login params
$status = true ;
}

else{
$status = false ;
}

}
else{
$status = 'error' ;
}

return $status;
}

// Create Login Parameters
Function Set_Login_Params($type,$username,$fullname,$token){
$_SESSION['type'] = $type ;
$_SESSION['token'] = $token ;
$_SESSION['username'] = $username ;
$_SESSION['fullname'] = $fullname ;
}

Function Unset_Login_Params(){
unset($_SESSION['token']);
unset($_SESSION['type']);
unset($_SESSION['username']);
unset($_SESSION['fullname']);
unset($_SESSION['key']);
unset($_COOKIE['key']);
unset($_COOKIE["SearchParams"]);
unset($_COOKIE['ref']);
}

?>