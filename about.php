<?php require_once('Connections/connect.php'); ?>
<?php $j=0?>
<?php

$sql1 = oci_parse($connect, "SELECT  * FROM product where QTYSOLD is not null and rownum < 10");
oci_execute($sql1);

	oci_define_by_name($sql1, "Name", $Name1);
	oci_define_by_name($sql1, "Type", $Type1);
	oci_define_by_name($sql1, "IMAGE", $image1);
	oci_define_by_name($sql1, "Prodid", $Prodid1);
	
	
$dyn_table1 ='<tr>';
While(oci_fetch($sql1)){
//	$Name1 = $row["Name"];
//	$Type1 = $row["Type"];
//	$image1 = $row["prod_image"];
//	$Prodid = $row["Prodid"];
		
	{	
		$dyn_table1 .='<p><td><tr><tr><br><strong>'.$Name1.'</strong></tr>';
		$dyn_table1 .='<br><strong>'.$Type1.'</strong><br>';
		$dyn_table1 .='<img src="'.$image1.'" width = "50", height = "50"/><br>';
		$dyn_table1 .='<a href="productdetail.php?Prodid='.$Prodid1.'"><img src="images/templatemo_detail.png"></a>';
		$dyn_table1 .='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Prodid1.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart"  /></form></td></p><p>&nbsp;</p>';
	}
	$j++;

}
$dyn_table1 .='</tr></table>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> changed BAZZINGA! | About Us</title>
<meta name="keywords" content="e-mall, about us, our store, ecommerce, online shop, discounts" />
<meta name="description" content="E-mall, about us" />
<link href="style.css" rel="stylesheet" type="text/css" />

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
    	<div id="site_title"><h1>ch BAZZINGA!</h1><br><h5>The online Shopping Store</h5></div>
        <div id="header_right">
        	<p>
	        <a href="account.php">My Account</a> | <a href="wishlist.php">My Wishlist</a> | <a href="shoppingcart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <a href="login.php">Log In</a></p>
           </div>
        <div class="cleaner"></div>
    </div> <!-- end of header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
          <ul>
                <li><a href="index.php" class="selected">Home</a></li>
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
                         </ul>
                 </li>
                <li><a href="about.php">About</a>
                    <ul>
                        <li><a href="#">WEBSITE USING ORACLE DB</a></li>
                        <li><a href="#">Term Project</a></li>
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
                    	<li class="first"><a href="dynamicproduct.php?type=Music">Music</a></li>
                        <li><a href="dynamicproduct.php?type=Movies">Movies</a></li>
                        <li><a href="dynamicproduct.php?type=Laptop">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=Games">Games</a></li>
                        <li><a href="dynamicproduct.php?type=Pen-Drives">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=Software">Softwares</a></li>
                       
                        <!--<li class="last"><a href="dynamicproduct.php?type=accessories">Accessories</a></li>-->
                    </ul>
                         </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="" title="image" /></a>Bestsellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	
                     <?php echo $dyn_table1;?>
                    <div class="cleaner"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="float_r">
        	<h1>About Us</h1>
        	<h2>Company Background</h2>
        <p>data.</p>
        <ul class="tmo_list">
        	<li>data.</li>
            <li>data.</li>
            <li>data.</li>
            <li>data.</li>
            
		</ul>
        <div class="cleaner h20"></div>
        <h3>Management Team</h3>
		<p>data.</p>
        <div class="cleaner"></div>
        <blockquote>data.
        </blockquote>
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
</body>
</html>