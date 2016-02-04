<?php require_once('Connections/connect.php'); ?>
<?php $i=0;$j=0?>
<?php
			session_start();
			if(isset($_SESSION['MM_Username1']))
			{?>
<?php
//check to see the url variable is set and it exists in the database
if(isset($_GET['name'])){
	include "Connections/connect.php";
	$name = $_GET['name'];
	//this var is used to check if Id exists,if yes then get the product detail else exit the script
	$sql = oci_parse($connect,"SELECT * FROM query WHERE name = '$name' ");
	oci_execute($sql);
	$Count = oci_num_rows($sql);//count the output amount
if($Count>0){
	//get all the prdoucdetails
	while($row = oci_fetch_array($sql)){
		
		$product_name=$row["name"];
		$price = $row["email_id"];
		$details = $row["contact_no"];
		$category = $row["message"];
		
		
	}
}else {
	echo "that item does no exist";
	exit();
}
}else {
	echo "Data to render this page is missing";
	exit();
}
oci_close();
?>
<?php
						//mysql_select_db($database_connect, $connect);

						$sql2 = oci_parse($connect,"SELECT * FROM product ORDER BY qtysold DESC LIMIT 3",$connect);
oci_execute($sql2);
						$dyn_table2 ='<tr>';
						While($row = oci_fetch_assoc($sql2)){
						$Name2 = $row["Name"];
						$Type2 = $row["Type"];
						$image2 = $row["prod_image"];
						$price2 = $row["Price"];	
						$Prodid = $row["Prodid"];
						{	
						$dyn_table2 .='<p><td><tr><tr><br>'.$Name2.'</tr>';
						$dyn_table2 .='<br>'.$Type2.'<br>';
						$dyn_table2 .='<br><img src="'.$image2.'" width = 100, height = 100/><br/>';
						$dyn_table2 .='<td><a href="productdetail.php?Prodid='.$Prodid.'"><img src="images/templatemo_detail.png"></a>';
						$dyn_table2 .='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Prodid.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart"  /></form></td></td></tr></p><br><br><br><br><br>';
						}
	

						}
						$dyn_table2 .='</tr></table>';
						?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("oci_real_escape_string") ? oci_real_escape_string($theValue) : oci_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "contact")) {
  $insertSQL = sprintf("INSERT INTO query (reply) WHERE name = $name VALUES (%s)",
                       
                       GetSQLValueString($_POST['text'], "text")  );

//  mysql_select_db($database_connect, $connect);
  $Result1 = oci_parse($connect$,insertSQL);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "contact")) {
  $updateSQL = sprintf("UPDATE query SET name=%s, contact_no=%s, message=%s, reply=%s WHERE email_id=%s",
                       GetSQLValueString($_POST['text'], "text"),
                       GetSQLValueString($_POST['text'], "int"),
                       GetSQLValueString($_POST['text'], "text"),
                       GetSQLValueString($_POST['text'], "text"),
                       GetSQLValueString($_POST['text'], "text"));

  //mysql_select_db($database_connect, $connect);
  $Result1 = oci_parse($connect,$updateSQL);
  oci_execute($Result1);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>change BAZZINGA | Query Repplies</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />
<link href="style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">


</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "top_nav", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>
<title>Untitled Document</title>

<style>
body {
	
	margin: 0px;
	padding: 0px;
	color: #fff;
}
.popupInfo {
	display: none;
	padding: 50px;
	background: #000;
	border: 1px solid #1852fd;
	float: left;
	font-size: 1.2en;
	font-color: #FFF;
	position: fixed;
	top: 75%;
	left: 50%;
	margin: -10px 0 0 -10px;
	z-index: 99999;
	box-shadow: 0px 0px 4px #1852fd;
	-moz-box-shadow: 0px 0px 4px #1852fd;
	-webkit-box-shadow: 0px 0px 4px #1852fd;
	border-radius: 0px;
	-moz-border-radius: 0px;
	-webkit-border-radius: 0px;
}
#mask {
	display: none;
	background: #000;
	position: fixed;
	left: 0;
	top: 0;
	z-index: 88888;
	width: 100%;
	height: 100%;
	opacity: 0.5;
}

</style>
<script>
$(document).ready(function() {
	$('a.popup-window').click(function(){
		var popupBox = $(this).attr('href');
		$(popupBox).fadeIn(400);
		
		var popMargTop = ($(popupBox).height() +24) / 2;
	    var popMargLeft = ($(popupBox).width() +24) / 2;
		
		$(popupBox).css({
		 'margin-top' : -popMargTop,
		 'margin-left' : -popMargLeft
		});
		
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(400);
		return false;
		
    });
		$('button.close, #mask').live('click', function() {
		$('#mask , .popupInfo').fadeOut(400,function() {
			$('#mask').remove();		
		});
		return false;
	});
});

