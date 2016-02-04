<?php require_once('Connections/connect.php'); ?>
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

$sql1 = oci_parse($connect,"SELECT * FROM product ORDER BY qtysold DESC");
oci_execute($sql1);
$dyn_table1 ='<tr>';
While($j<5&& $row = oci_fetch_assoc($sql1)){
	$Name1 = $row["Name"];
	$Type1 = $row["Type"];
	$image1 = $row["prod_image"];
	$price1 = $row["New_Price"];
	$prodid = $row["Prodid"];	
	{	
		$dyn_table1 .='<p><td><tr><tr><br>'.$Name1.'</tr>';
		$dyn_table1 .='<br>'.$Type1.'<br>';
		$dyn_table1 .='<img src="'.$image1.'" width = 100, height = 100/><br>';
		$dyn_table1 .='<a href="productdetail.php?Prodid='.$prodid.'"><img src="images/templatemo_detail.png"></a>';
		$dyn_table1 .='<img src="images/templatemo_addtocart.png"></td></p><br><br><br><br><br>';
	}
	$j++;

}
$dyn_table1 .='</tr></table>';
?>


<?php 
//mysql_select_db($database_connect, $connect);

$sql = oci_parse($connect,"SELECT * FROM product ORDER BY Prodid DESC ");
oci_execute($sql);
$dyn_table ='<table border="0" cellpadding="10"><tr>';

While($i<3 && $row = oci_fetch_assoc($sql)){
	
	$Name = $row["Name"];
	$Type = $row["Type"];
	$image=$row["prod_image"];
	$Prodid = $row["Prodid"];
	
	if($i%3==0){
		$dyn_table .='</tr><tr>';
		/*$dyn_table .='<td>'.$Name;
		$dyn_table .='<br>'.$Type.'<br>';
		$dyn_table .='<img src="'.$image.'" width = 200, height = 200/></td>';
*/
		
	}//else {
		
		$dyn_table .='<td>'.$Name;
		$dyn_table .='<br>'.$Type.'<br>';
		$dyn_table .='<img src="'.$image.'" width = "150", height ="200"/>';
		$dyn_table.='<br><img src="images/templatemo_addtocart.png" >';
		$dyn_table.='<a href = "productdetail?Prodid='.$Prodid.'"><img src="images/templatemo_detail.png"></a></td>';

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
<title>BAZZINGA | User Profile</title>
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

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>changed BAZZINGA</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
          <a href="myaccount.php">My Account</a> | <a href="wishlist.php">My Wishlist</a> | <a href="cart.php">My Cart</a> | <a href="checkout.php">Checkout</a> | <a href="logout.php">Log Out</a></p>
          <p>
           	  Shopping Cart: <strong></strong> ( <a href="cart.php">Show Cart</a> )
        </p>
        </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="info.php" class="selected">Info</a></li>
                <li><a href="acchistory.php">Account history</a></li>
                <li><a href="query_rep1.php">Query Replies</a></li>
                
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form action="#" method="get">
              <input type="text" value=" " name="keyword" id="keyword" title="keyword" onFocus="clearText(this)" onBlur="clearText(this)" class="txt_field" />
              <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
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
       	  <p>&nbsp;</p>
       	  <p>&nbsp;</p>
       	  <div class="sidebar_box"><span class="bottom"></span>
           	

<h3>Profile Picture</h3>
            <div class="profile_pic">
            
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
        	   <?php
			session_start();
			if(isset($_SESSION['MM_Username']))
			{?>
        	   <label style="font-size:36px" style="font-style:italic">
        	   <?php 
			 echo "Welcome  ".$_SESSION['MM_Username']."<br>";?>
        	   </label>
        </p>
       	    <p>&nbsp;</p>
   	    <p>&nbsp; </p>
 <?php        $m = $_SESSION['MM_Username'];
//mysql_select_db($database_connect, $connect);
$query_Recordset1 = "SELECT * FROM user_signup where Username = '$m'";
$Recordset1 = oci_parse($connect,$query_Recordset1);
oci_execute($Recordset1);
$row_Recordset1 = oci_fetch_assoc($Recordset1);
$totalRows_Recordset1 = oci_num_rows($Recordset1);
?>
        	 <table width="566" height="71" border="1">
        	  <tr>
        	    <th width="163" scope="row">My Name :</th>
        	    <td width="387"><?php echo $row_Recordset1['First Name']; ?><br /><?php echo $row_Recordset1['Last Name'];?></td>
      	    </tr>
            <tr>
        	    <th scope="row">My DOB :</th>
        	    <td><?php echo $row_Recordset1['DOB']; ?></td>
      	    </tr>
        	  <tr>
        	    <th scope="row">My Country :</th>
        	    <td><?php echo $row_Recordset1['Country']; ?></td>
      	    </tr>
        	  <tr>
        	    <th scope="row">My City :</th>
        	    <td><?php echo $row_Recordset1['City']; ?></td>
      	    </tr>
        	  
        	  <tr>
        	    <th scope="row">My Address:</th>
        	    <td><?php echo $row_Recordset1['Address']; ?></td>
      	    </tr>
            <tr>
        	    <th scope="row">My Zipcode :</th>
        	    <td><?php echo $row_Recordset1['Zipcode']; ?></td>
      	    </tr>
            <tr>
        	    <th scope="row">My Contact No :</th>
        	    <td><?php echo $row_Recordset1['Contact No']; ?></td>
      	    </tr>
        	  <tr>
        	    <th scope="row">My E-Mail ID :</th>
        	    <td><?php echo $row_Recordset1['E-Mail Id']; ?></td>
      	    </tr>
        	  
        	  
        	  <tr>
        	    <th scope="row">My Username :</th>
        	    <td><?php echo $row_Recordset1['Username']; ?></td>
      	    </tr>
        	  <tr>
        	    <th scope="row">&nbsp;</th>
        	    <td><form id="form1" name="form1" method="post" action="">
        	      <a href="editprofile.php"><img src="images/gallery/edit.png"/></a>
        	    </form></td>
      	    </tr>
          </table>	
			<?php }
			else
			{
			echo "you are not logged in";

			}?>
			
		 

       	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<h1><strong>New Products</strong></h1>
            <div class="product_box">
            <?php echo $dyn_table;?>
              </div>
            <div class="cleaner"></div> 
            
            
      </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="index.php">Home</a> | <a href="products.php">Products</a> | <a href="about.php">About</a> | <a href="faqs.html">FAQs</a> | <a href="checkout.php">Checkout</a> | <a href="contact.php">Contact Us</a>
		</p>

    	Copyright © 2015 <a href="#">BAZZINGA</a> 
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
<?php
oci_free_result($Recordset1);
?>
