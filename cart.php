<?php require_once('Connections/connect.php'); ?>
<?php $tid = 1;$job = 1;?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "inputtrans")) {
  $insertSQL = sprintf("INSERT INTO ``transaction`` (trans_id, username, prod_id, prod_name, prod_image, prod_type, quantity, prod_description, manufacturer, cart_total) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['x1'], "int"),
                       GetSQLValueString($_POST['x2'], "text"),
                       GetSQLValueString($_POST['x3'], "int"),
                       GetSQLValueString($_POST['x4'], "text"),
                       GetSQLValueString($_POST['x5'], "text"),
                       GetSQLValueString($_POST['x6'], "text"),
                       GetSQLValueString($_POST['x7'], "int"),
                       GetSQLValueString($_POST['x8'], "text"),
                       GetSQLValueString($_POST['x9'], "text"),
                       GetSQLValueString($_POST['x10'], "double"));

  //mysql_select_db($database_connect, $connect);
  $connect1 = oci_connect($username_connect, $password_connect, $database_connect);
  $Result1 = oci_parse($connect1,$insertSQL);
  oci_execute($Result1);
}

$j=0;
?>
<?php 
session_start();
//Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
include "Connections/connect.php";
?>
<?php 
	?>
<?php
//Section1
if(isset ($_POST['Prodid'])) {
	$Prodid = $_POST['Prodid'];
	$wasfound=false;
	$i = 0;
	//if the cart session variable is not set or cart is empty
	if(!isset($_SESSION["cart_array"])|| count($_SESSION["cart_array"])<1){
	//Run if the cart is empty or not set
	$_SESSION["cart_array"]=array(0=>array("item_id"=>$Prodid, "quantity"=>1));
	} else {
		//Run if the cart has at least one item in it
		foreach($_SESSION["cart_array"] as $each_item){
			$i++;
			while(list($key,$value)=each($each_item)){
				if($key=="item_id" && $value== $Prodid){
					//that item is in cart already so adjust its qauntity using array_splice()
					array_splice($_SESSION["cart_array"],$i-1,1,array(array("item_id"=>$Prodid,"quantity"=>$each_item['quantity']+1)));
					$wasfound=true;
				}//close if condition
			}//close while loop
		}//close foreach loop
		if($wasfound==false){
			array_push($_SESSION["cart_array"],array("item_id"=>$Prodid,"quantity"=>1));
		}
	}
	header("location: cart.php"); //this is used to prevent reposting of products and quantities on refreshing
	exit();
	
}

?>

<?php 
//section2
//if user chooses to empty hi scart
if(isset($_GET['cmd']) && $_GET['cmd']=="emptycart"){
	unset($_SESSION["cart_array"]);
	
}
?>

<?php 
//section3
//if user chooses to adjust item quantity
if(isset($_POST['item_to_adjust']) && $_POST['item_to_adjust']!=""){
//execute code
$item_to_adjust=$_POST['item_to_adjust'];
$quantity = $_POST['quantity'];
$quantity = preg_replace('#[^0-9]#i','',$quantity);//to prevent quantity in decimals such as 0.5
if($quantity>=100){$quantity=99;}
if($quantity < 1){$quantity=1;}
$i=0;
foreach($_SESSION["cart_array"] as $each_item){
			$i++;
			while(list($key,$value)=each($each_item)){
				if($key=="item_id" && $value== $item_to_adjust){
					//that item is in cart already so adjust its qauntity using array_splice()
					array_splice($_SESSION["cart_array"],$i-1,1,array(array("item_id"=>$item_to_adjust,"quantity"=>$quantity)));
					
				}//close if condition
			}//close while loop
		}//close foreach loop
}
?>


<?php
//Section 4.if the user wants to remove an item from the cart.
//the $i variable that was posted in section 4 in the 'X' buton is attained here and passed as index_to_remove

