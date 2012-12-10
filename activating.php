<?php
session_start();
require_once('database.php');
require_once 'mail.php';
if($_SESSION['loged']=="true" && $_SESSION['admin']=="true" && @$_SESSION['ip']==$_SERVER['REMOTE_ADDR']){
	if(@$_GET['id']){
		$id=$_GET['id'];
		$table=$_GET['table'];
		$type_id=$_GET['type_id'];
                $option=@$_GET['option'];
                $db=new database();
                $db->open_connection();
                if($option=="deactivate"){
                    $sql="UPDATE ".$table." SET Status='Deactivated' WHERE ID='$id'";
                    mysql_query($sql);
                    echo '
                                            <script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>Student deactivated.<br/><br/><a href="?do=student" onClick="errorhide()">Close</a><br/></div>';
                }
                else if($option=="make_admin"){
                    $sql="SELECT * FROM admin WHERE user_id='$id'";
                    $res=mysql_query($sql);
                    if(mysql_num_rows($res)>0) echo '
                                            <script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>User is an administrator already.<br/><br/><a href="?do=student" onClick="errorhide()">Close</a><br/></div>';
                    else{
                        $sql="INSERT INTO admin (user_id) VALUES('$id')";
                        mysql_query($sql);
                        echo '
                                            <script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>User is an administrator now.<br/><br/><a href="?do=student" onClick="errorhide()">Close</a><br/></div>';
                    }
                }
                else if($option=="delete_admin"){
                    $sql="DELETE FROM admin WHERE user_id='$id'";
                    mysql_query($sql);
                    echo '
                                            <script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>User is not an administrator anymore.<br/><br/><a href="?do=student" onClick="errorhide()">Close</a><br/></div>';
                }
                else{
                    if($table=="articles"){
                            $sql="UPDATE articles SET status='Active' WHERE ID='$id'";
                            mysql_query($sql);
                            $sql1="UPDATE posts SET number=number-1 WHERE type_id='$type_id'";
                            mysql_query($sql1);
                            $mail=new mail();
                            $s="SELECT title,user,user_type,intro FROM articles WHERE ID='$id'";
                            $r=mysql_query($s);
                            @$user_type;
                            @$title;
                            @$intro;
                            while(@$row=  mysql_fetch_array($r)){
                                $user_type=$row['user_type'];
                                $title=$row['title'];
                                $intro=$row['intro'];
                            }
                            if($user_type=="university")
                                $user_type="universitys";
                            else
                                $user_type="companys";
                            
                            $subject="[Lykeion]Article: ".$title;
                            $message="
                            <html>
                            <body bgcolor='#DCEEFC'>
                            <center>
                                <b> <a href='http://lykeion.eestec.net'>Lykeion</a> <br>        
                                <a href='http://lykeion.eestec.net/lykeion.jpg'><img src='http://lykeion.eestec.net/lykeion.jpg'></a>
                            </center>
                            <p>Dear Sir or Madam,<br></p><p> We would like to inform that your article <strong>'".$title."'</strong> is activated.<p>
                            <br><br>
                            <p>Best Regards,</p>
                             <p>Lykeion website team</p
                                ><img src='http://lykeion.eestec.net/images/lykeion-banner-v2.gif' width='300'>
                                <p>web: <a href='http://lykeion.eestec.net'>lykeion.eestec.net</a><br>
                                mail: <a href='mailto:lykeion@eestec.net'>lykeion@eestec.net</a><br>
                                <strong>POWER YOUR FUTURE</strong></p>
                             </body></html>";
                            $mail->SendMail($type_id, $user_type, $subject, $message);
							$db=new database();
                			$db->open_connection();
							$a="SELECT * FROM ".$user_type." WHERE ID='".$type_id."'";
							$rez=mysql_query($a);
							@$announcedby; 
							while($red=mysql_fetch_array($rez)){
								if($user_type=='universitys'){
									$announcedby=$red['Name_of_University'].", ".$red['Name_of_Faculty'];
								}
								else{
									$announcedby=$red['Name'];
								}
							}
							
							
                            $sql="SELECT ID, Name, Email FROM users WHERE subscribe=1 AND Status='Active'";
                            list($result,$a)=$db->query($sql);
                            while(@$row=  mysql_fetch_array($result)){
                                $ID=$row['ID'];
                                $Name=$row['Name'];
                                $Email=$row['Email'];
                                $subject="[Lykeion Update] Article ".$title." has been announced";
                                $message="
                                <html>
                                <body bgcolor='#DCEEFC'>
                                
                                <p>Hello ".$Name.",<br></p>
                                <p> We would like to inform you that new article on the Lykeion, announced by ".$announcedby.", has been published.
                                <h2> ".$title."</h2>
                                <br><br>
                                ".stripcslashes($intro)."<br>
                                    <br>
                                    <p> Visit and read more about the article on <a href='http://lykeion.eestec.net/index.php?do=preview&wt=article&id=".$id."'>lykeion.eestec.net</a></p>
                                <p>Best Regards,</p>
                                <p>Lykeion website team</p
                                ><img src='http://lykeion.eestec.net/images/lykeion-banner-v2.gif' width='300'>
                                <p>web: <a href='http://lykeion.eestec.net'>lykeion.eestec.net</a><br>
                                mail: <a href='mailto:lykeion@eestec.net'>lykeion@eestec.net</a><br>
                                <strong>POWER YOUR FUTURE</strong></p>
                                 </body></html>";
                                 $mail->SendMail($ID, 'users', $subject, $message);
                            }
                            echo '
                                            <script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>Article activated  <br/><br/><a href="?do=articles" onClick="errorhide()">Close</a><br/></div>';


                    }

                    else if($table=="users"){

                            $sql="UPDATE users SET Status='Active' WHERE ID='$id'";
                            mysql_query($sql);
                            /*$mail=new mail();
                            $subject="[Lykeion] Account activated";
                            $message="
                            <html>
                            <body bgcolor='#DCEEFC'>
                            <center>
                                <b>Welcome to <a href='http://lykeion.eestec.net'>Lykeion</a></b> <br>
                                <a href='http://lykeion.eestec.net/lykeion.jpg'><img src='http://lykeion.eestec.net/lykeion.jpg'></a>
                            </center>
                            <br><br>
                            Dear ".$this->Name." ".$this->Surname.",<br><p>Thank you for registering on Lykeion website. We honestly hope that this website will fulfill your expectations. You will recieve a mail when Administrator activates your account.</p>
                            <p>Your account info:</p><table>
                                <tr><td align='right'>Username:</td><td>".$this->Username."</td></tr>
                                <tr><td align='right'>Contact mail:</td><td>".$this->Email."</td></tr>
                            </table>
                            <p>By becoming a user of Lykeion website you have chance to:</p>
                            <p><ul >
                            <li><strong>enter your CV in unique database</strong>, which is viewed by companies AND universities from whole world</li>
					<li>apply for <strong>internships and jobs</strong> in high-tech companies</li>
					<li>apply for <strong>Bachelor,</strong> <strong>Master and PhD studies</strong> on technical universities worldwide</li>
					<li>establish direct communication channel with most recognizable and perspective universities, companies and experts worldwide</li>
					<li><strong>follow up the latest news</strong> and notifications of your future employer</li>
                            </ul> </p>
                            <p>Be the master of your opportunities!</p>
                            <br><br><p>Best regards,</p>
                            <p>Lykeion website team</p>
                            <p><a href='http://lykeion.eestec.net'>lykeion.eestec.net</a></p>
                            </body></html>";
                            $m=new mail();
                            $m->SendMail($last_id, "users", $subject, $message                              */

                            echo '
                                            <script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>Student activated.<br/><br/><a href="?do=student" onClick="errorhide()">Close</a><br/></div>';
                             
                    }
		
            }
        }
}