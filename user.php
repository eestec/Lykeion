<?php

require_once 'database.php';
require_once 'mail.php';
class Students_user{
	private $ID;
	private $Name;
	private $Surname;
	private $City;
	private $Country;
	private $Date_of_birth;
	private $Email;
	private $Username;
	private $Password;
	private $Eestec;
	private $Photo;
	private $Status;
	private $date_of_creation;
	private $CV;
	private $Last_login;
        public $education_id;
        public $title;
        public $subject;
        public $org_name;
        public $org_type;
        public $org_address;
        public $org_city;
        public $org_country;
        public $edu_level;
        public $edu_field;
        public $org_fday;
        public $org_fmonth;
        public $org_fyear;
        public $org_tday;
        public $org_tmonth;
        public $org_tyear;
        public $desirede;
	
	public function __construct()
	{
		
		
	}
		
	public function valid_email($email){
	    if (preg_match("#^[]{1,64}[^]{1,255}$#", $email))
		{
                       return false;
		}
	    // Split it into sections to make life easier
	    $email_array = explode("@", $email);
	    $local_array = explode(".", $email_array[0]);
	    for ($i = 0; $i < sizeof($local_array); $i++){
	        if (!preg_match("#^(([A-Za-z0-9!$%&038;'*+/=?^{|}~-][A-Za-z0-9!$%&038;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))#",$local_array[$i]))
			{
                            return false;
			}
	    }
	    if (!preg_match("#^\[?[0-9\.]+\]?$#", $email_array[1])){ 
	    // Check if domain is IP. If not, it should be valid domain name
	        $domain_array = explode(".", $email_array[1]);
	        if (sizeof($domain_array) < 2)
			{
                            return false; // Not enough parts to domain
			}
	        for ($i = 0; $i < sizeof($domain_array); $i++){
	            if (!preg_match("#^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$#", $domain_array[$i]))
				{
                            return false;
				}
	        }
	    }
	    return true;
	}
 
	public function valid_username($username, $minlength = 3, $maxlength = 30){
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
	 
	    preg_match("#^[A-Za-z0-9_\-]+$#", $username,$result); //only A-Z, a-z and 0-9 are allowed
	 
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
	    preg_match("#^[A-Za-z0-9_\-]+$#", $pass,$result);
	    if ($result){
	        return true;
	    } else {
	        return false;
	    }
	    return false;
	}
	
	public function user_exist($username){
		$db= new database();
		$sql="SELECT ID FROM `users` WHERE Username='".$username."'";	
		list($result,$a)=$db->query($sql);
		$c1=0;
		if($result && mysql_num_rows($result)>0) $c1=1;
		
		
		if($c1) return false;
		return true; 
	}
        public function mail_exist($mail){
		$db= new database();
		$sql="SELECT s.Email,u.Email FROM `users` as u, students as s WHERE s.Email='".$mail."' or u.Email='".$mail."'";
		list($result,$a)=$db->query($sql);
		$c1=0;
		if($result && mysql_num_rows($result)>0) $c1=1;


		if($c1) return false;
		return true;
	}
	
