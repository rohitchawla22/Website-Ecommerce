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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
  $insertSQL = sprintf("INSERT INTO billing (username, fullname, address, city, `state`, zipcode, country, creditcard, email, phone) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['text1'], "text"),
                       GetSQLValueString($_POST['text2'], "text"),
                       GetSQLValueString($_POST['text3'], "text"),
                       GetSQLValueString($_POST['text4'], "text"),
                       GetSQLValueString($_POST['text5'], "text"),
                       GetSQLValueString($_POST['text6'], "int"),
                       GetSQLValueString($_POST['text7'], "text"),
                       GetSQLValueString($_POST['text8'], "int"),
                       GetSQLValueString($_POST['text9'], "text"),
                       GetSQLValueString($_POST['text10'], "text"));

  //mysql_select_db($database_connect, $connect);
  $connect1 = oci_connect($username_connect, $password_connect, $database_connect);
  $Result1 = oci_parse($connect1,$insertSQL);
}

session_start();
if(isset($_SESSION['MM_Username']))
{?>
<script>
<?php $i=0;$j=0;?>
<?php
//mysql_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
$sql1 = oci_parse($connect1,"SELECT * FROM product ORDER BY qtysold DESC LIMIT 1");
oci_execute($sql1);
$dyn_table1 ='<tr>';
While($row = oci_fetch_assoc($sql1)){
	$Name1 = $row["Name"];
	$Type1 = $row["Type"];
	$image1 = $row["prod_image"];
	$price1 = $row["Price"];
	$Prodid = $row["Prodid"];	
	{	
		$dyn_table1 .='<p><td><tr><tr><br>'.$Name1.'</tr>';
		$dyn_table1 .='<br>'.$Type1.'<br>';
		$dyn_table1 .='<img src="'.$image1.'" width = 100, height = 100/><br>';
		$dyn_table1 .='<br><center><strong>Price: Rs.'.$price1.'</strong></center><br>';
		$dyn_table1 .='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Prodid.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart" align="left"/><a href="productdetail.php?Prodid='.$Prodid.'"><img src="images/templatemo_detail.png" height="21.5" align="right"></a></form></td>';
	}
	$j++;

}
$dyn_table1 .='</tr></table>';
?>

<?php        $m = $_SESSION['MM_Username'];
?>
</script>
			
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>changedBAZZINGA - Check Out</title>
<meta name="keywords" content="e-store, check out, ecommerce, online shop" />
<meta name="description" content="e-store" />
<link href="style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">


</script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "top_nav", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
function myFunction()
{
var x;
var r=confirm("Thank You for shopping with us.");
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
    	<div id="site_title"><h1>changed BAZZINGA<br></br></h1><h5> The Online Shopping Store</h5></a></h1></div>
        <div id="header_right">
        	
<label style="font-size:20px" style="font-style:italic">
<?php 
echo "Welcome  ".$_SESSION['MM_Username']."<br>";?>
 </label>
<p>
<a href="myaccount.php">My Account</a> |  <a href="cart.php">My Cart</a> | <a href="checkout.php">Checkout</a>  | <a href="logout.php">Logout</a></p>
<?php
			
			$total1 ="";
            if(isset($_SESSION['total1'])){
				$total1 =$_SESSION['total1'];
				
			}?>
          <p>
           	  Shopping Cart: <strong><?php echo $total1;?></strong> ( <a href="cart.php">Show Cart</a> )
        </p>
        </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="myaccount.php">Profile</a></li>
                <li><a href="acchistory.php">Account history</a></li>
                <li><a href="query_rep1.php">Query Replies</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="checkout.php" class="selected">Checkout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        
           <div id="templatemo_search">
          <form action="search3.php" method="post">
<input type="text" name="search" placeholder="search for products" onFocus="clearText(this)" onBlur="clearText(this)" class="txt_field" />
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
                    	<?php echo $dyn_table1 ;?>
          
                    </div>
                </div>
            </div>
        </div>
      <div id="content" class="float_r">
        	
 <h2>Checkout</h2>
            <h5><strong>BILLING INFORMATION</strong></h5>
        <div class="content_half float_l checkout">
          <form method="POST" id="form1" name="form1" action="<?php echo $editFormAction; ?>">
            <p>Username:<span id="sprytextfield1">
            <input type="text" name="text1" id="text1" />
            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span><br />
                <br />
				Full Name (must be same as on your credit card):  
                  
                  <span id="sprytextfield2">
                  <input type="text" name="text2" id="text2" />
                  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span>                   <br />
                <br />
              Address:
              
              <span id="sprytextfield3">
              <input name="text3" type="text" id="text3" value="" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span>				<br />
                <br />
              City:
              
              <span id="sprytextfield4">
              <input type="text" name="text4" id="text4" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span>                <br />
                <br />
                State:
                
                <span id="sprytextfield5">
                <input type="text" name="text5" id="text5" />
                <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span>                <br />
                <br />
                Zipcode:
                
                <span id="sprytextfield6">
                <input type="text" name="text6" id="text6" />
                <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>                <br />
                <br />
                Country:
                
              <span id="sprytextfield7">
              <input type="text" name="text7" id="text7" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.<br />
              <br />
            </span></span></p>
            <p>Credit card :
              
  <span id="sprytextfield8">
  <input type="text" name="text8" id="text8" />
  <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span>                <br />
              <br />
              E-MAIL:
              
              <span id="sprytextfield9">
              <input type="text" name="text9" id="text9" />
              <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span>				<br />
              <br />
              PHONE:<span id="sprytextfield10">
              <input type="text" name="text10" id="text10" />
              <span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span><br />
              <span style="font-size:10px">Please, specify your reachable phone number. YOU MAY BE GIVEN A CALL TO VERIFY AND COMPLETE THE ORDER.</span>
              <input type="submit" name="button" id="button" value="Submit" onClick="myFunction()"/>
              <input type="hidden" name="MM_insert" value="form1" />
              
            </p>
          </form>
      </div>
            
            <div class="cleaner h50"></div>
            <h3>SHOPPING CART</h3>
            <?php
			
			$total ="";
            if(isset($_SESSION['total'])){
				$total=$_SESSION['total'];
				
			}?>
            <h4>TOTAL AMOUNT: <strong>Rs. <?php echo $total;?> </strong></h4>
			<p>
             <input name = "checkbox" type="checkbox" onSelect="" />
			
            I accept the <a href="#">terms of use</a> of this website.
           
            <a href="transaction.php">Generate Bill</a></p>
			            <table style="border:1px solid #CCCCCC;" width="100%">
                <tr>
                    <td height="80px"> <img src="images/paypal.gif" alt="paypal" /></td>
                    <td width="400px;" style="padding: 0px 20px;">Recommended if you have a PayPal account. Fastest delivery time.
                    </td>
                    <td><a href="#" class="more">PAYPAL</a></td>
                </tr>
                <tr>
                    <td  height="80px"><img src="images/2co.gif" alt="paypal" />
                    </td>
                    <td  width="400px;" style="padding: 0px 20px;">E-Mall.com, Inc. is an authorized retailer of goods and services. CheckOut accepts customer orders via online checks, Visa, MasterCard, Discover, American Express, Diners, JCB and debit cards with the Visa, Mastercard logo. </td>
                    <td><a href="#" class="more">2CHECKOUT</a></td>
                </tr>
            </table>
    </div>
         <?php }
else
{
echo "<script>alert('You are not logged in');document.location.assign('index.php');</script>" ;
	

}?>
 
        <div class="cleaner"></div>
  </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="about.php">About</a> | <a href="faqs.html">FAQs</a> | <a href="checkout.php">Checkout</a> | <a href="contact.php">Contact Us</a>
		</p>

		Copyright © 2013 <a href="#">changedBAZZINGA</a> 
    <div class="pins">
									<a href="www.linkedin.com"><img src="images/pin_1.png"></a>
									<a href="www.twitter.com"><img src="images/pin_2.png"></a>
									<a href="www.blogspot.com"><img src="images/pin_3.png"></a>
									<a href="https://www.facebook.com/pages/Bazzinga-The-Online-Shopping-Store/212580378914678"><img src="images/pin_4.png"></a>
	  </div>
</div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:4, validateOn:["change"], maxChars:20});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {minChars:4, maxChars:20, validateOn:["change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["change"], minChars:1, maxChars:20});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["change"], minChars:3, maxChars:20});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {minChars:3, maxChars:20, validateOn:["change"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "zip_code", {validateOn:["change"], useCharacterMasking:true});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {minChars:3, maxChars:15, validateOn:["change"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "integer", {validateOn:["change"], minChars:4});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "email", {validateOn:["change"], minChars:5, maxChars:30});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "integer", {validateOn:["change"], isRequired:false, minChars:10, maxChars:10});
</script>
</body>
</html>