<?php
require_once 'database.php';

class mail{
	public function _construct(){
	}
	public function SendMail($id,$table,$subject,$message){
                $db=new database();
                @$sql;
                if($table=="users")
                    $sql="SELECT Email FROM ".$table." WHERE ID='$id'";
                else
                    $sql="SELECT Login_email FROM ".$table." WHERE ID='$id'";
		list($result,$a)=$db->query($sql);
		@$mail="";
		while(@$row=mysql_fetch_array($result)){
                    if($table=="users")
                        $mail=$row['Email'];
                    else
                        $mail=$row['Login_email'];
		}
		if($mail=="")
			return false;
		else{
                        $headers  = "From: Lykeion <noreply@eestec.net>\r\n";
                        $headers .= "Reply-To: noreply@eestec.net\r\n";
                        $headers .= "Content-type: text/html\r\n";

			mail($mail,$subject,$message,$headers);
			if(mail){return true;}
			else
				return false;
		}
	}
}

?>
