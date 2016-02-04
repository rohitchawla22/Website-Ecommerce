<?php require_once('Connections/connect.php'); ?>
<?php
			session_start();
			if(isset($_SESSION['MM_Username1']))
			{?>
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

$sql1 = mysql_query("SELECT * FROM product ORDER BY qtysold DESC LIMIT 3",$connect);

$dyn_table1 ='<tr>';
While($row = mysql_fetch_assoc($sql1)){
	$Name1 = $row["Name"];
	$Type1 = $row["Type"];
	$image1 = $row["prod_image"];
	$price1 = $row["New_Price"];
	$prodid = $row["Prodid"];	
	{	
		$dyn_table1 .='<p><td><tr><tr><br><p style="color:#000">'.$Name1.'</tr>';
		$dyn_table1 .='<br><p style="color:#000">'.$Type1.'<br>';
		$dyn_table1 .='<img src="'.$image1.'" width = 100, height = 100/><br>';
		$dyn_table1 .='<a href="productdetail.php?prodid=$Prodid>"<img src="images/templatemo_detail.png"></a><br><br><br><br><br>';
	}
	$j++;

}
$dyn_table1 .='</tr></table>';
?>


<?php 
mysql_select_db($database_connect, $connect);

$sql = mysql_query("SELECT * FROM product ORDER BY Prodid DESC ",$connect);

$dyn_table ='<table border="0" cellpadding="15"><tr>';

While($i<6 && $row = mysql_fetch_assoc($sql)){
	
	$Name = $row["Name"];
	$Type = $row["Type"];
	$image=$row["prod_image"];
	$Prodid = $row["Prodid"];
	$Price = $row["Price"];
	
	/*if($i%3==0){
		$dyn_table .='</tr><tr>';
		/*$dyn_table .='<td>'.$Name;
		$dyn_table .='<br>'.$Type.'<br>';
		$dyn_table .='<img src="'.$image.'" width = 200, height = 200/></td>';

		
	}else {*/
		
		$dyn_table .='<td>'.$Name;
		$dyn_table .='<br>'.$Type.'<br>';
		$dyn_table .='<img src="'.$image.'" width = "150", height ="180"/>';
		$dyn_table .='<br><center>Price: Rs.'.$Price.'<br><br>';
		$dyn_table.='<a href = "productdetail.php?Prodid='.$Prodid.'"><img src="images/templatemo_detail.png"></a></td>';

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
<title>BAZZINGA! | Admin Account</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />
<link href="style1.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<style type="text/css">
#templatemo_body_wrapper #templatemo_wrapper #templatemo_main #content table tr th {
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
<style>
body {
	
	margin: 0px;
	padding: 0px;
	color: #fff;
}
.popupInfo1 {
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
#mask1 {
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
		
		$('body').append('<div id="mask1"></div>');
		$('#mask1').fadeIn(400);
		return false;
		
    });
		$('button.close, #mask1').live('click', function() {
		$('#mask1 , .popupInfo1').fadeOut(400,function() {
			$('#mask1').remove();		
		});
		return false;
	});
});

$(document).keyup(function(e) {
	if(e.keyCode == 27) {
		$('#mask1, .popupInfo1, #popup-box').fadeout(400);
		return false;
	}

});
</script>

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>BAZZINGA!</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
          <a href="admin_acc.php" class="selected">My Account</a> | <a href="popularproducts.php">Popular products</a> | <a href="queries.php">queries</a> | <a href="user_db.php">user database</a> | <a href="logout.php">Sign out</a> </p>
          
        </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                
                 <li><a href="index.php">Home</a></li>
              <li><a href="admin_acc.php" class="selected">Profile</a></li>
              <li><a href="addproducts.php">Add Products</a></li>
              <li><a href="orders.php">orders</a>
                    
                </li>
              <li><a href="inventory.php">Store Inventory</a>
                    
                </li>
              <li></li>
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
        <?php        $m = $_SESSION['MM_Username1'];
mysql_select_db($database_connect, $connect);
$query_Recordset2 = "SELECT * FROM admin_login where AdminName = '$m'";
$Recordset2 = mysql_query($query_Recordset2, $connect) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
$img = $row_Recordset2['image'];
$dyn = '<tr><img src="'.$img.'" width ="200", height ="200"/></tr>';
$dyn1 = '<tr><img src="'.$img.'" width ="500", height="500" /></tr>';
?>
      <div id="sidebar" class="float_l">
       	  <p>&nbsp;</p>
       	  <p>&nbsp;</p>
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
                
       	  </div>
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
        	   
        	   <label style="font-size:36px" style="font-style:italic">
        	   <?php 
			 echo "Welcome Admin ".$_SESSION['MM_Username1']." !<br>";?>
        	   </label>
        </p>
       	    <p>&nbsp;</p>
   	    <p>&nbsp; </p>
 
        	 <form id="form1" name="form1" method="post" action="">
             <table width="566" height="71" border="0">
        	  <tr>
        	    <th width="163" scope="row"><div align="left">My Name :</div></th>
        	    <td width="387"><?php echo $row_Recordset2['name']; ?></td>
      	    </tr>
        	  <tr>
        	    <th scope="row"><div align="left">My E-Mail Id:</div></th>
        	    <td><?php echo $row_Recordset2['email_id']; ?></td>
      	    </tr>
        	  <tr>
        	    <th scope="row"><div align="left">My Username :</div></th>
        	    <td><?php echo $row_Recordset2['AdminName']; ?></td>
      	    </tr>
        	  <tr>
        	    <th scope="row"><div align="left">My Address:</div></th>
        	    <td><?php echo $row_Recordset2['address']; ?></td>
      	    </tr>
        	  <tr>
        	    <th scope="row"><div align="left">My Contact No :</div></th>
        	    <td><?php echo $row_Recordset2['Contact_no']; ?></td>
      	    </tr>
        	  <tr>
        	    <th scope="row">&nbsp;</th>
        	    <td>&nbsp;</td>
      	    </tr>
          </table>	
        </form>
			
			
		 

       	<p><br><marquee><a href="#popup-box" class="popup-window">GALLERY</a></marquee>&nbsp;</p>
       	<p>&nbsp;</p>
       	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<h1><strong>New Products</strong></h1>
            <div id="popup-box" class="popupInfo1">
            <?php echo $image;?>
            </div>
            <div class="product_box">
            <marquee><?php echo $dyn_table;?></marquee>
              </div>
            <div class="cleaner"></div> 
            
            
      </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
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
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
<?php }
			 else{
echo "<script>alert('You are not logged in');document.location.assign('index.php');</script>" ;} ?>

            </body>
</html>
<?php
mysql_free_result($Recordset2);
?>
