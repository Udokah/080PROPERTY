<?php 
session_start();
define("CURRENTPAGE", "./manage-users");
require_once("engine/auth.php") ; 
?>
<!DOCTYPE html>
<head>
<title>Manage Users</title>
<link href="css/general.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="img/favicon.jpg" />
<script src="js/jquery-1.9.1.min.js"></script>

<!-- Jquery user interface -->
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />

<!-- the nicescroll script -->
<script type="text/javascript" src="plugins/nicescroll/nicescroll.min.js"></script>
<script type="text/javascript" src="plugins/nicescroll/nicescroll.plus.js"></script>

<!-- Customizations here -->
<script src="js/script.js"></script>

<script>

$(function(){
	$(document).ajaxStart(function(){
		$('body').prepend('<img src="img/load2.gif" class="shloading" style="color:#f00; position:fixed; top:45%; left:50%; z-index:999;">')
	}).ajaxStop(function() {
		$('.shloading').remove();
  });
  });

 $(document).ready(function() {
    
	/// Hover tools function
	 var usertools = $(".userlist tbody tr") ;
	$('body').on('mouseover', usertools , function(){
		 $(this).find("span").show() ;
		 }).on('mouseout', function(){
			$(this).find("span").hide() ;
			 });
			 
	/// Modal box for creating new user
$("#crNewUseracc").dialog({
resizable: false,
autoOpen:false,
modal: true,
width:550,
height:450,
buttons: {
'Create Account': function() {
	
///// check required fields
$('#crNewUseracc .req').each(function() {
	var content = Number($.trim($(this).val().length));  // content length
	var msg = $(this).attr('data-alert');
	var minAlert = $(this).attr('min-alert');
	var minVal = Number($(this).attr('data-min'));  // minimum lenth
	
	if(content == 0){
		alert(msg) ;
		$(this).focus();
		exit();
	}
	else if(content < minVal){
		alert(minAlert);
		$(this).focus();
		exit();
	}
	else if($(this).attr('id') == 'Uname' && $(this).attr('data-valid') == '0'){
	alert('invalid username');
	exit();
}
});

var fullname = $.trim($('#Cname').val());
var username = $.trim($('#Uname').val());
var acctype = $.trim($('#Atype').val());
var pass1 = $.trim($('#pass1').val());
var pass2 = $.trim($('#pass2').val());

if(pass1 != pass2){
	alert('Passwords do not match');
	exit();
}

var dataSend = {fullname : fullname, username : username, acctype : acctype , password : pass1, action : 'createNewAccount' } ;
          
		 $(this).attr('disabled','disabled'); 
		$.ajax({
        url: "engine/ajax/createAccount.php",
		data: dataSend ,
        success: function (resData) {
        eval(resData);
		$(this).removeAttr('disabled');
		},
		error: function () {
        alert('An error occured, please try again');
		$(this).removeAttr('disabled');
        }
        });	

}, ////// end continue button
'Cancel': function() {
$(this).dialog('close');
} //end cancel button
},//end buttons
close: function(){
$('#crNewUseracc .req').each(function() {
	$(this).val('');
	});	
	$('#crNewUseracc').find('.err').remove();
	$('#crNewUseracc').find('.val').remove();
	}
});//end dialog	 
		

	$('#createNewUser').click(function(e){
		e.preventDefault();
    $('#crNewUseracc').dialog('open');
	});
	
//// Block user
$('body').on('click', '.block' , function(e){
	e.preventDefault();
	var uid = $(this).parent('span').attr("data-uid");
	
	/// Create confirm dialogue
	  $(document.createElement('div'))
        .attr({title: 'Confirm', 'class': 'Confirm'})
        .html('sure you want to block this user ?')
        .dialog({
            buttons: {
			"Yes": function(){ 
		$.post('engine/ajax/server.php',{ action: 'BlockUser' , uid : uid },
		function(retData){
           eval(retData) ;
		   $('.Confirm').dialog('close');
           });
			},
			"No": function(){
			$(this).dialog('close');
			}
			},
            close: function(){$(this).remove();},
            draggable: true,
            modal: true,
            resizable: false,
            width: 'auto'
        });
	});	
	
//// Unblock user
$('body').on('click', '.unblock' , function(e){
	e.preventDefault();
	var uid = $(this).parent('span').attr("data-uid");
	
	/// Create confirm dialogue
	  $(document.createElement('div'))
        .attr({title: 'Confirm', 'class': 'Confirm'})
        .html('sure you want to unblock this user ?')
        .dialog({
            buttons: {
			"Yes": function(){ 
		$.post('engine/ajax/server.php',{ action: 'UnblockUser' , uid : uid },
		function(retData){
           eval(retData) ;
		   $('.Confirm').dialog('close');
           });
			},
			"No": function(){
			$(this).dialog('close');
			}
			},
            close: function(){$(this).remove();},
            draggable: true,
            modal: true,
            resizable: false,
            width: 'auto'
        });
	});	
	
	//// Remove user
$('body').on('click', '.remove' , function(e){
	e.preventDefault();
	var uid = $(this).parent('span').attr("data-uid");
	
	/// Create confirm dialogue
	  $(document.createElement('div'))
        .attr({title: 'Confirm', 'class': 'Confirm'})
        .html('sure you want to remove this user ?')
        .dialog({
            buttons: {
			"Yes": function(){ 
		$.post('engine/ajax/server.php',{ action: 'RemoveUser' , uid : uid },
		function(retData){
           eval(retData) ;
		   $('.Confirm').dialog('close');
           });
			},
			"No": function(){
			$(this).dialog('close');
			}
			},
            close: function(){$(this).remove();},
            draggable: true,
            modal: true,
            resizable: false,
            width: 'auto'
        });
	});
	
	/// Check for valid username
$('#Uname').on('blur', function(){
	if($(this).val().length < 5){
		exit();
	}
	var username = $(this).val() ;
	$(this).next('span').html("<img src='img/load1.gif'/> checking...");
	$.post('engine/ajax/server.php',{ action: 'checkUsername' , username : username },
		function(retData){
         eval(retData);
           });
	});
	
	
	// Notifiy if account is super admin
	$('#Atype').on('blur', function(){
	if($(this).val() == 1){
		alert('NB: This user will be a super admin !');
	}
	});
	
Load_Users() // Load user list	
	
});
</script>

