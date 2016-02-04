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

?>