$(document).keyup(function(e) {
	if(e.keyCode == 27) {
		$('#mask, .popupInfo, #popup-box').fadeout(400);
		return false;
	}

});
</script>
</head>

<body>
<div id="popup-box" class="popupInfo">
<h3>Your Message has been Posted. Admin will reply to your query as soon as possible</h3>


</div>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>changed BAZZINGA</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
       <label style="font-size:36px" style="font-style:italic">
        	   <?php 
			 echo "Welcome Admin ".$_SESSION['MM_Username']." !<br>";?>
        	   </label>
          <a href="admin_acc.php" >My Account</a> | <a href="popularproducts.php">Popular products</a> | <a href="queries.php">queries</a> | <a href="user_db.php">user database</a> | <a href="logout.php">Sign out</a> </p>
          
      </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
              <li><a href="profile.php" >Profile</a></li>
              <li><a href="addproducts.php">Add Products</a></li>
              <li><a href="orders.php">orders</a>
                    
              </li>
              <li><a href="inventory.php">Store Inventory</a>
                    
              </li>
              <li></li>
            </ul>
            
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form action="#" method="get">
              <input type="text" value=" " name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
    </div> <!-- END of templatemo_menubar -->
    
    <div id="templatemo_main">
    	<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Categories</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first">
                        <a href="inventory_type.php">Type</a></li>
                        <li><a href="inventory_idinc.php">Id Increasing</a></li>
                        <li><a href="inventory_iddec.php">Id Decreasing</a></li>
                        <li><a href="inventory_mc1.php">Manufacturing Company</a>
                        </li>
                        <li><a href="inventory_qinc.php">Quantity increasing</a></li>
                        <li><a href="inventory_qdec.php">Quantity decreasing</a></li>
                        </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="image" title="image" /></a>Bestsellers </h3>   
            <div class="content"> 
                	<div class="bs_box">
                    <?php echo $dyn_table2;?>
                    <div class="cleaner"></div>
                    </div>
                    
              </div>
            </div>
    	</div>
        <div id="content" class="float_r">
        	<h1>Reply to User Queries!</h1>
            <div class="content_half float_l">
                <p>Enter Data.</p>
                <div id="contact_form">
                   <form method="POST" name="contact" action="<?php echo $editFormAction; ?><?php echo $editFormAction; ?>">
                        
                        Name:<textarea id="text" name="text" rows="0" cols="0" class="required"><?php echo $product_name;?></textarea>                      <div class="cleaner h10"></div>
                        Email:<textarea id="text" name="text" rows="0" cols="0" class="required"><?php echo $price;?></textarea>
                        <div class="cleaner h10"></div>
                        
                        Phone:<textarea id="text" name="text" rows="0" cols="0" class="required"><?php echo $details;?></textarea>
                        <div class="cleaner h10"></div>
                        
                        Message:<textarea id="text" name="text" rows="0" cols="0" class="required"><?php echo $category;?></textarea>
  
                        <div class="cleaner h10"></div>
                        
                        <label for="text">Reply:</label> <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                        <div class="cleaner h10"></div>
                        
                        
                        <input type="submit" class="submit_btn" name="submit" id="submit" value="Send"/>
                        <input type="hidden" name="MM_insert" value="contact" />
                        <input type="hidden" name="MM_update" value="contact" />
                        
                    </form>
                </div>
            </div>
        <div class="content_half float_r">
        	<h5>Primary Office</h5>
			University of florida<br />
			Gainesville<br />
			UP<br /><br />
						
			Phone: ************<br />
			Email: <a href="mailto:info@yourcompany.com">info@bazzinga.com</a><br/>
			
            <div class="cleaner h40"></div>
			
            <h5>Call Us At:-</h5>
			Rohit Chawla => Phone: *********<br />
			Ronak => Phone: <br />
			Akshat => Phone: <br /><br />
            GandFat => Phone: <br /><br />
			
			
			Email: <a href="mailto:contact@yourcompany.com">contact@bazzinga.com</a><br/>
			<br />
            </div>
        
        <div class="cleaner h40"></div>
        
        <iframe width="680" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="images/map.png"></iframe>
            
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="about.php">About</a> | <a href="faqs.php">FAQs</a> | <a href="checkout.php">Checkout</a> | <a href="contact.php">Contact Us</a>
		</p>

		Copyright © 2013 <a href="#">BAZZINGA</a> 
        <div class="pins">
									<a href="#"><img src="images/pin_1.png"></a>
									<a href="#"><img src="images/pin_2.png"></a>
									<a href="#"><img src="images/pin_3.png"></a>
									<a href="#"><img src="images/pin_4.png"></a>
								</div>
    </div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->

<?php }
			else
			{
			echo "<script>alert('You are not logged in');document.location.assign('index.php');</script>" ;} ?>

			}?>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>