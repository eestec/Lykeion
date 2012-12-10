<?php
require_once 'database.php';
$in=0;
if(@$_POST['send']){
    $in++;
    $satisfied=$_POST['satisfied'];
    $update=$_POST['update'];
    $addchange=$_POST['addchange'];
    if($addchange=="other") $addchange=$_POST['addchange2'];
    $like=$_POST['like'];
    $keep=$_POST['keep'];
    if($like=="other") $like=$_POST['like1'];
    if($keep=="other") $keep=$_POST['keep1'];
    $general=@$_POST['general'];
    $db=new database();
    $conn=$db->open_connection();
    
    $s="INSERT INTO feedback VALUES(NULL,'%s','%s','%s','%s','%s','%s')";
    $r=mysql_query(sprintf($s,  mysql_real_escape_string($satisfied),  mysql_real_escape_string($update), mysql_real_escape_string($addchange), mysql_real_escape_string($like), mysql_real_escape_string($keep), mysql_real_escape_string($general)));
    if(!$r) echo mysql_error ();
    mysql_close($conn);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="shortcut icon" href="favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lykeion</title>
<link href="lykeion.css" rel="stylesheet" type="text/css" />
<link href="mm_messages/mm_messages_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/validacija.js"></script>

<link href="calendar.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
       function Allowwriting(bool){
           
           
           
           if(bool)
{
       document.forms['feedback'].addchange2.readOnly=false;  //true has some freedom
}
else //if(!document.formOne.fieldInfo.checked)
{
      document.forms['feedback'].addchange2.readOnly=true;  //false has some freedom
      // also tried document.formOne.fieldtextarea.focus(); 
}
           
       }   
       function Allowwriting1(bool){
           
           
           
           if(bool)
{
       document.forms['feedback'].like1.readOnly=false;  //true has some freedom
}
else //if(!document.formOne.fieldInfo.checked)
{
      document.forms['feedback'].like1.readOnly=true;  //false has some freedom
      // also tried document.formOne.fieldtextarea.focus(); 
}
           
       }   
       function Allowwriting2(bool){
           
           
           
           if(bool)
{
       document.forms['feedback'].keep1.readOnly=false;  //true has some freedom
}
else //if(!document.formOne.fieldInfo.checked)
{
      document.forms['feedback'].keep1.readOnly=true;  //false has some freedom
      // also tried document.formOne.fieldtextarea.focus(); 
}
           
       }   
       </script>
<style type="text/css">
<!--
body {
	margin-top: 0px;
	margin-bottom: 0px;
}
-->
</style>
<script type="text/javascript">
function errorhide(){
				$("#error_message").hide();
}

</script>
</head>
    
    <body>
<div align="center">
	<div id="main_container">
		
        <div id="header_container">
        	<img src="images/header_menu.jpg" border="0" usemap="#Map2">
            <img src="images/header_main.jpg"  border="0" usemap="#Map">        
            <img src="images/header_down.jpg">        
        </div>
            
        <div id="central_container"><div id="nesto"></div>
    <div align="left" style="margin-left:50px;">
        <center>
            
            <?php
            if($in==0){
                
            ?>
            
            <form id="feedback" name="feedback" action="feedback.php" method="post">
                <table border="0">
                    <tr><td><h3>Are you satisfied with the content of the website?</h3></td></tr>
                    <tr><td><input type="radio" name="satisfied" value="Yes" checked="checked">Yes</td></tr>
                    <tr><td><input type="radio" name="satisfied" value="No">No</td></tr>
                    <tr><td><input type="radio" name="satisfied" value="It could be better">It could be better</td></tr>
                    <tr><td></td></tr>
                    <tr><td><h3>Did you update your CV on Lykeion?</h3></td></tr>
                    <tr><td><input type="radio" name="update" value="Yes" checked="checked">Yes</td></tr>
                    <tr><td><input type="radio" name="update" value="No">No</td></tr>
                    <tr><td><input type="radio" name="update" value="Partially">Partially</td></tr>
                    <tr><td></td></tr>
                    <tr><td><h3>Which new options would you add to the website?</h3></td></tr>
                    <tr><td><input type="radio" name="addchange" value="Forum" checked="checked" onclick="Allowwriting(false)">Forum</td></tr>
                    <tr><td><input type="radio" name="addchange" value="Comments for articles" onclick="Allowwriting(false)">Comments for articles</td></tr>
                    <tr><td><input type="radio" name="addchange" id="addchange1" onclick="Allowwriting(this.checked)" value="other"/>Other: <br><textarea name="addchange2" id="addchange2" rows="4" cols="40" readonly="true"></textarea></td></tr>
                    <tr><td></td></tr>
                    <tr><td><h3>Which part or feature of the website you like the most?</h3></td></tr>
                    <tr><td><input type="radio" name="like" value="CV format" checked="checked" onclick="Allowwriting1(false)">CV format</td></tr>
                    <tr><td><input type="radio" name="like" value="Messages"  onclick="Allowwriting1(false)">Messages</td></tr>
                    <tr><td><input type="radio" name="like" value="Favorites option"  onclick="Allowwriting1(false)">Favorites option</td></tr>
                    <tr><td><input type="radio" name="like" value="Exporting and importing CV" onclick="Allowwriting1(false)">Exporting and importing CV</td></tr>
                    <tr><td><input type="radio" name="like" id="like" onclick="Allowwriting1(this.checked)" value="other"/>Other: <br><textarea name="like1" id="like1" rows="4" cols="40" readonly="true"></textarea></td></tr>
                    <tr><td></td></tr>
                    <tr><td><h3>What did you find harder to do? </h3></td></tr>
                     <tr><td><input type="radio" name="keep" value="Register" checked="checked" onclick="Allowwriting2(false)">Register</td></tr>
                    <tr><td><input type="radio" name="keep" value="Import / export CV"  onclick="Allowwriting2(false)">Import / export CV</td></tr>
                    <tr><td><input type="radio" name="keep" value="Browse articles"  onclick="Allowwriting2(false)">Browse articles</td></tr>
                    <tr><td><input type="radio" name="keep" id="keep" onclick="Allowwriting2(this.checked)" value="other"/>Other: <br><textarea name="keep1" id="keep1" rows="4" cols="40" readonly="true"></textarea></td></tr>
                    <tr><td></td></tr>
                     <tr><td><h3>General comment: </h3></td></tr>
                     <tr><td><textarea name="general"  rows="4" cols="40"></textarea></td></tr>
                    <tr><td align="center"><input type="submit" name="send" value="Send feedback" class="button"></td></tr>
                </table>
            </form>
        <img src="images/feedback.jpg" width="200">
            <?php
            }
            else{
                ?>
            Thank you for your feedback.
            <?php
            }
        
        ?>
            <br><br>
            <a href="index.php"><strong>Back</strong></a>
        </center>
                   

    </div></div>
            <div id="footer_container" align="left">
        	<img src="images/footer_top.jpg">
			<div id="footer_content">
            	<div id="footer_estec_information">
                	<b>EESTEC International</b><br />
                	<i>Power your future!</i><br />
                    Eletrical Engineering STudents' European assoCiation<br /><br />
                    Mekelweg 4,<br />
                    2628 CD Delft, <a href="http://www.eestec.net">www.eestec.net</a><br />
                    The Netherlands 
            </div>
            <div id="footer_social">
            	Get social with us:<br />
            	<a href="http://www.facebook.com/pages/Lykeion/127125697390765" target="_blank"><img vspace="5px" src="images/fb.png" border="0" /></a> <a href="http://twitter.com/#!/EESTEC" target="_blank"><img vspace="5px" src="images/tw.png" border="0"/></a> <a href="http://www.flickr.com/photos/eestec/" target="_blank"><img vspace="5px" src="images/ln.png" border="0"/></a>
            </div><br /><br />
            <div id="footer_break_line">
            </div>
            <br /> <br />
            <div id="footer_lykeion_information">
            <br />
            	<estec>EESTEC Lykeion Portal<br />
                Copyright&copy;2011 EESTEC All rights reserved.</estec> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<links><a href="?do=terms">Terms of use</a> | Branding & Authorship | <a href="?do=contact">Contact</a></links>
            </div>
        </div>
        	
    </div>
            <map name="Map2" id="Map2">
  <area shape="rect" coords="318,10,395,24" href="?to=university" />
  <area shape="rect" coords="231,10,312,24" href="?to=company" />
  <area shape="rect" coords="163,10,227,24" href="?to=student" />
  <area shape="rect" coords="51,10,158,24" href="http://www.eestec.net/" target="_blank" /><area shape="rect" coords="-1,10,46,24" href="index.php" />
</map>
<map name="Map" id="Map">
    <area shape="rect" coords="10,17,200,137" href="index.php" title="Home" />
  <area shape="rect" coords="796,17,948,137" href="?to=university" title="Universities" />
  <area shape="rect" coords="649,18,794,136" href="?to=company" title="Companies" /><area shape="rect" coords="527,19,645,135" href="?to=student" title="Students" />
</map>
            
            </body>
</html>

