<?php
require_once 'database.php';

class user_login {
	private $id;
	private $name;
	private $username;
	private $rank;
	private $status;
	private $type;
	private $expire;
	private $chat_id;
	private $cv_id;
        private $subscribe;
	
	public function __construct(){
		if(@$_SESSION[status]<>''){
			$this->name=@$_SESSION['name'];
			$this->username=@$_SESSION['username'];
			$this->rank=@$_SESSION['rank'];
			$this->status=@$_SESSION['status'];
			$this->id=@$_SESSION['id'];
			$this->chat_id=@$_SESSION['chat_id'];
			$this->expire=@$_SERVER['expire'];
		}
	}
	
	public function login(){
		$db= new database();
		if(@$_SESSION[status]==''){
			$db->open_connection();
			$pass=md5(@$_POST[password]);
			$username=addslashes(@$_POST[username]);
			$sql="SELECT u.ID,u.Name,u.Username,u.CV,u.Status, u.subscribe ,c.ID as chat_id FROM `users` as u,`mm_messages_conv_users` as c WHERE Username='". $username ."' AND Password='".$pass."' AND u.ID=c.User_ID AND c.User_type='student' LIMIT 1";
			list($result,$a)=$db->query($sql);
			if($result && mysql_num_rows($result)>0){
			$this->type=='student';
				while ($podaci = mysql_fetch_array($result)){
					$this->id=$podaci['ID'];
					$this->name=$podaci['Name'];
					$this->username=$podaci['Username'];
					$this->rank='student';
					$this->cv_id=$podaci['CV'];
                                        $this->subscribe=$podaci['subscribe'];
					$this->status='active';
					$this->chat_id=$podaci['chat_id'];
					if($podaci['Status']<>'Ban'){
						@$_SESSION['loged']='true'; 
						@$_SESSION['name']=$this->name;
						@$_SESSION['username']=$this->username;
						@$_SESSION['rank']=$this->rank;
						@$_SESSION['status']=$this->status;
						@$_SESSION['id']=$this->id;
						@$_SESSION['cv_id']=$this->cv_id;
                                                @$_SESSION['subscribe']=$this->subscribe;
						@$_SESSION['chat_id']=$this->chat_id;
                                                @$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
				   	}
                                        $s="SELECT user_id FROM admin WHERE user_id='$this->id'";
                                        list($res,$b)=$db->query($s);
                                        while($row=@mysql_fetch_array($res)){
                                            @$_SESSION['admin']="true";
                                        }
                                        $s="UPDATE users SET Last_login=NOW() WHERE ID='$this->id'";
                                        $db->query($s);
					if($podaci['Status']!="Active")
					{
						$_SESSION['status']="not activated";
					}
				}
			} else {
				$sql="SELECT u.ID,u.Contact_person,u.Username,u.Status,c.ID as chat_id,u.Date_of_expire FROM `universitys` as u,`mm_messages_conv_users` as c WHERE u.Username='".$username ."' AND u.Password='".$pass."' AND u.ID=c.User_ID AND c.User_type='university' LIMIT 1";
				list($result,$a)=$db->query($sql);
				if($result && mysql_num_rows($result)>0){
				$this->type=='university';
					while ($podaci = mysql_fetch_array($result)){
						$this->id=$podaci['ID'];
						$this->name=$podaci['Contact_person'];
						$this->username=$podaci['Username'];
						$this->rank='university';
						$this->status=$podaci['Status'];
						$this->expire=$podaci['Date_of_expire'];
						$this->chat_id=$podaci['chat_id'];
						if($podaci['Status']<>'Ban'){ 							
							@$_SESSION['loged']='true';  
							@$_SESSION['name']=$this->name;
							@$_SESSION['username']=$this->username;
							@$_SESSION['rank']=$this->rank;
							@$_SESSION['status']=$this->status;
							@$_SESSION['id']=$this->id;
							@$_SESSION['expire']=$this->expire;
							@$_SESSION['chat_id']=$this->chat_id;
                                                        @$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
					   	}
                                                $now=time('Y-m-d');

                                                                if(strtotime($this->expire)<$now){
                                                                    $_SESSION['status']="not activated";
                                                                }
						if($podaci['Status']!="Active")
						{
							$_SESSION['status']="not activated";
						}
					}
				} else {
					$sql="SELECT u.ID,u.Contact_person,u.Username,u.visible, u.Status,c.ID as chat_id,u.Date_of_expire FROM `companys` as u,`mm_messages_conv_users` as c WHERE u.Username='". $username ."' AND u.Password='".$pass."' AND u.ID=c.User_ID AND c.User_type='company'  LIMIT 1";
					list($result,$a)=$db->query($sql);
						if($result && mysql_num_rows($result)>0){
						$this->type=='company';
							while ($podaci = mysql_fetch_array($result)){
								$this->id=$podaci['ID'];
								$this->name=$podaci['Contact_person'];
								$this->username=$podaci['Username'];
								$this->rank='company';
								$this->status=$podaci['Status'];
								$this->chat_id=$podaci['chat_id'];
								$this->expire=$podaci['Date_of_expire'];
                                                                @$_SESSION['visible']=$podaci['visible'];
								if($podaci['Status']<>'Ban'){ 
									@$_SESSION['loged']='true';  
									@$_SESSION['name']=$this->name;
									@$_SESSION['username']=$this->username;
									@$_SESSION['rank']=$this->rank;
									@$_SESSION['status']=$this->status;
									@$_SESSION['id']=$this->id;
									@$_SESSION['chat_id']=$this->chat_id;
									@$_SESSION['expire']=$this->expire;
                                                                        @$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
                                                                        
							   	}
                                                                $now=time('Y-m-d');
                                                                
                                                                if(strtotime($this->expire)<$now){
                                                                    $_SESSION['status']="not activated";
                                                                }
								if($podaci['Status']!="Active")
								{
									$_SESSION['status']="not activated";
								}
							}
						}
                                                else{
                                                    $sql="SELECT * FROM `admin` WHERE username='". $username ."' AND pass='".$pass."' ";
                                                       list($result,$a)=$db->query($sql);
                                                                if($result && mysql_num_rows($result)>0){
                                                                $this->type=='admin';
                                                                        while ($podaci = mysql_fetch_array($result)){
                                                                                $this->id=$podaci['ID'];
                                                                                $this->name=$podaci['name'];
                                                                                $this->username=$podaci['username'];
                                                                                $this->rank='admin';
                                                                                $this->status='active';
                                                                                        @$_SESSION['loged']='true';
                                                                                        @$_SESSION['name']=$this->name;
                                                                                        @$_SESSION['username']=$this->username;
                                                                                        @$_SESSION['rank']="admin";
                                                                                        @$_SESSION['status']=$this->status;
                                                                                        @$_SESSION['id']=$this->id;
                                                                                         @$_SESSION['admin']="true";
                                                                                         @$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
                                                                                       
                                                                                

                                                                        }
                                                                        
                                                                }
                                                }
				}
                                
			}
			if(@$_SESSION['status']=='')
			{
				echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/>The username or password you entered is incorrect<br/><br/><a href="" onclick="errorhide()">Close</a><br/></div>';
			}
				
			}
		
	}
	
