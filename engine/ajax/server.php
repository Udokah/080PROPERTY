<?php
session_start();
// Security
// NB: Exit() after each condition

if(!isset($_POST['action'])){
	echo "Not allowed" ;
	exit();
}

$MAX_REQ_SIZE = 10 ;  /// Maximum request size

// Load Functions ///
require_once("../config/connect.php"); 
require_once("../fn/lib.php"); 
require_once("../fn/fn.php"); 

$action = sanitize($_POST['action']) ;

// change password
if($action == 'changePassword'){
	
	if(!isset($_SESSION['username'])){
		$ret = "alert('Not allowed');" ;
	}
	else{
		
		$username = sanitize($_SESSION['username']) ;
		$oldpass = sanitize($_POST['oldpass']) ;
		$newpass = sanitize($_POST['password']) ;
		
		$change = change_password($username,$oldpass,$newpass) ;
		if($change == true){
			$ret = "alert('Changes has been saved');
			        		$('#oldpass').val('');
			        		$('#newpass1').val('');
			        		$('#newpass2').val('');" ;
		}
		elseif($change == false){
			$ret = "alert('Saving Failed');" ;
		}
		else{
			$ret = "alert('Incorrect old password');" ;
		}
	}
	
		echo "$(function(){ ".$ret." });" ;
	exit();
}

// change username
if($action == 'changeUsername'){
	
	if(!isset($_SESSION['username'])){
		$ret = "alert('Not allowed');" ;
	}
	else{
		$oldname = $_SESSION['username'] ;
		$newname = strtolower(sanitize($_POST['username']));
		
		$change = change_username($oldname,$newname) ;
		if($change == true){
			$_SESSION['username'] = $newname ; //Update session
			$ret = "alert('Changes has been saved');
			        $('.GenUsername').html('$newname').val('$newname');" ;
		}
		else{
			$ret = "alert('Saving Failed');" ;
		}
	}
	
		echo "$(function(){ ".$ret." });" ;
	exit();
}


/// Update UpdateProperty
if($action == 'UpdateProperty'){
	
	$_POST = sanitize($_POST); // Clean all inputs
	
	$Update = Update_property($_POST) ;
	
	if($_SESSION['type'] !== 3 ){  /// Guests cant perform updates
	
	if($Update == true){
		$ret = "alert('Changes has been saved'); location.reload(true);" ;
	}
	else{
		$ret = "alert('Saving failed');$('.Confirm').dialog('close');" ;
	}
	}
	else{
		$ret = "alert('Not allowed');" ;
	}
	
	echo "$(function(){ ".$ret." });" ;
	
	exit();
}

