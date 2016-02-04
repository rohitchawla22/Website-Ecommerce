<?php
# FileName="Connection_php_mysql.php"
# Type="Oracle"
# HTTP="true"
$hostname_connect = "oracle.cise.ufl.edu";
$database_connect = "oracle.cise.ufl.edu/ORCL";
$username_connect = "ggarg";
$password_connect = "AnkurGarg2008";
$connect = oci_connect($username_connect, $password_connect, $database_connect);
if (!$connect) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


$aname = $_POST['aname'];
$adetails = $_POST['adetails'];
$aphoto = addslashes (file_get_contents($_FILES['aphoto']['tmp_name']));
$image = getimagesize($_FILES['aphoto']['tmp_name']);

//$q = ;

$r = oci_parse($connect,"INSERT INTO products VALUES('','$aname','$adetails','$aphoto','$image['mime']')");
oci_execute($r);
if($r)
echo "information store successfully";
}
else
{
echo "error";
}




?>