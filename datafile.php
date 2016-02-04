<?php require_once('Connections/connect.php'); ?>
<?php
$nm1=$_GET['nm'];
if($nm1 == null)
{}
else
{
//mysql_connect("localhost","root","");
//mysql_select_db("emall");
$res=oci_parse($connect,"SELECT * FROM product WHERE Name like ('$nm1%')");
echo "<table>";
while($row=oci_fetch_array($res))
{
	echo "<tr>";
	echo "<td>";
	echo $row['Name'];
	echo "</td>";
	echo "</tr>";
}
echo "</table>";
}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>