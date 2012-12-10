<?php
require_once 'database.php';

$db= new database();
$db->open_connection();
$sql = "SELECT u.Country, COUNT(*) as `Count` FROM `users` as u GROUP BY u.Country";
list($result,$a)=$db->query($sql);


while ($line = mysql_fetch_array($result)){
	echo $line['Country'] . " " . $line['Count'] . "<br/>";
}


?>