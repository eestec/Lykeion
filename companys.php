<?php
require_once('database.php');
require_once 'mail.php';
class companys {
	private $ID;
	private $Name;
	private $Field_of_work;
    private $About_comapny;
	private $Number_of_emplyees;
	private $Contact_person;
	private $Address;
	private $City;
	private $Country;
	private $Phone_number;
	private $Fax_number;
	private $Email;
	private $Web;
	private $Facebook;
	private $Linkedin;
	private $Twitter;
	private $Username;
	private $Password;
	private $Logo;
	private $Login_email;
	private $Date_of_exire;
	private $date_of_creation;
    private $views;
    private $visible;


	
	public function __construct(){

	}
	
	public function load_company($publish_id){
		$db= new database();
		$sql="SELECT * FROM `companys` as m WHERE m.ID='".$publish_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
		    while ($podaci = mysql_fetch_array($result)){
				$this->ID=$podaci['ID'];
				$this->Name=$podaci['Name'];
				$this->Field_of_work=$podaci['Field_of_work'];
				$this->Number_of_emplyees=$podaci['Number_of_emplyees'];
				$this->Contact_person=$podaci['Contact_person'];
				$this->Address=$podaci['Address'];
                                $this->About_comapny=$podaci['About_company'];
				$this->City=$podaci['City'];
				$this->Country=$podaci['Country'];
				$this->Phone_number=$podaci['Phone_number'];
				$this->Fax_number=$podaci['Fax_number'];
				$this->Email=$podaci['Email'];
				$this->Web=$podaci['Web'];
				$this->Facebook=$podaci['Facebook'];
				$this->Linkedin=$podaci['Linkedin'];
				$this->Twitter=$podaci['Twitter'];
				$this->Username=$podaci['Username'];
				$this->Password=$podaci['Password'];
				$this->Logo=$podaci['Logo'];
				$this->Login_email=$podaci['Login_email'];
				$this->Date_of_exire=$podaci['Date_of_expire'];
				$this->date_of_creation=$podaci['date_of_creation'];
                                $this->views=$podaci['views'];
                                $this->visible=$podaci['visible'];
		    };
	    };
	}
	
	public function load_first(){
		
		$_SESSION['cm_name']=strip_tags($_POST['cm_Name']);
		$_SESSION['cm_Address']=strip_tags($_POST['cm_Address']);
		$_SESSION['cm_City']=strip_tags($_POST['cm_City']);
		$_SESSION['cm_Country']=strip_tags($_POST['cm_Country']);
		$_SESSION['cm_Username']=strip_tags($_POST['cm_Username']);
		$_SESSION['cm_Password']=$_POST['cm_Password'];
                $_SESSION['cm_Password1']=$_POST['cm_Password1'];
		$_SESSION['cm_Login_email']=strip_tags($_POST['cm_Login_email']);
                if(@$_SESSION["captcha"]==$_POST["captcha"])
                            return true;
                        else{


                            //return false;
                            header("Location: index.php?cat=cm&do=register&err=1");

                        }
	}
        
        public function load_final(){
		$this->ID=@$_POST['cm_ID'];
		$this->Name=$_SESSION['cm_name'];
		$this->Field_of_work=strip_tags(@$_POST['cm_Field_of_work']);
		$this->Number_of_emplyees=strip_tags(@$_POST['cm_Number_of_emplyees']);
		$this->Contact_person=strip_tags(@$_POST['cm_Contact_person']);
		$this->Address=$_SESSION['cm_Address'];
		$this->City=$_SESSION['cm_City'];
		$this->Country=$_SESSION['cm_Country'];
                $this->About_comapny=strip_tags($_POST['cm_About_com']);
		$this->Phone_number=strip_tags(@$_POST['cm_Phone_number']);
		$this->Fax_number=strip_tags(@$_POST['cm_Fax_number']);
		$this->Email=strip_tags(@$_POST['cm_Email']);
		$this->Web=strip_tags(@$_POST['cm_Web']);
		$this->Facebook=strip_tags(@$_POST['cm_Facebook']);
		$this->Linkedin=strip_tags(@$_POST['cm_Linkedin']);
		$this->Twitter=strip_tags(@$_POST['cm_Twitter']);
		$this->Username=$_SESSION['cm_Username'];
		$this->Password=$_SESSION['cm_Password'];
		$this->Logo=strip_tags(@$_POST['cm_Logo']);
		$this->Login_email=$_SESSION['cm_Login_email'];
		$this->Date_of_exire=@$_POST['cm_Date_of_exire'];
		$this->date_of_creation=@$_POST['cm_date_of_creation'];
                
	}
        
        public function load_from_post(){
		$this->ID=@$_POST['cm_ID'];
		$this->Name=strip_tags($_POST['cm_Name']);
		$this->Field_of_work=strip_tags(@$_POST['cm_Field_of_work']);
		$this->Number_of_emplyees=strip_tags(@$_POST['cm_Number_of_emplyees']);
		$this->Contact_person=strip_tags(@$_POST['cm_Contact_person']);
		$this->Address=strip_tags($_POST['cm_Address']);
		$this->City=strip_tags($_POST['cm_City']);
		$this->Country=strip_tags($_POST['cm_Country']);
                $this->About_comapny=strip_tags($_POST['cm_About_com']);
		$this->Phone_number=strip_tags(@$_POST['cm_Phone_number']);
		$this->Fax_number=strip_tags(@$_POST['cm_Fax_number']);
		$this->Email=strip_tags(@$_POST['cm_Email']);
		$this->Web=strip_tags(@$_POST['cm_Web']);
		$this->Facebook=strip_tags(@$_POST['cm_Facebook']);
		$this->Linkedin=strip_tags(@$_POST['cm_Linkedin']);
		$this->Twitter=strip_tags(@$_POST['cm_Twitter']);
		$this->Username=strip_tags($_POST['cm_Username']);
		$this->Password=$_POST['cm_Password'];
		$this->Logo=strip_tags(@$_POST['cm_Logo']);
		$this->Login_email=strip_tags($_POST['cm_Login_email']);
		$this->Date_of_exire=@$_POST['cm_Date_of_exire'];
		$this->date_of_creation=@$_POST['cm_date_of_creation'];
                if(@$_SESSION["captcha"]==$_POST["captcha"])
                            return true;
                        else{


                            //return false;
                            header("Location: index.php?cat=cm&do=register&err=1");

                        }
	}
	
	private function valid_email($email){
	    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email))
	        return false;
	    // Split it into sections to make life easier
	    $email_array = explode("@", $email);
	    $local_array = explode(".", $email_array[0]);
	    for ($i = 0; $i < sizeof($local_array); $i++){
	        if (!ereg("^(([A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~-][A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
	            $local_array[$i]))
	            return false;
	    }
	    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])){ 
	    // Check if domain is IP. If not, it should be valid domain name
	        $domain_array = explode(".", $email_array[1]);
	        if (sizeof($domain_array) < 2)
	            return false; // Not enough parts to domain
	        for ($i = 0; $i < sizeof($domain_array); $i++){
	            if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i]))
	                 return false;
	        }
	    }
	    return true;
	}
 
	private function valid_username($username, $minlength = 3, $maxlength = 30){
	    $username = trim($username);
	    if (empty($username)){
	        return false; // it was empty
	    }
	    if (strlen($username) > $maxlength){
	        return false; // to long
	    }
	    if (strlen($username) < $minlength){
	        return false; //to short
	    }
	 
	    $result = preg_match("#^[A-Za-z0-9_\-]+$#", $username); //only A-Z, a-z and 0-9 are allowed
	 
	    if ($result){
	        return true; // ok no invalid chars
	    } else {
	        return false; //invalid chars found
	    }
	    return false;
	}
 
	private function valid_password($pass, $minlength = 6, $maxlength = 15){
	    $pass = trim($pass);
	    if (empty($pass)){
	        return false;
	    }
	    if (strlen($pass) < $minlength){
	        return false;
	    }
	    if (strlen($pass) > $maxlength){
	        return false;
	    }
	    $result = preg_match("#^[A-Za-z0-9_\-]+$#", $pass);
	    if ($result){
	        return true;
	    } else {
	        return false;
	    }
	    return false;
	}
	
	public function user_exist($username){
		$db= new database();
		
		$c2=0;
		
		$sql="SELECT ID FROM `companys` WHERE Username='".$username."'";
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0) $c2=1;
		
		
		if($c2) return false;
		return true; 
	}
        public function mail_exist($mail){
		$db= new database();

		$c2=0;

		$sql="SELECT ID FROM `companys` WHERE Login_email='".$mail."'";
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0) $c2=1;


		if($c2) return false;
		return true;
	}
	
	public function save_to_database(){
		$db= new database();
                $con=$db->open_connection(); 
		if($this->user_exist($this->Username) &&  $this->valid_password($this->Password) && $this->Password==$_SESSION['cm_Password1'] && $this->valid_username($this->Username)){
			
			$sql="INSERT INTO `companys` VALUES 
 			(NULL,'".  htmlentities($this->Name,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Field_of_work,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Number_of_emplyees,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Contact_person,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Address,ENT_QUOTES, "UTF-8")."','".htmlentities($this->City,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Country,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Phone_number,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Fax_number,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Email,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Web,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Facebook,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Linkedin,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Twitter,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Username,ENT_QUOTES, "UTF-8")."',MD5('".$this->Password."'),'img/thumbs/avatar.jpg','".htmlentities($this->Login_email,ENT_QUOTES, "UTF-8")."',NOW(),NOW(),'Pending','".htmlentities($this->About_comapny, ENT_QUOTES, "UTF-8")."',0,0)";
			list($a,$this->id)=$db->query($sql);
			$this_id=$this->id;
			$sql="INSERT INTO `mm_messages_conv_users` VALUES(NULL,'".$this_id."','".htmlentities($this->Username,ENT_QUOTES, "UTF-8")."','-1','company')";
			list($a,$a)=$db->query($sql);
                        $subject="[Lykeion] Welcome to Lykeion";
                            $message="
                            <html>
                            <body bgcolor='#DCEEFC'>
                            <center>
                                <b>Welcome to <a href='http://lykeion.eestec.net'>Lykeion</a></b> <br>        
                                <a href='http://lykeion.eestec.net/lykeion.jpg'><img src='http://lykeion.eestec.net/lykeion.jpg'></a>
                            </center>
                            <br><br>
                            Dear Sir or Madam,<br><br>Thank you for registering on Lykeion website. Your account will be activated by Administrator.</p><p> We honestly hope that this website will fulfill your expectations. Your will recieve a mail when Administrator activates your account<br><br>
                            <p>Your account info:</p><table>
                                <tr><td align='right'>Username:</td><td>".$this->Username."</td></tr>
                                <tr><td align='right'>Contact mail:</td><td>".$this->Email."</td></tr>
                            </table>
                            <p>By cooperating with EESTEC on Lykeion project, your Company have chance to:</p>
                            <p><ul>
					<li><strong>announce       internships and jobs</strong> offers on Lykeion portal</li>
					<li><strong>announce news</strong> and promotional activities of the company on Lykeion portal</li>
					<li>access to <strong>Lykeion CV       database</strong> of students of technical sciences from whole Europe</li>
					<li>establish direct communication channel with most perspective       students of technical sciences and soft skills</li>
			    </p></ul>
                            <p>Students who apply in Lykeion database are not just ordinary future employees. Most of these students are/were active in international students organizations such as EESTEC or IEEE student branches, so they possess huge motivation for pursuing international career, are conscious of internationality, they have experiences in teamwork, project management and acquire wide knowledge of soft skills.</p>
                            <br><br><p>Best Regards,</p>
                                <p>Lykeion website team</p
                                <img src='http://lykeion.eestec.net/images/lykeion-banner-v2.gif' width='300'>
                                <p>web: <a href='http://lykeion.eestec.net'>lykeion.eestec.net</a><br>
                                mail: <a href='mailto:lykeion@eestec.net'>lykeion@eestec.net</a><br>
                                <strong>POWER YOUR FUTURE</strong></p>
                             </body></html>";
                            $m=new mail();
                            $m->SendMail($this_id, "companys", $subject, $message);
                             $subject="[Registration] New Company just registered";
                            $message="<html>

                                <body>
                                <p>A new Company, <strong>".$this->Name."</strong> just registered on Lykeion website.</p>

<p><a href='http://lykeion.eestec.net'>lykeion.eestec.net</a></p>
                                </body>
                                </html>";
                            $m->SendMail(1, "admin", $subject, $message);
			header("Location: index.php?to=registered");
			return $this->id;
			
		}else {
			
			if(!$this->user_exist($this->Username)) echo '<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/><br/>Username exists<br/><br/><a href="index.php?cat=cm&do=register" onclick="errorhide()">Close</a><br/></div>';
			else if(!$this->mail_exist($this->Email)) echo '<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/><br/>Entered e-mail already exists<br/><br/><a href="index.php?cat=cm&do=register" onclick="errorhide()">Close</a><br/></div>';
                        else if(!$this->valid_password($this->Password)) echo '<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/><br/>Invalid password<br/><br/><a href="index.php?cat=cm&do=register" onclick="errorhide()">Close</a><br/></div>';
			
			//if(!$this->valid_email($this->Email)) echo 'E-mail is not valid<br/>';
			else if(!$this->valid_username($this->Username)) echo '<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/><br/>Invalid username<br/><br/><a href="index.php?cat=cm&do=register" onclick="errorhide()">Close</a><br/></div>';
		};
	}
	
	public function update_to_database(){
		$db= new database();
                $con=$db->open_connection();
		$sql=sprintf("UPDATE `companys` SET Name='%s', Field_of_work='%s', Number_of_emplyees='%s', Contact_person='%s', Address='%s', City='%s', Country='%s', Phone_number='%s',  Fax_number='%s', Email='%s', Web='%s', Facebook='%s', Linkedin='%s', Twitter='%s', About_company='%s' WHERE ID='".$this->ID."'",
                        mysql_real_escape_string($this->Name),mysql_real_escape_string($this->Field_of_work),mysql_real_escape_string($this->Number_of_emplyees),mysql_real_escape_string($this->Contact_person),mysql_real_escape_string($this->Address),mysql_real_escape_string($this->City),mysql_real_escape_string($this->Country),mysql_real_escape_string($this->Phone_number),mysql_real_escape_string($this->Fax_number),mysql_real_escape_string($this->Email),mysql_real_escape_string($this->Web),mysql_real_escape_string($this->Facebook),mysql_real_escape_string($this->Linkedin),mysql_real_escape_string($this->Twitter), mysql_real_escape_string($this->About_comapny));
		//$db->query($sql);
                
                if(mysql_query($sql)) {
                     echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/>Profile updated.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
                }
                else echo mysql_error ();
                mysql_close($con);
               
	}
	
	public function delete_from_database(){
		$db= new database();
		$sql="DELETE FROM companys  WHERE ID='".$this->id."'";
		$db->query($sql);
	}
	
	public function editData(){
	echo '<form action="index.php" method="post" enctype="multipart/form-data" name="companyeditform" id="companyeditform" class="studentform">
            
                <label>Name</label><input name="cm_Name" class="lykeion_textbox" type="text" id="cm_Name" value="'.$this->Name.'"/> 
		 <label>Field of work</label><input name="cm_ID" class="lykeion_textbox" type="hidden" id="cm_ID"  value="'.$this->ID.'"/> <input name="cm_Field_of_work" class="lykeion_textbox" type="text" id="cm_Field_of_work" value="'.$this->Field_of_work.'"/> 
		 <label>About the company</label><textarea name="cm_About_com" class="lykeion_textbox" id="cm_About_com" rows=5 cols=70 >'.$this->About_comapny.'</textarea> 
		<label>Number of employees</label> <input name="cm_Number_of_emplyees" class="lykeion_textbox" type="text" id="cm_Number_of_emplyees" value="'.$this->Number_of_emplyees.'"/> 
                <label>Contact person</label><input name="cm_Contact_person" class="lykeion_textbox" type="text" id="cm_Contact_person"  value="'.$this->Contact_person.'"/> 
		 <label>Address</label><input name="cm_Address" class="lykeion_textbox" type="text" id="cm_Address" value="'.$this->Address.'"/> 
		 <label>City</label><input name="cm_City" class="lykeion_textbox" type="text" id="cm_City"  value="'.$this->City.'"/> 
		 <label>Country</label><input name="cm_Country" class="lykeion_textbox" type="text" id="cm_Country"  value="'.$this->Country.'"/>
		 <label>Phone number</label><input name="cm_Phone_number" class="lykeion_textbox" type="text" id="cm_Phone_number"  value="'.$this->Phone_number.'"/>
		 <label>Fax number</label><input name="cm_Fax_number" class="lykeion_textbox" type="text" id="cm_Fax_number"  value="'.$this->Fax_number.'"/>
		 <label>Email</label> <input name="cm_Email" class="lykeion_textbox" type="text" id="cm_Email"  value="'.$this->Email.'"/> 
		 <label>Web</label><input name="cm_Web" class="lykeion_textbox" type="text" id="cm_Web"  value="'.$this->Web.'"/> 
		 <label>Facebook</label><input name="cm_Facebook" class="lykeion_textbox" type="text" id="cm_Facebook"  value="'.$this->Facebook.'"/> 
		 <label>LinkedIn</label><input name="cm_Linkedin" class="lykeion_textbox" type="text" id="cm_Linkedin"  value="'.$this->Linkedin.'"/> 
		 <label>Twitter</label><input name="cm_Twitter" class="lykeion_textbox" type="text" id="cm_Twitter"  value="'.$this->Twitter.'"/> 
		<input type="submit" name="company_edit" class="btn" value="" />
		
		</form>';
	}
	
	public function show_register_form(){
	echo '
            <div id="content">
   <div id="simple-page-container">
                        <div id="head-section">
                                <img src="images/icon-students.png" alt="Contact us" />
                                <h2>Step 1</h2>
                                <p>your company information</p>
                        </div>
                        <div id="head-section1">
                                <img src="images/icon-universities.png" alt="Contact us" />
                                <h2>Step 2</h2>
                                <p>add your company information</p>
                        </div>
                         <div id="head-section1">
                                <img src="images/contact-us-icon.png" alt="Contact us" />
                                <h2>Step 3</h2>
                                <p>account activation</p>
                        </div>
                          <div class="clear"></div>
                        
                        <div id="main-section">
                                <div id="edit-cv-container">
			<h2>Create account on Lykeion</h2>
                        <center><p><strong>To register, you have to finish all 3 steps</strong></p></center>
             <form name="companyform" id="companyform" class="studentform" action="index.php" method="post">
		
		 <label>Name</label><input name="cm_Name" class="lykeion_textbox" type="text" id="cm_Name" value="'.$this->Name.'"/> 
		 <label>Address</label><input name="cm_Address" class="lykeion_textbox" type="text" id="cm_Address"  value="'.$this->Address.'"/>
		 <label>City</label><input name="cm_City" class="lykeion_textbox" type="text" id="cm_City"  value="'.$this->City.'"/>
		 <label>Country</label><input name="cm_Country" class="lykeion_textbox" type="text" id="cm_Country" value="'.$this->Country.'"/>
		 <label>Login email</label><input name="cm_Login_email" class="lykeion_textbox" type="text" id="cm_Login_email"  value="'.$this->Login_email.'"/> 
		 <label>Username</label><input name="cm_Username" class="lykeion_textbox" type="text" id="cm_Username"  value="'.$this->Username.'"/> 
		 <label>Password</label><input name="cm_Password" class="lykeion_textbox" type="password" id="cm_Password"  value="'.$this->Password.'"/> 
		 <label>Retype password</label><input name="cm_Password1" class="lykeion_textbox" type="password" id="cm_Password1" value="'.$this->Password.'"/> 
		  <br><label>Enter 3 black symbols from image</label>
                        <img src="captcha.php" alt="captcha image"><br>
                        <input type="text" name="captcha" id="captcha" size="3" maxlength="3">
                        
                    <input class="btn" type="submit" name="company_register" value="">
				</form>
                                
 </form>
		</div>
                        </div>
                </div>
<div id="shadow-up"> </div>';
	}
        
        public function show_register_final(){
	echo ' <div id="content">
   <div id="simple-page-container">
                        <div id="head-section1">
                                <img src="images/icon-students.png" alt="Contact us" />
                                <h2>Step 1</h2>
                                <p>your company information</p>
                        </div>
                        <div id="head-section">
                                <img src="images/icon-universities.png" alt="Contact us" />
                                <h2>Step 2</h2>
                                <p>add your company information</p>
                        </div>
                         <div id="head-section1">
                                <img src="images/contact-us-icon.png" alt="Contact us" />
                                <h2>Step 3</h2>
                                <p>account activation</p>
                        </div>
                          <div class="clear"></div>
                        
                        <div id="main-section">
                                <div id="edit-cv-container">
			<h2>Create account on Lykeion</h2>
            
<form action="index.php" method="post" enctype="multipart/form-data" name="companyeditform" id="companyeditform" class="studentform">
            
                 
		 <label>Field of work</label><input name="cm_ID" class="lykeion_textbox" type="hidden" id="cm_ID"  value="'.$this->ID.'"/> <input name="cm_Field_of_work" class="lykeion_textbox" type="text" id="cm_Field_of_work" value="'.$this->Field_of_work.'"/> 
		 <label>About the company</label><textarea name="cm_About_com" class="lykeion_textbox" id="cm_About_com" rows=5 cols=48 >'.$this->About_comapny.'</textarea> 
		<label>Number of employees</label> <input name="cm_Number_of_emplyees" class="lykeion_textbox" type="text" id="cm_Number_of_emplyees" value="'.$this->Number_of_emplyees.'"/> 
                <label>Contact person</label><input name="cm_Contact_person" class="lykeion_textbox" type="text" id="cm_Contact_person"  value="'.$this->Contact_person.'"/>  
		 <label>Web</label><input name="cm_Web" class="lykeion_textbox" type="text" id="cm_Web"  value="'.$this->Web.'"/> 
		 <label>Facebook</label><input name="cm_Facebook" class="lykeion_textbox" type="text" id="cm_Facebook"  value="'.$this->Facebook.'"/> 
		 <label>LinkedIn</label><input name="cm_Linkedin" class="lykeion_textbox" type="text" id="cm_Linkedin"  value="'.$this->Linkedin.'"/> 
		 <label>Twitter</label><input name="cm_Twitter" class="lykeion_textbox" type="text" id="cm_Twitter"  value="'.$this->Twitter.'"/> 
		<input type="submit" name="company_register_final" class="btn" value="" />
		
		</form>
                
</div>
                        </div>
                </div>
<div id="shadow-up"> </div>';
	}
        
        public function show_register_last(){
             $_SESSION['step']=3;
            ?>
<div id="content">
   <div id="simple-page-container">

                       <div id="head-section1">
                                <img src="images/icon-students.png" alt="Contact us" />
                                <h2>Step 1</h2>
                                <p>your company information</p>
                        </div>
                        <div id="head-section1">
                                <img src="images/icon-universities.png" alt="Contact us" />
                                <h2>Step 2</h2>
                                <p>add your company information</p>
                        </div>
                         <div id="head-section">
                                <img src="images/contact-us-icon.png" alt="Contact us" />
                                <h2>Step 3</h2>
                                <p>account activation</p>
                        </div>
                        

                        <div class="clear"></div>
                        
                        <div id="main-section"><br><br>
                                <b>Thank you for registering.</b><br>
				<p>Your account will be activated by website team and you will be informed via email.</p>
                                <p>After that, we recommend you to update rest of your Company information!<br>
                                    <a href="index.php">Go to the Home page</a></p>
                        </div>
                </div>
<div id="shadow-up"> </div>

		
        
   
<?php
	}
		
}
	if(isset($_POST['company_register'])) {
		$add_student= new companys();
		$true=$add_student->load_first();
                if($true==true)
                    header("Location:index.php?cat=cm&do=register&step=2");   
	}
        if(isset($_POST['company_register_final'])) {
		$add_student= new companys();
		$add_student->load_final();
               $add_student->save_to_database();
                   header("Location:index.php?cat=cm&do=register&step=3");  
	}	
	if(isset($_POST['company_edit'])) {
		$add_student= new companys();
		$add_student->load_from_post();
		$add_student->update_to_database();
	}
	
?>