	public function save_to_database(){
		$db= new database();
		$i=0;
		if($this->user_exist($this->Username)==false)
		{
			$i++;
			echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/><br/>Username exists<br/><br/><a href="index.php?cat=st&do=register" onclick="errorhide()">Close</a><br/></div>';
		}
                if($this->mail_exist($this->Email)==false)
		{
			$i++;
			echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/><br/>User with entered e-mail already exists<br/><br/><a href="index.php?cat=st&do=register" onclick="errorhide()">Close</a><br/></div>';
		}
		else if($this->valid_password($this->Password)==false && ($this->Password==$_SESSION['users_Password1'])==false && $i==0)
		{
			$i++;
			echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/><br/>Invalid password<br/><br/><a href="index.php?cat=st&do=register" onclick="errorhide()">Close</a><br/></div>';
		}
		else if($this->valid_username($this->Username)==false && $i==0)
		{
			$i++;
			echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/><br/>Invalid username. Username should not contain spaces or any other special characters.<br/><br/><a href="index.php?cat=st&do=register" onclick="errorhide()">Close</a><br/></div>';
		}
		else if($this->valid_email($this->Email)==false && $i==0)
		{
			$i++;
			echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/><br/>Invalid mail address<br/><br/><a href="index.php?cat=st&do=register" onclick="errorhide()">Close</a><br/></div>';
		}
                else{
                    if($i==0)
                    {
                            $sql="INSERT INTO `students` (Name, Surname, Country, City,Email, Desired_employment, Date_of_birth) VALUES
                                    ('".htmlentities($this->Name,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Surname,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Country)."','".htmlentities($this->City)."','".@$this->Email."', '".htmlentities($this->desirede)."', '".htmlentities($this->Date_of_birth)."')";
                            list($ba,$a)=$db->query($sql);
                            $this->CV=$a;
                             $activation=md5(time());
                            $sql="INSERT INTO `users` VALUES
                                     (NULL,'".htmlentities($this->Name,ENT_QUOTES, "UTF-8")."','".htmlentities($this->Surname,ENT_QUOTES, "UTF-8")."','".htmlentities($this->City)."','".htmlentities($this->Country)."','".$this->Date_of_birth."','".$this->Email."','".htmlentities($this->Username)."',MD5('".$this->Password."'),'".$this->Eestec."','img/thumbs/avatar.jpg','Pending',NOW(),'".$this->CV."',NOW(),'$activation','1')";
                            list($ba,$last_id)=$db->query($sql);
                            $slq1="INSERT INTO `mm_messages_conv_users` VALUES(NULL,'".$last_id."','".htmlentities($this->Username,ENT_QUOTES, "UTF-8")."','-1','student')";
                            list($a,$a)=$db->query($slq1);


			    
           
                for($i=0;$i<sizeof($this->education_id);$i++){
                     if($this->education_id[$i]==-1){
                         $sql="INSERT INTO education VALUES (NULL, '".$this->CV."','".addslashes($this->title[$i])."','".addslashes($this->subject[$i])."','".addslashes($this->org_name[$i])."','".addslashes($this->org_type[$i])."','".addslashes($this->org_address[$i])."','".addslashes($this->org_city[$i])."','".addslashes($this->org_country[$i])."','".addslashes($this->edu_level[$i])."','".addslashes($this->edu_field[$i])."','".addslashes($this->org_fday[$i])."','".addslashes($this->org_fmonth[$i])."','".addslashes($this->org_fyear[$i])."','".addslashes($this->org_tday[$i])."','".addslashes($this->org_tmonth[$i])."','".addslashes($this->org_tyear[$i])."')";
                        list($a,$this->education_id[$i])=$db->query($sql);
                    }
                    else{
                        $s="UPDATE education SET DAY_FROM='".$this->org_fday[$i]."', MONTH_FROM='".$this->org_fmonth[$i]."', YEAR_FROM='".$this->org_fyear[$i]."', DAY_TO='".$this->org_tday[$i]."', MONTH_TO='".$this->org_tmonth[$i]."',YEAR_TO='".$this->org_tyear[$i]."', TITLE='".addslashes($this->title[$i])."', SUBJECT='".addslashes($this->subject[$i])."', ORG_NAME='".$this->org_name[$i]."', ORG_TYPE='".addslashes($this->org_type[$i])."',ORG_ADDRESS='".  addslashes($this->org_address[$i])."', ORG_MUNIC='".  addslashes($this->org_city[$i])."',COUNTRY='".  addslashes($this->org_country[$i])."',EDULEVEL='".  addslashes($this->edu_level[$i])."',EDU_FIELD='".  addslashes($this->edu_field[$i])."' WHERE ID='".$this->education_id[$i]."'";
                        $db->query($s);
                    }
                }


                            $subject="[Lykeion] Welcome to Lykeion";
                            $message="
                            <html>
                            <body bgcolor='#DCEEFC'>
                            <center>
                                <b>Welcome to <a href='http://lykeion.eestec.net'>Lykeion</a></b> <br>        
                                <a href='http://lykeion.eestec.net/lykeion.jpg'><img src='http://lykeion.eestec.net/lykeion.jpg'></a>
                            </center>
                            <br><br>
                            Dear ".$this->Name." ".$this->Surname.",<br><p>Thank you for registering on Lykeion website.</p>
                                <p>Click on the following link to activate your account: <a href='http://lykeion.eestec.net/index.php?activate=".$activation."'>http://lykeion.eestec.net/index.php?activate=".$activation."</a></p>
                            <p>Be the master of your opportunities!</p>
                            <br><br><p>Best Regards,</p>
                                <p>Lykeion website team</p
                                <img src='http://lykeion.eestec.net/images/lykeion-banner-v2.gif' width='300'>
                                <p>web: <a href='http://lykeion.eestec.net'>lykeion.eestec.net</a><br>
                                mail: <a href='mailto:lykeion@eestec.net'>lykeion@eestec.net</a><br>
                                <strong>POWER YOUR FUTURE</strong></p>
                            </body></html>";
                            $m=new mail();
                            $m->SendMail($last_id, "users", $subject, $message);
                            /*$subject="[Registration] New Student just registered";
                            $message="<html>

                                <body>
                                <p>A new Student, <strong>".$this->Name." ".$this->Surname."</strong> just registered on Lykeion website.</p>

<p><a href='http://lykeion.eestec.net'>lykeion.eestec.net</a></p>
                                </body>
                                </html>";
                            $m->SendMail(1, "admin", $subject, $message);*/
                            header("Location: index.php?to=registered");
                    } else {
                            echo '
                                    <script type="text/javascript">
                                            function errorhide(){
                                                    $("#error_message").hide();
                                            }
                                    </script>
                                    <div id="error_message"><br/><br/>There was an error with entered data.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
                    };
                }
		
	}
	
