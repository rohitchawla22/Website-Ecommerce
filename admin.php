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
  $MM_redirectLoginSuccess = "admin_acc.php";
  $MM_redirectLoginFailed = "faqs.html";
  $MM_redirecttoReferrer = false;
 // mysql_select_db($database_connect, $connect);
  $connect1 = oci_connect($username_connect, $password_connect, $database_connect);
  $LoginRS__query=sprintf("SELECT adminid,name, password FROM admin WHERE name=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = oci_parse($connect1,$LoginRS__query);
  oci_execute($LoginRS);
  $loginFoundUser = oci_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username1'] = $loginUsername;
    $_SESSION['MM_UserGroup1'] = $loginStrGroup;	      

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Best Buy Copy The online Shopping Store | Admin signin</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />



<link href="style.css" rel="stylesheet" type="text/css" />
<link href="temp.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">


</script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "top_nav", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
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

#templatemo_body_wrapper #templatemo_wrapper #templatemo_main #sidebar .sidebar_box .content .bs_box {
	color: #000;
}
#templatemo_body_wrapper #templatemo_wrapper #templatemo_main #content .product_box h6 strong {
	color: #000;
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
function func()
{
var x;
var r=confirm("Thank you for Signing up with Best Buy Coppy! A confirmation E-mail has been sent to your email id with confirmation code");
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

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>BAZZINGA!</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
          <a href="account.php">My Account</a> | <a href="cart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <a href="#popup-box" class="popup-window">Log In/Sign up</a>  | <a href="admin.php" class="selected">Admin</a></p>
          
      </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">ENTERTAINMENT</a>
                    <ul>
                        <li><a href="dynamicproduct.php?type=Music">Music</a></li>
                        <li><a href="dynamicproduct.php?type=Movies">Movies</a></li>
                        
                  </ul><!-- end inner ul -->
                </li>
                <li><a href="#">Hard Goods products</a>
                	<ul>
                    	<li><a href="dynamicproduct.php?type=Laptop">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=Games">Games</a></li>
                        <li><a href="dynamicproduct.php?type=Pen-Drives">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=Softwares">Softwares</a></li>
                         </ul></li>
                <li><a href="about.php" class="selected">About Us</a>
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
<input type="text" name="search" placeholder="search for products" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
<input type="submit" value="search" class="sub_btn"/>
          </form>
        </div>
    </div> <!-- END of templatemo_menubar -->
    
   
        <div id="content" class="float_r">
        <h2>Welcome Admin! Login and attain the experinece of a lifetime!</h2>
        <div align="left">
          <p><img src="images/gallery/Admin.gif" width="374" height="310" />        </p>
          <div align="right">
          <?php if(!isset($_SESSION['MM_Username1'])) { ?>
          <table width="374" border="1">
           <form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">
            <tr>
              <th width="60" scope="row">Admin Name</th>
              <td width="144" align="left">
              <span id="sprytextfield1">
              <input type="text" name="textfield" id="textfield4" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span>
              
             </td>
            </tr>
            <tr>
              <th scope="row">Password</th>
              <td align="left">
                <span id="sprypassword1">
                <input type="password" name="textfield2" id="textfield5" />
                <span class="passwordRequiredMsg">A value is required.</span><span class="passwordMinCharsMsg">Minimum number of characters not met.</span><span class="passwordMaxCharsMsg">Exceeded maximum number of characters.</span></span>
                
            </td>
            </tr>
            <tr>
              <th scope="row">&nbsp;</th>
              <td align="left">
                <input type="submit" name="button" id="button" value="Log in " />
            </form></td>
           
            </tr>
          </table>
      
          <p>&nbsp;</p>
        </div>
        </div>
		

        <!-- END of templatemo_main -->
    
<div id="templatemo_footer">
    	<p><a href="index.php"><b>Home</b></a> | <a href="products.php"><b>Products</b></a> | <a href="about.php"><b>About</b></a> | <a href="checkout.php"><b>Checkout</b></a> | <a href="contact.php"><b>Contact Us</b></a>
		</p>

    	Copyright © 2015 <a href="#">BAZZINGA!</a> 
         <div class="pins">
									<a href="#"><img src="images/pin_1.png"></a>
									<a href="#"><img src="images/pin_2.png"></a>
									<a href="#"><img src="images/pin_3.png"></a>
									<a href="#"><img src="images/pin_4.png"></a>
	  </div>
</div> <!-- END of templatemo_footer -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"], minChars:4, maxChars:20});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:4, maxChars:20, validateOn:["change"]});
</script>
<?php } else{
echo "<script>alert('You are already logged in');document.location.assign('index.php');</script>" ;} ?>
</body>
    </html>