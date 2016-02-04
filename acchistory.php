<?php require_once('Connections/connect.php'); ?>
<?php
			session_start();
			if(isset($_SESSION['MM_Username']))
			{
?>
        	   
<script>
<?php $i=0;$j=0;?>
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
//mysql_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);

$sql1 = oci_parse($connect1,"SELECT * FROM product ORDER BY qtysold DESC");

$dyn_table3 ='<tr>';
While($j<5&& $row = oci_fetch_assoc($sql1)){
	$Name1 = $row["Name"];
	$Type1 = $row["Type"];
	$image1 = $row["prod_image"];
	$price1 = $row["Price"];
	$prodid = $row["Prodid"];	
	{	
		$dyn_table3 .='<p><td><tr><tr><br>'.$Name1.'</tr>';
		$dyn_table3 .='<img src="'.$image1.'" width = 100, height = 100/><br>';
		$dyn_table3 .='<center>'.$price1.'<br>';
		$dyn_table3 .='<a href="productdetail.php?Prodid='.$prodid.'"><img src="images/templatemo_detail.png"></a>';
		$dyn_table3 .='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$prodid.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart"  /></form></td></p><br><br><br><br><br>';
	}
	$j++;

}
$dyn_table3 .='</tr></table>';
?>


<?php        $m = $_SESSION['MM_Username'];
//mysql_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
$query_Recordset1 = sprintf("SELECT * FROM account where Username = '$m'");
$Recordset1 = oci_parse($connect1,$query_Recordset1);
oci_execute($Recordset1);
$row_Recordset1 = oci_fetch_assoc($Recordset1);
$totalRows_Recordset1 = oci_num_rows($Recordset1);
$img = $row_Recordset1['picture'];
$dyn = '<tr><img src="'.$img.'" width ="200", height ="200"/></tr>'; 
$dyn1 = '<tr><img src="'.$img.'" width="500" height="500"/></tr>';
?>
 
    
<?php
//mysql_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
$m = $_SESSION['MM_Username'];
$sql1 = oci_parse($connect1,"SELECT * FROM transaction WHERE username = '$m' ORDER BY trans_id DESC");
oci_execute($sql1);
$dyn_table1 ='<tr>';
While($row = oci_fetch_assoc($sql1)){
	
	$Name1 = $row["prod_name"];
	$Type1 = $row["prod_type"];
	$id = $row["prod_id"];
	$image1 = $row["prod_image"];
	$mc = $row["manufacturer"];
	$qty = $row["quantity"];
	
	$des = $row["prod_description"];
	$pr = $row["price"];
	{	
		$dyn_table1 .='<tr>';
		
		$dyn_table1 .='<td><a href=\"productdetail.php?Prodid='.$id.'\">'.$Name1.'<br/><img src="'.$image1.'" alt="'. $Name1.'" width ="70", height = "100" border="0" /></td>';
		$dyn_table1 .='<td>'.$Type1.'</td>';
		
		$dyn_table1 .='<td>'.$mc.'</td>';
		$dyn_table1 .='<td>'.$qty.'</td>';
		
		$dyn_table1 .='<td>'.$des.'</td>';
		$dyn_table1 .='<td>'.$pr.'</td>';
		$dyn_table1 .='</tr>';
	}
	$j++;$m++;

}
$dyn_table1 .='</table>';

?>


</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bazzinga | User Profile</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />
<link href="style1.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<style type="text/css">
#templatemo_body_wrapper #templatemo_wrapper #templatemo_main #content table tr th {
	color: #FFF;
}
#templatemo_body_wrapper #templatemo_wrapper #templatemo_main #content .product_box strong {
	color: #FFF;
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
	top: 45%;
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
	opacity: 0.8;
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
</script>


</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>BAZZINGA</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
          <a href="myaccount.php" class="selected">My Account</a> |  <a href="cart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <a  href="logout.php">Logout</a></p>
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
                
                <li><a href="checkout.php">Checkout</a></li>
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
       	  <p>&nbsp;</p>
       	  <div class="sidebar_box"><span class="bottom"></span>
       	    
       	    <div id="popup-box" class="popupInfo">
<?php echo $dyn1;?>
</div>
<h3>Profile Picture</h3>
            <div class="profile_pic">
            <a href="#popup-box" class="popup-window"><?php echo $dyn;?></a>
            </div>   
                
   	  </div>
   	    <div class="sidebar_box"><span class="bottom"></span>
       	      <h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="image" title="image" /></a>Bestsellers </h3>   
          <div class="content"> 
           	<div class="bs_box">
           	  <?php echo $dyn_table3;?></div>
          </div>
   	    </div>
      </div>
      <div id="content" class="float_r">
        <div style="margin:0px; text-align: left; font-size: 14px; box-sizing: content-box; color: #000;">
          <h1>Account History - Products Ordered</h1>
  <table width="639" border="0" cellpadding="6">
    <tr bgcolor="#ddd">
    <td width="20%">Product</td>
      <td width="11%"><strong>Type</strong></td>
      
      <td width="20%"><strong>Manufacturing company</strong></td>
      <td width="16%"><strong>Quantity</strong></td>
      <td width="16%"><strong>Description</strong></td>
      <td width="17%"><strong>Price</strong></td>
      
        
    </tr>
    <?php echo $dyn_table1;?>
    <!--<tr>
     <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>-->
  
        
        </table>
                    
                    
        </div>
		 


       	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	
            <div class="cleaner"></div> 
            
            
      </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="about.php">About</a> | <a href="faqs.html">FAQs</a> | <a href="checkout.php">Checkout</a> | <a href="contact.php">Contact Us</a>
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

			

<script type="text/javascript">
</script>
<?php } else{
echo "<script>alert('You are not logged in');document.location.assign('index.php');</script>" ;} ?>
</body>
    </html>