	public function update_to_database(){
		$db= new database();
		$sql="UPDATE `users` SET , Name='".$this->Name."', Surname='".$this->Surname."', City='".$this->City."', Country='".$this->Country."', Date_of_birth='".$this->Date_of_birth."', Email='".$this->Email."', Username='".$this->Username."', Password='".$this->Password."', Eestec='".$this->Eestec."', Photo='".$this->Photo."', Status='".$this->Status."' )";
		list($a,$this->id)=$db->query($sql);
	}

       public function activate($a){
           $activation=addslashes($a);
           $db=new database();
            $db=new database();
                        $sql="UPDATE users SET Status='Active' WHERE activation='$activation'";
                        list($b,$n)=$db->query($sql);
                        if($n!=-1){
                            $tek='<div id="content">
		<div id="simple-page-container">
			<div id="head-section">
				<img src="images/terms-of-use-icon.jpg" alt="Contact us" />
				<h2>Activation done</h2>
				<p></p>
			</div>

			<div class="clear"></div>
			
			<div id="main-section">
				<p><strong>Your account is activated!</strong></p><p>Please go to the <a href="index.php">home</a> page to log in. </p>
				  </div></div>
	</div>
	
	<div id="shadow-down"></div>
	
	
	
</div>';
                            $sql="SELECT * FROM users WHERE activation='$activation'";
                            list($s,$a)=$db->query($sql);
                            while($row=mysql_fetch_array($s)){
                                $this->ID=$row['ID'];
                                $this->Name=$row['Name'];
                                $this->Surname=$row['Surname'];
                                $this->Username=$row['Username'];
                                $this->Email=$row['Email'];
                            }
                                  $mail=new mail();
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
                            $m->SendMail($this->ID, "users", $subject, $message);
                            return $tek;
                        }
                        else
                        {
                            $tek='<div align="left" style="margin-left:50px;">
				<p><strong></strong></p><p>There was an error while activating the account. Contact us for help. </p>
				  </div>';
                            return $tek;
                        }
       }
	
