<?php
$j=0;$i=0;$f=1;
?>
<?php require_once('Connections/connect.php'); ?>
<?php
			session_start();
			if(isset($_SESSION['MM_Username']))
			{?>
<?php
mysql_select_db($database_connect, $connect);

$sql1 = mysql_query("SELECT * FROM product ORDER BY Prodid ASC",$connect);

$dyn_table1 ='<tr>';
While($row = mysql_fetch_assoc($sql1)){
	
	$Name1 = $row["Name"];
	$Type1 = $row["Type"];
	$id = $row["Prodid"];
	$image1 = $row["prod_image"];
	$mc = $row["Manufacturing Company"];
	$qty = $row["Quantity"];
	$color = $row["Colour"];
	$des = $row["Description"];
	$pr = $row["Price"];
	$ds= $row["Discount"];
	$qtys= $row["qtysold"];	
	{	
		$dyn_table1 .='<tr>';
		$dyn_table1 .='<td>'.$f.'</td>';
		$dyn_table1 .='<td><a href=\"productdetail.php?Prodid='.$id.'\">'.$Name1.'<br/><img src="'.$image1.'" alt="'. $Name1.'"  border="0" /></td>';
		$dyn_table1 .='<td>'.$Type1.'</td>';
		$dyn_table1 .='<td>'.$id.'</td>';
		$dyn_table1 .='<td>'.$mc.'</td>';
		$dyn_table1 .='<td>'.$qty.'</td>';
		
		$dyn_table1 .='<td>'.$des.'</td>';
		$dyn_table1 .='<td>'.$pr.'</td>';
		$dyn_table1 .='<td>'.$ds.'</td>';
		$dyn_table1 .='<td>'.$qtys.'</td>';
		$dyn_table1 .='</tr>';
	}
	$j++;$f++;

}
$dyn_table1 .='</table>';

?>
<?php
						mysql_select_db($database_connect, $connect);

						$sql2 = mysql_query("SELECT * FROM product ORDER BY qtysold DESC LIMIT 3",$connect);

						$dyn_table2 ='<tr>';
						While($row = mysql_fetch_assoc($sql2)){
						$Name2 = $row["Name"];
						$Type2 = $row["Type"];
						$image2 = $row["prod_image"];
						$price2 = $row["Price"];
						$m = $row["Prodid"];	
						{	
						$dyn_table2 .='<tr><br>'.$Name2.'</tr>';
						$dyn_table2 .='<br>'.$Type2.'<br>';
						$dyn_table2 .='<br><img src="'.$image2.'" width = 100, height = 100/><br/>';
						$dyn_table2 .='<td><a href="productdetail.php?x='.$m.'"><img src="images/templatemo_detail.png"></a></td></tr><br><br><br><br><br>';
						}
	

						}
						$dyn_table2 .='</tr></table>';
						?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bazzinga | Sort Inventory</title>
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
    	<div id="site_title"><h1>BAZZINGA</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
       <label style="font-size:36px" style="font-style:italic">
        	   <?php 
			 echo "Welcome Admin ".$_SESSION['MM_Username']." !<br>";?>
        	   </label>
          <a href="admin_acc.php" >My Account</a> | <a href="popularproducts.php">Popular products</a> | <a href="queries.php">queries</a> | <a href="user_db.php">user database</a> | <a href="logout.php">Sign out</a> </p>
          
      </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="addproducts.php">Add Products</a></li>
              <li><a href="orders.php">orders</a>
                    
                </li>
              <li><a href="inventory.php" class="selected">Store Inventory</a>
                    
                </li>
              <li></li>
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
            	<h3>SORT BY</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first">
                        <a href="inventory_type.php">Type</a></li>
                        <li><a href="inventory_idinc.php"class="selected" >Id Increasing</a></li>
                        <li><a href="inventory_iddec.php">Id Decreasing</a></li>
                        <li><a href="inventory_mc1.php">Manufacturing Company</a></li>
                        <li><a href="inventory_qinc.php">Quantity increasing</a></li>
                        <li><a href="inventory_qdec.php">Quantity decreasing</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="image" title="image" /></a>Bestsellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    <?php echo $dyn_table2;?>
                    <div class="cleaner"></div>
                    </div>
                    
                </div>
            </div>
        </div>
      <div id="content" class="float_r">
        	        <div style="margin: 0px; text-align: left; font-size: 14px; box-sizing: content-box; color: #000;">
  <h1>STORE INVENTORY</h1>
  <table width="675" border="0" cellpadding="6">
    <tr bgcolor="#ddd">
      <th width="29%" scope="row">S.NO</th>
      <th width="29%" scope="row">Product</th>
      <td width="7%"><strong>Type</strong></td>
      <td width="3%"><strong>^ID</strong></td>
      <td width="11%"><strong>Manufacturing company</strong></td>
      <td width="7%"><strong>Quantity</strong></td>
      <td width="10%"><strong>Description</strong></td>
      <td width="5%%"><strong>Price</strong></td>
      <td width="10%"><strong>Discount</strong></td>
      <td width="10%"><strong>Qty Sold</strong></td>
        
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
        <div style="float:right; width: 215px; margin-top: 20px;">
                    
		  <p><a href="addproducts.php">Add Products</a></p>
                    
                    
        </div>
       <br/>
       <br/>
            <br/>
     </div>
     
    <div class="cleaner"></div>   
    </div><!-- END of templatemo_main -->
    <div class="cleaner"></div>
    </div> <!-- END of templatemo_wrapper -->
    <div id="templatemo_footer">
    	<p><a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="about.php">About</a> | <a href="faqs.html">FAQs</a> | <a href="contact.php">Contact Us</a>
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
<?php }
			else
			{
			echo "you are not logged in";

			}?>

<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>










