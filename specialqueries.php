<?php require_once('Connections/connect.php'); ?>
<?php $i=0;$j=0?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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

$colname_Recordset1 = "-1";
if (isset($_GET['Type'])) {
  $colname_Recordset1 = $_GET['Type'];
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO account (userid,`email-id`, `username`, `password`,'creditcard','Firstname', lastname`,'address','contactno','city','country',date_of_birth' ) VALUES (null,%s, %s, %s, %s, %s,null,null,null,null,null,null)",
                       GetSQLValueString($_POST['textfield'], "text"),
                       GetSQLValueString($_POST['textfield2'], "text"),
                       GetSQLValueString($_POST['textfield5'], "text"),
                       GetSQLValueString($_POST['textfield3'], "text"),
                       GetSQLValueString($_POST['textfield4'], "text"));

  //($database_connect, $connect);
  $Result1 = oci_parse($connect,$insertSQL);
  $query_Recordset1 = sprintf("SELECT * FROM product WHERE Type LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = oci_parse($connect,$query_Recordset1);
$row_Recordset1 = oci_fetch_assoc($Recordset1);
$totalRows_Recordset1 = oci_num_rows($Recordset1);
$x = $_POST['textfield3'];
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['textfield'])) {
  $loginUsername=$_POST['textfield'];
  $password=$_POST['textfield2'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "myaccount.php";
  $MM_redirectLoginFailed = "faqs.html";
  $MM_redirecttoReferrer = false;
  //mysql_select_db($database_connect, $connect);
  $connect1 = oci_connect($username_connect, $password_connect, $database_connect);
  $LoginRS__query=sprintf("SELECT Username, Password FROM account WHERE Username=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = oci_parse($connect1,$LoginRS__query);
  oci_execute($LoginRS);
  $loginFoundUser = oci_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>


<?php
//check to see the url variable is set and it exists in the database
if(isset($_GET['type'])){
	include "Connections/connect.php";
	$type = $_GET['type'];
	//this var is used to check if Id exists,if yes then get the product detail else exit the script
	$sql = oci_parse($connect, "SELECT * FROM product WHERE Type like '$type%' and  rownum < 200 ORDER BY Prodid ");
	oci_execute($sql);
	
	while (($row_Recordset1 = oci_fetch_assoc($sql)) != false) {
    echo"error";
}
$Count = oci_num_rows($sql);

//$totalRows_Recordset1 = mysql_num_rows($Recordset1);
//$totalRows_Recordset1  = oci_num_rows($sql);
//======================================================
	//$Count = mysql_num_rows($sql);//count the output amount
	oci_define_by_name($sql, "Name", $Name);
	oci_define_by_name($sql, "Type", $Type);
	oci_define_by_name($sql, "IMAGE", $image);
	oci_define_by_name($sql, "Prodid", $Prodid);
	oci_define_by_name($sql, "Quantity", $qty);
	oci_define_by_name($sql, "SALEPRICE", $price);
	
  
		
		
		
		
		
		



}else {
	echo "Data to render this page is missing";
	exit();
}
//oci_close($connect);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BAZZINGA! | Products</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="temp.css" type="text/css" rel="stylesheet" />
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
	top: 50%;
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

#templatemo_body_wrapper #templatemo_wrapper #templatemo_main #sidebar .sidebar_box .content .bs_box {
	color: #000;
}
#templatemo_body_wrapper #templatemo_wrapper #templatemo_main #content .product_box h6 strong {
	color: #000;
}
</style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
<script>
$(document).ready(function() {
	$('a.popup-window').click(function(){
		var popupBox = $(this).attr('href');
		$(popupBox).fadeIn(3000);
		
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
function func()
{
var x;
var r=confirm("Thank you for Signing up with Bazzinga! A confirmation E-mail has been sent to your email id with confirmation code");
if (r==true)
  {
  x="You pressed OK!";
  }
else
  {
  x="You pressed Cancel!";
  }

}


</script>
</head>

<body>
<div id="popup-box" class="popupInfo">
<h7>Welcome to Best Buy Copy!</h7><br>
<h6>  The one click shopping store..</h6><br><br>
<div class="column1">
<h6>Login and shop with the best offers</h6><br><br>
<table width="100" border="0">
  <tr>
    <th width="10" scope="row">Username</th>
    <td width="10"><form id="form2" name="form2" method="POST" action="<?php echo $loginFormAction; ?>">
      
      <span id="sprytextfield1">
      <input type="text" name="textfield" id="textfield">
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span>
</td>
  </tr>
  <br>
  <tr>
    <th scope="row">Password</th>
    <td>
     <span id="sprypassword1">
     <input type="password" name="textfield2" id="textfield2">
     <span class="passwordRequiredMsg">A value is required.</span><span class="passwordMinCharsMsg">Minimum number of characters not met.</span><span class="passwordMaxCharsMsg">Exceeded maximum number of characters.</span></span>
     
    </td>
  </tr>
  <br>
  <tr>
    <th scope="row">&nbsp;</th>
    <td>
      <input type="submit" name="button" id="button" value="Login" />
    </form></td>
  </tr>
</table>
</div>
<div class="column2">
     <h6> Signup and get the experience of a lifetime</h6>
            <form  id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="250">
  <tr>
    <td width="56">First Name</td>
    <td width="100"><input type="text" name="textfield" id="textfield" /></td>
  </tr>
  <br>
  <tr>
    <td>Last name</td>
    <td><input type="text" name="textfield2" id="textfield2" /></td>
  </tr>
  <br>
  <tr>
    <td>Username</td>
    <td>
      <span id="sprytextfield2">
      <input type="text" name="textfield3" id="textfield3">
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span></span></td>
  </tr>
  <br>
  <tr>
    <td>Password</td>
    <td><span id="sprypassword2">
    <input type="password" name="textfield4" id="textfield4">
    <span class="passwordRequiredMsg">A value is required.</span><span class="passwordMinCharsMsg">Minimum number of characters not met.</span><span class="passwordMaxCharsMsg">Exceeded maximum number of characters.</span></span>      
      </td>
  </tr>
  <br>
  <tr>
    <td>E-Mail Id</td>
    <td><span id="sprytextfield3">
    <input type="text" name="textfield5" id="textfield5">
    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>
      </td>
  </tr>
  <br>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Submit" onclick="func()" /></td>
  </tr>
  </table>
<input type="hidden" name="MM_insert" value="form1" />
      </form>        	
</div>

</div>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>Best Buy Copy</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
           <a href="myaccount.php">My Account</a> |  <a href="cart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <?php if(isset($_SESSION['MM_Username'])){?><a href="logout.php">Logout</a><?php } else { ?> <a href="#popup-box" class="popup-window">Log In/Sign up</a> <?php } ?> | <a href="admin.php"> Admin </a></p>
          <p>
           	  Shopping Cart: <strong><?php if (isset($_SESSION['total1'])){ echo $_SESSION['total'];} ?></strong> ( <a href="cart.php">Show Cart</a> )
              
            
        </p>
        </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php" class="selected">Home</a></li>
                <li><a href="#">ENTERTAINMENT</a>
                    <ul>
                        <li><a href="dynamicproduct.php?type=Music">Music</a></li>
                        <li><a href="dynamicproduct.php?type=Movie">Movies</a></li>
                  </ul><!-- end inner ul -->
                </li>
                <li><a href="#">ELECTRONICS</a>
                	<ul>
                    	<li><a href="dynamicproduct.php?type=Laptop">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=Game">Games</a></li>
                        <li><a href="dynamicproduct.php?type=Pen-Drives">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=Softwares">Softwares</a></li>
						<li><a href="dynamicproduct.php?type=Special Queries">Special Queries</a></li>
                     </ul>
                 </li>
                <li><a href="about.php">About</a>
                    <ul>
                        <li><a href="#">WEBSITE USING ORACLR DB</a></li>
                        <li><a href="#">Term Project</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Next Step</a></li>
                  </ul>
                </li>
                <li></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
           <form action="search3.php" method="post">
<input type="text" name="search" placeholder="search for products" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
<input type="submit" value="search" class="sub_btn"/>
          </form>
        </div>
    </div> <!-- END of templatemo_menubar -->
    
    <div id="templatemo_main">
    	<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>Categories</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first"><a href="dynamicproduct.php?type=Music">Music</a></li>
                        <li><a href="dynamicproduct.php?type=Movie">Movies</a></li>
                        <li><a href="dynamicproduct.php?type=Laptop">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=Game">Games</a></li>
                        <li><a href="dynamicproduct.php?type=Pen_Drive">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=Software">Softwares</a></li>
						<li><a href="dynamicproduct.php?type=Special Queries">Special Queries</a></li>
                        
                    </ul>
                </div>
            </div>
                        <?php
		                        
						//mysql_select_db($database_connect, $connect);

						$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
						$sql2 = oci_parse($connect1, "select /*+ index_desc(product PRODSALE_IDX) */ * from product where QTYSOLD is not null and rownum < 4");					
						oci_execute($sql2);							
						oci_define_by_name($sql, "Name", $Name2);
						oci_define_by_name($sql, "Type", $Type2);
						oci_define_by_name($sql, "IMAGE", $image2);
						oci_define_by_name($sql, "Prodid", $Prodid1);
						//oci_define_by_name($sql, "Quantity", $qty);
						oci_define_by_name($sql, "SALEPRICE", $price2);
						
						$dyn_table2 ='<tr>';
						While(oci_fetch($sql2)){
/*							$Name2 = $row["Name"];
							$Type2 = $row["Type"];
							$image2 = $row["prod_image"];
							$price2 = $row["Price"];	
							$Prodid1 = $row["Prodid"];
*/							{	
								$dyn_table2 .='<p><td><tr><tr><br>'.$Name2.'</tr>';
								$dyn_table2 .='<br>'.$Type2.'<br>';
								$dyn_table2 .='<br><img src="'.$image2.'" width = 100, height = 100/><br/>';
								$dyn_table2.='<br><center><strong>Price: Rs.'.$price2.'</strong></center><br>';
								$dyn_table2.='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Prodid1.'" />
								<input type="image" src="images/templatemo_addtocart.png" name="add to cart" align="left"/><a href="productdetail.php?Prodid='.$Prodid1.'"><img src="images/templatemo_detail.png" height="21.5" align="right"></a></form></td>';
							}
	

						}
						$dyn_table2 .='</tr></table>';
						?>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="image" title="image" /></a>Bestsellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    <?php echo $dyn_table2; ?>	
                </div>
            </div>
        </div>
        </div>
        <div id="content" class="float_r">
        	<h1> <?php echo $type;?></h1>
            
			<h4 > 1) Total NO of Tuples inserted in to Database Of Ecommerce  </h4>
			<b><?php include("tuple.php")
			?></b>
			<br></br>
			
			<h4> 2) Names of all those users from account who's age is less 
			than 20 and listen to type music and genre is heavy metal.</h4>
			<b><?php include("quer2.php")
			?></b>
			<br></br>
			
			<h4> 3) Display products in which from the product table search for the sale price of product id ....
			if the sale price is greater than 10$ give a discount of 5%
			else if sale price is greater than 20$ then 10% discount ...
			else if sale price is greater than 30$ then give 15% percent discount.
			Now from the shipping cost, if it is greater than 2$ then add shipping cost to the new sale price calculated above
			else if it is less than equal to 2$ shipping cost is made free i.e. nothing is added to new sale price
			hint: sales price = (sales price + (shipping cost  * discount rate)  discount rate</h4>
			<b><?php include("quer3.php")
			?></b>
			<br></br>
			
			<h4 > 4) Show recommended products to the user </h4>
			<b><?php include("query4.php")
			?></b>
			<br></br>
			
			<h4 > 5)Display all those users with their names and the name of products 
			who have purchased a product and have given a review of greater than 3.  </h4>
			<b><?php include("query5.php")
			?></b>
			
                 
            
            <div class="cleaner"></div>
               	
                        
            <div class="cleaner"></div>
                 	
                    	
             
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="about.php">About</a> | <a href="faqs.html">FAQs</a> | <a href="checkout.php">Checkout</a> | <a href="contact.php">Contact Us</a>
		</p>


    	Copyright © 2013 <a href="#">BEST BUY COPY</a>
        
    </div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:4, validateOn:["change"], maxChars:20});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["change"], minChars:5, maxChars:24});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {minChars:4, validateOn:["change"]});
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2", {minChars:4, maxChars:24, validateOn:["change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
</script>
</body>
</html>