	public function load_from_database($id){
		$db= new database();
		$sql="SELECT * FROM students WHERE ID='".$id."'";
		list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0)
		while ($podaci = mysql_fetch_array($result))
		{
			$this->ID=$podaci['ID'];
			$this->Name=$podaci['Name'];
			$this->Surname=$podaci['Surname'];
			$this->City=$podaci['City'];
			$this->Country=$podaci['Country'];
			$this->Date_of_birth=$podaci['Date_of_birth'];
			$this->Email=$podaci['Email'];
			$this->Username=$podaci['Username'];
			$this->Password=$podaci['Password'];
			$this->Eestec=$podaci['Eestec'];
			$this->Photo=$podaci['Photo'];
			$this->Status=$podaci['Status'];
			$this->date_of_creation=$podaci['date_of_creation'];
			$this->CV=$podaci['CV'];
			$this->Last_login=$podaci['Last_login'];
		}
	}
	
	public function load_final(){
			$this->ID=$_SESSION['users_ID'];
			$this->Name=$_SESSION['users_Name'];
			$this->Surname=$_SESSION['users_Surname'];
			$this->City=$_SESSION['users_City'];
			$this->Country=$_SESSION['users_Country'];
			$this->Date_of_birth=$_SESSION['users_Date_of_birth'];
			$this->Email=$_SESSION['users_Email'];
			$this->Username=$_SESSION['users_Username'];
			$this->Password=$_SESSION['users_Password'];
			$this->Password1=$_SESSION['users_Password1'];
			$this->Eestec=$_SESSION['users_Eestec'];
			$this->Photo=$_SESSION['users_Photo'];
			$this->Status=$_SESSION['users_Status'];
			$this->date_of_creation=$_SESSION['users_date_of_creation'];
			$this->CV=$_SESSION['users_CV'];
			$this->Last_login=$_SESSION['users_Last_login'];
                        $this->desirede=htmlentities(@$_POST['stud_cv_Desired_employment'],ENT_QUOTES, "UTF-8");
                        $this->Date_of_birth=htmlentities(@$_POST['stud_cv_Date_of_birth'],ENT_QUOTES, "UTF-8");
                        $number=@$_POST['education_number'];
                        for($i=0;$i<$number;$i++){
                            $this->education_id[$i]=@$_POST['education_id'.$i];
                            $this->org_fday[$i]=@$_POST['org_fday'.$i];
                            $this->org_fmonth[$i]=@$_POST['org_fmonth'.$i];
                            $this->org_fyear[$i]=@$_POST['org_fyear'.$i];
                            $this->org_tday[$i]=@$_POST['org_tday'.$i];
                            $this->org_tmonth[$i]=@$_POST['org_tmonth'.$i];
                            $this->org_tyear[$i]=@$_POST['org_tyear'.$i];
                            $this->title[$i]=htmlentities(@$_POST['stud_cv_title'.$i],ENT_QUOTES, "UTF-8");
                            $this->org_name[$i]=htmlentities(@$_POST['stud_cv_org_name'.$i],ENT_QUOTES, "UTF-8");
                            $this->subject[$i]=htmlentities(@$_POST['stud_cv_subject'.$i],ENT_QUOTES, "UTF-8");
                            $this->org_type[$i]=htmlentities(@$_POST['stud_cv_org_type'.$i],ENT_QUOTES, "UTF-8");
                            $this->org_address[$i]=htmlentities(@$_POST['stud_cv_org_address'.$i],ENT_QUOTES, "UTF-8");
                            $this->edu_level[$i]=htmlentities(@$_POST['stud_cv_level'.$i],ENT_QUOTES, "UTF-8");
                            $this->org_city[$i]=htmlentities(@$_POST['stud_cv_org_city'.$i]);
                            $this->org_country[$i]=htmlentities(@$_POST['stud_cv_org_country'.$i],ENT_QUOTES, "UTF-8");
                            $this->edu_field[$i]=htmlentities(@$_POST['stud_cv_field'.$i],ENT_QUOTES, "UTF-8");
                        }
                        
	}
        
        public function load_personal(){
			$_SESSION['users_ID']=$_POST['users_ID'];
			$_SESSION['users_Name']=addslashes($_POST['users_Name']);
			$_SESSION['users_Surname']=addslashes($_POST['users_Surname']);
			$_SESSION['users_City']=addslashes($_POST['users_City']);
			$_SESSION['users_Country']=addslashes($_POST['users_Country']);
			$_SESSION['users_Date_of_birth']=@$_POST['users_Date_of_birth'];
			$_SESSION['users_Email']=addslashes($_POST['users_Email']);
			$_SESSION['users_Username']=addslashes($_POST['users_Username']);
			$_SESSION['users_Password']=$_POST['users_Password'];
			$_SESSION['users_Password1']=$_POST['users_Password1'];
			$_SESSION['users_Eestec']=@$_POST['users_Eestec'];
			$_SESSION['users_Photo']=@$_POST['users_Photo'];
			$_SESSION['users_Status']=@$_POST['users_Status'];
			$_SESSION['users_date_of_creation']=@$_POST['users_date_of_creation'];
			$_SESSION['users_CV']=@$_POST['users_CV'];
			$_SESSION['users_Last_login']=@$_POST['users_Last_login'];
                        if(@$_SESSION["captcha"]==$_POST["captcha"])
                            return true;
                        else{                
                            //return false;
                            header("Location: index.php?cat=st&do=register&err=1");

                        }
	}

	public function show_register_form(){
            $_SESSION['state']='registration';
            $_SESSION['step']=1;
            ?>
<div id="content">
   <div id="simple-page-container">
                        <div id="head-section">
                                <img src="images/icon-students.png" alt="Contact us" />
                                <h2>Step 1</h2>
                                <p>your profile information</p>
                        </div>
                        <div id="head-section1">
                                <img src="images/icon-universities.png" alt="Contact us" />
                                <h2>Step 2</h2>
                                <p>add your education information</p>
                        </div>
                         <div id="head-section1">
                                <img src="images/contact-us-icon.png" alt="Contact us" />
                                <h2>Step 3</h2>
                                <p>activate account</p>
                        </div>
                        

                        <div class="clear"></div>
                        
                        <div id="main-section">
                                <div id="edit-cv-container">
			<h2>Create account on Lykeion</h2>
                       <center><p><strong>To register, you have to finish all 3 steps</strong></p></center>
                        <form name="studentform" id="studentform" class="studentform" action="index.php" method="post">
			<label>Name </label>                      
                        
			<input type="text" name="users_Name"  required>
			<label>Surname</label>
			<input type="text" name="users_Surname" required>  
			<label>Country</label>
			<input type="text" name="users_Country" id="users_Country" required>
			<label>City</label>
			<input type="text" name="users_City" required>
			<label>Email</label>
			<input type="text" name="users_Email" required>
			<label>Username</label>
			<input type="text" name="users_Username" required>
			<label>Password</label>
			<input type="password" name="users_Password" id="users_Password" required>
			<label>Password (repeat)</label>
			<input type="password" name="users_Password1" id="users_Password1" required><br>
			<label>EESTEC</label>
			<input type="checkbox" name="users_Eestec" ><br>
			<label>Enter 3 black symbols from image</label><label> <img src="captcha.php" alt="captcha image"></label>
			<input type="text" name="captcha" id="captcha" size="3" maxlength="3">
			
                        <label></label>
			
			<input class="btn" type="submit" name="student_register" value="">
			 
		
                        </form>
		</div>
                        </div>
                </div>
<div id="shadow-up"> </div>

		
        
   
<?php
	}

