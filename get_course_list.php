<?php
@session_start();
if($_SESSION['loged']=='true'){
require_once 'database.php';
$db= new database();
$db->open_connection();
$q = strtolower($_GET["q"]);
if (!$q) return;
//Students
$number=0;
$sql = "select Username, Name, Surname from users where Name LIKE '%$q%' or Surname LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$number++;
	$cname = $rs['Username']." '".$rs['Name']." ".$rs['Surname']."'";
	echo "$cname\n";
}
//Universities
$sql = "select Username, Name_of_University, Name_of_Faculty from universitys where Name_of_University LIKE '%$q%' or Name_of_Faculty LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$number++;
	$cname = $rs['Username']." '".$rs['Name_of_University']." ".$rs['Name_of_Faculty']."'";
	echo "$cname\n";
}
//Copmanies
$sql = "select Username, Name from companys where Name LIKE '%$q%' or Username LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$number++;
	$cname = $rs['Username']." '".$rs['Name']."'";
	echo "$cname\n";
}
if($number==0){
	echo "There is no user with typed letters\n";
}
}
?>