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



?>

<?php
//oci_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
$sql1 = oci_parse($connect1,"SELECT * FROM product1 ORDER BY qtysold DESC");
oci_execute($sql1);
$dyn_table1 ='<tr>';
While($j<5&& $row = oci_fetch_assoc($sql1)){
	$Name1 = $row["Name"];
	$Type1 = $row["Type"];
	$image1 = $row["prod_image"];
	$price1 = $row["Price"];
	$prodid = $row["Prodid"];	
	{	
		$dyn_table1 .='<p><td><tr><tr><br><p style="color:#000">'.$Name1.'</tr>';
		$dyn_table1 .='<img src="'.$image1.'" width = 100, height = 100/><br>';
		$dyn_table1 .='<br><br><br><br><br><br><br><p style="color:#000">Price : Rs.'.$price1.'<br>';
		$dyn_table1 .='<td><a href="productdetail.php?Prodid='.$prodid.'"><img src="images/templatemo_detail.png"></a>';
		$dyn_table1 .='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$prodid.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart"  /></form></td></td></p>';
	}
	$j++;

}
$dyn_table1 .='</tr></table>';
?>


<?php        $m = $_SESSION['MM_Username'];
//oci_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
$query_Recordset1 = "SELECT * FROM account where USERNAME = '$m'";
$Recordset1 = oci_parse($connect1,$query_Recordset1);
oci_execute($Recordset1);
$row_Recordset1 = oci_fetch_assoc($Recordset1);
$totalRows_Recordset1 = oci_num_rows($Recordset1);
$img = $row_Recordset1['picture'];
$dyn = '<tr><img src="'.$img.'" width ="200", height ="200"/></tr>'; 
$dyn1 = '<tr><img src="'.$img.'" width="500" height="500"/></tr>';
?>
 
     <?php 
//oci_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
$sql = oci_parse($connect1,"SELECT * FROM transaction WHERE username = '$m'");
oci_execute($sql);
While($row = oci_fetch_assoc($sql)){
	$t = $row["prod_type"];
}


$sql2 = oci_parse($connect1,"SELECT * FROM product WHERE Type = '$t' LIMIT 9");
oci_execute($sql2);
$dyn_table ='<table  cellpadding="10"><tr>';

While($row = oci_fetch_assoc($sql2)){
	
	$Name = $row["Name"];
	$Type = $row["Type"];
	$image=$row["prod_image"];
	$Pd = $row["Prodid"];
	$price = $row["Price"];
	
	if($i%3==0){
		$dyn_table .='</tr><tr>';
		/*$dyn_table .='<td>'.$Name;
		$dyn_table .='<br>'.$Type.'<br>';
		$dyn_table .='<img src="'.$image.'" width = 200, height = 200/></td>';
*/
		
	}//else {
		
		$dyn_table .='<td><p style="color:#000">'.$Name;
		$dyn_table .='<img src="'.$image.'" width = 175, height = 200/>';
		$dyn_table.='<br><center><strong><p style="color:#000">dPrice: Rs.'.$price.'</strong></center><br>';
		$dyn_table.='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Pd.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart" align="left"/><a href="productdetail.php?Prodid='.$Pd.'"><img src="images/templatemo_detail.png" height="21.5" align="right"></a></form></td>';
		
	//}
	
	
	
	
	
	$i++;

}
$dyn_table .='</tr></table>';