if(isset($_POST['index_to_remove'])&& $_POST['index_to_remove']!=""){
	//Access the array and run the code to remove that array index
	$key_to_remove =$_POST['index_to_remove'];
	if(count($_SESSION["cart_array"]) <= 1){
		unset($_SESSION["cart_array"]);
	}else {
		unset($_SESSION["cart_array"]["$key_to_remove"]);
		sort($_SESSION["cart_array"]);

}
}
?>
 <?php
			
			if(isset($_SESSION['MM_Username']))
			{?>

<?php
//Section5
//cart for user view
$m = $_SESSION['MM_Username'];
$cartOutput="";
$cartTotal="";
$itemTotal="";
$cartTotal1="";
$cartTotaln="";
$disc1 = "";


if(!isset($_SESSION["cart_array"])||count($_SESSION["cart_array"])<1) {
	$cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
}else{
	
	$i=0;
	foreach($_SESSION["cart_array"]as $each_item){
		
		$item_id=$each_item['item_id'];
		$sql=sprintf("SELECT * FROM product1 WHERE Prodid='$item_id' LIMIT 1");
		$q1=oci_parse($connect,$q1);
		oci_execute($q1);
		while($row=oci_fetch_array($ql)){
			$product_name=$row["Name"];
			$price=$row["Price"];
			$details=$row["Description"];
			$image = $row["prod_image"];
			$type= $row["Type"];
			$mc = $row["Manufacturing Company"];
			
		}
		$pricetotal= $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		$itemTotal = $itemTotal + $each_item['quantity'];
		
		//Dynamic table
		$cartOutput .='<tr>';
		$cartOutput .='<td><a href=\"productdetail.php?Prodid=$item_id\">'.$product_name.'<br/><img src="'.$image.'" alt="'. $product_name .'" width ="100", height = "100" border="0" /></td>';
		$cartOutput .='<td>'.$details.'</td>';
		$cartOutput .='<td>Rs '.$price.'</td>';
		$cartOutput .='<td><form action="cart.php" method="post">
		<input name="quantity" type="text" value="'.$each_item['quantity'].'" size="1" maxlength="2" />
					  <input name="adjustBtn '.$item_id.'" type="submit"  value="change"/>
					  <input name="item_to_adjust" type="hidden" value="'.$item_id.'"/></form></td>';
		//$cartOutput .='<td>'.$each_item['quantity'].'</td>';
		$cartOutput .='<td>Rs '.$pricetotal.'</td>';
		
		$cartOutput .='<td><form action="cart.php" method="post"><input name="deleteBtn '.$item_id.'" type="submit"  value="X"/><input name="index_to_remove" type="hidden" value="'.$i.'"/></form></td>';
		$cartOutput .="</tr>";
		
		$y = $each_item['quantity'];
		$yo = oci_parse($connect,"INSERT INTO cart(username, prod_id, prod_name, prod_image, prod_type, quantity, prod_description, manufacturer, price, cart_total) 
   VALUES('$m',$item_id,'$product_name','$image','$type',$y, '$details','$mc',$price,$cartTotal)");
  	oci_execute($yo);
		$i++;$job++;
		
	}
	$cartTotal1 = $cartTotal;
	$cartTotal='<div align="right">Cart Total: Rs'.$cartTotal.'</div>';
	

		
	}
	/*if(isset($_POST['coupon'])){
		$cpn = $_POST['coupon'];
		
		$sql4=mysql_query("SELECT * FROM coupon WHERE coupon_name ='$cpn'");
		while($row=mysql_fetch_array($sql4)){
		$n = $row["coupon_name"];
		$dic = $row["discount"];
		}
		$mk = $dic;
		$yah = ($dic * $cartTotal1)/100;
		$cartTotal1 = $cartTotal1 - $yah;
		
	$cartTotaln='<div align="right">Discounted Total: Rs'.$yah.'</div>';
		
		
		}
		else echo"myFunction()";

	$var = $job - 1;
	$_SESSION['item'] = $var;
$_SESSION['total'] = $cartTotal1;
$_SESSION['total1']= $itemTotal;
	*/
?>
<?php


//mysql_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
$sql1 = oci_parse($connect1,"SELECT * FROM product1 ORDER BY qtysold DESC");
oci_execute($sql1);
$dyn_table1 ='<tr>';
While($j<3&& $row = oci_fetch_assoc($sql1)){
	$Name1 = $row["Name"];
	$Type1 = $row["Type"];
	$image1 = $row["prod_image"];
	$Prodid1 = $row["Prodid"];
	$price1 = $row["Price"];
		
	{	
		$dyn_table1 .='<p><td><tr><tr><br><strong>'.$Name1.'</strong></tr>';
		$dyn_table1 .='<br><strong>'.$Type1.'</strong><br>';
		$dyn_table1 .='<img src="'.$image1.'" width = "50", height = "50"/><br>';
		$dyn_table1 .='<br><center><strong>Price: Rs.'.$price1.'</strong></center><br>';
		$dyn_table1 .='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Prodid1.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart" align="left"/><a href="productdetail.php?Prodid='.$Prodid1.'"><img src="images/templatemo_detail.png" height="21.5" align="right"></a></form></td>';}
	$j++;

}
$dyn_table1 .='</tr></table>';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BAZZINGA | Shopping Cart</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />
<link href="style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<style type="text/css">
#templatemo_wrapper #templatemo_main #templatemo_footer p a {
	color: #000;
}
#templatemo_wrapper #templatemo_main #templatemo_footer a {
	color: #000;
}
</style>
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

