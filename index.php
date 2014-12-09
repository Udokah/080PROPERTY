<?php 
session_start();
define("CURRENTPAGE", "./dashboard");
require_once("engine/auth.php") ; 
?>
<!DOCTYPE html>
<head>
<title>080PROPERTY REAL ESTATE PORTAL</title>
<link href="css/general.css" rel="stylesheet" type="text/css" media="all" />
<link rel="icon" href="img/favicon.jpg" />
<script src="js/jquery-1.9.1.min.js"></script>

<!-- Jquery user interface -->
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<link href="css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />

<!-- the nicescroll script -->
<script type="text/javascript" src="plugins/nicescroll/nicescroll.min.js"></script>
<script type="text/javascript" src="plugins/nicescroll/nicescroll.plus.js"></script>

<script src="js/snd.js"></script> <!-- sound player -->

<script src="js/script.js"></script>

<script>
$(function() {
	// Hide all tips
	$(".tools li a").next("span").hide();
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
<?php include("inc/header.php"); ?>
<?php include("engine/fn/fn.php"); ?>
</div>


<div class="main">

<div class="welcome">
Welcome <a href="./settings" title="<?php echo acc_type($_SESSION['type']); ?> Profile">
<?php echo $_SESSION['fullname']; ?></a>
</div>

<?php
$display1 = $display2 = '' ;
if($_SESSION['type'] !== '1'){
	$display1 = 'none' ;
}
if($_SESSION['type'] == '3'){
	$display2 = 'none' ;
}
?>

<ul class="tools">
<li style="display:<?php echo $display1; ?> ;">
<a href="./manage-users"><img src="img/manage.png" />
<label>Manage Users</label>
</a>
<span><strong>(ADMIN ONLY)</strong> Add new users, delete users and change user account priviledges.</span>
</li>
<li>
<a href="./manage-properties"><img src="img/m-property.png" />
<label>Manage Properties</label>
</a>
<span>view properties, search, edit and delete properties</span>
</li>
<li style="display:<?php echo $display2; ?> ;">
<a href="./add-new-property"><img src="img/add.png" />
<label>Add a Property</label>
</a>
<span>Add a new property to the data bank.</span>
</li>
</ul>
</div>

<div class="footer">
<?php include("inc/footer.php"); ?>
</div>

</div>

</body>
</html>