public function show_register_last(){
             $_SESSION['step']=3;
            ?>
<div id="content">
   <div id="simple-page-container">

                        <div id="head-section1">
                                <img src="images/icon-students.png" alt="Contact us" />
                                <h2>Step 1</h2>
                                <p>your profile information</p>
                        </div>
                        <div id="head-section1">
                                <img src="images/icon-universities.png" alt="Contact us" />
                                <h2>Step 2</h2>
                                <p>add your education information</p>
                        </div>
                         <div id="head-section">
                                <img src="images/contact-us-icon.png" alt="Contact us" />
                                <h2>Step 3</h2>
                                <p>activate account</p>
                        </div>
                        

                        <div class="clear"></div>
                        
                        <div id="main-section"><br><br>
                                <b>Thank you for registering.</b><br>
				<b>Now, you need to activate your account. Activation link has been sent to your email.</b>
                                <p>After that, we recommend you to update rest of your CV data (work experience and other skills) and Find Your Opportunity!</p>
                        </div>
                </div>
<div id="shadow-up"> </div>

		
        
   
<?php
	}
        
        public function show_education_form(){
            $_SESSION['step']=2;
            ?>
    <div id="content">
   <div id="simple-page-container">
                        <div id="head-section1">
                                <img src="images/icon-students.png" alt="Contact us" />
                                <h2>Step 1</h2>
                                <p>your profile information</p>
                        </div>
                        <div id="head-section">
                                <img src="images/icon-universities.png" alt="Contact us" />
                                <h2>Step 2</h2>
                                <p>add your education information</p>
                        </div>
                         <div id="head-section1">
                                <img src="images/contact-us-icon.png" alt="Contact us" />
                                <h2>Step 3</h2>
                                <p>activate account</p>
                        </div>
                        

                        <div class="clear"></div>
                        
                        <div id="main-section">
		<div id="edit-cv-container">
			<h2>Add your education information</h2>
			
		<form class="studentform" id="studentform" action="index.php" method="post" name="form" enctype="multipart/form-data">
			

			
			
			
		
    <?php
           echo '<div id="education0">
               
                <input type="hidden" name="education_id0" id="education_id0" value="-1">';
                    echo '<label>Date of birth </label>
			<input type="date" name="stud_cv_Date_of_birth" required >
                        <label>Desired employment</label>
			<input type="text" name="stud_cv_Desired_employment" required><br>
                        <label>Dates of studying</label><input type="number" step="1" min=1 max=31 name="org_fday0">
                        <input type=number min=1 max=12 step=1 name="org_fmonth0">';
                    
                    echo '<input type=number min=1940 max=2020 step=1 name="org_fyear0">
                   -<input type=number step="1" min=1 max=31 name="org_tday0"><option>D</option><option>-></option>';
                    
                    echo ' <input type=number min=1 max=12 step=1 name="org_tmonth0">';
                  
                    echo '<input type=number min=1940 max=2020 step=1 name="org_tyear0"><br><br>';
                    
                    
                     ?>
		 <label>Title of qualification awarded</label> <input type="text" name="stud_cv_title0"  id="stud_cv_title0" required>
		 <label>Principal subjects/occupational skills covered</label> <textarea rows="5" cols="10" style="resize: none;" name="stud_cv_subject0" class="lykeion" id="stud_cv_subject0"  ></textarea> <br>
		 <label>Name organisation providing education or training</label> <input type="text" name="stud_cv_org_name0"  id="stud_cv_org_name0"  value="" required> <br /><br />
		<label>Type of organisation providing education or training</label> <input type="text" name="stud_cv_org_type0"  id="stud_cv_org_type0"  value=""> <br /><br />
                <label>Address of organisation</label> <input type="text" name="stud_cv_org_address0" id="stud_cv_org_address0"    value=""> 
                <label>City of organisation</label> <input type="text" name="stud_cv_org_city0"  id="stud_cv_org_city0"  value="" required>
                     <label>Country of organisation</label> <input type="text" name="stud_cv_org_country0"  id="stud_cv_org_country0"  value=""> 
                <label>Level in national or international classification</label> <input name="stud_cv_level0"  type="text" id="stud_cv_level0"  value="" list="level-list"/> <datalist id="level-list"> <option value="Bachelor"> <option value="Master"> <option value="PhD"> <option value="High School"></datalist> <br /><br />
                <label>Education field</label><input name="stud_cv_field0"  type="text" id="stud_cv_field0"  value="" required list="field-list"/><datalist id="field-list"><option value="Computer Science and Informatics"><option value="Automatic Control and Electronics"><option value="Electric Power Engineering"><option value="Telecommunication"><option value="Civil Engineering"><option value="Mechanical Engineering"><option value="Chemical Engineering"></datalist> 
                <a href=javascript:showhide("education0",-1);>Delete this education</a>
                </div>
                   <div id="new_education"></div>
   <a href=javascript:AddElement("education");>Add more education</a>
    <input type="hidden" name="education_number" id="education_number" value="1">
    <input type="submit" name="final_st_register" class="btn" value="" />
              </form>
		</div>
                        </div>
                </div>
</div>
<div id="shadow-up"> </div>
    <?php
        }
        
        public function subscribe_form(){
            echo '<div class="article">
                <form action="index.php" method="post" enctype="multipart/form-data" class="studentform" >
		  
        <p><strong>'.$_SESSION['info'].'</strong><br />
	        You are '; if($_SESSION['subscribe']==0) echo 'not '; echo 'subscribed to email notifications. <p>If you are subscribed, you will recieve emails about article updates. 
    If you are not subscribed, you will not recieve those emails, only ones regarding to the profile updates</p>
			<label>Recieve email notifications </label><input name="subscribe"  type="checkbox" id="subscribe"'; if($_SESSION['subscribe']==1) echo ' checked="checked"'; echo ' value="1" />
			
        <br>
         <input type="submit" name="subscribe_change" class="btn" value="" />
          
        
      
      </form></div>';
                        unset($_SESSION['info']);
            
        }
        public function subscribe_change(){
            $db=new database();
            if(@$_POST['subscribe']==1){
                $s="UPDATE users SET subscribe='1' WHERE ID ='".$_SESSION['id']."'";
                $db->query($s);
                $_SESSION['info']="You are subscribed now.";
                $_SESSION['subscribe']=1;
                header("Location:index.php?cat=st&do=edit_profile");
            }
            else{
                $s="UPDATE users SET subscribe='0' WHERE ID ='".$_SESSION['id']."'";
                $db->query($s);
                $_SESSION['info']="You are not subscribed anymore.";
                $_SESSION['subscribe']=0;
                header("Location:index.php?cat=st&do=edit_profile");
            }
        }
	
}
	if(isset($_POST['student_register'])) {
		$add_student= new Students_user();
		$true=$add_student->load_personal();
		if($true==true)
                    header("Location:index.php?cat=st&do=register&step=2");   
	}
        if(isset($_POST['final_st_register'])) {
		$add_student= new Students_user();
		$true=$add_student->load_final();
		$add_student->save_to_database();
 		header("Location:index.php?cat=st&do=register&step=3"); 
	}
        
        if(isset($_POST['subscribe_change'])) {
		$s= new Students_user();
                $s->subscribe_change();
		
	}
?>
