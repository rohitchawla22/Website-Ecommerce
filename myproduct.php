<?php require_once('Connections/connect.php'); ?><?php
//check to see the url variable is set and it exists in the database
if(isset($_GET['Prodid'])){
	include "Connections/connect.php";
	$Prodid = preg_replace('#[^0-9]#i','',$_GET['Prodid']);
	//this var is used to check if Id exists,if yes then get the product detail else exit the script
	$connect1 = oci_connect($username_connect, $password_connect, $database_connect);
	$sql = oci_parse($connect1,"SELECT * FROM product WHERE Prodid = '$Prodid' LIMIT 5");
	oci_execute($sql);
	$productCount = oci_num_rows($sql);//count the output amount
if($productCount>0){
	//get all the prdoucdetails
	while($row = oci_fetch_array($sql)){
		
		$product_name=$row["Name"];
		$price = $row["Price"];
		$details = $row["Description"];
		$category = $row["Type"];
		//$date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
	
	}
}else {
	echo "that item does no exist";
	exit();
}
}else {
	echo "Data to render this page is missing";
	exit();
}
oci_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $product_name; ?></title>
</head>

<body>
<div id="centre" id="mainwrapper">
<div id="content">
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr>
<td width="20" valign="top"><img src="images/gallery/<?php echo $Prodid;?>.jpg" width="142" height="188" alt="<?php echo $product_name;?>" /><br/>
<a href="images/gallery/<?php echo $Prodid;?>.jpg">View full size image</a></td>
<td width="80%" valign="top"><h3><?php echo $product_name;?></h3>
<p><?php echo $price; ?><br/>
<br/>
<?php echo $category; ?><br/>
<br/>
<?php echo $details; ?>
<br/>
</p>
<p>ADD to Cart<br/>
</p></td>
</tr>
</table>
</div>
</div>
</body>
</html>