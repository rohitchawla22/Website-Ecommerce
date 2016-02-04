<?php require_once('Connections/connect.php'); ?>
<?php $j=0; ?>
<?php
			session_start();
			if(isset($_SESSION['MM_Username1']))
			{?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO product (Name, prod_image, Type, Prodid, `Manufacturing Company`, `Mfd Date`, Quantity, Colour, `Description`, Price, Discount, New_Price) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['textfield1'], "text"),
                       GetSQLValueString($_POST['textfield2'], "text"),
                       GetSQLValueString($_POST['textfield3'], "text"),
                       GetSQLValueString($_POST['textfield4'], "int"),
                       GetSQLValueString($_POST['textfield5'], "text"),
                       GetSQLValueString($_POST['textfield6'], "date"),
                       GetSQLValueString($_POST['textfield7'], "int"),
                       GetSQLValueString($_POST['textfield8'], "text"),
                       GetSQLValueString($_POST['textfield9'], "text"),
                       GetSQLValueString($_POST['textfield10'], "double"),
                       GetSQLValueString($_POST['textfield11'], "double"),
                       GetSQLValueString($_POST['textfield12'], "double"));

  //mysql_select_db($database_connect, $connect);
  $connect1 = oci_connect($username_connect, $password_connect, $database_connect);
  $Result1 = oci_parse($connect1,$insertSQL);
  oci_execute($Result1);
}
?>
<?php
//mysql_select_db($database_connect, $connect);
$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
$sql1 = oci_parse($connect1,"SELECT * FROM product ORDER BY qtysold DESC");
oci_execute($sql1);
$dyn_table1 ='<tr>';
While($j<3&& $row = oci_fetch_assoc($sql1)){
	$Name1 = $row["Name"];
	$Type1 = $row["Type"];
	$image1 = $row["prod_image"];
	$Prodid = $row["Prodid"];
		
	{	
		$dyn_table1 .='<p><td><tr><tr><br><strong>'.$Name1.'</strong></tr>';
		$dyn_table1 .='<br><strong>'.$Type1.'</strong><br>';
		$dyn_table1 .='<img src="'.$image1.'" width = "50", height = "50"/><br>';
		$dyn_table1 .='<a href="productdetail.php?Prodid='.$Prodid.'"><img src="images/templatemo_detail.png"></a>';
		$dyn_table1 .='<form name="formx" id="formx" method="post" action="cart.php"><input type="hidden" name="Prodid" id="Prodid" value="'.$Prodid.'" />
<input type="image" src="images/templatemo_addtocart.png" name="add to cart"  /></form></td></p><p>&nbsp;</p>';
	}
	$j++;

}
$dyn_table1 .='</tr></table>';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Best Buy Copy! | Add Products</title>
<meta name="keywords" content="shopping store, e-mall, ecommerce, online shop" />
<meta name="description" content="E-mall is an online shopping store that provides the most trendy clothes at the lowest prices " />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="temp.css" type="text/css" rel="stylesheet" />
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

<script src="jquery.js" type="text/javascript"></script>
<title>Best Buy Copy! | Add Products</title>


</head>

