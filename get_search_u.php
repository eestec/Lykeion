<?php
@session_start();
require_once 'database.php';
if($_SESSION['loged']=='true'){
$db= new database();
$db->open_connection();
$q = strtolower($_GET["q"]);
if (!$q) return;
//Name of university
$sql = "select Name_of_University from universitys where Name_of_University LIKE '%$q%' or Name_of_Faculty LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['Name_of_University'];
	echo "$cname\n";
}
}
?>
