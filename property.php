<?php 
session_start();
define("CURRENTPAGE", "./manage-properties");
require_once("engine/auth.php") ; 
?>
<!DOCTYPE html>
<head>
<title>Manage Property</title>
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

 $(function() {
	/// When show more is clicked
	$('.more a').on('click', function(e){
		e.preventDefault();
		var page = $(this).attr('data-page');
		Load_listings(page);
		});
	
	// Search Listings
	$('#SearchForm :submit').on('click', function(e){
		e.preventDefault();
		///// check required fields
    $('#SearchForm .req').each(function() {
	var content = $.trim($(this).val());  // value
	var msg = $(this).attr('data-alert');
	if(content == ''){
		$(this).focus();
		alert(msg);
		exit();
	}
	});
	
	// get all fields
	var location = $.trim($('#location').val());
	var mnprice = $.trim($('#mnprice').val());
	var mxprice = $.trim($('#mxprice').val());
	var openhouse = $.trim($('#openhouse').val());
	var proptype = $.trim($('#proptype').val());
	var beds = $.trim($('#beds').val());
	var baths = $.trim($('#baths').val());
	var sale = $.trim($('#sale').val());
	var rent = $.trim($('#rent').val());
	
	// Form Data
var DataSend = {location : location , mnprice : mnprice , mxprice : mxprice , openhouse : openhouse , proptype : proptype , beds : beds , baths : baths , sale : sale , rent : rent , action : 'SearchListings' , page : 0 , perform : 'NewSearch'};
        
		var oldData = $('#LoadHere').html() ;  // get old data in case of failure
		$('#LoadHere').html("<center><img src='img/load2.gif' /><br>searching</center>");
    	$.ajax({
        url: "engine/ajax/server.php",
		data: DataSend ,
        success: function(resData) {
		$('#LoadHere').html(" "); // empty container
        eval(resData);
		},
		error: function () {
        alert('An error occured, search was not completed');
		$('#LoadHere').html(oldData);  // replace old data
        }
        });	
	
	});

Load_listings(0) //// Load all listings
	});
</script>

<script>

// View more search results
function MoreRes(page){
		// Form Data
var DataSend = { page : page , perform : 'showMore' , action : 'SearchListings' } ;
	
	    $.ajax({
        url: "engine/ajax/server.php",
		data: DataSend ,
        success: function(resData){
        eval(resData);
		},
		error: function () {
        alert('An error occured, more search results was not loaded');
        }
        });	
}

// Load listings
function Load_listings(page){
	
	var dataSend = {page : page, action : 'LoadAllListings'} ;
	
		$.ajax({
        url: "engine/ajax/server.php",
		data: dataSend ,
        success: function (resData) {
        eval(resData);
		},
		error: function () {
        alert('An error occured, please try again');
var msg = "<a href='#showmore' onclick='Load_listings(" + page + ")' >Reload Listings</a>" ;
		$('#LoadHere').next('.more').html(msg);
        }
        });	
	
}

</script>

</head>
<body>

<div class="container">

<div class="header">
<?php include("inc/header.php"); ?>
</div>


<div class="main">

<nav>
<ul>
<li><a href="./settings" id="myprofile"><?php echo $_SESSION['fullname']; ?></a></li>
<li><a href="./dashboard">Dashboard</a></li>
<li><a href="./manage-users">Manage Users</a></li>
<li><a href="./manage-properties" class="current">Manage Properties</a></li>
<li><a href="./add-new-property">Add a Property</a></li>
</ul>
</nav>

<div class="section">
<h2>Manage Property<a href="#help" data-title="Help article"></a></h2>

<div class="content-area" style="overflow:hidden">

<form action="#" method="post" id="SearchForm">
<table class="searchtools">
<tr>
<td><span>Location</span><input type="text" data-alert="enter the location of the property" title="enter the location of the property e.g address,state" class="req" maxlength="50" id="location" placeholder="address of the property e.g street, close"/></td>
<td colspan="2"><span>Price range &#x20a6; </span>
<input type="text" class="req small" placeholder="MIN" onblur="if(this.value=='')this.value='MIN'" title="enter the minimum price" onfocus="if(this.value=='MIN')this.value=''"  value="MIN" value="MIN" id="mnprice" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text"mxprice id="mxprice" placeholder="MAX" onblur="if(this.value=='')this.value='MAX'" title="enter the maximum price" onfocus="if(this.value=='MAX')this.value=''" value="MAX" value="MAX" class="small" />
</td>
<td>
 <div class="">
        <input type="checkbox" id="openhouse" value="1" />
        <label for="openhouse"><span></span>Open House</label>
    </div>
  
</td>
</tr>
<tr>
<td>
<span>Property type</span>
<select title="select the type of property" id="proptype">
<option value="" selected>Select Type</option>
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
</td>
<td><span>Beds</span> <input type="text" placeholder="Any" id="beds" class="small" /></td>
<td><span>Bath</span> <input type="text" placeholder="Any" id="baths" class="small" /></td>
<td>
 <div id="radio">
   <input type="radio" id="sale" value="1" name="radio" /><label for="sale"><span></span>Sale</label>
   &nbsp;&nbsp;&nbsp;&nbsp;
   <input type="radio" id="rent" value="1" name="radio" /><label for="rent"><span></span>Rent</label>
  </div>
</td>
</tr>
<tr>
<td colspan="4" align="center"><input type="submit" value="Find Property" /></td>
</tr>
</table>
</form>


<div class="showresults">
<div id="LoadHere">

</div>
</div>

<div class="more"><a href="#showmore">show more</a></div>

</div>

</div>

<div class="viewProperty" title="View Property"></div>
</div>

<div class="footer">
<?php include("inc/footer.php"); ?>
</div>

</div>

</body>
</html>