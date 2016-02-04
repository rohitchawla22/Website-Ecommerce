<?php require_once('Connections/connect.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "contact")) {
  $insertSQL = sprintf("INSERT INTO query (name, email_id, contact_no, message) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['phone'], "int"),
                       GetSQLValueString($_POST['text'], "text"));

  //mysql_select_db($database_connect, $connect);
  $connect1 = oci_connect($username_connect, $password_connect, $database_connect);
  $Result1 = oci_parse( $connect1 ,$insertSQL);
  oci_execute($Result1);
}
?>
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

  //mysql_select_db($database_connect, $connect);
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
  mysql_select_db($database_connect, $connect);
  
  $LoginRS__query=sprintf("SELECT username, password FROM account WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = oci_parse($connect,$LoginRS__query);
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
						//mysql_select_db($database_connect, $connect);

						$sql2 = oci_parse($connect,"SELECT * FROM product ORDER BY qtysold DESC LIMIT 3");

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
						$dyn_table2 .='<td><a href="productdetail.php?Prodid='.$Prodid.'"><img src="images/templatemo_detail.png" ></a>';
						$dyn_table2 .='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Prodid.'" />
						<input type="image" src="images/templatemo_addtocart.png" name="add to cart"  /></form></td></td></tr></p><br><br><br><br><br>';
						}
	

						}
						$dyn_table2 .='</tr></table>';
						?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>changed BAZZINGA | The online Shopping Store</title>
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
<h7>changed Welcome to BAZZINGA!</h7><br>
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
    	<div id="site_title"><h1>BAZZINGA</h1><br><h5>The online Shopping Store</h5></div>
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
                        <li><a href="dynamicproduct.php?type=Mshirt">Music</a></li>
                        <li><a href="dynamicproduct.php?type=Mtshirt">Movies</a></li>
                        <!--<li><a href="dynamicproduct.php?type=Mtrousers">Trousers</a></li>
                        <li><a href="dynamicproduct.php?type=Mjeans">Jeans</a></li>
                        <li><a href="dynamicproduct.php?type=Mshoes">Shoes</a></li>-->
                  </ul><!-- end inner ul -->
                </li>
                <li><a href="#">Hard Goods products</a>
                	<ul>
                    	<li><a href="dynamicproduct.php?type=wshirt">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=wtshirt">Games</a></li>
                        <li><a href="dynamicproduct.php?type=wdresses">Pen-Drives</a></li>
                        <!--<li><a href="dynamicproduct.php?type=wjeans">Jeans</a></li>
                        <li><a href="dynamicproduct.php?type=wshoes">Shoes</a></li>
                        <li><a href="dynamicproduct.php?type=wjewel">Jewellery</a></li>
                        <li><a href="dynamicproduct.php?type=wbags">Handbags</a></li>-->
                     </ul>
                 </li><a href="about.php">About</a>
                    <ul>
                        <li><a href="#">Website</a></li>
                        <li><a href="#">UNIVERSITY OF FLORIDA DBMS Project</a></li>
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
                    	<li class="first"><a href="dynamicproduct.php?type=shirt">Music</a></li>
                        <li><a href="dynamicproduct.php?type=tshirt">Movies</a></li>
                        <li><a href="dynamicproduct.php?type=trousers">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=jeans">Gaming</a></li>
                        <li><a href="dynamicproduct.php?type=dresses">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=shoes">Sort by artist</a></li>
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
        	<h1>Contact Us</h1>
            <div class="content_half float_l">
                <p>Enter Data.</p>
                <div id="contact_form">
                   <form method="POST" name="contact" action="<?php echo $editFormAction; ?>">
                        
                        <label for="author">Name:</label> <input type="text" id="author" name="author" class="required input_field" />
                        <div class="cleaner h10"></div>
                        <label for="email">Email:</label> <input type="text" id="email" name="email" class="validate-email required input_field" />
                        <div class="cleaner h10"></div>
                        
                        <label for="phone">Phone:</label> <input type="text" name="phone" id="phone" class="input_field" />
                        <div class="cleaner h10"></div>
        
                        <label for="text">Message:</label> <textarea id="text" name="text" rows="0" cols="0" class="required"></textarea>
                        <div class="cleaner h10"></div>
                        
                        
                        <input type="submit" class="submit_btn" name="submit" id="submit" value="Send"/>
                        <input type="hidden" name="MM_insert" value="contact" />
                        
                    </form>
                </div>
            </div>
        <div class="content_half float_r">
        	<h5>Primary Office</h5>
			UNIVERSITY OF FLORIDA,<br />
			Gainesville,<br />
			 FLORIDA<br /><br />
						
			Phone: XX-XXXXXXXXXX<br />
			Email: <a href="mailto:rohitchawla@ufl">info@bazzinga.com</a><br/>
			
            <div class="cleaner h40"></div>
			
            <h5>CALL US DIRECTLY</h5>
			Rohit Chawla => Phone: 9717-980-447<br/>
            Ganpat       => Phone: 9717-980-447<br/>
            Ronak Gupta  => Phone: 8860-266-619<br/>
            Akshat Sharma => Phone: 9717-980-447<br/>
			<br />
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


<script type='text/javascript' src='js/logging.js'></script><script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:4, validateOn:["change"], maxChars:20});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["change"], minChars:5, maxChars:24});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {minChars:4, validateOn:["change"]});
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2", {minChars:4, maxChars:24, validateOn:["change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
</script>
</body>
</html>