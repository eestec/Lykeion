<?php
require_once('database.php');
require_once('config.php');
require_once('language.php');
require_once('mail.php');

class messages{
	private $id;
	private $id_msg;
	private $date;
	private $ip;
	private $headline;
	private $msg;
	private $id_user;
	private $read;
	private $first;
	private $user_id;
	private $send_to;
	
	public function __construct(){
		$this->ip=$this->get_IP_address();
		$this->user_id=$_SESSION['chat_id'];
	}
	
	private function get_IP_address(){
	    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }else {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    };
	    return $ip;
	}
	
	public function load_from_post(){
		$this->headline=addslashes(@$_POST['messages_headline']);
		$this->msg=addslashes($_POST['messages_msg']);
		$this->send_to=addslashes(@$_POST['messages_send_to']);
		if(@$_POST['messages_id_conversation']) $this->id=$_POST['messages_id_conversation'];
	}
	
	public function save_conversation_to_database(){
		$db= new database();
                $db->open_connection();
		// check if recepients exists
		$a= explode(' ',$this->send_to);
		$sql="SELECT ID, User_type, User_ID FROM `mm_messages_conv_users` WHERE User='%s'";
		$result2=mysql_query(sprintf($sql, mysql_real_escape_string($a[0])));
		//list($result2,$a)=$db->query($sql);
		if($result2 && mysql_num_rows($result2)>0){
			// move on
			$sql="INSERT INTO `mm_messages_conversation` VALUES(NULL,'".htmlentities($this->headline,ENT_QUOTES, 'UTF-8')."')";
			list($a,$this->id)=$db->query($sql);
			$sql="INSERT INTO `mm_messages_msg` VALUES(NULL,'".$this->id."','".htmlentities($this->headline,ENT_QUOTES, 'UTF-8')."','".htmlentities($this->msg,ENT_QUOTES, 'UTF-8')."','".$this->user_id."',NOW(),'".$this->ip."')";
			list($a,$a)=$db->query($sql);
			// add users to conversation
			while ($podaci1 = mysql_fetch_array($result2)){
				$reciver_id=$podaci1['ID'];
				$receiver_type=$podaci1['User_type'];
				$receiver_uid=$podaci1['User_ID'];
				$sql="INSERT INTO `mm_messages_clients` VALUES(NULL,'".$this->id."','".$reciver_id."','0','0')";
				$db->query($sql);
			}
				$sql="INSERT INTO `mm_messages_clients` VALUES(NULL,'".$this->id."','".$this->user_id."','1','0')";
				$db->query($sql);
				if($receiver_type=='company' || $receiver_type=='university')
				{
					$receiver_type=$receiver_type.'s';
					$subject="[Lykeion Message] New message in your inbox ";
		                    	$message="
		                    	<html>
		                    	<body bgcolor='#DCEEFC'>
		                    	<p>Dear Sir or Madam,<br></p><p> We would like to inform that you received the message <strong>".$this->headline."</strong> in your inbox on Lykeion website.<p>
		                    	<p> Message content: ".$this->msg."<br><br> To reply on the message, log in on http://lykeion.eestec.net and go to your inbox. </p>
		                    	<p>Best Regards,</p>
		                     	<p>Lykeion website team</p
		                        ><img src='http://lykeion.eestec.net/images/lykeion-banner-v2.gif' width='300'>
		                        <p>web: <a href='http://lykeion.eestec.net'>lykeion.eestec.net</a><br>
		                        mail: <a href='mailto:lykeion@eestec.net'>lykeion@eestec.net</a><br>
		                        <strong>POWER YOUR FUTURE</strong></p>
		                     	</body></html>";
					$mail=new mail();
					$mail->SendMail($receiver_uid, $receiver_type, $subject, $message);
				}
                                echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/>Message sent.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
		}
                else echo '<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/>Wrong username of reciever. <br/><br/><a href="?do=send_message" onclick="errorhide()">Close</a><br/></div>';
		
	}
	
	public function save_msg_to_database(){
		$db= new database();
		$sql="INSERT INTO `mm_messages_msg` VALUES(NULL,'".$this->id."','".htmlentities($this->headline,ENT_QUOTES, 'UTF-8')."','".htmlentities($this->msg,ENT_QUOTES, 'UTF-8')."','".$this->user_id."',NOW(),'".$this->ip."')";
		list($a,$a)=$db->query($sql);
		$sql="UPDATE `mm_messages_clients` SET Readed='0',Deleted='0' WHERE ID_conversation='".$this->id."' AND User!='".$this->user_id."'";
		list($a,$a)=$db->query($sql);
		$sql1="SELECT User_ID, User_type FROM mm_messages_conv_users WHERE ID=(SELECT User FROM mm_messages_clients WHERE ID_conversation='".$this->id."' AND User!='".$this->user_id."')";
		list($res, $a)=$db->query($sql1);
		while($row=mysql_fetch_array($res)){
			$receiver_id=$row['User_ID'];
			$receiver_type=$row['User_type']; 
			if($receiver_type=='company' || $receiver_type=='university')
				{
					$receiver_type=$receiver_type.'s';
					$subject="[Lykeion Message] New message in your inbox ";
		                    	$message="
		                    	<html>
		                    	<body bgcolor='#DCEEFC'>
		                    	<p>Dear Sir or Madam,<br></p><p> We would like to inform that you received a reply in one of the conversations in your inbox on Lykeion website.<p>
		                    	<p> Message content: ".$this->msg."<br><br> To reply on the message, log in on http://lykeion.eestec.net and go to your inbox. </p>
		                    	<p>Best Regards,</p>
		                     	<p>Lykeion website team</p
		                        ><img src='http://lykeion.eestec.net/images/lykeion-banner-v2.gif' width='300'>
		                        <p>web: <a href='http://lykeion.eestec.net'>lykeion.eestec.net</a><br>
		                        mail: <a href='mailto:lykeion@eestec.net'>lykeion@eestec.net</a><br>
		                        <strong>POWER YOUR FUTURE</strong></p>
		                     	</body></html>";
					$mail=new mail();
					$mail->SendMail($receiver_id, $receiver_type, $subject, $message);
				}
		}
		echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/>Message sent.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
	}
	
	public function delete_conversation_from_database(){
		$db= new database();
		$sql="UPDATE `mm_messages_clients` SET Deleted='1' WHERE ID_conversation='".$this->id."' AND User='".$this->user_id."'";
		$db->query($sql);
	}
	
	public function show_conversation($id,$user){
		global $messages_language;
		$db= new database();$users;
		$sql="SELECT * FROM `mm_messages_conversation` as m,`mm_messages_clients` as c WHERE m.ID='".$id."' AND c.ID_conversation='".$id."' AND c.User='".$user."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0)
		    while ($podaci = mysql_fetch_array($result)){
				echo '<div id="article-wall">
				<h3>'.$podaci['Subject'].'</h3>';
		    	
				//show recepients
				$sql1="SELECT c.User FROM `mm_messages_clients` as m,`mm_messages_conv_users` as c WHERE m.ID_conversation='".$id."' AND m.User=c.User";
		    	list($result1,$a)=$db->query($sql1);
		    	
		  		//show text messages
		  		$sql1="SELECT c.User, c.User_type, m.Send,m.Headline,m.MSG FROM `mm_messages_msg` as m LEFT JOIN `mm_messages_conv_users` as c ON m.User=c.ID WHERE m.ID_conversation='".$id."' ORDER BY m.ID";
		  		list($result1,$a)=$db->query($sql1);
		  		
		  		if($result1 && mysql_num_rows($result1)>0)
		  		while ($podaci1 = mysql_fetch_array($result1)){
					 if($podaci1['User_type']=='company')
					 	$usr="SELECT Name, Contact_person as Surname from companys where Username='".$podaci1['User']."'";
					 else if($podaci1['User_type']=='university')
					 	$usr="SELECT Name_of_University as Name, Name_of_Faculty as Surname from universitys where Username='".$podaci1['User']."'";
					 else
					 	$usr="SELECT Name, Surname from users where Username='".$podaci1['User']."'";
                                    	list($res,$c)=$db->query($usr); 
                                    while($row=mysql_fetch_array($res)){
                                        $name=$row['Name']." ".$row['Surname'];}
		  			echo '<div class="article">
		  			<h6>'.$messages_language[5].': <strong>'.$name.' ('.$podaci1['User'] .')</strong> '.$messages_language[6].': '.date("d M.Y H:i",strtotime($podaci1['Send'])).'</h6>
		  			<h6>'.$podaci1['Headline'].'</h6>
		  			<p>'.nl2br($podaci1['MSG']).'</p>
		  			</div>';
		  		};
		  		
		    	
		    	$this->show_add_msg($id);
                        echo '</div>';
		    	$sql1="UPDATE `mm_messages_clients` SET Readed='1' WHERE ID_conversation='".$id."' AND User='".$user."'";
		    	$db->query($sql1);
		    };
	    
	}
	
	public function show_all_messsages($filter='all'){
		global $messages_language;
		$db= new database();
		
		$sql="SELECT mmc.Readed,mc.Subject,mc.ID FROM `mm_messages_conversation` as mc,`mm_messages_clients` as mmc WHERE (mmc.Deleted='0' AND mc.ID=mmc.ID_conversation AND mmc.User='".$this->user_id."') ORDER BY mc.ID DESC";
		list($result,$a)=$db->query($sql);
		echo '<div id="article-wall">
                    
                    <div id="message">
			
			<a class="import-europass" href="index.php?do=send_message">New message</a></div>
		';
		if($result && mysql_num_rows($result)>0)
		while($podaci=mysql_fetch_array($result)){
			$sql="SELECT mu.User FROM `mm_messages_clients` as mc,`mm_messages_conv_users` as mu WHERE mc.ID_conversation='".$podaci['ID']."' AND mc.User=mu.ID";
			list($result1,$a)=$db->query($sql);
			$sql="SELECT mm.Send,mm.MSG,mu.User,c.Subject FROM `mm_messages_conv_users` as mu,`mm_messages_msg` as mm, mm_messages_conversation as c WHERE mm.User=mu.ID AND mm.ID_conversation='".$podaci['ID']."' AND c.ID='".$podaci['ID']."' ORDER BY mm.Send DESC LIMIT 1";
			list($result2,$a)=$db->query($sql);
			echo '<a href="index.php?do=show_message&id='.$podaci['ID'].'">';
			if($podaci['Readed']=='1')	echo '<div id="class="article">'; else echo '<div class="article first-article">';
			
			
			/*while($podaci1=mysql_fetch_array($result1)){
				echo $podaci1['User'].', ';
			};*/
			 echo "<center>";
			while($podaci1=mysql_fetch_array($result2)){
                           
				if( strlen($podaci1['MSG'])>50 ) $MSG=substr($podaci1['MSG'],0,46).'...'; else $MSG=$podaci1['MSG'];
				echo'	<h3>'.$podaci1['Subject'].'</h3>
                                    <h6>'.date("d M.Y H:i",strtotime($podaci1['Send'])).'</h6>
						<p>'.$MSG.'</p>
						
					';
			};
                        echo '</center></div></a>';
		}
		echo '</div>';
	}
	
	public function show_start_conversation(){
		global $messages_language;
		echo '
                    <div id="article-wall">
                    <div class="article">
		<form action="index.php" class="studentform" method="post" enctype="multipart/form-data" name="form_message" id="form_message">
                
		
                <p>Automatic pop-up enabled. Type username or name and select the user.</p><br><br><br>
			<label>'.$messages_language[3].': </label><input name="messages_send_to" type="text"  id="messages_send_to" />
			<label>'.$messages_language[0].': </label><input name="messages_headline" class="lykeion_textbox" type="text" id="messages_headline" />
			<label>'.$messages_language[1].': </label><textarea name="messages_msg" class="lykeion_textbox" cols="70" rows="5" id="messages_msg"></textarea>
			<input class="send-btn" type="submit" name="messages_start_conversation" value="">
		
		</form></div></div>';
	}
	
	public function show_add_msg($id_conversation){
		global $messages_language;
		echo '
		<form action="index.php" class="studentform" method="post" enctype="multipart/form-data" name="form_message" id="form_message">
		<input name="messages_id_conversation" id="messages_id_conversation" type="hidden" value="'.$id_conversation.'"/>
		
			
			<label>'.$messages_language[1].':</label> <textarea name="messages_msg" cols="55" rows="5" id="messages_msg"  ></textarea>
			<input class="btn" type="submit" name="messages_send" value="">
		
		</form>';
	}

	public function show_side_info(){
		$db= new database();
		$sql="SELECT COUNT(*) as num FROM `mm_messages_clients` as mc WHERE mc.User='".$this->user_id."' AND mc.Readed='0' AND mc.Deleted='0'";
		@$n;
                list($result,$a)=$db->query($sql);
		if($result  && mysql_num_rows($result)>0){ 
			while($podaci1=mysql_fetch_array($result)){
                            
                            $n=$podaci1['num'];
                        }
		
		} else $plus="";
                if($n>0) echo' <div class="new-messages">'.$n.'</div>
			';
                    
                    echo '<a href="index.php?do=show_inbox">Inbox</a>';
		
			
	}
	
}

	if(isset($_POST['messages_start_conversation'])) {
		$msg= new messages();
		$msg->load_from_post();
		$msg->save_conversation_to_database();
	}

	if(isset($_POST['messages_send'])) {
		$msg= new messages();
		$msg->load_from_post();
		$msg->save_msg_to_database();
	}
	
?>
