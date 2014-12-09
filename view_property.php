<?php 
session_start();
define("CURRENTPAGE", "./view-property");
require_once("engine/auth.php") ; 

if(!isset($_GET['token'])){
	echo "Not allowed" ;
	exit();
}

require_once("engine/fn/lib.php") ; 
$token = sanitize($_GET['token']);

$q = mysql_query("SELECT * FROM prp_listings WHERE token = '$token'") or die(mysql_error());
$r = mysql_fetch_array($q);
if($r){
extract($r);
}
else{
	echo "<center><h2>Property Not Found !</h2><br>
	<a href='#' onclick='history.go(-1);'>&laquo; Go Back</a></center>" ;
	exit();
}

?>
<!DOCTYPE html>
<head>
<title>Property : <?php echo $address ; ?></title>
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

<!-- Image Lightbox script -->
<script type="text/javascript" src="plugins/lightbox/jquery.lightbox-0.5.min.js"></script>
<link rel="stylesheet" type="text/css" href="plugins/lightbox/css/jquery.lightbox-0.5.css" media="screen" />

<script type="text/javascript">

$(function(){
	$(document).ajaxStart(function(){
		$('body').prepend('<img src="img/load2.gif" class="shloading" style="color:#f00; position:fixed; top:45%; left:50%; z-index:999;">')
	}).ajaxStop(function() {
		$('.shloading').remove();
  });
  });

$(function() {
    $('.gallery a').lightBox();
	$(".save").hide();
});

