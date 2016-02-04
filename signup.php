<?php require_once('Connections/connect.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO account (userid,`email-id`, `username`, `password`,'creditcard','Firstname', lastname`,'address','contactno','city','country',date_of_birth' ) VALUES (null,%s, %s, %s, %s, %s,null,null,null,null,null,null)",
  					   GetSQLValueString($_POST['textfield'], "text"),
                       GetSQLValueString($_POST['textfield2'], "text"),
                       GetSQLValueString($_POST['textfield5'], "text"),
                       GetSQLValueString($_POST['textfield3'], "text"),
                       GetSQLValueString($_POST['textfield4'], "text"));

  //oci_select_db($database_connect, $connect);
  $Result1 = oci_parse($connect,$insertSQL);
  oci_execute($Result1);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ch E-mall | The online Shopping Store</title>
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

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>E-Mall</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
          <a href="#">My Account</a> | <a href="#">My Wishlist</a> | <a href="#">My Cart</a> | <a href="#">Checkout</a> | <a href="#">Log In</a> | <a href="signup.htm">Sign up</a></p>
          <p>
           	  Shopping Cart: <strong>3 items</strong> ( <a href="shoppingcart.html">Show Cart</a> )
        </p>
        </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.html" class="selected">Home</a></li>
                        <li><a href="products.php">ENTERTAINMENT</a>
                  
                    <ul>
                        <li><a href="dynamicproduct.php?type=Music">Music</a></li>
                        <li><a href="dynamicproduct.php?type=Movie">Movies</a></li>
                        
                  </ul><!-- end inner ul -->
                </li>
                <li><a href="#">Hard Goods products</a>
                	<ul>
                    	<li><a href="dynamicproduct.php?type=Laptop">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=Game">Games</a></li>
                        <li><a href="dynamicproduct.php?type=Pen-Drives">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=Softwares">Softwares</a></li>
                         </ul>
                 </li>
                <li><a href="about.html">About</a>
                    <ul>
                        <li><a href="#">Sub menu 1</a></li>
                        <li><a href="#">Sub menu 2</a></li>
                        <li><a href="#">Sub menu 3</a></li>
                  </ul>
                </li>
                <li></li>
                <li><a href="checkout.html">Checkout</a></li>
                <li><a href="contact.html">Contact Us</a></li>
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
                    	<a href="#">Music</a></li>
                        <li><a href="#">Movie</a></li>
                        <li><a href="#">Laptop</a></li>
                        <li><a href="#">Game</a></li>
                        <li><a href="#">Pen-Drive</a></li>
                        <li><a href="#">Software</a></li>
                        
                    
                        <li><a href="products.html">entertainment</a></li>
                   
                    </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="image" title="image" /></a>Bestsellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title</a></h4>
                        <p class="price">Rs 0.00</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title 2</a></h4>
                        <p class="price">Rs 0.00</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title 3</a></h4>
                        <p class="price">rs0.00</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title 5</a></h4>
                        <p class="price">Rs 0.00</p>
                        <div class="cleaner"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="float_r">
        <h2><b>Welcome Admin!! <span class="h10"><br />
        Signup and get the </span></b><span class="h10"><b>experience of a lifetime</b>...</span></h2>
        <form  id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="280" cellspacing="0" cellpadding="20">
  <tr>
    <td width="56">First Name</td>
    <td width="142"><input type="text" name="textfield" id="textfield" /></td>
  </tr>
  <tr>
    <td>Last name</td>
    <td><input type="text" name="textfield2" id="textfield2" /></td>
  </tr>
  <tr>
    <td>Username</td>
    <td><label for="textfield7"></label>
      <input type="text" name="textfield3" id="textfield3" /></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><label for="textfield8"></label>
      <input type="text" name="textfield4" id="textfield4" /></td>
  </tr>
  <tr>
    <td>E-Mail Id</td>
    <td><label for="textfield9"></label>
      <input type="text" name="textfield5" id="textfield5" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="Submit" /></td>
  </tr>
  </table>
<input type="hidden" name="MM_insert" value="form1" />
      </form>
</div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="index.php"><b>Home</b></a> | <a href="products.php"><b>Products</b></a> | <a href="about.php"><b>About</b></a> | <a href="checkout.php"><b>Checkout</b></a> | <a href="contact."><b>Contact Us</b></a>
		</p>

    	Copyright © 2015 <a href="#">Your Company Name</a> | <a href="http://www.templatemo.com/preview/templatemo_367_shoes">Shoes Theme</a> by <a href="http://www.templatemo.com" target="_parent" title="free css templates">templatemo</a>
         <div class="pins">
									<a href="#"><img src="images/pin_1.png"></a>
									<a href="#"><img src="images/pin_2.png"></a>
									<a href="#"><img src="images/pin_3.png"></a>
									<a href="#"><img src="images/pin_4.png"></a>
								</div>
    </div> <!-- END of templatemo_footer -->
    </body>
    </html>