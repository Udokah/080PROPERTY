<?php 
session_start();
define("CURRENTPAGE", "./add-new-property");
require_once("engine/auth.php") ; 
?>
<!DOCTYPE html>
<head>
<title>Add a Property</title>
<link href="css/general.css" rel="stylesheet" type="text/css" media="all" />

<link href="css/properties.css" rel="stylesheet" type="text/css" media="all" />
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

$(document).ready(function(){
	
	$('#AddForm :submit').click(function(e){
		e.preventDefault();
		
		$('.req').each(function() {
			var content = $.trim($(this).val()) ;
			var msg = $(this).attr('data-alert');
			if(content == ''){
				$(this).focus();
				alert(msg);
				exit();
			    }
				// Validate integer inputs
	  if($(this).attr('name') == 'baths' || $(this).attr('name') == 'beds'){
		  if(!isInt(content)){
		alert('enter number of ' + $(this).attr('name') + ' in integers e.g 1,2');
		exit();
		  }
			}
		 });
		 
		 /// Validate uploaded images
		 $('.uploadImage').each(function() {
			 var img = $(this).val();
			 if(img != ''){
			var size = this.files[0].size ;
			 
			    /// Check if file is an image
			 	pattern = new RegExp(/(jpg|png|jpeg|gif)$/i);
			if(!pattern.test(img)) {
			var err = 'Only JPG, PNG or GIF files are allowed!';
			$(this).css('border','2px solid #F00').prev('span').append("<img class='errImg' src='img/alert.png' width='16px' height='16px'/>");
				alert(err);
				exit();
				}
				
				/// Check Image file limit Max:3MB
				if(size > 3145728){
	$(this).css('border','2px solid #F00').prev('span').append("<img class='errImg' src='img/alert.png' width='16px' height='16px'/>");
				alert("the image '" + img + "' exceeded the image file size limit");
				    exit();
				}
				
				}
		});
		 
	 $(this).val('Processing').attr('disabled','disabled');	 
	 $('#AddForm').submit();
	 });
	
	
	});
</script>

<script>

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
<li><a href="./manage-users">Manage Users</a></li>
<li><a href="./manage-properties">Manage Properties</a></li>
<li><a href="./add-new-property" class="current">Add a Property</a></li>
</ul>
</nav>

<div class="section">
<h2>Add a Property<a href="#help" data-title="Help article"></a></h2>

<div class="content-area">

<form id="AddForm" action="engine/add_new_property.php" method="post" enctype="multipart/form-data" class="add-prop">
<table>
<tr>
<td>Address</td>
<td>
<input type="text" maxlength="80" title="Where the property is located" id="address" placeholder="location of the property" name="address" data-alert="please enter the property address"  class="req" />
</td>
</tr>
<tr>
<td>Property Type</td>
<td>
<select title="select the type of property" name="propertytype" data-alert="choose the property type"  id="propertytype" class="req">
<option value="" selected >select type</option>
<option value="Apartment" >Apartment</option>
<option value="Apartment Complex">Apartment Complex</option>
<option value="Bungalow">Bungalow</option>
<option value="Duplex">Duplex</option>
<option value="House">House</option>
<option value="Inn/Lodge">Inn/Lodge</option>
<option value="Lots/Land">Lots/Land</option>
<option value="Office Space">Office Space</option>
<option value="Reception Halls">Reception Halls</option>
<option value="Restaurant">Restaurant</option>
<option value="Room">Room</option>
<option value="Shop">Shop</option>
<option value="Warehouse">Warehouse</option>
<option value="other">other</option>
</select>

<input type="hidden" name="action" value="AddNewProperty" />
</td>
</tr>
<tr>
<td>Price</td>
<td>&#x20a6; <input type="text" maxlength="13" title="enter the price of the property" placeholder="Price" name="price" data-alert="Please enter the price"  value="" id="price" class="small req" /></td></tr>
<tr>
<td>Open House</td>
<td>
<select id="openhouse" title="choose if its an open house or not" name="openhouse" >
<option value="1" selected >YES</option>
<option value="0">NO</option>
</select>
</td>
</tr>
<tr>
<td>Property For</td>
<td>
<select id="for" class="req" name="for" title="What is the property for" data-alert="Choose a lease type">
<option value="" selected >Choose lease type</option>
<option value="sale" >SALE</option>
<option value="rent">RENT</option>
</select>
</td>
</tr>
<tr>
<td>Bedrooms</td>
<td><input type="text" maxlength="2" placeholder="any" title="enter number of bedrooms in integers e.g 1,2,3" name="beds" data-alert="enter the number of bedrooms" id="beds" class="small req"/></td>
</tr>
<tr>
<td>Bathrooms</td>
<td><input type="text" maxlength="2" placeholder="any" title="enter number of bathrooms in integers e.g 1,2,3" name="baths" data-alert="enter the number of bathrooms" id="baths" class="small req"/></td>
</tr>
<tr>
<td>Description</td>
<td>
<textarea id="description" title="Brief description of the title" placeholder="Enter property description here" name="description" data-alert="Enter the property description"  class="req" maxlength='1000' ></textarea>
</td>
</tr>
<tr>
<td>Choose images (Max File size is 3MB)</td>
<td class="fileUploads">
<div title="Upload images of the property"><span></span><input type="file" name="image1" class="uploadImage" /></div>
<div><span></span><input type="file" name="image2" class="uploadImage" /></div>
<div><span></span><input type="file" name="image3" class="uploadImage" /></div>
<div><span></span><input type="file" name="image4"class="uploadImage"  /></div>
</td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" value="Add Property" /></td></tr>
</table>
</form>

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