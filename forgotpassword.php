<?php
require_once 'database.php';
require_once 'mail.php';
class forgot_password{
    public function _construct(){}
    public function show_form(){
        echo '
<div id="content">
		<div id="simple-page-container">
			<div id="head-section">
				<img src="images/terms-of-use-icon.jpg" alt="Contact us" />
				<h2>Password</h2>
				<p>recover your password</p>
			</div>

			<div class="clear"></div>
			
			<div id="main-section">
				
            <h3>Enter your data</h3>
			 <form action="index.php" method="post" enctype="multipart/form-data" name="forgotpassword" id="forgotpassword" class="studentform">
			 <label>Username:</label><input type="text" name="username" id="username">
                                    <label>Email:</label><input type="text" name="mail" id="mail">
                                    
                                    <input type="submit" name="forgot" class="btn" value="" /> 
			</form>
			</div>
		</div>
	</div>            


';
    }

    public function generate_password(){
        $username=$_POST['username'];
        $true=0;
        $mail=$_POST['mail'];
        $db=new database();
        $sql="SELECT ID,Login_email, Username FROM universitys";
        list($result,$a)=$db->query($sql);
        while(@$row=  mysql_fetch_array($result)){
            
            if($username==$row['Username'] && $mail==$row['Login_email']){
                $true++;
                $id=$row['ID'];
                $new_password="lykeion".time();
                $pass_base=md5($new_password);
                $s="UPDATE universitys SET Password='$pass_base' WHERE ID='$id'";
                $db->query($s);
                $m=new mail();
                $subject="[Lykeion] New password";
                $message="
                    <html>
                            <body bgcolor='#DCEEFC'>
                            <center>
                                 <br>
                                <a href='http://lykeion.eestec.net/lykeion.jpg'><img src='http://lykeion.eestec.net/lykeion.jpg'></a>
                            </center>
                            <br><br>

                Dear user<br><br>Your new password is generated. It is recommended that you change password after you log in.<br><br><strong> New password:".$new_password."</strong><br><br>
                <p>Best regards,</p>
                            <p>Lykeion website team</p>
                            <p><a href='http://lykeion.eestec.net'>lykeion.eestec.net</a></p>
                             </body></html>";
                $m->SendMail($id, "universitys", $subject, $message);
            }
        }
        $sql="SELECT ID,Login_email, Username FROM companys";
        list($result,$a)=$db->query($sql);
        while(@$row=  mysql_fetch_array($result)){
            
            if($username==$row['Username'] && $mail==$row['Login_email']){
                $true++;
                $id=$row['ID'];
                $new_password="lykeion".time();
                $pass_base=md5($new_password);
                $s="UPDATE companys SET Password='$pass_base' WHERE ID='$id'";
                $db->query($s);
                $m=new mail();
                $subject="[Lykeion] New password";
                $message="<html>
                            <body bgcolor='#DCEEFC'>
                            <center>
                                <br>
                                <a href='http://lykeion.eestec.net/lykeion.jpg'><img src='http://lykeion.eestec.net/lykeion.jpg'></a>
                            </center>
                            <br><br>

                Dear user<br><br>Your new password is generated. It is recommended that you change password after you log in.<br><br><strong> New password:".$new_password."</strong><br><br>
                <p>Best regards,</p>
                            <p>Lykeion website team</p>
                            <p><a href='http://lykeion.eestec.net'>lykeion.eestec.net</a></p>
                             </body></html>";
                $m->SendMail($id, "companys", $subject, $message);
            }
        }
        $sql="SELECT ID,Email, Username FROM users";
        list($result,$a)=$db->query($sql);
        while(@$row=  mysql_fetch_array($result)){
            
            if($username==$row['Username'] && $mail==$row['Email']){
                $true++;
                $id=$row['ID'];
                $new_password="lykeion".time();
                $pass_base=md5($new_password);
                $s="UPDATE users SET Password='$pass_base' WHERE ID='$id'";
                $db->query($s);
                $m=new mail();
                $subject="[Lykeion] New password";
                $message="<html>
                            <body bgcolor='#DCEEFC'>
                            <center>
                                 <br>
                                <a href='http://lykeion.eestec.net/lykeion.jpg'><img src='http://lykeion.eestec.net/lykeion.jpg'></a>
                            </center>
                            <br><br>

                Dear user<br><br>Your new password is generated. It is recommended that you change password after you log in.<br><br><strong> New password:".$new_password."</strong><br><br>
                <p>Best regards,</p>
                            <p>Lykeion website team</p>
                            <p><a href='http://lykeion.eestec.net'>lykeion.eestec.net</a></p>
                             </body></html>";
                $m->SendMail($id, "users", $subject, $message);
            }
        }
        if($true>0)
        echo '
                                    <script type="text/javascript">
                                            function errorhide(){
                                                    $("#error_message").hide();
                                            }
                                    </script>
                                    <div id="error_message"><br/><br/>Your new generated password has been sent to your mail address.<br/><br/><a href="?do=" onclick="errorhide()">Close</a><br/></div>';
    
        else
            echo '
                                    <script type="text/javascript">
                                            function errorhide(){
                                                    $("#error_message").hide();
                                            }
                                    </script>
                                    <div id="error_message"><br/><br/>Wrong username or email address.<br/><br/><a href="?do=" onclick="errorhide()">Close</a><br/></div>';
    }
}

if(isset($_POST['forgot'])){
    $g=new forgot_password();
    $g->generate_password();
}

?>