$(document).ready(function() {
	   	var table = $(".propDesc table");
		
	    /// Edit Property
        $(".edit").on('click',function(e){
		e.preventDefault();
		$(this).hide();
		$('.noedit').fadeToggle('fast');
		$('.toedit').fadeToggle('fast'); 
		
		/// Loop through each select items
		$('.toedit').each(function(){
		var realVal = $.trim($(this).next('.noedit').val()) ;
		/// Iterate each option	
		var inputId = $(this).attr('id') ;
		var select = document.getElementById(inputId);
		var opts = select.options;
		var opt=0;
        for(opt=0; opt<opts.length; opt++) {
		var optVal = $.trim(opts[opt].value) ;
        if(optVal == realVal){
			opts[opt].selected = 'selected' ;
		}
		}
		}); /// end of select loop
		
		table.removeClass("view-mode").addClass("edit-mode");
		$(".propDesc table input").removeAttr("disabled");
		$(".propDesc table textarea").removeAttr("disabled");
		$(".propDesc table select").removeAttr("disabled");
		$(".save").show();
		});
		
		/// Save Edits
		$(".save").on('click',function(e){
		e.preventDefault();
        
		/// Create confirm dialogue
	  $(document.createElement('div'))
        .attr({title: 'Confirm', 'class': 'Confirm'})
        .html('save changes ?')
        .dialog({
            buttons: {
			"Yes": function(){ 
            
			$('.req').each(function() {
			var content = $.trim($(this).val()) ;
			var msg = $(this).attr('data-alert');
			if(content == ''){
				$(this).focus();
				$('.Confirm').dialog('close');
				alert(msg);
				exit();
			    }
				// Validate integer inputs
	  if($(this).attr('id') == 'baths' || $(this).attr('id') == 'beds'){
		  if(!isInt(content)){
		$('.Confirm').dialog('close');
		alert('enter number of ' + $(this).attr('id') + ' in integers e.g 1,2');
		exit();
		  }
			}
		 });
		 
		 	// get all fields
	var address = $.trim($('#address').val());
	var propertytype = $.trim($('#propertytype').val());
	var action = $.trim($('#action').val());
	var token = $.trim($('#token').val());
	var price = $.trim($('#price').val());
	var beds = $.trim($('#beds').val());
	var baths = $.trim($('#baths').val());
	var leaseType = $.trim($('#leaseType').val());
	var description = $.trim($('#description').val());
	
	var openhouse = $.trim($('#openhouse').val());
	if(openhouse == 'Yes'){
		openhouse = 1 ;
	}
	else{
		openhouse = 0 ;
	}
	
		// Form Data
var DataSend = {address : address , propertytype : propertytype , action : action , token : token , propertytype : propertytype , price : price , beds : beds , baths : baths , leaseType : leaseType , description : description , openhouse : openhouse };

    	$.ajax({
        url: "engine/ajax/server.php",
		data: DataSend ,
        success: function(resData){
        eval(resData);
		},
		error: function () {
        alert('An error occured, changes were not saved');
        }
        });	
			
			},
			"Not yet": function(){
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
		
				/// Delete Property
		$(".delete").on('click',function(e){
		e.preventDefault();
		var goto = $(this).attr('href') ;
			/// Create confirm dialogue
	  $(document.createElement('div'))
        .attr({title: 'Confirm', 'class': 'Confirm'})
        .html('sure you want to delete this property ?')
        .dialog({
            buttons: {
			"Yes": function(){ 
             window.location =  goto ;
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
});
</script>

<!-- Customizations here -->
<script src="js/script.js"></script>

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
<li><a href="./add-new-property">Add a Property</a></li>
</ul>
</nav>

<div class="section">
<h2>View Property<a href="#help" data-title="Help article"></a></h2>

<div class="content-area">

<div class="propDesc">
<table class="view-mode">
<tr>
<td>Address</td>
<td>
<input type="text" id="address" data-alert="please enter the property address" disabled="disabled" value="<?php echo $address ; ?>" class="req" />
</td>
</tr>
<tr>
<td>Property Type</td>
<td>
<select name="propertytype" id="propertytype" class='toedit req' title="select the type of property" disabled="disabled" data-alert="choose the property type" >
<option value="">select property type</option>
<option value="Apartment">Apartment</option>
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
<input type="text" class="noedit" id="prptype" disabled="disabled" value="<?php echo $property_type ; ?>" class="req" />
<input type="hidden" id="action" value="UpdateProperty" />
<input type="hidden" id="token" value="<?php echo $token ; ?>" />
</td>
</tr>
<tr>
<td>Price</td>
<td>&#x20a6;<input type="text" data-alert="Please enter the price" disabled="disabled" value="<?php echo $price ; ?>" id="price" class="req" /></td></tr>
<tr>
<td>Open House</td>
<td>
<?php $var = ($open_house == 1) ? 'Yes' : 'No' ; ?>
<select class="toedit" id="openhouse" disabled="disabled" >
<option value="Yes" >Yes</option>
<option value="No" >No</option>
</select>
<input type="text" class="noedit" id="op" disabled="disabled" value="<?php echo $var; ?>" />
</td>
</tr>
<tr>
<td>Property For</td>
<td>
<select disabled="disabled" id="leaseType" class="toedit">
<option value="sale">sale</option>
<option value="rent">rent</option>
</select>
<input type="text" class="noedit" id="for" disabled="disabled" 
value="<?php echo $lease_type ; ?>" class="req" />
</td>
</tr>
<tr>
<td>Bedrooms</td>
<td><input type="text" data-alert="enter the number of bathrooms" disabled="disabled" value="<?php echo $beds ; ?>" id="beds" class="req" /></td>
</tr>
<tr>
<td>Bathrooms</td>
<td><input type="text" class="req" data-alert="enter the number of bathrooms" disabled="disabled" value="<?php echo $baths ; ?>" id="baths" /></td>
</tr>
<tr>
<td>Description</td>
<td>
<textarea id="description" data-alert="Enter the property description" disabled="disabled" class="req"><?php echo $description ; ?></textarea>
</td>
</tr>
<tr><td>Images</td><td>
<section class="gallery">

<?php
if($images){
$IMG = explode("|",$images) ; // get all images
foreach($IMG as $pic){
	$pic = 'property_images/'.$pic ;
    echo "<a href=\"".$pic."\"><img src=\"".$pic."\" alt=\"Property Image\" /></a>" ;
  }
  }
  else{
	  echo 'No Images Available' ;
  }
?>
</section>
</td></tr>
</table>
</div>

<?php
$display = '' ;
if($_SESSION['type'] == 3){
	$display = 'none' ;
}
?>

<div class="propOptions" style="display:<?php echo $display; ?>">
<ul>
<li><a href="#Edit" class="edit">Edit</a></li>
<li><a href="#Save" class="save">Save</a></li>
<li><a href="engine/deleteListing.php?token=<?php echo $token ; ?>&images=<?php echo $images ; ?>" class="delete">Delete</a></li>
</ul>
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