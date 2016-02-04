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
$query_Recordset1 = sprintf("SELECT * FROM product1 WHERE Type LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
$Recordset1 = mysql_query($query_Recordset1, $connect) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<script>
<?php $i=0;$j=0?>
function func()
{
	Window.location.assign('gridbox.php');
	if(i!=0 && i%9==0)
	{$j=$i;} 
}

<?php require_once('Connections/connect.php'); ?>
<?php 
//mysql_select_db($database_connect, $connect);
$sql = oci_parse($connect,"SELECT Name,Type,prod_image FROM product1 ORDER BY Prodid ");
oci_execute($sql);
$dyn_table ='<table border="1" cellpadding="10"><tr>';
While($row = oci_fetch_assoc($sql)){
	$Name = $row["Name"];
	$Type = $row["Type"];
	$image=$row["prod_image"];
	
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
</script>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<link href="style.css" rel="stylesheet" type="text/css" />
<body>
<h3>Dynamic PHP grid layout</h3>

<p>
<div class="product_box">
<?php echo $dyn_table;?>

<form name="form1" method="post" action="">
  <input type="submit" name="button" id="button" value="&gt;&gt;NEXT" onClick="func()">
  <input type="submit" name="button2" id="button2" value="&lt;&lt;PREVIOUS" onClick="func1()">
</form>
</div>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>&nbsp;</p>
</body>
</html>
<?php
oci_free_result($Recordset1);
?>
