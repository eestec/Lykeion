<?php
@session_start();
if($_SESSION['loged']=='true'){
require_once 'database.php';
function check($array,$str){
	$brojac=0;
	for($i=0;$i<count($array);$i++){
		if($array[$i]==$str)
			$brojac++;
	}
	if($brojac==0)
		return false;
	else
		return true;
}
$db= new database();
$db->open_connection();
@$array;
$q = strtolower($_GET["q"]);
if (!$q) return;
//Academic level
$sql = "select Academic_level from jobs_intersips where Academic_level LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['Academic_level'];
	if(check($array,$cname)==false)
		$array[]=$cname;
}

for($i=0;$i<count($array);$i++){
    echo $array[$i]."\n";
}
}
?>
