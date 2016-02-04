<script>
function func()
{
	window.location.assign("productdetail.php")
}
</script><?php require_once('Connections/connect.php'); ?>
<?php

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

//  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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
if (isset($_POST['Type'])) {
  $colname_Recordset1 = $_POST['Type'];
}

// mysql_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
$query_Recordset1 = sprintf("SELECT * FROM product WHERE Type LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));

//$Recordset1 = mysql_query($query_Recordset1, $connect) or die(mysql_error());
$Recordset1 = oci_parse($connect1, $query_Recordset1);
//print($query_Recordset1);
//$row_Recordset1 = mysql_fetch_assoc($Recordset1);
oci_execute($Recordset1);
while (($row_Recordset1 = oci_fetch_assoc($Recordset1)) != false) {
    
}


//$totalRows_Recordset1 = mysql_num_rows($Recordset1);
$totalRows_Recordset1  = oci_num_rows($Recordset1);
	
?>
<script>
<?php $i=0;$j=0?>
function func()
{
	Window.location.assign('gridbox.php');
	if(i!=0 && i%9==0)
	{$j=$i;} 
}
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
  $insertSQL = sprintf("INSERT INTO user_signup (`First Name`, `Last Name`, `E-Mail Id`, `Username`, `Password`) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['textfield'], "text"),
                       GetSQLValueString($_POST['textfield2'], "text"),
                       GetSQLValueString($_POST['textfield5'], "text"),
                       GetSQLValueString($_POST['textfield3'], "text"),
                       GetSQLValueString($_POST['textfield4'], "text"));

  //mysql_select_db($database_connect, $connect);
  $connect1 = oci_connect($username_connect, $password_connect, $database_connect);
  $Result1 = mysql_query($insertSQL, $connect1) or die(mysql_error());
  $query_Recordset1 = sprintf("SELECT * FROM product WHERE Type LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
  
$Recordset1 = mysql_query($query_Recordset1, $connect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
 // mysql_select_db($database_connect, $connect);
 $connect1 = oci_connect($username_connect, $password_connect, $database_connect);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM user_signup WHERE Username=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
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
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BAZZINGA | Products</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="temp.css" rel="stylesheet" type="text/css" />
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
		$(popupBox).fadeIn(400);
		
		var popMargTop = ($(popupBox).height() +24) / 2;
	    var popMargLeft = ($(popupBox).width() +24) / 2;
		
		$(popupBox).css({
		 'margin-top' : -popMargTop,
		 'margin-left' : -popMargLeft
		});
		
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(3000);
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
<h7>Welcome to BAZZINGA!</h7><br>
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
    <td><input type="submit" name="button" id="button" value="Submit" onClick="func()" /></td>
  </tr>
  </table>
<input type="hidden" name="MM_insert" value="form1" />
      </form>        	
</div>

</div>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>BAZZINGA</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
           <a href="myaccount.php">My Account</a> |  <a href="cart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <?php if(isset($_SESSION['MM_Username'])){?><a href="logout.php">Logout</a><?php } else { ?> <a href="#popup-box" class="popup-window">Log In/Sign up</a> <?php } ?> | <a href="admin.php"> Admin </a> </p>
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
                        <li><a href="dynamicproduct.php?type=Movies">Movies</a></li>
                       <!-- <li><a href="dynamicproduct.php?type=Mtrousers">Trousers</a></li>
                        <li><a href="dynamicproduct.php?type=Mjeans">Jeans</a></li>
                        <li><a href="dynamicproduct.php?type=Mshoes">Shoes</a></li>-->
                  </ul><!-- end inner ul -->
                </li>
                <li><a href="#">Hard Goods</a>
                	<ul>
                    	<li><a href="dynamicproduct.php?type=Laptops">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=Games">Games</a></li>
                        <li><a href="dynamicproduct.php?type=Pen-Drives">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=Softwares">Softwares</a></li>
                        <!--<li><a href="dynamicproduct.php?type=wshoes">Shoes</a></li>
                        <li><a href="dynamicproduct.php?type=wjewel">Jewellery</a></li>
                        <li><a href="dynamicproduct.php?type=wbags">Handbags</a></li>-->
                  </ul>
            </li>
                <li><a href="about.php">About</a>
                    <ul>
                        <li><a href="#">Website</a></li>
                        <li><a href="#">Minor Project</a></li>
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
<input type="text" name="search" placeholder="search for products" />
<input type="submit" value="search" />
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
                        <li><a href="dynamicproduct.php?type=Movies">Movies</a></li>
                        <li><a href="dynamicproduct.php?type=Laptops">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=Games">Games</a></li>
                        <li><a href="dynamicproduct.php?type=Pen-Drives">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=Softwares">Softwares</a></li>
                               
                    </ul>
                </div>
            </div>
                        <?php
						    if ( $conn = oci_connect('ggarg','AnkurGarg2008','oracle.cise.ufl.edu:1521/orcl'))
   							{

  							 }
  								 else
 							  {
  							     die("could not connect to foo");
  							 }
//						mysql_select_db($database_connect, $connect);

//						$sql2 = mysql_query(,$connect);
						$sql2 = oci_parse($connect, "select /*+ index_desc(product PRODSALE_IDX) */ * from product where QTYSOLD is not null and rownum < 4");

						oci_define_by_name($sql2, "Name", $Name2);
						oci_define_by_name($sql2, "Type", $Type2);
						oci_define_by_name($sql2, "IMAGE", $image2);
						oci_define_by_name($sql2, "Price", $price2);						
						oci_define_by_name($sql2, "Prodid", $Prodid);				
						oci_execute($sql2);						
						$dyn_table2 ='<tr>';						
						
						While($row = oci_fetch_assoc($sql2)){
						/*$Name2 = $row["Name"];
						$Type2 = $row["Type"];
						$image2 = $row["prod_image"];
						$price2 = $row["Price"];
						$Prodid = $row["Prodid"];	
						*/
						{	
						$dyn_table2 .='<p><td><tr><tr><br>'.$Name2.'</tr>';
						$dyn_table2 .='<br>'.$Type2.'<br>';
						$dyn_table2 .='<br><a href="productdetail.php?Prodid='.$Prodid.'"><img src="'.$image2.'" width = 100, height = 100/></a><br/>';
						$dyn_table2 .='<br><center><strong>Price: Rs.'.$price2.'</strong></center><br>';
						$dyn_table2 .='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Prodid.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart" align="left"/><a href="productdetail.php?Prodid='.$Prodid.'"><img src="images/templatemo_detail.png" height="21.5" align="right"></a></form></td></tr></p><br><br><br><br><br>';
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


<?php
//mysql_connect("localhost","root","") or die("cannot connect");
//mysql_select_db("emall"); 
//echo "dfasdfasda";
//print_r($_POST);
//exit;


if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);//filter
	$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
	//$sqldd = "SELECT * from product WHERE (Name LIKE '%Music%' OR Type LIKE '%Music%' )and rownum < 20 ";
	$query1 = oci_parse($connect1, "SELECT * from product WHERE ( Name LIKE '%$searchq%' OR Type LIKE '%$searchq%' ) and rownum < 20");
//	$query = mysql_query("SELECT * from product WHERE Name LIKE '%$searchq%' OR Type LIKE '%$searchq%'") or die("could not search");
//	print( "654654 SELECT * from product WHERE Name LIKE '%$searchq%' OR Type LIKE '%$searchq%'");
//	exit;
	//$count = mysql_num_rows($query);
		
	oci_define_by_name($query1, "Name", $Name1);
	oci_define_by_name($query1, "Type", $Type1);
	oci_define_by_name($query1, "IMAGE", $image1);
	oci_define_by_name($query1, "Prodid", $Prodid1);
	oci_define_by_name($query1, "Quantity", $qty1);
	oci_define_by_name($query1, "SALEPRICE", $price1);
	
	oci_execute($query1);
	$Count1 = oci_num_rows($query1);
	print( "SELECT * from product WHERE Name LIKE '%$searchq%' OR Type LIKE '%$searchq%'");
//	print($Count1);
//	exit;
//	if ($Count1==0)
//	{ 
//		$output= 'There was no search results!';
	//}else	{;
	$output ='<table border="0" cellpadding="10"><tr>';
	
		While(oci_fetch($query1)){
	/*
	$Name = $row["Name"];
	$Type = $row["Type"];
	$image=$row["prod_image"];
	$Prodid = $row["Prodid"];
	$qty = $row["Quantity"];
	$price = $row["Price"];
	*/
	
	if($i%3==0){
		$output .='</tr><tr>';
		/*$dyn_table .='<td>'.$Name;
		$dyn_table .='<br>'.$Type.'<br>';
		$dyn_table .='<img src="'.$image.'" width = 200, height = 200/></td>';
*/
		
	}//else {
		
		$output .='<td><p style="color: #000">'.$Name1;
		$output .='<br>'.$Type1.'<br>';
		$output .='<a href="productdetail.php?Prodid='.$Prodid1.'"><img src="'.$image1.'" width = 200, height = 200/></a>';
		$output.='<br><center><p style="color: #000">Price: Rs.'.$price1.'</p></center><br>';
		$output.='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Prodid1.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart" align="left"/><a href="productdetail.php?Prodid='.$Prodid1.'"><img src="images/templatemo_detail.png" height="21.5" align="right"></a></form></td>';
		



	//}
	
	
	
	
	
	$i++;

}
$output .='</tr></table>';

//	}
}
?>

        <div id="content" class="float_r">
        	<h1> Search Results</h1>
            <div class="product_box">
			<?php echo $output;?>

        	</div>
                 
            
            <div class="cleaner"></div>
               	
                        
            <div class="cleaner"></div>
                 	
                    	
             
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="about.php ">About</a> | <a href="faqs.html">FAQs</a> | <a href="checkout.php">Checkout</a> | <a href="contact.php">Contact Us</a>
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
<?php
//mysql_free_result($Recordset1);
?>
