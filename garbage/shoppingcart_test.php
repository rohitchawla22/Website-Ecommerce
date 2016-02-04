<?php

	function get_product_name($prodid){
		$result=mysql_query("select Name from product where Prodid=$prodid");
		$row=mysql_fetch_array($result);
		return $row['Name'];
	}
	function get_price($prodid){
		$result=mysql_query("select Price from product where Prodid=$prodid");
		$row=mysql_fetch_array($result);
		return $row['Price'];
	}
	function remove_product($prodid){
		$prodid=intval($prodid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($prodid==$_SESSION['cart'][$i]['Prodid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$prodid=$_SESSION['cart'][$i]['Prodid'];
			$q=$_SESSION['cart'][$i]['Quantity'];
			$price=get_price($prodid);
			$sum+=$price*$q;
		}
		return $sum;
	}
	function addtocart($prodid,$q){
		if($prodid<1 || $q<1) { return;}
		else
		if(is_array($_SESSION['cart'])){
			if(product_exists($prodid)) return;
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['Prodid']=$prodid;
			$_SESSION['cart'][$max]['Quantity']=$q;
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['Prodid']=$prodid;
			$_SESSION['cart'][0]['Quantity']=$q; 
		}
	}
	function product_exists($prodid){
		$prodid=intval($prodid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($prodid==$_SESSION['cart'][$i]['Prodid']){
				$flag=1;
				break;
			}
		}
		return $flag;
	}


?>
<?php require_once('Connections/connect.php'); ?>
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

$colname_Recordset1 = "-1";
if (isset($_GET['Type'])) {
  $colname_Recordset1 = $_GET['Type'];
}
mysql_select_db($database_connect, $connect);
$query_Recordset1 = sprintf("SELECT * FROM product WHERE Type LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $connect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
	
	echo 'hello';
	/*if($_REQUEST['command']=='delete' && $_REQUEST['Prodid']>0){
		remove_product($_REQUEST['Prodid']);
	}
	else if($_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
	}
	else if($_REQUEST['command']=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$prodid=$_SESSION['cart'][$i]['Prodid'];
			$q=intval($_REQUEST['product'.$prodid]);
			if($q>0 && $q<=999){
				$_SESSION['cart'][$i]['Quantity']=$q;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
			}
		}
	}*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<script language="javascript">
	function del(prodid){
		if(confirm('Do you really mean to delete this item')){
			document.form1.prodid.value=prodid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}


</script>
</head>

<body>
<form name="form1" method="post">
<input type="hidden" name="prodid" />
<input type="hidden" name="command" />
	<div style="margin:0px auto; width:600px;" >
    <div style="padding-bottom:10px">
    	<h1 align="center">Your Shopping Cart</h1>
    <input type="button" value="Continue Shopping" onclick="window.location='producttest.php'" />
    </div>
    	<div style="color:#F00"><? $msg?></div>
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
    	<?php
			/*if(is_array($_SESSION['cart'])){
            	echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td>Image</td><td>Prodid</td><td>Name</td><td>Price</td><td>Quantity</td><td>Amount</td><td>Options</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$prodid=$_SESSION['cart'][$i]['Prodid'];
					$q=$_SESSION['cart'][$i]['Quantity'];
					$pname=get_product_name($prodid);
					if($q==0) continue;*/
			?>
            		<tr bgcolor="#FFFFFF"><td><? $i+1?></td><td><? $pname ?></td>
                    <td>$ <? get_price($prodid)?></td>
                    <td><input type="text" name="product<? $prodid?>" value="<? $q ?>" maxlength="3" size="2" /></td>                    
                    <td>$ <? get_price($prodid)*$q ?></td>
                    <td><a href="javascript:del(<? $prodid ?>)">Remove</a></td></tr>
            <?					
				}
			?>
				<tr><td><b>Order Total: $<? get_order_total() ?></b></td><td colspan="5" align="right"><input type="button" value="Clear Cart" onclick="clear_cart()"><input type="button" value="Update Cart" onclick="update_cart()"><input type="button" value="Place Order" onclick="window.location='billing.php'"></td></tr>
			<?
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td>";
			}
		?>
        </table>
    </div>
</form>
</body>
</html>