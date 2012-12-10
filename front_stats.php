<?php
require_once 'database.php';

$db= new database();
$db->open_connection();
$s="SELECT count( * ) as broj FROM students";
$r=mysql_query($s);
while($row=  mysql_fetch_array($r)){
	echo "<h6><div class=\"stattitle\">Students:</div>".$row['broj']."</h6>";
}

$s="SELECT count( * ) as broj FROM companys WHERE Status='Active' and Date_of_expire >= curdate()";
$r=mysql_query($s);
while($row=  mysql_fetch_array($r)){
	echo "<h6><div class=\"stattitle\">Companies:</div>".$row['broj']."</h6>";
}

$s="SELECT count( * ) as broj FROM universitys  WHERE Status='Active' and Date_of_expire >= curdate()";
$r=mysql_query($s);
while($row=  mysql_fetch_array($r)){
	echo "<h6><div class=\"stattitle\">Universities:</div>".$row['broj']."</h6>";
}

$s="SELECT count( * ) as broj FROM articles  WHERE jobtype!='-1' and Status='Active'";
$r=mysql_query($s);
while($row=  mysql_fetch_array($r)){
	echo "<h6><div class=\"stattitle\">Jobs:</div>".$row['broj']."</h6>";
}

$s="SELECT count( * ) as broj FROM articles  WHERE scolarship!='-1' and Status='Active'";
$r=mysql_query($s);
while($row=  mysql_fetch_array($r)){
	echo "<h6><div class=\"stattitle\">Scholarships:</div>".$row['broj']."</h6>";
}

$s="SELECT count( * ) as broj FROM articles  WHERE Status='Active'";
$r=mysql_query($s);
while($row=  mysql_fetch_array($r)){
	echo "<h6><div class=\"stattitle\">Articles:</div>".$row['broj']."</h6>";
}

?>
