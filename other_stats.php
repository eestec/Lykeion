<?php
require_once 'database.php';

$db= new database();
$db->open_connection();

echo "<h4>Gender:</h4>";

$s="SELECT count( * ) as broj FROM students where Gender = 'M'";
$r=mysql_query($s);
while($row=  mysql_fetch_array($r)){
	echo "Male: ".$row['broj']."<br/>";
}

$s="SELECT count( * ) as broj FROM students where Gender = 'F'";
$r=mysql_query($s);
while($row=  mysql_fetch_array($r)){
	echo "Female: ".$row['broj']."<br/>";
}

echo "<h4>Education Level:</h4>";

$s="SELECT e.EDULEVEL as edulevel FROM students s, education e where s.ID = e.student_id";
$r=mysql_query($s);
$bachelor = 0;
$master = 0;
$phd = 0;
$highSchool = 0;
while($row=  mysql_fetch_array($r)){
	$edulevel = strtolower($row['edulevel']);
	if (strpos($edulevel, "bachelor") !== false) $bachelor++;			// contains word bachelor in level of education
	else if (strpos($edulevel, "bsc") !== false) $bachelor++;
	if (strpos($edulevel, "master") !== false) $master++;
	else if (strpos($edulevel, "msc") !== false) $master++;
	if (strpos($edulevel, "phd") !== false) $phd++;
	if (strpos($edulevel, "high school") !== false) $highSchool++;
}
echo "Bachelors: " . $bachelor . "<br/>";
echo "Masters: " . $master . "<br/>";
echo "PhD: " . $phd . "<br/>";
echo "High School: " . $highSchool;



echo "<h4>Education Field:</h4>";

$s="SELECT e.EDU_FIELD as edufield FROM students s, education e where s.ID = e.student_id";
$r=mysql_query($s);
$computerScience = 0;
$automatic = 0;
$electronics = 0;
$telecommunication = 0;
$power = 0;
$electrical = 0;
$civil = 0;
$mechanical = 0;
$chemical = 0;

while($row=  mysql_fetch_array($r)){
	$edufield = strtolower($row['edufield']);
	if (strpos($edufield, "computer science") !== false) $computerScience++;
	else if (strpos($edufield, "computer engineering") !== false) $computerScience++;
	else if (strpos($edufield, "information technology") !== false) $computerScience++;
	else if (strpos($edufield, "ict") !== false) $computerScience++;
	else if (strpos($edufield, "informatics") !== false) $computerScience++;
	if (strpos($edufield, "automatic control") !== false) $automatic++;	
	if (strpos($edufield, "electronic") !== false) $electronics++;	
	if (strpos($edufield, "telecommunication") !== false) $telecommunication++;	
	if (strpos($edufield, "power") !== false) $power++;
	if (strpos($edufield, "electrical") !== false) $electrical++;
	if (strpos($edufield, "civil") !== false) $civil++;
	if (strpos($edufield, "mechanical") !== false) $mechanical++;
	if (strpos($edufield, "chemical") !== false) $chemical++;
}

echo "Computer Science/IT: " . $computerScience . "<br/>";
echo "Automatic control: " . $automatic . "<br/>";
echo "Electronics: " . $electronics . "<br/>";
echo "Telecommunications: " . $telecommunication . "<br/>";
echo "Power engineering: " . $power . "<br/>";
echo "Electrical engineering: " . $electrical . "<br/>";
echo "Civil engineering: " . $civil . "<br/>";
echo "Mechanical engineering: " . $mechanical . "<br/>";
echo "Chemical engineering: " . $chemical . "<br/>";

?>