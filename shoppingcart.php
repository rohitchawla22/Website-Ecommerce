<?php
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
if(isset($_POST['item_to_adjust']) && $_POST['item_to_adjust']!==""){
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
//Section5
//cart for user view
$cartOutput="";
$cartTotal="";
$itemTotal="";
if(!isset($_SESSION["cart_array"])||count($_SESSION["cart_array"])<1) {
	$cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
}else{
	
	$i=0;
	foreach($_SESSION["cart_array"]as $each_item){
		
		$item_id=$each_item['item_id'];
		$sql=oci_parse($connect,"SELECT * FROM product WHERE Prodid='$item_id' LIMIT 5");
		oci_execute($sql);
		while($row=oci_fetch_array($sql)){
			$product_name=$row["Name"];
			$price=$row["Price"];
			$details=$row["Description"];
			$image = $row["prod_image"];
			
		}
		$pricetotal= $price * $each_item['quantity'];
		$cartTotal = $pricetotal + $cartTotal;
		$itemTotal = $itemTotal + $each_item['quantity'];
		
		//Dynamic table
		$cartOutput .="<tr>";
		$cartOutput .="<td><a href=\"productdetail.php?Prodid=$item_id\">".$product_name.'<br/><img src="'.$image.'" alt="'. $product_name .'" width ="100", height = "100" border="0" /></td>';
		$cartOutput .='<td>'.$details.'</td>';
		$cartOutput .='<td>Rs '.$price.'</td>';
		$cartOutput .='<td><form action="cart.php" method="post">
		<input name="quantity" type="text" value="'.$each_item['quantity'].'" size="1" maxlength="2" />
					  <input name="adjustBtn '.$item_id.'" type="submit"  value="change"/>
					  <input name="item_to_adjust" type="hidden" value="'.$item_id.'"/></form></td>';
		//$cartOutput .='<td>'.$each_item['quantity'].'</td>';
		$cartOutput .='<td>Rs '.$pricetotal.'</td>';
		$cartOutput .='<td><form action="cart.php" method="post"><input name="deleteBtn '.$item_id.'" type="submit"  value="X"/><input name="index_to_remove" type="hidden" value=""/></form></td>';
		$cartOutput .="</tr>";
		$i++;
		
	}
	$cartTotal='<div align="right">Cart Total: Rs'.$cartTotal.'</div>';
	
	}
?>
<?php
//mysql_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
$sql1 = oci_parse($connect1,"SELECT Name,Type,prod_image FROM product ORDER BY qtysold DESC");
oci_execute($sql1);
$dyn_table1 ='<tr>';
While($j<3&& $row = oci_fetch_assoc($sql1)){
	$Name1 = $row["Name"];
	$Type1 = $row["Type"];
	$image1 = $row["prod_image"];
		
	{	
		$dyn_table1 .='<p><td><tr><tr><br><strong>'.$Name1.'</strong></tr>';
		$dyn_table1 .='<br><strong>'.$Type1.'</strong><br>';
		$dyn_table1 .='<img src="'.$image1.'" width = "50", height = "50"/><br>';
		$dyn_table1 .='<img src="images/templatemo_detail.png" width="30" height="20">';
		$dyn_table1 .='<img src="images/templatemo_addtocart.png" width="30" height="20"></td></p><p>&nbsp;</p>';
	}
	$j++;

}
$dyn_table1 .='</tr></table>';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Mall | Shopping Cart</title>
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

</script>

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>E-Mall</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
          <a href="myaccount.php">My Account</a> | <a href="wishlist">My Wishlist</a> | <a href="cart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <a href="#popup-box" class="popup-window">Log In/Sign up</a>  | <a href="admin.php"> Admin </a></p>
          <p>
           	  Shopping Cart: <strong><?php echo $itemTotal;?></strong> ( <a href="cart.php">Show Cart</a> )
        </p>
      </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php" class="selected">Home</a></li>
                <li><a href="products.php">ENTERTAINMENT</a>
                  
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
                         </ul>
                 </li>
                <li><a href="about.php">About</a>
                    <ul>
                        <li><a href="#">Sub menu 1</a></li>
                        <li><a href="#">Sub menu 2</a></li>
                        <li><a href="#">Sub menu 3</a></li>
                  </ul>
                </li>
                <li></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
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
                       <a href="#">Music</a></li>
                        <li><a href="#">Movies</a></li>
                        <li><a href="#">Laptops</a></li>
                        <li><a href="#">Games</a></li>
                        <li><a href="#">Pen-Drive</a></li>
                        <li><a href="#">Software</a></li>
                        
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
                    
					<p><a href="checkout.php">Proceed to checkout</a></p>
                    <p><a href="javascript:history.back()">Continue shopping</a></p>
                    
        </div>
       <br/>
       <br/>
       <div style="float:left; width:300px; margin-top: 30px;">
       <a href="cart.php?cmd=emptycart">Click Here to Empty Your Shopping cart</a></p>
       </div>
     <br/>
     </div>
    <div class="cleaner"></div>   
    </div><!-- END of templatemo_main -->
    <div class="cleaner"></div>
    </div> <!-- END of templatemo_wrapper -->
    <div id="templatemo_footer">
    	<p><a href="#">Home</a> | <a href="#">Products</a> | <a href="#">About</a> | <a href="#">FAQs</a> | <a href="#">Checkout</a> | <a href="#">Contact Us</a>
		</p>

    	<strong>Copyright © 2015</strong> <a href="#"><strong>Your Company Name</strong></a> 
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










