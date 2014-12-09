
<!DOCTYPE html>
<head>
<title>LOGIN :: 080PROPERTY REAL ESTATE PORTAL</title>
<link href="css/general.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="img/favicon.jpg" />
<script src="js/jquery-1.9.1.min.js"></script>

<!-- Jquery user interface -->
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />

<script>
	//AJAX LOADING EFFECT
$(function(){
	$(document).ajaxStart(function(){
		$('body').prepend('<img src="img/load2.gif" class="shloading" style="color:#f00; position:fixed; top:45%; left:50%; z-index:999;">')
	}).ajaxStop(function() {
		$('.shloading').remove();
  });
  });
  
  
window.old_alert = window.alert;
window.alert = function(message, fallback){
    if(fallback)
    {
        old_alert(message);
        return;
    }
    $(document.createElement('div'))
        .attr({title: 'Alert', 'class': 'alert'})
        .html(message)
        .dialog({
			minHeight: 200,
			minWidth: 300,
            buttons: {OK: function(){$(this).dialog('close');}},
            close: function(){$(this).remove();},
            draggable: true,
            modal: true,
            resizable: false,
            width: 'auto'
        });
};


$(function() {
	
	$(".login").on('submit', function(e){
		e.preventDefault();
		var username = $.trim($("#username").val());
		var password = $.trim($("#password").val());
		
		$('.req').each(function() {
	    var content = $.trim($(this).val());
	    var msg = $(this).attr('data-alert');
	    if(content == ''){
		alert(msg);
		$(this).focus();
		exit();
	    }
        });
		var DatatoSend = { username: username , password: password , action: 'Login' };
		
		$(this).find(":submit").hide();  //hide button
		
		$.ajax({
        url: "engine/ajax/login.php",
		type: "POST",
		cache: false ,
		data: DatatoSend ,
        success: function (resData) {
        eval(resData);
		$(".login").find(":submit").show(); // show button
        },
		error: function () {
        alert('Login Error');
        }
        });
	});
	
});
</script>

<style>
body{
	background-image:url(img/bg1.png);
}

.main{
	 text-align:center;
	 margin-top:50px;
}

  .footer{
	  position:fixed; 
  }
</style>

</head>
<body>
<div class="container">

<div class="header">
<table>
<tr>
<td style="background-image:none;"><a href="#"><img src="img/logo.jpg" alt="00" /></a></td>
</tr>
</table>
</div>


<div class="main">

<form class="login" method="post" action="#">
<table>
<tr>
<td>username</td>
<td><input type="text" maxlength="10" data-alert="Username field is empty !" placeholder="Enter username" id="username" name="username" class="req"/></td>
</tr>
<tr>
<td>password</td>
<td><input type="password" maxlength="20" data-alert="Password field is empty" placeholder="Enter password" id="password" name="password" class="req"/></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="sign in"/></td>
</tr>
</table>
</form>

</div>

<div class="footer">
<?php include("inc/footer.php"); ?>
</div>

</div>

</body>
</html>