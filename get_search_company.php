<?php
@session_start();
if($_SESSION['loged']=='true'){
require_once 'database.php';
$db= new database();
$db->open_connection();
$q = strtolower($_GET["q"]);
if (!$q) return;
//Name of Company
$sql = "select Name from companys where Name LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['Name'];
	echo "$cname\n";
}
}
?>
