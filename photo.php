q<?php require_once('Connections/connect.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO product (Name, `prod image`, Type, Prod_Id, `Manufacturing Company`, `Mfd Date`, Quantity, Colour, `Description`, Price, Discount, `New Price`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['prod image'], "blob"),
                       GetSQLValueString($_POST['textfield'], "text"),
                       GetSQLValueString($_POST['textfield2'], "int"),
                       GetSQLValueString($_POST['textfield3'], "text"),
                       GetSQLValueString($_POST['textfield4'], "date"),
                       GetSQLValueString($_POST['textfield5'], "int"),
                       GetSQLValueString($_POST['textfield6'], "text"),
                       GetSQLValueString($_POST['textfield7'], "text"),
                       GetSQLValueString($_POST['textfield8'], "double"),
                       GetSQLValueString($_POST['textfield9'], "double"),
                       GetSQLValueString($_POST['textfield10'], "double"));

  mysql_select_db($database_connect, $connect);
  $Result1 = mysql_query($insertSQL, $connect) or die(mysql_error());

  $insertGoTo = "productlist.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<html>
<title>pic</title>
<script>
function func()
{

}
</script>
<body>
<form action="<?php echo $editFormAction; ?>" name="form" enctype="multipart/form-data" method="POST">
<table border=0 align=center bgcolor=black width=100%>
<tr><td colspan=2>&nbsp;</td></tr>
</table>
<table width="337" border=0 align=center bgcolor=grey>
<tr><td colspan=2><h2>Information</h2></td></tr>
<tr>
<td width="73"> name</td><td width="254"><input type=text name="Name"></td>
</tr>
<tr>
<td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
<td>type</td><td><input type="text" name="textfield" id="textfield"></td>
</tr>
<tr>
  <td>Prod Id</td>
  <td><input type="text" name="textfield2" id="textfield2"></td>
</tr>
<tr>
  <td>Manufacturing Company</td>
  <td><input type="text" name="textfield3" id="textfield3"></td>
</tr>
<tr>
  <td>Mfd Date</td>
  <td><input type="text" name="textfield4" id="textfield4"></td>
</tr>
<tr>
  <td>Quantity</td>
  <td><input type="text" name="textfield5" id="textfield5"></td>
</tr>
<tr>
  <td>Colour</td>
  <td><input type="text" name="textfield6" id="textfield6"></td>
</tr>
<tr>
  <td>Description</td>
  <td><input type="text" name="textfield7" id="textfield7"></td>
</tr>
<tr>
  <td>Price </td>
  <td><input type="text" name="textfield8" id="textfield8"></td>
</tr>
<tr>
  <td>Discount</td>
  <td><input type="text" name="textfield9" id="textfield9"></td>
</tr>
<tr>
  <td>New Price</td>
  <td><input type="text" name="textfield10" id="textfield10"></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td><input type=submit name="submit" value="add product" onClick="func()"></td>
</tr>
</table>
<input type="hidden" name="MM_insert" value="form">
</form>
</body>
</html>