function func2()
{
var x;
var r=confirm("Your cart is empty");
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
        	   <label style="font-size:24px" style="font-style:italic">
        	   <?php 
			 echo "Welcome  ".$_SESSION['MM_Username']."<br>";?>
        	   </label>
          <a href="myaccount.php">My Account</a> | <a href="cart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <a href="logout.php">Log out</a>  | <a href="admin.php"> Admin </a></p>
          <p>
           	  Shopping Cart: <strong><?php echo $itemTotal;?></strong> ( <a href="cart.php">Show Cart</a> )
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
                    <?php echo $dyn_table1;?>
                    <div class="cleaner"></div>
                    </div>
                    
                </div>
            </div>
        </div>
      <div id="content" class="float_r">
        	        <div style="margin: 18px; text-align: left; font-size: 14px; box-sizing: content-box; color: #000;">
  
  <table width="675" border="0" cellpadding="6">
    <tr bgcolor="#ddd">
      <th width="29%" scope="row">Product</th>
      <td width="26%"><strong>Product Description</strong></td>
      <td width="17%"><strong>Unit Price</strong></td>
      <td width="11%"><strong>Quantity</strong></td>
      <td width="7%"><strong>Total</strong></td>
      <td width="10%"><strong>Remove</strong></td>
    </tr>
    <?php echo $cartOutput;?>
    <!--<tr>
     <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>-->
  
        <td align="right" style="background:#ddd; font-weight:bold"><?php echo $cartTotal;?></td>
                
          

        </table>
        <div style="float:right; width: 215px; margin-top: 20px;">
                 
          <p>&nbsp; </p>
          <form id="coupon" name="coupon" method="post" action="">
            Enter Coupon Code
            <input type="text" name="coupon" id="coupon" />
            <br />
            <input type="submit" name="button" id="button" value="Apply Code" onclick="myFunction()" />
<br />
          </form>
          <td align="right" style="background:#ddd; font-weight:bold"><?php echo $cartTotaln;?></td>
        
          <p><?php if ($itemTotal > 0){ ?><a href="checkout.php"><br />
            Proceed to checkout</a></p><?php } else {?><form name="yala" method="" onclick="func2()">Proceed to Checkout </form><?php } ?>

          <p><a href="products.php">Continue shopping</a></p>
                    
    </div>
       <br/>
       <br/>
       <div style="float:left; width:300px; margin-top: 30px;">
       <a href="cart.php?cmd=emptycart">Click Here to Empty Your Shopping cart</a></p>
       </div>
     <br/>
     </div>
     <?php }
else
{
echo "<script>alert('You are not logged in');document.location.assign('index.php');</script>" ;
			
}?>
    <div class="cleaner"></div>   
    </div><!-- END of templatemo_main -->
    <div class="cleaner"></div>
    </div> <!-- END of templatemo_wrapper -->
    <div id="templatemo_footer">
    	<p><a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="about.php">About</a> | <a href="faqs.html">FAQs</a> | <a href="checkout.php">Checkout</a> | <a href="contact.php">Contact Us</a>
		</p>

    	Copyright © 2013 <a href="#">BAZZINGA!</a> 
         <div class="pins">
									<a href="#"><img src="images/pin_1.png"></a>
									<a href="#"><img src="images/pin_2.png"></a>
									<a href="#"><img src="images/pin_3.png"></a>
									<a href="#"><img src="images/pin_4.png"></a>
	  </div>
    </div> <!-- END of templatemo_footer -->
    

</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>