?>
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>changed Bazzinga | User Profile</title>
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
    	<div id="site_title"><h1>changed BAZZINGA</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
          <a href="myaccount.php" class="selected">My Account</a>  | <a href="cart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <a  href="logout.php">Logout</a></p>
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
                <li><a href="profile.php">Info</a></li>
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
    <div class= "cover">
       <div id="slider-wrapper">
                <div id="slider" class="nivoSlider">
                    <a href=""><img src="images/gallery/Dress-like-A-Londoner.jpg" width="900"  height="500" alt="" /></a>
                    <a href="#"><img src="images/gallery/commuter.jpg" alt="" width="800" height="500" title="" /></a>
                    <a href="#"><img src="images/gallery/heroBanner_2.jpg" width="800" height="500" alt="" /></a>
                    <a href=""><img src="images/gallery/i_contactus.jpg" width="800" height="500" alt="" title="" /></a>
                    <a href=""><img src="images/gallery/large-mens-clothinglarge-mens-clothing.jpg" width="800" height="500" alt="" title="" /></a>
                </div>
                
        </div>
            <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
            <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
            <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
            </script>
    </div>
   	    <p>&nbsp;</p>
      <div id="sidebar" class="float_l">
   	    <p>&nbsp;</p>
   	    <p>&nbsp;</p>
   	    <p>&nbsp;</p>
   	    <div class="sidebar_box"><span class="bottom"></span>
   	      
  <div id="popup-box" class="popupInfo">
<?php echo $dyn1;?>
</div>
<h3>Profile Picture</h3>
            <div class="profile_pic">
            <a href="#popup-box" class="popup-window"><?php echo $dyn;?></a>
            </div>
            <br />
            <br />   
                
   	    </div>
       	  <br />
       	  <div class="sidebar_box"><span class="bottom"></span>
   	        <h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="image" title="image" /></a>Bestsellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	<?php echo $dyn_table1;?>
                    </div>
                </div>
        </div>
      </div>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <div id="content" class="float_r">
        	<p>&nbsp;</p>
            <p>&nbsp;</p>
            
       	    <p>
        	   
        </p>
       	    <p>&nbsp;</p>
   	    <p>&nbsp; </p>
        <label style="font-size:36px" style="font-style:italic">
        	   <?php 
			 echo "Welcome  ".$_SESSION['MM_Username']."<br>";?>
        	   </label><br />
        	 <table width="566" height="71" border="0" align="center">
        	  <tr>
        	    <th scope="row">&nbsp;</th>
        	    <td>&nbsp;</td>
      	    </tr>
        	  <tr>
        	    <th width="163" align="left" scope="row">My Name :</th>
        	    <td width="387"><?php echo $row_Recordset1['First Name']; ?></td>
      	    </tr>
        	  <tr>
        	    <th align="left" scope="row">My E-Mail Id:</th>
        	    <td><?php echo $row_Recordset1['E-Mail Id']; ?></td>
      	    </tr>
        	  <tr>
        	    <th align="left" scope="row">My Username :</th>
        	    <td><?php echo $row_Recordset1['Username']; ?></td>
      	    </tr>
        	  <tr>
        	    <th align="left" scope="row">My Address:</th>
        	    <td><?php echo $row_Recordset1['Address']; ?></td>
      	    </tr>
        	  <tr>
        	    <th align="left" scope="row">My Contact No :</th>
        	    <td><?php echo $row_Recordset1['Contact No']; ?></td>
      	    </tr>
        	  <tr>
        	    <th scope="row">&nbsp;</th>
        	    <td><form id="form1" name="form1" method="post" action="">
        	    </form></td>
      	    </tr>
          </table>	
			
		 


       	<p>&nbsp;</p>
        	<p>&nbsp;</p>
            
        	<h1><strong>Recommended Products</strong></h1>
        <div class="product_box">
        
            <strong><?php echo $dyn_table;?></strong></p>
          
        </div>
            <div class="cleaner"></div> 
            
            
      </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="about.php">About</a> | <a href="faqs.html">FAQs</a> | <a href="checkout.php">Checkout</a> | <a href="contact.php">Contact Us</a>
		</p>

    	Copyright © 2015 <a href="#">changed BAZZINGA</a>
         <div class="pins">
									<a href="#"><img src="images/pin_1.png"></a>
									<a href="#"><img src="images/pin_2.png"></a>
									<a href="#"><img src="images/pin_3.png"></a>
									<a href="#"><img src="images/pin_4.png"></a>
								</div>
    </div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->

			


<?php
oci_free_result($Recordset1);
?>
<?php }
			else
			{
			echo "<script>alert('You are not logged in');document.location.assign('index.php');</script>" ;
			
			}
?>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>
