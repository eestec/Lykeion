<?php
@session_start();
if(@$_SESSION['loged']=='true' && @$_SESSION['admin']=="true"){
        ini_set("session.use_only_cookies",true);	
        if(!isset($_SESSION['generated']) || @$_SESSION['generated']<(time()-30000)){
            session_regenerate_id(true);
            $_SESSION['generated']=time();
        }
        if(@$_SESSION['loged']=='true' && @$_SESSION['ip']!=$_SERVER['REMOTE_ADDR'])
            header("Location:index.php?go=logout");
        require_once 'database.php';
        require_once 'mail.php';
	function check($id,$type){
		$db=new database();
		$db->open_connection();
		$s="SELECT * FROM posts WHERE type_id='$id' AND type='$type'";
		$r=mysql_query($s);
		if(mysql_num_rows($r)>0)
			return true;
		else
			return false;
		
	}
        if(@$_POST['sendmail']){
            $mailsubject="[Lykeion] ".$_POST['mailsubject'];
            $mailtext=$_POST['mailtext'];
	    $receive=$_POST['receive'];
            $_SESSION['mailtext']=$mailtext;
            $_SESSION['mailsubject']=$mailsubject;
            if(strlen($mailsubject)<=5){
                $_SESSION['error']="Mail subject is too short. It needs to be longer than 5 characters";
                header("Location:admin.php?do=mail");
            }
            else if(strlen($mailtext)<=15){
                $_SESSION['error']="Mail text is too short. It needs to be longer than 15 characters";
                header("Location:admin.php?do=mail");
            }
            else{
                require_once 'mail.php';
                $mail=new mail();
                $id=0;
                $mailtext="<html><body>".$mailtext."
<br><br><p>Best Regards,</p>
                                <p>Lykeion website team</p
                                <img src='http://lykeion.eestec.net/images/lykeion-banner-v2.gif' width='300'>
                                <p>web: <a href='http://lykeion.eestec.net'>lykeion.eestec.net</a><br>
                                mail: <a href='mailto:lykeion@eestec.net'>lykeion@eestec.net</a><br>
                                <strong>POWER YOUR FUTURE</strong></p>
</body></html>";
                $s="SELECT ID FROM users WHERE Status='Active'";
                $db=new database(); 
                list($result,$a)=$db->query($s);
                while($row=  mysql_fetch_array($result)){
                    $id=$row['ID']; 
                    $t=$mail->SendMail($id, 'users', $mailsubject, $mailtext);
                }
		if($receive=='All')
		{
		        $s="SELECT ID FROM universitys WHERE Status='Active' AND Date_of_expire>NOW()";
		        list($result,$a)=$db->query($s);
		        while($row=  mysql_fetch_array($result)){
		            $id=$row['ID'];
		            $t=$mail->SendMail($id, 'universitys', $mailsubject, $mailtext);
		        }
		        $s="SELECT ID FROM companys WHERE Status='Active' AND Date_of_expire>NOW()";
		        list($result,$a)=$db->query($s);
		        while($row=  mysql_fetch_array($result)){
		            $id=$row['ID']; 
		            $t=$mail->SendMail($id, 'companys', $mailsubject, $mailtext);
		        }
		}
                if($t==true) $_SESSION['error']="Mails were successfully sent";
                else $_SESSION['error']="An error occurred, please try again";
                header("Location:admin.php?do=mail");
            }
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


<link href="calendar.css" type="text/css" rel="stylesheet" />
<script src="js/calendar.js" type="text/javascript"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="js/validacija.js"></script>
<script src="js/elements.js" type="text/javascript"></script>


<link href="calendar.css" type="text/css" rel="stylesheet" />

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
function Activate(id,table,tid){
    $("div#wall_article_news").slideUp(function() {});
	jQuery.get("activating.php?id="+id+"&table="+table+"&type_id="+tid, function(info){
    jQuery("#nesto").html(info);
  });    
	//$("div#wall_article_news").slideDown(function() {});
   
}
function Activateoptions(id,table){
	
	 $("div#wall_article_news").slideUp(function() {});
  jQuery.get("activating_options.php?id="+id+"&table="+table, function(form){
      
    jQuery("#ao").html(form);
  });
}
function Deactivate(id,table){
    
	 
  jQuery.get("activating_options.php?id="+id+"&table="+table+"&option=deactivate", function(form){
    jQuery("#nesto").html(form);
  });
}

function DeactivateStudent(id){
    jQuery.get("activating.php?id="+id+"&table=users&option=deactivate", function(form){
    jQuery("#nesto").html(form);
  });
}

function Admin(id,option){
    jQuery.get("activating.php?id="+id+"&table=none&option="+option, function(form){
    jQuery("#nesto").html(form);
  });
}

/*$(document).ready(function() {

// On click of the Next button...
    $("#ne").click(function(){ 

// Use the Slide Up animation to close the #wrapper div...
        $("div#wall_article_news").slideUp(function() 

// Then load INTO the quoteContainer div the output of randomquote.php
            { /*$("#quoteContainer").load("test1.php?q=1");});

// And after that, execute the Slide Down animation
        //$("div#wrapper").slideDown();
    });
});*/
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
       
	<?php
		
                    ?>
             <div id="left_part_students"><div id="left_column_students">
                <br />
                <div align="center">Welcome <?php echo $_SESSION['name'];?><br>
                    <a href="?do=">Home</a><br />
                    <a href="?do=statistics">Statistics</a><br />
                <a href="?do=articles">Articles</a><br />
                <a href="?do=student">Students</a><br />
                <a href="?do=company">Companies</a><br />
                <a href="?do=university">Universities</a><br />
                <a href="?do=mail">Mail</a><br />
                <a href="?do=feedback">Feedback</a><br />
                <a href="index.php">Back to user profile</a><br />
                <a href="?do=log">Log</a><br />
                <a href="?do=bugs">Reported bugs</a><br />
                
                <a href="index.php?go=logout">Log out</a>
                </div>
                </div></div>
            <?php 
			$db=new database();
			$db->open_connection();
			if(@$_POST['activate_u']){
				$id=$_POST['id'];
				$period=$_POST['period'];
				$number=$_POST['number'];
				$sql="UPDATE universitys SET Status='Active', Date_of_expire=DATE_ADD(CURDATE(), INTERVAL $period MONTH) WHERE ID='$id'";
				mysql_query($sql);
				if(check($id,"university")==true){
					$sql1="UPDATE posts SET number='$number' WHERE type_id='$id'";
					mysql_query($sql1);
				}
				else{
					$sql1="INSERT INTO posts VALUES(NULL,'university','$id','$number')";
					mysql_query($sql1);
				}
                                $mail=new mail();
                                $subject="[Lykeion]Account activated";
                                $message="<html>
                                <body bgcolor='#DCEEFC'>
                                <center>
                                    <b>Welcome to <a href='http://lykeion.eestec.net'>Lykeion</a></b> <br>
                                    <a href='http://lykeion.eestec.net/lykeion.jpg'><img src='http://lykeion.eestec.net/lykeion.jpg'></a>
                                </center>
                                <p>Dear Sir or Madam,<br></p>
                                <p>We would like to inform you that your account is activated. Now you can use Lykeion with it's all options.</p>
                                <br><br><p>Best Regards,</p>
                                 <p>Lykeion website team</p
                                <img src='http://lykeion.eestec.net/images/lykeion-banner-v2.gif' width='300'>
                                <p>web: <a href='http://lykeion.eestec.net'>lykeion.eestec.net</a><br>
                                mail: <a href='mailto:lykeion@eestec.net'>lykeion@eestec.net</a><br>
                                <strong>POWER YOUR FUTURE</strong></p>
                                 </body></html>";
                                $true=$mail->SendMail($id, "universitys", $subject, $message);
                                if($true==true)
                                    echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>University activated.<br/><br/><a href="?do=university" onclick="errorhide()">Close</a><br/></div>';
                                else
                                    echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>University activated, but there was a problem with sending the mail to user..<br/><br/><a href="?do=university" onclick="errorhide()">Close</a><br/></div>';
			}
			if(@$_POST['activate_c']){
				$id=$_POST['id'];
				$period=$_POST['period'];
				$number=$_POST['number'];
                                $change=$_POST['change'];
                                $visible=0;
                                if(@$_POST['visible']==-99) $visible=1;
				$sql="UPDATE companys SET Status='Active', visible='$visible', Date_of_expire=DATE_ADD(CURDATE(), INTERVAL $period MONTH) WHERE ID='$id'";
				mysql_query($sql);
				if(check($id,"company")==true){
					$sql1="UPDATE posts SET number=number+'$number' WHERE type_id='$id'";
					mysql_query($sql1);
				}
				else{
					$sql1="INSERT INTO posts VALUES(NULL,'company','$id','$number')";
					mysql_query($sql1);
				}
                                if($change==0){
                                    $mail=new mail();
                                    $subject="[Lykeion]Account activated";
                                    $message="
                                    <html>
                                    <body bgcolor='#DCEEFC'>
                                    <center>
                                        <b>Welcome to <a href='http://lykeion.eestec.net'>Lykeion</a></b> <br>
                                        <a href='http://lykeion.eestec.net/lykeion.jpg'><img src='http://lykeion.eestec.net/lykeion.jpg'></a>
                                    </center>
                                    <p>Dear Sir or Madam,<br></p>
                                    <p>We would like to inform you that your account is activated. Now you can use Lykeion with it's all options.</p>
                                    <br><br><p>Best Regards,</p>
                                     <p>Lykeion website team</p
                                <img src='http://lykeion.eestec.net/images/lykeion-banner-v2.gif' width='300'>
                                <p>web: <a href='http://lykeion.eestec.net'>lykeion.eestec.net</a><br>
                                mail: <a href='mailto:lykeion@eestec.net'>lykeion@eestec.net</a><br>
                                <strong>POWER YOUR FUTURE</strong></p>
                                     </body></html>";
                                    $true=$mail->SendMail($id, "companys", $subject, $message);
                                    if($true==true)
                                        echo '
                                            <script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>Company activated.<br/><br/><a href="?do=company" onclick="errorhide()">Close</a><br/></div>';
                                    else
                                        echo '
                                            <script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>Company activated, but there was problem while sending the mail.<br/><br/><a href="?do=company" onclick="errorhide()">Close</a><br/></div>';

                                }
                                else
                                    echo '<script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>Company settings changed.<br/><br/><a href="?do=company" onclick="errorhide()">Close</a><br/></div>';
                        }
			if(@$_GET['do']==""){
				$db=new database();
				$db->open_connection();
				
			?>
                
                <div id="central_column_students" align="left"><strong>New accounts that need to be activated</strong><br /><div id="announce_wall"><div id="ao"></div>
                <?php
               
				
				$sql="SELECT * FROM universitys WHERE Status='Pending'";
				$result=mysql_query($sql);
				while(@$row=mysql_fetch_array($result)){
					
					?>
                    <div id="wall_article_news">
                	<div id="wall_article_headline" align="left"><strong><?php echo $row['Name_of_University'].", ".$row['Name_of_Faculty'];?></strong></div><div id="wall_article_date_and_other" align="right"><a href="javascript:Activateoptions(<?php echo $row['ID'];?>,'university')"; title="Activate account for University">Activate options</a></div>
                    <div id="article_introtext" align="justify"><?php echo $row['City'].", ".$row['Country']." Email: ".$row['Login_email'];?>
                    
                    </div>
                    
                     <div id="wall_article_date_and_other" align="right"><?php echo "Date of creation: ".$row['date_of_creation'];?></div>
                	</div>
                    <?php
				}
				$sql="SELECT * FROM companys WHERE Status='Pending'";
				$result=mysql_query($sql);
				while(@$row=mysql_fetch_array($result)){
					?>
                    <div id="wall_article_news">
                	<div id="wall_article_headline" align="left"><strong><?php echo $row['Name'].", ".$row['Field_of_work'];?></strong></div><div id="wall_article_date_and_other" align="right"><a href="javascript:Activateoptions(<?php echo $row['ID'];?>,'company')"; title="Activate account for Company" >Activate options</a></div>
                    <div id="article_introtext" align="justify"><?php echo $row['City'].", ".$row['Country']."<br>Contact Person: ".$row['Contact_person'].", Email: ".$row['Login_email'];?>
                    
                    </div>
                    
                     <div id="wall_article_date_and_other" align="right"><?php echo "Date of creation: ".$row['date_of_creation'];?></div>
                	</div>
                    <?php
				}
                ?>
                
                
                </div></div>
			<?php
			}
                        
                        
                        //PART FOR ACTIVATING THE ARTICLES
                        else if(@$_GET['do']=="articles"){
                            $db=new database();
                            $db->open_connection();
                            $sql="SELECT * FROM `articles` as a, posts as p WHERE a.status='Pending'AND a.user_type=p.type AND a.user=p.type_id AND a.deleted=0  ORDER BY a.date_of_creation";
                            $result=mysql_query($sql);
                            ?>
                            <div id="central_column_students" align="left"><div id="announce_wall">
                            <?php
                            while(@$row=  mysql_fetch_array($result)){
                                $number=$row['number'];
                                $type=$row['type'];
                                $id=$row['type_id'];
                                ?>
                                <div id="wall_article_news">
                                            <div id="wall_article_headline" align="left"><?php echo $row['title'];?></div>
                                            <?php
											if($number>0){?>
                                            <div id="wall_article_date_and_other" align="right"><a href=javascript:Activate(<?php echo $row['ID'];?>,"articles",<?php echo $id;?>); title="Activate article">ACTIVATE</a></div><?php }?>
                                            <div id="article_introtext" align="justify"><?php echo $row['intro'];
                                            if($type=="university"){
                                                $s="SELECT Name_of_University, Status FROM universitys WHERE ID='$id'";
                                                $r=mysql_query($s);
                                                while($row1=  mysql_fetch_array($r)){
                                                    $name=$row1['Name_of_University'];
                                                    $status=$row1['Status'];
                                                    ?></div>
                                                    <div id="wall_article_date_and_other" align="right"><?php echo $name.", Status: ".$status." and has ".$number." articles to announce."; ?></div>
                                                    <?php
                                                }
                                            }
                                            else if($type=="company"){
                                                $s="SELECT Name, Status FROM companys WHERE ID='$id'";
                                                $r=mysql_query($s);
                                                while($row1=  mysql_fetch_array($r)){
                                                    $name=$row1['Name'];
                                                    $status=$row1['Status'];
                                                    ?></div>
                                                    <div id="wall_article_date_and_other" align="right"><?php echo $name.", Status: ".$status." and has ".$number." articles to announce."; ?></div>
                                                    <?php
                                                }
                                            }
                                       ?>
                                                    </div>
                                                    <?php
													
                            }
                                 ?>
                                </div></div>
                                <?php
                        }
                        
                        
                        
                        //PART FOR VIEWING THE LOG
                        else if(@$_GET['do']=='log'){
                            $sql="SELECT * FROM log ORDER BY time DESC";
                            list($result,$a)=$db->query($sql);
                            ?>
             <div id="central_column_students" align="left"><div id="announce_wall"><div id="ao"></div>
                     <table border="1">
                         <tr><td align="center"><strong>Query</strong></td><td align="center"><strong>Error</strong></td><td align="center"><strong>Time</strong></td></tr>
                         <?php
                         while(@$row=  mysql_fetch_array($result)){
                             ?>
                         <tr><td><?php echo $row['query'];?></td><td><?php echo $row['error'];?></td><td><?php echo $row['time'];?></td></tr>
                         <?php
                         }
                         ?>
                     </table></div></div>
            <?php
                        }
                        
                        
                        
                        //LIST OF REPORTED BUGS
                        else if(@$_GET['do']=='bugs'){
                            $sql="SELECT * FROM bugs ";
                            list($result,$a)=$db->query($sql);
                            ?>
             <div id="central_column_students" align="left"><div id="announce_wall"><div id="ao"></div>
                     <table border="1">
                         <tr><td align="center"><strong>Title</strong></td><td align="center"><strong>User info</strong></td><td align="center"><strong>Description</strong></td><td align="center"><strong>Type</strong></td><td align="center"><strong>When</strong></td><td align="center"><strong>Input</strong></td></tr>
                         <?php
                         while(@$row=  mysql_fetch_array($result)){
                             $user="";
                             $mail="";
                             $user_id=$row['user_id'];
                             $typ=$row['user_type'];
                             if($typ=='student')
                             {

                                $s="SELECT * FROM users WHERE id='$user_id'";
                                list($r,$b)=$db->query($s);
                                while($row1=  mysql_fetch_array($r)){
                                    $user=$row1['Name']." ".$row1['Surname'];
                                    $mail=$row1['Email'];
                                }
                             }
                             else{
                                 $s="SELECT * FROM ".$typ." WHERE ID='$user_id'";
                              list($r,$b)=$db->query($s);
                                while($row1=  mysql_fetch_array($r)){
                                    $user=$row1['Name'];
                                    $mail=$row1['Login_email'];
                                }
                             }
                             ?>
                         <tr><td><?php echo $row['title'];?></td><td><?php echo "Name: ".$user.", email: ".$mail; ?></td><td><?php echo $row['description'];?></td><td><?php echo $row['type'];?></td><td><?php echo $row['when'];?></td><td><?php echo $row['input'];?></td></tr>
                         <?php
                         }
                         ?>
                     </table></div></div>
            <?php
                        }
                        
                        
                        //VIEW FEEDBACK
                        else if(@$_GET['do']=='feedback'){
                            $sql="SELECT * FROM feedback ";
                            list($result,$a)=$db->query($sql);
                            ?>
             <div id="central_column_students" align="left"><div id="announce_wall"><div id="ao"></div>
                     <table border="1">
                         <tr><td align="center"><strong>Are you satisfied with the content of the website?</strong></td><td align="center"><strong>Did you update your CV on Lykeion?</strong></td><td align="center"><strong>What would you add or change on the website?</strong></td><td align="center"><strong>Which part or feature of the website you like the most?</strong></td><td align="center"><strong>What did you find harder to do? </strong></td><td align="center"><strong>General comment </strong></td></tr>
                         <?php
                         while(@$row=  mysql_fetch_array($result)){
                             $user="";
                             $mail="";
                             $satisfied=$row['satisfied'];
                             $update=$row['update'];
                             $addchange=$row['addchange'];
                             $like=$row['like'];
                             $keep=$row['keep'];
                             $general=$row['general'];
                             ?>
                         <tr><td><?php echo $satisfied;?></td><td><?php echo $update; ?></td><td><?php echo nl2br($addchange);?></td><td><?php echo nl2br($like);?></td><td><?php echo nl2br($keep);?></td><td><?php echo nl2br($general);?></td></tr>
                         <?php
                         }
                         ?>
                     </table></div></div>
            <?php
                        }
                        
                        
                        else if(@$_GET['do']=="university"){
                            ?>
                            <div id="central_column_students" align="left"><div id="announce_wall"><div id="ao"></div>
                                    <?php
                                    $sql="SELECT * FROM universitys ORDER BY Date_of_expire DESC";
                                    $db=new database();
                                    list($result,$a)=$db->query($sql);
                                    while(@$row=  mysql_fetch_array($result)){
                                        ?>
                                        <div id="wall_article_news">
                                            <div id="wall_article_headline" align="left"><strong><?php echo $row['Name_of_University'].", ".$row['Name_of_Faculty'];?></strong></div><div id="wall_article_date_and_other" align="right">
                                                <?php
                                                if($row['Status']=="Active"){
                                                    ?>
                                                <strong>Status: Active </strong>; <a href="javascript:Deactivate(<?php echo $row['ID'];?>,'universitys');" title="Deactivate account."><h3>Deactivate account</h3></a></div>
                                                <?php
                                                }
                                                else if($row['Status']!="Active"){
                                                ?>
                                                    <strong>Status: <?php echo $row['Status'];?> </strong>; <a href="javascript:Activateoptions(<?php echo $row['ID'];?>,'university');" title="Activate account for University"><h3>Activate options</h3></a></div>
                                                <?php
                                                }?>
                                        <div id="article_introtext" align="justify"><?php echo $row['City'].", ".$row['Login_email'];?>

                                        </div>

                                         <div id="wall_article_date_and_other" align="right"><?php echo "Date of expire: ".$row['Date_of_expire'];?></div>
                                            </div>
                                        <?php
                                    }
                                    ?>
                            </div></div>
                            <?php

                        }
                        else if(@$_GET['do']=="company"){
                            ?>
                            <div id="central_column_students" align="left"><div id="announce_wall"><div id="ao"></div>
                                    <?php
                                    $sql="SELECT * FROM companys ORDER BY Date_of_expire DESC";
                                    $db=new database();
                                    list($result,$a)=$db->query($sql);
                                    while(@$row=  mysql_fetch_array($result)){
                                        ?>
                                        <div id="wall_article_news">
                                            <div id="wall_article_headline" align="left"><strong><?php echo $row['Name'];?></strong></div><div id="wall_article_date_and_other" align="right">
                                                <?php
                                                if($row['Status']=="Active"){
                                                    ?>
                                                <strong>Status: Active </strong>; <a href="javascript:Activateoptions(<?php echo $row['ID'];?>,'change');" title="Change company options."><h3>Change options</h3></a><a href="javascript:Deactivate(<?php echo $row['ID'];?>,'companys');" title="Deactivate account."><h3>Deactivate account</h3></a></div>
                                                <?php
                                                }
                                                else if($row['Status']!="Active"){
                                                ?>
                                                    <strong>Status: <?php echo $row['Status'];?> </strong>; <a href="javascript:Activateoptions(<?php echo $row['ID'];?>,'company');" title="Activate account for University"><h3>Activate options</h3></a></div>
                                                <?php
                                                }?>
                                        <div id="article_introtext" align="justify"><?php echo $row['City'].", ".$row['Login_email'];?>

                                        </div>

                                         <div id="wall_article_date_and_other" align="right"><?php echo "Date of expire: ".$row['Date_of_expire'];?></div>
                                            </div>
                                        <?php
                                    }
                                    ?>
                            </div></div>
                            <?php

                        }

                        else if(@$_GET['do']=="statistics"){
                            ?>
                            <div id="central_column_students" align="left"><div id="announce_wall"><div id="ao"></div>
                                    <?php
                                     $s="SELECT count( * ) as broj FROM users";
                                $r=mysql_query($s);
                                while($row=  mysql_fetch_array($r)){
                                    echo "<br><h3>There are ".$row['broj']." registered users in database.</h3> <br>";
                                }
                                $sql = "SELECT u.Country, COUNT(*) as `Count` FROM `users` as u GROUP BY u.Country";
                                list($result,$a)=$db->query($sql);

                                ?>
                                    <table border="1"><tr><td align="center"><strong>Country</strong></td><td align="center"><strong>Number of students</strong></td></tr>
                                        <?php
                                while ($line = mysql_fetch_array($result)){
                                        echo "<tr><td align='center'>".$line['Country'] . "</td><td align='center'> " . $line['Count'] . "</td></tr>";
                                }
                                    ?>
                                    </table>
									
								<?php include ("other_stats.php");?>
                            </div>
							</div>
                            <?php

                        }
                        else if(@$_GET['do']=="student"){
                            ?>
                            <div id="central_column_students" align="left"><div id="announce_wall"><div id="ao"></div>
                                    <?php
                                    $sql="SELECT * FROM users ORDER BY date_of_creation DESC";
                                    $db=new database();
                                    list($result,$a)=$db->query($sql);
                                    while(@$row=  mysql_fetch_array($result)){
                                        $userid=$row['ID'];
                                        $s="SELECT * FROM admin WHERE user_id='$userid'";
                                        list($res,$b)=$db->query($s);
                                        $admin=0;
                                        if(mysql_num_rows($res)>0) $admin++;
                                        ?>
                                        <div id="wall_article_news">
                                            <div id="wall_article_headline" align="left"><strong><?php echo $row['Name'];?></strong> <strong><?php echo $row['Surname'];?></strong></div><div id="wall_article_date_and_other" align="right">
                                                <?php
                                                if($row['Status']=="Active"){
                                                    ?>
                                                <strong>Status: Active </strong>; <a href="javascript:DeactivateStudent(<?php echo $row['ID'];?>);" title="Deactivate account."><h3>Deactivate account</h3></a></div>
                                                <?php
                                                }
                                                else if($row['Status']!="Active"){
                                                ?>
                                                    <strong>Status: <?php echo $row['Status'];?> </strong>; <a href="javascript:Activate(<?php echo $row['ID'];?>,'users',0);" title="Activate account for University"><h3>Activate account</h3></a></div>
                                                <?php
                                                }?>
                                        <div id="article_introtext" align="justify"><?php echo $row['Username'].", ".$row['City'].", ".$row['Country']." Mail: ".$row['Email'];?>
                                            <div id="wall_article_date_and_other" align="right"><?php if($admin==0){
                                                ?><strong>User </strong> <a href=javascript:Admin(<?php echo $userid;?>,"make_admin"); title="Make this user administrator"><img src="images/admin.png" height="20"/></a><?php
                                            }
                                            else{
                                                ?><strong>Administrator </strong> <a href=javascript:Admin(<?php echo $userid;?>,"delete_admin"); title="Remove this user from administrator"><img src="images/no.png" height="20"/></a><?php
                                            }
                                            ?></div>
                                        </div>

                                         <div id="wall_article_date_and_other" align="right"><?php echo "Last login: ".$row['Last_login'];?></div>
                                            </div>
                                        <?php
                                    }
                                    ?>
                            </div></div>
                            <?php

                        }
                        
                        
                        //SENDING THE MAILS TO ALL USERS
                        else if(@$_GET['do']=='mail'){
                            ?>
                            <div id="central_column_students" align="left">
                                <div id="announce_wall">
                                    <form action="admin.php" method="post">
                                        <table border="0">
                                            <p><strong>Important note:</strong> This administrator option provides you to send email to all registered users on Lykeion website (univeristies, students and companies). No need for adding signature in the email text. It will be added automatically.</p>
						Who receives mail: <select name="receive"><option>All</option><option>Students</option></select>
                                            <p><strong><font color="red"><?php echo @$_SESSION['error'];?></font></strong></p>
                                            <?php
                                            if(@$_SESSION['error']=="Mails were successfully sent"){
                                                $_SESSION['error']="";
                                                $_SESSION['mailsubject']="";
                                                $_SESSION['mailtext']="";
                                            }
                                            ?>
                                            <tr><td><strong>Mail subject:</strong></td><td><input type="text" name="mailsubject" maxlength="300" style="width:98%" value="<?php echo @$_SESSION['mailsubject'];?>"></td></tr>
                                            <tr><td><strong>Mail text</strong></td><td></td></tr>
                                            <tr><td colspan="2"><textarea name="mailtext" cols="100" rows="30" id="mailtext"  style="width:200%"><?php echo @$_SESSION['mailtext'];?></textarea></td></tr>
                                     <script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
			        <script type="text/javascript">
			            tinyMCE.init({
							// General options
							//mode : "textareas",
							theme : "advanced",
							plugins : "youtube,safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
							mode : "exact",
							elements : "mailtext",
							relative_urls: false,
                    		remove_script_host : false,
							
							// Theme options
							theme_advanced_buttons1 : "bold,italic,underlitheme_advanced_buttonsne,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontsizeselect",
							theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,link,unlink,code,media",
							
							
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : false,
					        
					        
							// Example content CSS (should be your site CSS)
							content_css : "css/content.css",
					
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "lists/template_list.js",
							external_link_list_url : "lists/link_list.js",
							external_image_list_url : "lists/image_list.js",
							media_external_list_url : "lists/media_list.js",
					
							// Replace values for the template plugin
							template_replace_values : {
								username : "Some User",
								staffid : "991234"
							}
   			            });
   			            
   			            tinyMCE.init({
							// General options
							//mode : "textareas",
							theme : "simple",
							plugins : "youtube,safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
							mode : "exact",
							elements : "article_intro_txt",
							relative_urls: false,
                    		remove_script_host : false,
							
							// Theme options
							theme_advanced_layout_manager : "SimpleLayout",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
					        
					        
							// Example content CSS (should be your site CSS)
							content_css : "css/content.css",
					
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "lists/template_list.js",
							external_link_list_url : "lists/link_list.js",
							external_image_list_url : "lists/image_list.js",
							media_external_list_url : "lists/media_list.js",
					
							// Replace values for the template plugin
							template_replace_values : {
								username : "Some User",
								staffid : "991234"
							}
   			            });
		            </script>
                                     <tr><td colspan="2" align="center"><input type="submit" class="button" name="sendmail" value="Send mail"> </td></tr>
                                        </table>
                                    </form>
                                </div>
                                
                                
                            </div>
                            <?php
                        }
		
	?>





	</div>
        

 <div id="footer_container" align="left">
        	<img src="images/footer_top.jpg">
			<div id="footer_content">
            	<div id="footer_estec_information">
                	<b>EESTEC International</b><br />
                	<i>Power your future!</i><br />
                    Eletrical Engineering STudents' European assoCiation<br /><br />
                    Mekelweg 4,<br />
                    2628 CD Delft, <a href="http://www.eestec.net">www.eestec.net</a><br />
                    The Netherlands <a href="mailto:board@eestec.net">board@eestec.net</a>
            </div>
            <div id="footer_social">
            	Get social with us:<br />
            	<a href="http://www.facebook.com/pages/Electrical-Engineering-Students-European-assoCiation/154927151189732"><img vspace="5px" src="images/fb.png" border="0" /></a> <a href="http://twitter.com/%20EESTEC_tweets"><img vspace="5px" src="images/tw.png" border="0"/></a> <a href="http://www.flickr.com/photos/eestec/"><img vspace="5px" src="images/ln.png" border="0"/></a> 
            </div><br /><br />
            <div id="footer_break_line">
            </div>
            <br /> <br />
            <div id="footer_lykeion_information">
            <br />
            	<estec>EESTEC Lykeion Portal<br />
                Copyright&copy;2011 EESTEC All rights reserved.</estec> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<links>Terms of use | Branding & Autorship | Contact</links>
            </div>
        </div>
        	
    </div>
</div>
<map name="Map2" id="Map2">
  <area shape="rect" coords="318,10,395,24" href="?to=university" />
  <area shape="rect" coords="231,10,312,24" href="?to=company" />
  <area shape="rect" coords="163,10,227,24" href="?to=student" />
  <area shape="rect" coords="51,10,158,24" href="http://www.eestec.net/" /><area shape="rect" coords="-1,10,46,24" href="index.php" />
</map>
<map name="Map" id="Map">
  <area shape="rect" coords="796,17,948,137" href="?to=university" />
  <area shape="rect" coords="649,18,794,136" href="?to=company" /><area shape="rect" coords="527,19,645,135" href="?to=student" />
</map>
</body>
</html>
<?php
}
?>