<body>
<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1>Best Buy Copy!</h1><br><h5>The online Shopping Store</h5></div>
      <div id="header_right">
       	<p>
        <label style="font-size:20px" style="font-style:italic">
        	   <?php 
			 echo "Welcome Admin ".$_SESSION['MM_Username1']." !<br>";?>
        	   </label>
          <a href="admin_acc.php">My Account</a> | <a href="popularproducts.php">Popular products</a> | <a href="query.php">queries</a> | <a href="user_db.php">user database</a> | <a href="logout.php">Sign out</a> </p>
          
      </div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="addproducts.php" class="selected">Add Products</a></li>
              <li><a href="orders.php">orders</a>
                    
                </li>
              <li><a href="inventory.php">Store Inventory</a>
                    
                </li>
              <li></li>
              
              
            </ul>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
          <form name="form" method="POST">
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
                    	<li class="first"><a href="dynamicproduct.php?type=Music">Music</a></li>
                        <li><a href="dynamicproduct.php?type=Movies">Movies</a></li>
                        <li><a href="dynamicproduct.php?type=Laptops">Laptops</a></li>
                        <li><a href="dynamicproduct.php?type=Games">Games</a></li>
                        <li><a href="dynamicproduct.php?type=Pen_Drives">Pen-Drives</a></li>
                        <li><a href="dynamicproduct.php?type=Softwares">Softwares</a></li>
                       <!-- <li><a href="dynamicproduct.php?type=wjewel">Jewellery</a></li>
                        <li><a href="dynamicproduct.php?type=watches">Watches</a></li>
                        <li><a href="dynamicproduct.php?type=whandbags">Handbags</a></li>
                        <li><a href="dynamicproduct.php?type=wtravelbags">TravelBags</a></li>
                        <li><a href="dynamicproduct.php?type=sportswear">Sportswear</a></li>
                        <li><a href="dynamicproduct.php?type=sheets">Sheets</a></li>
                        <li><a href="dynamicproduct.php?type=tiles">Tiles</a></li>
                        <li><a href="dynamicproduct.php?type=gadgets">gadgets</a></li>
                        <li class="last"><a href="dynamicproduct.php?type=accessories">Accessories</a></li>-->
                    </ul>
                </div>
            </div>
          <div class="sidebar_box"><span class="bottom"></span>
            	<h3><a class="sidebar_box_icon" title="image" rel="nofollow" target="_blank"><img src="images/templatemo_sidebar_header.png" alt="image" title="image" /></a>Bestsellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	<?php echo $dyn_table1; ?>
                        <div class="cleaner"></div>
                    </div>
                </div>
            </div>
        </div>
      <div id="content" class="float_r">
        	
            
       	<h1>Add New Products</h1>
        
       	<p>&nbsp;</p>
        
        <table width="396" border="1">
          <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
          <tr>
            <th scope="row">Product Name</th>
            <td>
              <input type="text" name="textfield1" id="textfield1">
            </td>
          </tr>
          <tr>
            <th scope="row">Product Image</th>
            <td><input type="text" name="textfield2" id="textfield2"></td>
          </tr>
          <tr>
            <th scope="row">Product Type</th>
            <td><input type="text" name="textfield3" id="textfield3"></td>
          </tr>
          <tr>
            <th scope="row">Product Id</th>
            <td><input type="text" name="textfield4" id="textfield4"></td>
          </tr>
          <tr>
            <th scope="row">Manufacturing Company</th>
            <td><input type="text" name="textfield5" id="textfield5"></td>
          </tr>
          <tr>
            <th scope="row">Mfd Date</th>
            <td><input type="text" name="textfield6" id="textfield6"></td>
          </tr>
          <tr>
            <th scope="row">Quantity</th>
            <td><input type="text" name="textfield7" id="textfield7"></td>
          </tr>
          <tr>
            <th scope="row">Colour</th>
            <td><input type="text" name="textfield8" id="textfield8"></td>
          </tr>
          <tr>
            <th scope="row">Description</th>
            <td><input type="text" name="textfield9" id="textfield9"></td>
          </tr>
          <tr>
            <th scope="row">Price</th>
            <td><input type="text" name="textfield10" id="textfield10"></td>
          </tr>
          <tr>
            <th scope="row">Discount</th>
            <td><input type="text" name="textfield11" id="textfield11"></td>
          </tr>
          <tr>
            <th scope="row">New Price</th>
            <td><input type="text" name="textfield12" id="textfield12"></td>
          </tr>
          <tr>
            <th scope="row">&nbsp;</th>
            <td>
              <input type="submit" name="button" id="button" value="Submit">
              <input type="hidden" name="MM_insert" value="form1">
            </form></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="#">Home</a> | <a href="#">Products</a> | <a href="#">About</a> | <a href="#">FAQs</a> | <a href="#">Checkout</a> | <a href="#">Contact Us</a>
		</p>

    	Copyright © 2015 <a href="#">Your Company Name</a> | <a href="http://www.templatemo.com/preview/templatemo_367_shoes">Shoes Theme</a> by <a href="http://www.templatemo.com" target="_parent" title="free css templates">templatemo</a>
         <div class="pins">
									<a href="#"><img src="images/pin_1.png"></a>
									<a href="#"><img src="images/pin_2.png"></a>
									<a href="#"><img src="images/pin_3.png"></a>
									<a href="#"><img src="images/pin_4.png"></a>
	  </div>
    </div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->

<?php }
			else
			{
			echo "you are not logged in";

			}?>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>
<