	public function logout(){
            @$_SESSION[username]='';
		@$_SESSION[status]='';
		@$_SESSION[rank]='';
		@$_SESSION[id]='';
		@$_SESSION[name]='';
		@$_SESSION[expire]='';
		@$_SESSION[chat_id]='';
		session_destroy();
		
	}
	
	public function loged_form(){
		echo '<div id="article_mini_menu">
				  <div class="plugin_menu_box_main_container_header">User Panel</div>	
			      <table width="98%" border="0" cellpadding="3" cellspacing="2" class="plugin_menu_box_main_container">
			        <tr>
			          <td>Name: '.$this->name.'</td>
			        </tr>
			        <tr>
			          <td>Username: '.$this->username.'</td>
			        </tr>
			        <tr>
			          <td>Rank: '.$this->rank.'</td>
			        </tr>
			        <tr>
			          <td><a href="?menu=user&do=logout">Logout</a></td>
			        </tr>
			      </table>
				</div>';
	}
	
	public function login_form(){
		echo ('
		<div id="user_login_container">
			<form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form">
				<table width="220" height="106" border="0" cellpadding="1" cellspacing="0" class="plugin_menu_box_main_container">
            <tr>
              <td height="16" class="plugin_menu_box_main_container_header"> Login </td>
            </tr>
            <tr>
              <td height="84">
                <table width="220" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="78" height="29" ><div align="center" >Username:</div></td>
                    <td width="142"><input name="username" type="text" id="user" size="22" maxlength="15" /></td>
                  </tr>
                  <tr>
                    <td ><div align="center" >Password:</div></td>
                    <td><input name="password" type="password" id="pass" size="22" maxlength="15" /></td>
                  </tr>
                  <tr>
                    <td height="31" colspan="2"><div align="center">
                        <table width="173" height="33" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="user_login" type="submit" value="Login" /></td>
                          </tr>
                        </table>
                    </div></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
			</form>
		</div>
		');
	}
	
}

if(isset($_POST['user_login'])) {
	$add_user= new user_login(); 
	$add_user->login();	
}

?>