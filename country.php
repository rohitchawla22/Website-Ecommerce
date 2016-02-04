<?php
$j=0;$i=0;
?>
<?php require_once('Connections/connect.php'); ?>
<?php
			session_start();
			if(isset($_SESSION['MM_Username1']))
			{?>

<?php
mysql_select_db($database_connect, $connect);

$sql1 = mysql_query("SELECT * FROM user_signup GROUP BY Country",$connect);

$dyn_table1 ='<tr>';
While($row = mysql_fetch_assoc($sql1)){
	
	$Name1 = $row["First Name"];
	$Name2 = $row["Last Name"];
	$country = $row["Country"];
	$city = $row["City"];
	$address = $row["Address"];
	$cn = $row["Contact No"];
	$eid= $row["E-Mail Id"];
	$un= $row["Username"];
	$image1 = $row["picture"];
	$uid= $row["user id"];
		
	{	
		$dyn_table1 .='<tr>';
		$dyn_table1 .='<td>'.$j.'</td>';
		$dyn_table1 .='<td>'.$Name1 .''.$Name2.'<br/><img src="'.$image1.'" alt="'. $Name1.'" width ="70", height = "100" border="0" /></td>';
		$dyn_table1 .='<td>'.$country.'</td>';
		$dyn_table1 .='<td>'.$city.'</td>';
		$dyn_table1 .='<td>'.$address.'</td>';
		$dyn_table1 .='<td>'.$cn.'</td>';
		
		$dyn_table1 .='<td>'.$eid.'</td>';
		$dyn_table1 .='<td>'.$un.'</td>';
		$dyn_table1 .='</tr>';
	}
	$j++;

}
$dyn_table1 .='</table>';

?>
<?php
mysql_select_db($database_connect, $connect);

$sql3 = mysql_query("SELECT * FROM user_signup",$connect);

$dyn_table3 ='<tr>';
While($row = mysql_fetch_assoc($sql3)){
	
	
	$mc1 = $row["Country"];
	{	
		$dyn_table3 .='<tr>';
		$dyn_table3 .='<td>=>'.$mc1.'</td><br>';
		$dyn_table3 .='</tr>';
	}
	$i++;

}
$dyn_table3 .='</table>';

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
						$Prodid = $row["Prodid"];
						{	
						$dyn_table2 .='<p><td><tr><tr><br>'.$Name2.'</tr>';
						$dyn_table2 .='<br>'.$Type2.'<br>';
						$dyn_table2 .='<br><img src="'.$image2.'" width = 100, height = 100/><br/>';
						$dyn_table2 .='<td><a href="productdetail.php?Prodid='.$Prodid.'"><img src="images/templatemo_detail.png" ></a>';
						$dyn_table2 .='<img src="images/templatemo_addtocart.png" ></td></td></tr></p><br><br><br><br><br>';
						}
	

						}
						$dyn_table2 .='</tr></table>';
						?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BAZZINGA | Inventory</title>
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
			 echo "Welcome Admin ".$_SESSION['MM_Username1']." !<br>";?>
        	   </label>
          <a href="admin_acc.php" >My Account</a> | <a href="popularproducts.php">Popular products</a> | <a href="queries.php">queries</a> | <a href="user_db.php" class="">user database</a> | <a href="logout.php">Sign out</a> </p>
          
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
              <form action="search3.php" method="post">
<input type="text" name="search" placeholder="search for products" />
<input type="submit" value="search" />
</form>
        </div>
    </div> <!-- END of templatemo_menubar -->
    
    <div id="templatemo_main">
    	<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3>SORT BY</h3>   
                <div class="content">
                  <ul class="sidebar_list">
                  <li><a href="newuser.php">New Users</a></li>
                      <li><a href="Olduser.php">Oldest Users</a></li>
                      <li><a href="country.php">Country</a>
                      <ul>
                      <li><?php echo $dyn_table3;?></li>
                      </ul></li>
                      <li><a href="city.php">City</a></li>
                        
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
  <h1>USER DATABASE</h1>
  <table width="657" border="0" cellpadding="6">
    <tr bgcolor="#ddd">
      <th width="33" scope="row"><strong>S.No</strong></th>
      <td width="87" align="left"><strong>User</strong></td>
      <td width="57"><strong>Country</strong></td>
      <td width="27"><strong>City</strong></td>
      <td width="113"><strong>Address</strong></td>
      <td width="60"><strong>Contact No</strong></td>
      <td width="105"><strong>E-Mail Id</strong></td>
      <td width="79"><strong>Username</strong></td>
        
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










