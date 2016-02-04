<?php require_once('Connections/connect.php'); ?>
<?php $i=0;$j=0;$x =1;?>

<?php
			session_start();
			
			if(isset($_SESSION['MM_Username']))
			{?>
<?php
if(isset($_SESSION['item']))
{
	$tt1 = $_SESSION['item'];}
	else
	{$tt1 = 0;}
?>
<?php if($tt1 > 0){ ?>
<?php
$m=$_SESSION['MM_Username'];
$sql1 = mysql_query("SELECT * FROM billing WHERE username = '$m'");
$Count1 = mysql_num_rows($sql1);//count the output amount

While($row = mysql_fetch_assoc($sql1)){
	
	$Name1 = $row["fullname"];
	$address = $row["address"];
	$city=$row["city"];
	$state = $row["state"];
	$zip= $row["zipcode"];
	$country =$row["country"];
	$ccard = $row["creditcard"];
	$email = $row["email"];
	$phone = $row["phone"];
	$n='no';
	
}
?>
<?php

$sql = mysql_query("SELECT * FROM cart WHERE username = '$m' ORDER BY trans_id DESC LIMIT $tt1 ");
$Count = mysql_num_rows($sql);//count the output amount

While($row = mysql_fetch_assoc($sql)){
	
	$Name = $row["prod_name"];
	$Type = $row["prod_type"];
	$image=$row["prod_image"];
	$prodid = $row["prod_id"];
	$qty = $row["quantity"];
	$details =$row["prod_description"];
	$mc = $row["manufacturer"];
	$price = $row["price"];
	$cart_total = $row["cart_total"];
	
	
	$sql1 = mysql_query("SELECT * FROM billing WHERE username = '$m'");
	$Count1 = mysql_num_rows($sql1);//count the output amount

While($row = mysql_fetch_assoc($sql1)){
	
	$Name1 = $row["fullname"];
	$address = $row["address"];
	$city=$row["city"];
	$state = $row["state"];
	$zip= $row["zipcode"];
	$country =$row["country"];
	$ccard = $row["creditcard"];
	$email = $row["email"];
	$phone = $row["phone"];
	$n='no';
	
}
$yo = mysql_query("INSERT INTO transaction(username, prod_id, prod_name, prod_image, prod_type, quantity, prod_description, manufacturer, price, cart_total,full_name,payment_status,address,address_city,address_state,address_zip,address_country,credit_card,email_id,phone) 
   VALUES('$m',$prodid,'$Name','$image','$Type',$qty, '$details','$mc',$price,$cart_total,'$Name1','n','$address','$city','$state',$zip,'$country','$ccard','$email',$phone)");
   
   


}


?>
<?php
$sql3 = mysql_query("SELECT * FROM transaction WHERE username = '$m' AND payment_status ='n' ORDER BY trans_id DESC LIMIT $tt1");
$Count3 = mysql_num_rows($sql3);//count the output amount
$dyn_table ='<table border="0" cellpadding="10"><tr>';
While($row = mysql_fetch_assoc($sql3)){
	$no = $row["trans_id"];
	$uname = $row["username"];
	$pid = $row["prod_id"];
	$pname = $row["prod_name"];
	$pimge= $row["prod_image"];
	$ptype= $row["prod_type"];
	$quantity = $row["quantity"];
	$description =$row["prod_description"];
	$manuf= $row["manufacturer"];
	$pprice= $row["price"]; 
	$ctotal = $row["cart_total"];
	$fname = $row["full_name"];
	$add = $row["address"];
	$city1=$row["address_city"];
	$state1 = $row["address_state"];
	$zip1= $row["address_zip"];
	$country1 =$row["address_country"];
	$ccard1 = $row["credit_card"];
	$email1 = $row["email_id"];
	$phone1 = $row["phone"];
	
	{	
		$dyn_table .='<tr>';
		$dyn_table .='<td>'.$x.'</td>';
		$dyn_table .='<td><a href=\"productdetail.php?Prodid='.$pid.'\">'.$pname.'<br/><img src="'.$pimge.'" alt="'. $pname.'" width ="70", height = "100" border="0" /></td>';
		$dyn_table .='<td><center><p>&nbsp;</p>'.$description.'</center></td>';
		$dyn_table .='<td><center>'.$ptype.'</center></td>';
		$dyn_table .='<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$manuf.'</center></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$dyn_table .='<td><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$quantity.'</center></td>';
		$dyn_table .='<td><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$pprice.'</center></td>';
		$dyn_table .='<td><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ctotal.'</center></td>';
		$dyn_table .='</tr>';
	}
	$j++;$x++;
$yo1 = mysql_query("INSERT INTO acchistory(username, prod_id, prod_name, prod_image, prod_type, quantity, prod_description, manufacturer,unit price, cart_total) 
   VALUES('$m',$pid,'$pname','$pimge','$ptype',$quantity, '$description','$manuf',$pprice,$ctotal)");
}

$dyn_table .='</tr></table>';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BAZZINGA | Shopping Cart</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />
<link href="rapchik.css" rel="stylesheet" type="text/css" />

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
    	<div id="site_title"><h1>BAZZINGA!</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
        	   <label style="font-size:36px" style="font-style:italic">
        	   <?php 
			 echo "Welcome  ".$_SESSION['MM_Username']."<br>";?>
        	   </label>
          <a href="myaccount.php">My Account</a> | <a href="cart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <a href="logout.php">Logout</a>  | <a href="admin.php"> Admin </a></p>
          <p>
           	  Shopping Cart: <strong><?php if (isset($_SESSION['total1'])){ echo $_SESSION['total'];} ?></strong> ( <a href="cart.php">Show Cart</a> )
              
            
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
                <li></li>
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
    	<div id="sidebar" class="float_l"></div>
   	  <div id="content" class="float_r">
        	        <div style="margin: 18px; text-align: left; font-size: 14px; box-sizing: content-box; color: #000;">
        	          <h1>Transaction Statement</h1>
  <h3>User Information:-</h3>
  <table width="900" height="200" border="1">
  <form id="form1" name="form1" method="post" action="">  <tr>
      <th scope="row">Full Name:</th>
      <td><input name="text2" type="text" class="required" id="text2" style="width:200px;" value="<?php echo $fname;?>" size="0" />
      </td>
      <td><strong>Address:</strong></td>
      <td><input name="text3" type="text" class="required" id="text3" style="width:300px;" value="<?php echo $add;?> " size="0" />
      </td>
    </tr>
    <tr>
      <th scope="row">City        </th>
      <td><input name="text4" type="text" class="required" id="text4" style="width:300px;" value="<?php echo $city1;?>" size="0" />
      </td>
      <td><strong>State:</strong></td>
      <td><input name="text5" type="text" class="required" id="text5" style="width:300px;" value="<?php echo $state1;?>" size="0" />
      </td>
    </tr>
    <tr>
      <th scope="row">Zipcode:</th>
      <td><input name="text6" type="text" class="required" id="text6" style="width:300px;" value="<?php echo $zip1;?>" size="0" /></td>
      <td><strong>Country:</strong></td>
      <td><input name="text7" type="text" class="required" id="text7" style="width:300px;" value="<?php echo $country1;?>" size="0" /></td>
    </tr>
    <tr>
      <th scope="row">Credit Card No:</th>
      <td><input name="text8" type="text" class="required" id="text8" style="width:300px;" value="<?php echo $ccard1;?>" size="0" />
            </td>
      <td><strong>E-Mail Id:</strong></td>
      <td><input name="text9" type="text" class="required" id="text9" style="width:300px;" value="<?php echo $email1;?>" size="0" />
      </td>
    </tr>
    <tr>
      <th scope="row">Phone</th>
      <td><input name="text10" type="text" class="required" id="text10" style="width:300px;" value="<?php echo $phone1;?>" size="0" />
      </form></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  
  <table width="873" border="0" cellpadding="6">
    <tr bgcolor="#ddd">
    <th width="7%" scope="row">S.no</th>
      <th width="18%">Product</th>
      <td width="21%"><strong>Description</strong></td>
      <td width="8%"><strong>Type</strong></td>
      <td width="14%"><strong>Manufacturer</strong></td>
      <td width="12%"><strong>Quantity</strong></td>
      <td width="8%"><strong>Price</strong></td>
      <td width="12%"><strong>CartTotal</strong></td>
    </tr>
    <?php echo $dyn_table;?>
    <!--<tr>
     <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>-->
  
        <td align="right" style="background:#ddd; font-weight:bold">Cart Total: Rs<?php echo $ctotal;?></td>
        </table>
        <div style="float:right; width: 215px; margin-top: 20px;">
        
          


			

<p>&nbsp;</p>


					
          <p>
          <a href="cart.php?cmd=emptycart">Complete Transaction</a>
          <a href="products.php">Continue shopping</a></p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
                    
        </div>
       <br/>
       <div style="float:left; width:300px; margin-top: 30px;"></div>
       <?php } else { echo "<script>alert('No item added');document.location.assign('cart.php');</script>" ;} ?>
    <?php }
			else
			{
			echo "<script>alert('You are not logged in');document.location.assign('index.php');</script>" ;
			
			}
?>
       <br/>
       <br/>
     </div>
        <div class="cleaner">
          <form id="form2" name="form2" method="post" action="">
        <center><input type="button" name="button" id="button" value="Print Slip" onclick="window.print()"/></center>
      </form>
  </div>   
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
