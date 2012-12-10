<?php
require_once('database.php');
require_once 'mail.php';
class universitys {
	private $ID;
	private $Logo;
	private $Name_of_University;
	private $Name_of_Faculty;
	private $Address;
	private $City;
	private $ZIP_code;
	private $Country;
	private $Contact_person;
	private $Phone_number;
	private $Fax;
	private $Web;
	private $Email;
	private $Facebook;
	private $Twitter;
	private $Other;
	private $Number_of_students;
	private $About_University;
	private $About_Faculty;
	private $Username;
	private $Password;
	private $Login_email;
	private $Date_of_exire;
	private $date_of_creation;

	
	public function __construct(){

	}
	
	public function load_university($publish_id){
		$db= new database();
		$sql="SELECT * FROM `universitys` as m WHERE m.ID='".$publish_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
		    while ($podaci = mysql_fetch_array($result)){
				$this->ID=$podaci['ID'];
				$this->Logo=$podaci['Logo'];
				$this->Name_of_University=$podaci['Name_of_University'];
				$this->Name_of_Faculty=$podaci['Name_of_Faculty'];
				$this->Address=$podaci['Address'];
				$this->City=$podaci['City'];
				$this->ZIP_code=$podaci['ZIP_code'];
				$this->Country=$podaci['Country'];
				$this->Contact_person=$podaci['Contact_person'];
				$this->Phone_number=$podaci['Phone_number'];
				$this->Fax=$podaci['Fax'];
				$this->Web=$podaci['Web'];
				$this->Email=$podaci['Email'];
				$this->Facebook=$podaci['Facebook'];
				$this->Twitter=$podaci['Twitter'];
				$this->Other=$podaci['Other'];
				$this->Number_of_students=$podaci['Number_of_students'];
				$this->About_University=$podaci['About_University'];
				$this->About_Faculty=$podaci['About_Faculty'];
				$this->Username=$podaci['Username'];
				$this->Password=$podaci['Password'];
				$this->Login_email=$podaci['Login_email'];
				$this->Date_of_exire=$podaci['Date_of_expire'];
				$this->date_of_creation=$podaci['date_of_creation'];
		    };
	    };
	}
	
	public function load_from_post(){
                $this->ID=$_POST['un_id'];
		$this->Name_of_University=addslashes($_POST['un_Name_of_University']);
		$this->Name_of_Faculty=addslashes($_POST['un_Name_of_Faculty']);
		$this->Address=addslashes($_POST['un_Address']);
		$this->City=addslashes($_POST['un_City']);
		$this->ZIP_code=addslashes(@$_POST['un_ZIP_code']);
		$this->Country=addslashes($_POST['un_Country']);
		$this->Contact_person=addslashes(@$_POST['un_Contact_person']);
		$this->Phone_number=addslashes(@$_POST['un_Phone_number']);
		$this->Fax=addslashes(@$_POST['un_Fax']);
		$this->Web=addslashes(@$_POST['un_Web']);
		$this->Email=addslashes(@$_POST['un_Email']);
		$this->Facebook=addslashes(@$_POST['un_Facebook']);
		$this->Twitter=addslashes(@$_POST['un_Twitter']);
		$this->Other=addslashes(@$_POST['un_Other']);
		$this->Number_of_students=addslashes(@$_POST['un_Number_of_students']);
		$this->About_University=addslashes(@$_POST['un_About_University']);
		$this->About_Faculty=addslashes(@$_POST['un_About_Faculty']);
		$this->Username=addslashes($_POST['un_Username']);
		$this->Password=$_POST['un_Password'];
		$this->Login_email=$_POST['un_Login_email'];
		$this->Date_of_exire=@$_POST['un_Date_of_exire'];
		$this->date_of_creation=@$_POST['un_date_of_creation'];
                if(@$_SESSION["captcha"]==$_POST["captcha"])
                            return true;
                        else{


                            //return false;
                            header("Location: index.php?cat=un&do=register&err=1");

                        }
	}
	
        public function load_from_first(){
                
		$_SESSION['un_Name_of_University']=addslashes($_POST['un_Name_of_University']);
		$_SESSION['un_Name_of_Faculty']=addslashes($_POST['un_Name_of_Faculty']);
		$_SESSION['un_Address']=addslashes($_POST['un_Address']);
		$_SESSION['un_City']=addslashes($_POST['un_City']);
		
		$_SESSION['un_Country']=addslashes($_POST['un_Country']);
		
		
		$_SESSION['un_Username']=addslashes($_POST['un_Username']);
		$_SESSION['un_Password']=$_POST['un_Password'];
		$_SESSION['un_Login_email']=$_POST['un_Login_email'];
                $_SESSION['un_Password1']=$_POST['un_Password1'];
                if(@$_SESSION["captcha"]==$_POST["captcha"])
                            return true;
                        else{


                            //return false;
                            header("Location: index.php?cat=un&do=register&err=1");

                        }
	}
        
        public function load_from_final(){
                
		$this->Name_of_University=$_SESSION['un_Name_of_University'];
		$this->Name_of_Faculty=$_SESSION['un_Name_of_Faculty'];
		$this->Address=$_SESSION['un_Address'];
		$this->City=$_SESSION['un_City'];
		
		$this->Country=$_SESSION['un_Country'];
		
		$this->Web=addslashes(@$_POST['un_Web']);
		
		$this->Number_of_students=addslashes(@$_POST['un_Number_of_students']);
		$this->About_University=addslashes(@$_POST['un_About_University']);
		$this->About_Faculty=addslashes(@$_POST['un_About_Faculty']);
		$this->Username=$_SESSION['un_Username'];
		$this->Password=$_SESSION['un_Password'];
		$this->Login_email=$_SESSION['un_Login_email'];
		
	}
        
        
	private function valid_email($email){
	    if (!preg_match("#^[^@]{1,64}@[^@]{1,255}$#", $email))
	        return false;
	    // Split it into sections to make life easier
	    $email_array = explode("@", $email);
	    $local_array = explode(".", $email_array[0]);
	    for ($i = 0; $i < sizeof($local_array); $i++){
	        if (!preg_match("#^(([A-Za-z0-9!$%&038;'*+/=?^_`{|}~-][A-Za-z0-9!$%&038;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$#",
	            $local_array[$i]))
	            return false;
	    }
	    if (!preg_match("^\[?[0-9\.]+\]?$", $email_array[1])){ 
	    // Check if domain is IP. If not, it should be valid domain name
	        $domain_array = explode(".", $email_array[1]);
	        if (sizeof($domain_array) < 2)
	            return false; // Not enough parts to domain
	        for ($i = 0; $i < sizeof($domain_array); $i++){
	            if (!preg_match("#^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$#", $domain_array[$i]))
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
	        return false; //toshort
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
		
		$sql="SELECT ID FROM `universitys` WHERE Username='".$username."'";	
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0) $c2=1;
		
		if($c2) return false;
		return true; 
	}
        public function mail_exist($mail){
		$db= new database();

		$c2=0;

		$sql="SELECT ID FROM `universitys` WHERE Login_email='".$mail."'";
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0) $c2=1;

		if($c2) return false;
		return true;
	}
	
	
	public function save_to_database(){
		$db= new database();
		if($this->user_exist($this->Username) &&  $this->valid_password($this->Password) && $this->Password==$_SESSION['un_Password1'] && $this->valid_username($this->Username) ){
			$sql="INSERT INTO `universitys` VALUES 
	 		(NULL,'img/thumbs/avatar.jpg','".htmlentities($this->Name_of_University)."','".htmlentities($this->Name_of_Faculty)."','".htmlentities($this->Address)."','".htmlentities($this->City)."','".$this->ZIP_code."','".htmlentities($this->Country)."','".htmlentities($this->Contact_person)."','".htmlentities($this->Phone_number)."','".htmlentities($this->Fax)."','".htmlentities($this->Web)."','".htmlentities($this->Email)."','".htmlentities($this->Facebook)."','".htmlentities($this->Twitter)."','".htmlentities($this->Other)."','".htmlentities($this->Number_of_students)."','".htmlentities($this->About_University)."','".htmlentities($this->About_Faculty)."','".htmlentities($this->Username)."',MD5('".$this->Password."'),'".$this->Login_email."','".$this->Date_of_exire."',NOW(),'Pending',0)";
			list($a,$this->id)=$db->query($sql);
			$this_id=$this->id;
			$sql="INSERT INTO `mm_messages_conv_users` VALUES(NULL,'".$this_id."','".$this->Username."','-1','university')";
			list($a,$a)=$db->query($sql);
                        $subject="Welcome to Lykeion";
                            $message="
                            <html>
                            <body bgcolor='#DCEEFC'>
                            <center>
                                <b>Welcome to <a href='http://lykeion.eestec.net'>Lykeion</a></b> <br>        
                                <a href='http://lykeion.eestec.net/lykeion.jpg'><img src='http://lykeion.eestec.net/lykeion.jpg'></a>
                            </center>
                            <br><br>
                            Dear Sir or Madam,<br><br>Thank you for registering on Lykeion website. We honestly hope that this website will fulfill your expectations. Your will recieve a mail when Administrator activates your account.<br>
                            <p>Your account info:</p><table>
                                <tr><td align='right'>Username:</td><td>".$this->Username."</td></tr>
                                <tr><td align='right'>Contact mail:</td><td>".$this->Email."</td></tr>
                            </table>
                            <p>By cooperating with EESTEC on Lykeion project, your University have chance to:</p>
                            <p><ul >
					<li><strong>announce Bachelor, Master       and PhD study programs</strong> on Lykeion portal</li>
					<li><strong>announce research       possibilities</strong> on your university on Lykeion portal</li>
					<li><strong>announce news</strong> and promotional activities of company on Lykeion portal</li>
					<li>access to<strong> Lykeion CV       database</strong> of students of technical sciences from whole Europe</li>
					<li>establish direct communication channel with most perspective       students of technical sciences and soft skills</li>
                            </ul></p>
                            <p>Students who apply in Lykeion database are not just ordinary students. Most of these students are/were active in international students organizations, so they possess huge motivation for pursuing international career, are conscious of internationality, they have experiences in teamwork, project management and acquire wide knowledge of soft skills.</p>
                            <br><br><p>Best Regards,</p>
                                <p>Lykeion website team</p
                                <img src='http://lykeion.eestec.net/images/lykeion-banner-v2.gif' width='300'>
                                <p>web: <a href='http://lykeion.eestec.net'>lykeion.eestec.net</a><br>
                                mail: <a href='mailto:lykeion@eestec.net'>lykeion@eestec.net</a><br>
                                <strong>POWER YOUR FUTURE</strong></p>
                             </body></html>";
                            $m=new mail();
                            $m->SendMail($this_id, "universitys", $subject, $message);
                             $subject="[Registration] New University just registered";
                            $message="<html>

                                <body>
                                <p>A new University, <strong>".$this->Name_of_University."</strong>, <strong>".$this->Name_of_Faculty."</strong> just registered on Lykeion website.</p>

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
		$sql="UPDATE `universitys` SET  Name_of_University='".htmlentities($this->Name_of_University,ENT_QUOTES, "UTF-8")."', Name_of_Faculty='".  htmlentities($this->Name_of_Faculty,ENT_QUOTES, "UTF-8")."', Address='".htmlentities($this->Address,ENT_QUOTES, "UTF-8")."', City='".htmlentities($this->City,ENT_QUOTES, "UTF-8")."', ZIP_code='".htmlentities($this->ZIP_code,ENT_QUOTES, "UTF-8")."', Country='".htmlentities($this->Country,ENT_QUOTES, "UTF-8")."', Contact_person='".htmlentities($this->Contact_person,ENT_QUOTES, "UTF-8")."', Phone_number='".htmlentities($this->Phone_number,ENT_QUOTES, "UTF-8")."', Fax='".htmlentities($this->Fax,ENT_QUOTES, "UTF-8")."', Web='".htmlentities($this->Web,ENT_QUOTES, "UTF-8")."', Email='".htmlentities($this->Email,ENT_QUOTES, "UTF-8")."', Facebook='".htmlentities($this->Facebook,ENT_QUOTES, "UTF-8")."', Twitter='".htmlentities($this->Twitter,ENT_QUOTES, "UTF-8")."', Other='".htmlentities($this->Other,ENT_QUOTES, "UTF-8")."', Number_of_students='".htmlentities($this->Number_of_students,ENT_QUOTES, "UTF-8")."', About_University='".htmlentities($this->About_University,ENT_QUOTES, "UTF-8")."', About_Faculty='".htmlentities($this->About_Faculty,ENT_QUOTES, "UTF-8")."' WHERE ID='".$this->ID."'";
		$db->query($sql);
                echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>Your profile is updated.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
	}
	
	public function delete_from_database(){
		$db= new database();
		$sql="DELETE FROM `universitys`  WHERE ID='".$this->id."'";
		$db->query($sql);
	}
	
 	public function editData(){
	echo '<div class="article">
            <form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form" class="studentform">
	
        <input type="hidden" name="un_id" value="'.$this->ID.'" id="un_id">
            <label>Name of University</label><input name="un_Name_of_University" class="lykeion_textbox" type="text" id="un_Name_of_University"  value="'.$this->Name_of_University.'"/>
			 <label>Name of Faculty</label><input name="un_Name_of_Faculty" class="lykeion_textbox" type="text" id="un_Name_of_Faculty"  value="'.$this->Name_of_Faculty.'"/> 
			 <label>Address</label><input name="un_Address" class="lykeion_textbox" type="text" id="un_Address" value="'.$this->Address.'"/> 
			 <label>City</label><input name="un_City" class="lykeion_textbox" type="text" id="un_City" value="'.$this->City.'"/>
			 <label>ZIP code</label><input name="un_ZIP_code" class="lykeion_textbox" type="text" id="un_ZIP_code" value="'.$this->ZIP_code.'"/> 
			 <label>Country</label><input name="un_Country" class="lykeion_textbox" type="text" id="un_Country" value="'.$this->Country.'"/> 
			 <label>Contact person</label><td width="365"><label> <input name="un_Contact_person" class="lykeion_textbox" type="text" id="un_Contact_person" size="65" maxlength="199" style="width:98%" value="'.$this->Contact_person.'"/> </label></td>  </tr>
			 <label>Phone number</label><input name="un_Phone_number" class="lykeion_textbox" type="text" id="un_Phone_number"  value="'.$this->Phone_number.'"/> 
			 <label>Fax</label><input name="un_Fax" class="lykeion_textbox" type="text" id="un_Fax" value="'.$this->Fax.'"/>
			 <label>Web</label><input name="un_Web" class="lykeion_textbox" type="text" id="un_Web" value="'.$this->Web.'"/>
			 <label>Email</label><input name="un_Email" class="lykeion_textbox" type="text" id="un_Email" value="'.$this->Email.'"/>
			 <label>Facebook</label><input name="un_Facebook" class="lykeion_textbox" type="text" id="un_Facebook" value="'.$this->Facebook.'"/>
			 <label>Twitter</label><input name="un_Twitter" class="lykeion_textbox" type="text" id="un_Twitter" value="'.$this->Twitter.'"/> 
			 <label>Other</label><input name="un_Other" class="lykeion_textbox" type="text" id="un_Other" value="'.$this->Other.'"/>
			 <label>Number of students</label><input name="un_Number_of_students" class="lykeion_textbox" type="text" id="un_Number_of_students"  value="'.$this->Number_of_students.'"/> 
			 <label>About University</label><textarea name="un_About_University" class="lykeion_textbox" type="text" id="un_About_University" cols="65" rows="4"  >'.$this->About_University.'</textarea>
			 <label>About Faculty</label><textarea name="un_About_Faculty" class="lykeion_textbox" type="text" id="un_About_Faculty" cols="65" rows="4" >'.$this->About_Faculty.'</textarea>
	<input type="submit" name="university_edit" class="btn" value="" />
		
		</form></div>';
 	}
        
        public function show_register_step2(){
	echo '<div id="content">
   <div id="simple-page-container">
                        <div id="head-section1">
                                <img src="images/icon-students.png" alt="Contact us" />
                                <h2>Step 1</h2>
                                <p>your university information</p>
                        </div>
                        <div id="head-section">
                                <img src="images/icon-universities.png" alt="Contact us" />
                                <h2>Step 2</h2>
                                <p>add your university information</p>
                        </div>
                         <div id="head-section1">
                                <img src="images/contact-us-icon.png" alt="Contact us" />
                                <h2>Step 3</h2>
                                <p>account activation</p>
                        </div>
                          <div class="clear"></div>
                        
                        <div id="main-section">
                                <div id="edit-cv-container">
            <form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form" class="studentform">
	
        
            
			
			 <label>Web</label><input name="un_Web" class="lykeion_textbox" type="text" id="un_Web" value="'.$this->Web.'"/>
			 
			 <label>Number of students</label><input name="un_Number_of_students" class="lykeion_textbox" type="text" id="un_Number_of_students"  value="'.$this->Number_of_students.'"/> 
			 <label>About University</label><textarea name="un_About_University" class="lykeion_textbox" type="text" id="un_About_University" cols="65" rows="4"  >'.$this->About_University.'</textarea>
			 <label>About Faculty</label><textarea name="un_About_Faculty" class="lykeion_textbox" type="text" id="un_About_Faculty" cols="65" rows="4" >'.$this->About_Faculty.'</textarea>
	<input type="submit" name="university_register_final" class="btn" value="" />
		
		</form></div>
                        </div>
                </div>
<div id="shadow-up"> </div>';
 	}
        
        public function show_register_final(){
	echo '<div id="content">
   <div id="simple-page-container">
                        <div id="head-section1">
                                <img src="images/icon-students.png" alt="Contact us" />
                                <h2>Step 1</h2>
                                <p>your university information</p>
                        </div>
                        <div id="head-section1">
                                <img src="images/icon-universities.png" alt="Contact us" />
                                <h2>Step 2</h2>
                                <p>add your university information</p>
                        </div>
                         <div id="head-section">
                                <img src="images/contact-us-icon.png" alt="Contact us" />
                                <h2>Step 3</h2>
                                <p>account activation</p>
                        </div>
                          <div class="clear"></div>
                        
                        <div id="main-section">
                                 <b>Thank you for registering.</b><br>
				<p>Your account will be activated by website team and you will be informed via email.</p>
                                <p>After that, we recommend you to update rest of your University/Faculty information!<br>
                                    <a href="index.php">Go to the Home page</a></p>
                        </div>
                </div>
<div id="shadow-up"> </div>';
 	}
	
	public function show_register_form(){
	echo ' <div id="content">
   <div id="simple-page-container">
                        <div id="head-section">
                                <img src="images/icon-students.png" alt="Contact us" />
                                <h2>Step 1</h2>
                                <p>your university information</p>
                        </div>
                        <div id="head-section1">
                                <img src="images/icon-universities.png" alt="Contact us" />
                                <h2>Step 2</h2>
                                <p>add your university information</p>
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
<form name="universityform" id="universityform" class="studentform" action="index.php" method="post">

	
			 <label>Name of University</label><input name="un_Name_of_University" class="lykeion_textbox" type="text" id="un_Name_of_University"  value="'.$this->Name_of_University.'"/> 
			 <label>Name of Faculty</label><input name="un_Name_of_Faculty" class="lykeion_textbox" type="text" id="un_Name_of_Faculty"  value="'.$this->Name_of_Faculty.'"/> 
			 <label>Address</label><input name="un_Address" class="lykeion_textbox" type="text" id="un_Address"  value="'.$this->Address.'"/> 
			 <label>City</label><input name="un_City" class="lykeion_textbox" type="text" id="un_City"  value="'.$this->City.'"/>
			 <label>Country</label><input name="un_Country" class="lykeion_textbox" type="text" id="un_Country"  value="'.$this->Country.'"/> 
			 <label>Login email</label> <input name="un_Login_email" class="lykeion_textbox" type="text" id="un_Login_email"  value="'.$this->Login_email.'"/>
			 <label>Username</label><input name="un_Username" class="lykeion_textbox" type="text" id="un_Username"  value="'.$this->Username.'"/> 
			 <label>Password</label><input name="un_Password" class="lykeion_textbox" type="password" id="un_Password"  value="'.$this->Password.'"/>
			 <label>Retype password</label><input name="un_Password1" class="lykeion_textbox" type="password" id="un_Password1"  value="'.$this->Password.'"/> <br>
		
                         <label>Enter 3 black symbols from image</label>
                        <img src="captcha.php" alt="captcha image"><br>
                       <input type="text" name="captcha" id="captcha" size="3" maxlength="3">
                     <input class="btn" type="submit" name="university_register" value="">
		
		</form>
                
</div>
                        </div>
                </div>
<div id="shadow-up"> </div>';
	
	}
		
}
	if(isset($_POST['university_register'])) {
		$add_student= new universitys();
		$true=$add_student->load_from_first();
                if($true==true)
                     header("Location:index.php?cat=un&do=register&step=2");  
	}
        
        if(isset($_POST['university_register_final'])) {
		$add_student= new universitys();
		$true=$add_student->load_from_final();
                
                    $add_student->save_to_database();
                    header("Location:index.php?cat=cm&do=register&step=3"); 
	}

	if(isset($_POST['university_edit'])) {
		$add_student= new universitys();
		$add_student->load_from_post();
		$add_student->update_to_database();
	}	
	

?>