<?php
session_start();
define("CURRENTPAGE", "./view-property");
require_once("engine/auth.php") ; 
?>
<!DOCTYPE html>
<head>
<title>Settings</title>
<link href="css/general.css" rel="stylesheet" type="text/css" media="all" />

<link href="css/security.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="img/favicon.jpg" />

<script src="js/jquery-1.9.1.min.js"></script>

<!-- the nicescroll script -->
<script type="text/javascript" src="plugins/nicescroll/nicescroll.min.js"></script>
<script type="text/javascript" src="plugins/nicescroll/nicescroll.plus.js"></script>

<!-- Jquery user interface -->
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">

$(function() {

	$(document).ajaxStart(function(){
		$('body').prepend('<img src="img/load2.gif" class="loading" style="color:#f00; position:fixed; top:45%; left:50%; z-index:999;">')
	}).ajaxStop(function() {
		$('.loading').remove();
  });
  });
  
$(document).ready(function(){
	
	// SETTING NAVIGATION
	var sel = $(".sec-nav li a");
	var nav = $(".sec-nav");
	 
	    /// When a link is clicked
	    sel.click(function(e){
		e.preventDefault();
		nav.each(function(){
		$(this).find("a").removeClass("active"); // remove all active links
		});
		$(this).addClass("active"); // add active class to selected
		
		var tab = $(this).attr("href");
		
		$(".security section").slideUp("fast", function(){
			$(tab).stop().slideDown("fast");
			});
		
		});
		
		/// Change password
$('#changepassword form').submit(function(e){
	e.preventDefault();
	
				$('.req').each(function() {
			var content = $.trim($(this).val()) ;
			var msg = $(this).attr('data-alert');
			if(content == ''){
				$(this).focus();
				alert(msg);
				exit();
			    }
				 });	
				
	var oldpass = $.trim($('#oldpass').val());
	var newpass1 = $.trim($('#newpass1').val());
	var newpass2 = $.trim($('#newpass2').val());
	
	if(newpass1.length < 5 ){
		alert('Password must be at least 5 characters');
		exit();
	}
	
	if(newpass1 != newpass2){
		$('#newpass1').val('');
		$('#newpass2').val('');
		alert('Passwords do not match');
		exit();
	}

var DataSend = { oldpass : oldpass , password : newpass2 , action : 'changePassword'} ;
    	$.ajax({
        url: "engine/ajax/server.php",
		data: DataSend ,
        success: function(resData){
        eval(resData);
		},
		error: function () {
		$('#oldpass').val('');
		$('#newpass1').val('');
		$('#newpass2').val('');
        alert('An error occured, password was not changed');
        }
				
		 });
		 

});
	
	
///// Change userame
$('#changeusername form').submit(function(e){
	e.preventDefault();
	var username = $.trim($('#username').val());
	if(username == ''){
		$('#username').focus();
		alert('enter a new username');
		exit();
	}
	  
	var DataSend = { username : username , action : 'changeUsername'} ;
    	$.ajax({
        url: "engine/ajax/server.php",
		data: DataSend ,
        success: function(resData){
        eval(resData);
		},
		error: function () {
        alert('An error occured, username was not changed');
        }
        });	
	});

	});
</script>

<!-- Customizations here -->
<script src="js/script.js"></script>
</head>
<body>

<div class="container">

<div class="header">
<?php include("inc/header.php") ; ?>
</div>

<?php
// Load Functions ///
require_once("engine/fn/lib.php"); 
require_once("engine/fn/fn.php"); 
?>

<div class="main">

<nav>
<ul>
<li><a href="./settings" id="myprofile"><?php echo $_SESSION['fullname']; ?></a></li>
<li><a href="./dashboard">Dashboard</a></li>
<li><a href="./manage-users">Manage Users</a></li>
<li><a href="./manage-properties">Manage Properties</a></li>
<li><a href="./add-new-property">Add a Property</a></li>
</ul>
</nav>

<div class="section">
<h2>Profile <a href="#help" data-title="Help article"></a></h2>

<div class="content-area">

<ul class="sec-nav">
<li><a href="#profile-view" class="active">Profile</a></li>
<li><a href="#changeusername">Change username</a></li>
<li><a href="#changepassword">Change Password</a></li>
</ul>

<div class="security">

<section id="profile-view">
<table>
<tr><td>fullname:</td><td><?php echo $_SESSION['fullname']; ?></td></tr>
<tr><td>username:</td><td class="GenUsername" ><?php echo $_SESSION['username']; ?></td></tr>
<tr><td>account type:</td><td><?php echo acc_type($_SESSION['type']); ?></td></tr>
<tr><td>Last Login:</td><td><?php echo Get_last_login($_SESSION['username']); ?></td></tr>
</table>
</section>

<section id="changeusername">
<form action="#">
<table>
<tr><td>change username</td></tr>
<tr><td><input type="text" maxlength="20" class="GenUsername" id="username" 
value="<?php echo $_SESSION['username']; ?>" class="req"/></td></tr>
<tr><td><input type="submit" value="save" /></td></tr>
</table>
</form>
</section>

<section id="changepassword">
<form action="#">
<table>
<tr><td>Old Password</td></tr>
<tr><td><input type="password" maxlength="15" data-alert="enter your old password" autocomplete="off" placeholder="Old password" value="" id="oldpass" class="req"/></td></tr>
<tr><td>New Password</td></tr>
<tr><td><input type="password" maxlength="15" data-alert="enter the new password" id="newpass1" placeholder="New password" class="req"/></td></tr>
<tr><td>Confirm New Password</td></tr>
<tr><td><input type="password" maxlength="15" data-alert="confirm the new password" id="newpass2" placeholder="Confirm new password" class="req"/></td></tr>
<tr><td><input type="submit" value="save" /></td></tr>
</table>
</form>
</section>

</div>

</div>

</div>

<div class="clear"></div>
</div>

<div class="footer">
<?php include("inc/footer.php"); ?>
</div>

</div>

</body>
</html>