<?php
require_once 'database.php';
require_once 'images.php';

class password_change {
	private $id;
	private $name;
	private $rank;
	private $old_password;
	private $new_password;
	
	public function __construct(){
		$this->id=$_SESSION['id'];
		$this->rank=$_SESSION['rank'];
	}
	
	public function change(){
		$db= new database();
		$this->old_password=$_POST['old_password'];	
		$this->new_password=$_POST['new_password'];
		if($_POST['new_password']==$_POST['new_password1'])// if new password is correct
		{
		// check if old password is correct 
			// update student profile
			if($this->rank=='student')
				$sql="SELECT ID FROM `users` WHERE Password=MD5('".$this->old_password."') AND ID='".$this->id."'";
			// update university profile
			if($this->rank=='university')
				$sql="SELECT ID FROM `universitys` WHERE Password=MD5('".$this->old_password."') AND ID='".$this->id."'";
			// update company profile
			if($this->rank=='company')
				$sql="SELECT ID FROM `companys` WHERE Password=MD5('".$this->old_password."') AND ID='".$this->id."'";
	
			list($result,$a)=$db->query($sql);

			if($result && mysql_num_rows($result)>0 ){
				//update password
			
				// update student profile
				if($this->rank=='student')
					$sql="UPDATE `users` SET Password=MD5('".$this->new_password."') WHERE ID='".$this->id."'";
				// update university profile
				if($this->rank=='university')
					$sql="UPDATE `universitys` SET Password=MD5('".$this->new_password."') WHERE ID='".$this->id."'";
				// update company profile
				if($this->rank=='company')
					$sql="UPDATE `companys` SET Password=MD5('".$this->new_password."') WHERE ID='".$this->id."'";
		
				list($a,$a)=$db->query($sql);
				echo '<div id="error_message"><br/><br/>Password changed!<br/><br/><a onclick="errorhide()">Close</a><br/></div>';
			}
			else {
			echo '<div id="error_message"><br/><br/>Password not changed!<br/><br/><a onclick="errorhide()">Close</a><br/></div>';
			};
		}
		
	}	
	
	public function show_password_change_form(){
		echo('<div class="article"><form action="index.php" method="post" enctype="multipart/form-data" name="passwordchangeform" id="passwordchangeform" class="studentform">
		
	        <label>Old password:</label><input name="old_password"  type="password" id="old_password"  />
			<label>New password:</label><input name="new_password" class="lykeion_textbox" type="password" id="new_password"  />
			<label>New password:</label><input name="new_password1" class="lykeion_textbox" type="password" id="new_password1" />
         <input type="submit" name="password_change" class="btn" value="" />
          
        
      
      </form></div>');
	}
	
}

if(isset($_POST['password_change'])) {
	$pass= new password_change();
	$pass->change();
}

?>