<script>
function Load_Users(){
	var DatatoSend = { action: 'LoadUsers' };
	var msg = "<tr><td colspan=5 align=center><img src='img/load2.gif' /></td></tr>" ;
        $('#LoadListHere').html(msg);
		$.ajax({
        url: "engine/ajax/server.php",
		data: DatatoSend ,
        success: function (resData) {
        $('#LoadListHere').html(resData);
		},
		error: function () {
var err = "<tr><td colspan=5 align=center><a href='#' onclick='Load_Users()'>An error occured: click here to reload List</a></td></tr>" ;
        $('#LoadListHere').html(err);
        }
        });	
}
</script>

</head>
<body>

<div class="container">

<div class="header">
<?php include("inc/header.php") ; ?>
</div>


<div class="main">

<nav>
<ul>
<li><a href="./settings" id="myprofile"><?php echo $_SESSION['fullname']; ?></a></li>
<li><a href="./dashboard">Dashboard</a></li>
<li><a href="./manage-users" class="current">Manage Users</a></li>
<li><a href="./manage-properties">Manage Properties</a></li>
<li><a href="./add-new-property">Add a Property</a></li>
</ul>
</nav>

<div class="section">
<h2>Manage Users<a href="#help" data-title="Help article"></a></h2>

<div class="content-area">

<table class="formtools">
<tr>
<td>
<!--<form action="#" class="search" >
<input type="text" placeholder="search users by name here" onblur="if(this.value=='')this.value='search users by name here'" onfocus="if(this.value=='search users by name here')this.value=''" value="search users by name here" id="search" required /><input type="submit" value="" />
</form>
<img src="img/load2.gif" />-->
</td>
<td>
<a href="#NewUser" id="createNewUser">Add New user</a>
</td>
</tr>
</table>

<br />

<table class="userlist">

<tr><th>Name</th><th>Username</th><th>Account type</th><th>Last login</th><th>Actions</th></tr>

<tbody id="LoadListHere">

</tbody>

</table>


<!--<table class="pagination">
<tr>
<td><a href="#" class="prev">Prev</a></td>
<td><span><img src="img/load2.gif" /></span></td>
<td><a href="#" class="next">Next</a></td>
</tr>
</table>-->

<div class="createNewUser modal" id="crNewUseracc" title="Create New User Account">
<table>
<tr><td>Name</td><td><input type="text" data-alert="Please enter your full name" placeholder="Firstname Lastname" data-min="5" min-alert="Fullname must be at least 5 characters" id="Cname" maxlength="20" class="req"/></td></tr>
<tr><td>Username</td><td valign="baseline"><input type="text" id="Uname" placeholder="choose a username" maxlength="20" data-valid="0" data-alert="choose a username" data-min="5" min-alert="Username must be at least 5 characters" class="req" title="Username e.g myusernme123"/> 
<span style="display:inline-block; margin-top:9px;"></span></td></tr>
<tr>
<td>Account Type</td>
<td>
<select id="Atype" data-min="1" data-alert="You must choose the user's account type" class="req">
<option value="" selected>select type</option>
<option value="1">Admin</option>
<option value="2">Staff</option>
<option value="3">Guest</option>
</select>
</td>
</tr>
<tr><td>Password</td><td><input type="password" id="pass1" placeholder="enter a password" maxlength="15" data-min="5" data-alert="Password is required" min-alert="Password must be at least 5 characters" class="req"/></td></tr>
<tr><td>confirm password</td><td><input type="password" id="pass2" placeholder="confirm password" maxlength="15" data-min="5" data-alert="confirm entered password" min-alert="Password must be at least 5 characters" class="req"/></td></tr>
</table>
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