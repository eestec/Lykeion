<?php
@session_start();
if($_SESSION['loged']=='true'){
require_once 'database.php';
$db= new database();
$db->open_connection();
$q = strtolower($_GET["q"]);
if (!$q) return;
//Article topic
$sql = "select title from articles where title LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['title'];
	echo "$cname\n";
}
}
?>
