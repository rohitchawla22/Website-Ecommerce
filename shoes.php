<script>
function func()
{
	window.location.assign("productdetail.php")
}
</script><?php require_once('Connections/connect.php'); ?>
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

$colname_Recordset1 = "-1";
if (isset($_GET['Type'])) {
  $colname_Recordset1 = $_GET['Type'];
}
//oci_select_db($database_connect, $connect);
$query_Recordset1 = sprintf("SELECT * FROM product WHERE Type LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = oci_parse($connect,$query_Recordset1);
oci_execute($Recordset1);
$row_Recordset1 = oci_fetch_assoc($Recordset1);
$totalRows_Recordset1 = oci_num_rows($Recordset1);
?>
<script>
<?php $i=0;$j=0?>
function func()
{
	Window.location.assign('gridbox.php');
	if(i!=0 && i%9==0)
	{$j=$i;} 
}


</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Mall - Products</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />
<link href="style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />

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
    	<div id="site_title"><h1>E-Mall</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
          <a href="#">My Account</a> | <a href="#">My Wishlist</a> | <a href="#">My Cart</a> | <a href="#">Checkout</a> | <a href="#">Log In</a> | <a href="#">Sign up</a></p>
          <p>
           	  Shopping Cart: <strong>3 items</strong> ( <a href="shoppingcart.php">Show Cart</a> )
        </p>
        </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
                <li><a href="index.php" class="selected">Home</a></li>
                <li><a href="products.php">Men's Products</a>
                 <li><a href="#">ENTERTAINMENT</a>
                    <ul>
                        <li><a href="dynamicproduct.php?type=Music">Music</a></li>
                        <li><a href="dynamicproduct.php?type=Movie">Movies</a></li>
                        
                  </ul><!-- end inner ul -->
                </li>
                <li><a href="#">Hard Goods products</a>
                	<ul>
                    	<li><a href="dynamicproduct.php?type=Laptop">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=Game">Games</a></li>
                        <li><a href="dynamicproduct.php?type=Pen-Drive">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=Software">Softwares</a></li>
                         </ul>
                 </li>
                <li><a href="about.php">About</a>
                    <ul>
                        <li><a href="http://www.templatemo.com/page/1">Sub menu 1</a></li>
                        <li><a href="http://www.templatemo.com/page/2">Sub menu 2</a></li>
                        <li><a href="http://www.templatemo.com/page/3">Sub menu 3</a></li>
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
              <input type="text" value=" " name="keyword" id="keyword" title="keyword" onFocus="clearText(this)" onBlur="clearText(this)" class="txt_field" />
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
                        <li><a href="#">Movie</a></li>
                        <li><a href="#">Laptop</a></li>
                        <li><a href="#">Game</a></li>
                        <li><a href="#">Pen-Drive</a></li>
                        <li><a href="#">Software</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="image" title="image" /></a>Bestsellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title</a></h4>
                        <p class="price">Rs 0.00</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title 2</a></h4>
                        <p class="price">Rs 0.00</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title 3</a></h4>
                        <p class="price">rs0.00</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">title 5</a></h4>
                        <p class="price">Rs 0.00</p>
                        <div class="cleaner"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
mysql_select_db($database_connect, $connect);
$m = "shoes";
$sql = oci_parse($connect,"SELECT Name,Type,prod_image,Prodid,Quantity FROM product WHERE Type = 'shoes' ORDER BY Prodid ");
oci_execute($sql);

$dyn_table ='<table border="0" cellpadding="10"><tr>';
While($row = oci_fetch_assoc($sql)){
	$Name = $row["Name"];
	$Type = $row["Type"];
	$image=$row["prod_image"];
	$prodid = $row["Prodid"];
	$qty = $row["Quantity"];
	
	if($i%3==0){
		$dyn_table .='</tr><tr>';
		/*$dyn_table .='<td>'.$Name;
		$dyn_table .='<br>'.$Type.'<br>';
		$dyn_table .='<img src="'.$image.'" width = 200, height = 200/></td>';
*/
		
	}//else {
		
		$dyn_table .='<td>'.$Name;
		$dyn_table .='<br>'.$Type.'<br>';
		$dyn_table .='<img src="'.$image.'" width = 200, height = 200/>';
		$dyn_table.='<form name="form1" method="post" action="">
  <input type="submit" name="button" id="button" value="&gt;&gt;Add To cart" onClick="func()">

</form></td>';

	//}
	
	
	
	
	
	$i++;

}
$dyn_table .='</tr></table>';
?>

        <div id="content" class="float_r">
        	<h1> Music</h1>
            <div class="product_box">
			<?php echo $dyn_table;?>

<form name="form1" method="post" action="">
  <input type="submit" name="button" id="button" value="&gt;&gt;NEXT" onClick="func()">
  <input type="submit" name="button2" id="button2" value="&lt;&lt;PREVIOUS" onClick="func1()">
</form>
        	</div>
                 
            
            <div class="cleaner"></div>
               	
                        
            <div class="cleaner"></div>
                 	
                    	
             
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="#">Home</a> | <a href="#">Products</a> | <a href="#">About</a> | <a href="#">FAQs</a> | <a href="#">Checkout</a> | <a href="#">Contact Us</a>
		</p>


    	Copyright © 2015 <a href="#">E-Mall</a>
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