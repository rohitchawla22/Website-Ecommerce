<?php
$j=1;$i=0;
?>
<?php require_once('Connections/connect.php'); ?>
<?php
			session_start();
			if(isset($_SESSION['MM_Username1']))
			{?>
<?php
//mysql_select_db($database_connect, $connect);

$sql1 = oci_parse($connect,"SELECT * FROM query");
oci_execute($sql1);
$dyn_table1 ='<tr>';
While($row = oci_fetch_assoc($sql1)){
	
	$Name1 = $row["name"];
	$Type1 = $row["email_id"];
	$id = $row["contact_no"];
	
	$mc = $row["message"];
	{	
		$dyn_table1 .='<tr>';
		$dyn_table1 .='<td>'.$j.'</td>';
		$dyn_table1 .='<td>'.$Name1.'</td>';
		$dyn_table1 .='<td>'.$Type1.'</td>';
		$dyn_table1 .='<td>'.$id.'</td>';
		$dyn_table1 .='<td>'.$mc.'</td>';
		
		$dyn_table1 .='<td><a href="query_rep.php?name='.$Name1.'">Respond to Query</a></td>';
		$dyn_table1 .='</tr>';
	}
	$j++;

}
$dyn_table1 .='</table>';

?>
<?php
//mysql_select_db($database_connect, $connect);

$sql2 = oci_parse($connect,"SELECT * FROM product");
oci_execute($sql2);

$dyn_table2 ='<tr>';
While($row = oci_fetch_assoc($sql2)){
	
	
	$mc1 = $row["Manufacturing Company"];
	{	
		$dyn_table2 .='<tr>';
		$dyn_table2 .='<td>'.$mc1.'</td>';
		$dyn_table2 .='</tr>';
	}
	$i++;

}
$dyn_table2 .='</table>';

?>
<?php
						//mysql_select_db($database_connect, $connect);

						$sql2 = oci_parse($connect,"SELECT * FROM product ORDER BY qtysold DESC LIMIT 3");
						oci_execute($sql1);
						$dyn_table3 ='<tr>';
						While($row = oci_fetch_assoc($sql2)){
						$Name2 = $row["Name"];
						$Type2 = $row["Type"];
						$image2 = $row["prod_image"];
						$price2 = $row["Price"];
						$Prodid = $row["Prodid"];	
						{	
						$dyn_table3 .='<p><td><tr><tr><br>'.$Name2.'</tr>';
						$dyn_table3 .='<br>'.$Type2.'<br>';
						$dyn_table3 .='<br><img src="'.$image2.'" width = 100, height = 100/><br/>';
						$dyn_table3 .='<td><a href="productdetail.php?Prodid='.$Prodid.'"><img src="images/templatemo_detail.png" ></a>';
						$dyn_table3 .='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Prodid.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart"  /></form></td></td></tr></p><br><br><br><br><br>';
						}
	

						}
						$dyn_table3 .='</tr></table>';
						?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BAZZINGA | QUERY</title>
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
       <label style="font-size:36px" style="font-style:italic">
        	   <?php 
			 echo "Welcome Admin ".$_SESSION['MM_Username1']." !<br>";?>
        	   </label>
          <a href="admin_acc.php" >My Account</a> | <a href="popularproducts.php">Popular products</a> | <a href="queries.php">queries</a> | <a href="user_db.php">user database</a> | <a href="logout.php">Sign out</a> </p>
          
      </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
              <li><a href="profile.php" >Profile</a></li>
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
                        <li><a href="inventory_idinc.php">Id Increasing</a></li>
                        <li><a href="inventory_iddec.php">Id Decreasing</a></li>
                        <li><a href="inventory_mc1.php">Manufacturing Company</a>
                        </li>
                        <li><a href="inventory_qinc.php">Quantity increasing</a></li>
                        <li><a href="inventory_qdec.php">Quantity decreasing</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="image" title="image" /></a>Bestsellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    <?php echo $dyn_table3;?>
                    <div class="cleaner"></div>
                    </div>
                    
                </div>
            </div>
        </div>
      <div id="content" class="float_r">
        	        <div style="margin:0px; text-align: left; font-size: 14px; box-sizing: content-box; color: #000;">
  <h1>USER QUERIES!</h1>
  <table width="700" border="1" cellpadding="6">
    <tr bgcolor="#ddd">
      <th width="7%" scope="row">S.No</th>
      <td width="22%"><strong> User Name</strong></td>
      <td width="17%"><strong>E-Mail id</strong></td>
      <td width="13%"><strong>Contact No</strong></td>
      <td width="30%"><strong>Message</strong></td>
      <td width="11%"><strong>Respond</strong></td>
        
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

    	Copyright © 2013 <a href="#">BAZZINGA</a> 
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
			echo "<script>alert('You are not logged in');document.location.assign('index.php');</script>" ;} ?>
			}?>

<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>