// Search Listings
if($action == 'SearchListings'){
	
$perform = sanitize($_POST['perform']) ;
	
	if($perform == 'NewSearch'){
	$PARAMS = sanitize($_POST) ;	
	}
	else{ // show more results from previous search
	/// If cookie expires
	if(!isset($_COOKIE["SearchParams"])){
	$ret = "alert('Search Expired. Perform another search')" ;
	echo "$(function(){ ".$ret." });" ;
	exit();
	}
	$PARAMS = sanitize($_COOKIE["SearchParams"]) ;	
	}
	
	$Results = Search_Listings($PARAMS);
	$count = count($Results) ;
	
	if($count == 0){
		if($perform == 'NewSearch'){  // If ordinary search is performed
    $ret = "alert('No results'); Load_listings(0);" ;
		}
		else{ // If button is clicked to show more results
	 $ret = "$('.more').html('No more results');" ;	
		}
	}
	else{
		$html = implode("", $Results); // get all html
	
	if($count < $MAX_REQ_SIZE){
	$ret = "$('#LoadHere').append(\"$html\");$('.more').fadeOut('fast');" ;
	}
	else{
	$page = $PARAMS['page'] ;
	$page++;  // Increase to next page
	$PARAMS['page'] = $page ; /// Update current page
	
	setcookie("SearchParams", $PARAMS, time()+3600);  // store search params in cookie
	
 $content="<a href='#More' class='moreRes' onclick='MoreRes($page)'>Show More Results</a>" ;
    $ret = "$('#LoadHere').append(\"$html\");
            $('.more').html(\"$content\");" ;
	}
	}
	echo "$(function(){ ".$ret." });" ;
	exit();
}

// Load listings
if($action == 'LoadAllListings'){
	
	$page = sanitize($_POST['page']) ;
	$Listings = Load_Listings($page);
	$count = count($Listings) ;
	
	if($count == 0){
	$ret = "$('.more').html('No more listings')" ;
	}
	else{
		$html = implode("", $Listings); // get all html
	
	if($count < $MAX_REQ_SIZE){
		$ret = "$('#LoadHere').append(\"$html\");$('.more').fadeOut('fast');" ;
	}
	else{
	$page++;  // Increase to next page
    $ret = "$('#LoadHere').append(\"$html\");
            $('.more a').attr('data-page','$page');" ;
	}
		
	}
	echo "$(function(){ ".$ret." });" ;
	exit();
}

// Check if username exits
if($action == 'checkUsername'){
$username = strtolower(sanitize($_POST['username'])); //IMPORTATANT Change to lower case
	$ret = $msg = '';
	$check = check_username($username);
	if($check == 0){
	$msg = "<label class='val'><img src='img/valid.png' /> Valid</label>" ;
	$ret = "$('#Uname').attr('data-valid','1').next('span').html(\"$msg\");" ;	
	}
	else{
    $msg = "<label class='err'><img src='img/invalid.png'/> Invalid Username</label>";
	$ret = "$('#Uname').attr('data-valid','0').next('span').html(\"$msg\");" ;	
	}
	
	echo "$(function(){ ".$ret." });" ;
	exit();
}

//Remove User
if($action == 'RemoveUser'){
	
	if($_SESSION['type'] !== 1 ){  /// Only admin can remove users
	$uid = sanitize($_POST['uid']) ;
	$unblock = Remove_user($uid);
	$ret = '' ;
	if($unblock == true){
	$ret = "$(function(){
	$('#tl$uid').parent('td').parent('tr').fadeOut('slow', function(){
		$(this).remove();
		});
		});";
	}
	else{
	$ret = "$(function(){
		alert('unable to remove user');
		});";
	}
	}
	else{
		$ret = "$(function(){
		alert('Not allowed');
		});";
	}
	
	echo $ret ;
	exit();
}

//UnBlock User
if($action == 'UnblockUser'){
	
	if($_SESSION['type'] !== 1 ){  /// Only admin can unblock users
	$uid = sanitize($_POST['uid']) ;
	$unblock = Unblock_user($uid);
	$ret = '' ;
	if($unblock == true){
	$ret = "$(function(){
	$('#tl$uid').find('.unblock').addClass('block').removeClass('unblock').html('block').attr('href','#Block');
			});";
	}
	else{
	$ret = "$(function(){
		alert('unable to unblock user');
		});";
	}
	}
	else{
		$ret = "$(function(){
		alert('Not allowed');
		});";
	}
	
	echo $ret ;
	exit();
}

//Block User
if($action == 'BlockUser'){
	
	if($_SESSION['type'] !== 1 ){  /// Only admin can block users
	$uid = sanitize($_POST['uid']) ;
	$block = block_user($uid);
	$ret = '' ;
	if($block == true){
	$ret = "$(function(){
	$('#tl$uid').find('.block').addClass('unblock').removeClass('block').html('unblock').attr('href','#Unblock');
			});";
	}
	else{
	$ret = "$(function(){
		alert('unable to block user');
		});";
	}
	}
	else{
		$ret = "$(function(){
		alert('Not allowed');
		});";
	}
	
	echo $ret ;
	exit();
}


// Condition to Load Users List
if($action == 'LoadUsers'){
$userlist = Load_Users_List() ;
echo $userlist ;
exit();
}


?>