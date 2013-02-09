<?php
@session_start();
require_once 'database.php';
class Students_cv{
	public $ID;
	public $Name;
	public $Surname;
	public $Date_of_birth;
        public $Country_code;
	public $Country;
	public $City;
        public $Photo;
        public $Postal_code;
	public $Address;
	public $Phone_number;
	public $Email;
	public $Fax;
	public $Gender;
        public $Nationality;
        public $Desired_code;
        public $Desired_employment;
        public $Mother_language;
        public $Motherlang_code;
        public $Social_skills;
	public $Organisational_skills;
	public $Technical_skills;
	public $Computer_skills;
	public $Artistic_skills;
	public $Other_skills;
	public $Driving_licence;
	public $Additional_information;
	public $Annexes;
        public $work_id;
        public $fyear;
        public $fmonth;
        public $fday;
        public $tyear;
        public $tmonth;
        public $tday;
        public $code_position;
        public $position;
        public $activities;
        public $work_name;
        public $work_adress;
        public $work_city;
        public $pcode;
        public $work_country;
        public $work_country_code;
        public $sector_code;
        public $sector;
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
        public $language_id;
        public $language_code;
        public $olanguage;
        public $listening;
        public $reading;
        public $spoken_interaction;
        public $spoken_production;
        public $writing;		
	public function save_to_database(){
		$db= new database();
		$sql="INSERT INTO `students` VALUES 
 			(NULL,'".addslashes($this->Name)."','".addslashes($this->Surname)."','".addslashes($this->Date_of_birth)."','".addslashes($this->Country)."','".addslashes($this->City)."','".addslashes($this->Address)."','".addslashes($this->Phone_number)."','".addslashes($this->Email)."','".addslashes($this->Fax)."','".$this->Gender."','".addslashes($this->Desired_employment)."','".$this->Mother_tongue."','".addslashes($this->Social_skills)."','".addslashes($this->Organisational_skills)."','".addslashes($this->Technical_skills)."','".addslashes($this->Computer_skills)."','".addslashes($this->Artistic_skills)."','".addslashes($this->Other_skills)."','".$this->Driving_licence."','".addslashes($this->Additional_information)."','".addslashes($this->Annexes)."','".addslashes($this->Country_code)."','".addslashes($this->Postal_code)."','".addslashes($this->Desired_code)."','".addslashes($this->Motherlang_code)."')";
		list($a,$this->ID)=$db->query($sql);
                
                    $sql="INSERT INTO work_experience VALUES (NULL, '".$this->ID."','".addslashes($this->fday[$i])."','".addslashes($this->fmonth[$i])."','".addslashes($this->fyear[$i])."','".addslashes($this->tday[$i])."','".addslashes($this->tmonth[$i])."','".addslashes($this->tyear[$i])."','".addslashes($this->code_position[$i])."','".addslashes($this->position[$i])."','".addslashes($this->activities[$i])."','".addslashes($this->work_name[$i])."','".addslashes($this->work_adress[$i])."','".addslashes($this->work_city[$i])."','".addslashes($this->pcode[$i])."','".addslashes($this->work_country_code[$i])."','".addslashes($this->work_country[$i])."','".addslashes($this->sector_code[$i])."','".addslashes($this->sector[$i])."')";
                    list($a,$this->work_id)=$db->query($sql);
                

                echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>Your CV is saved.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
	}
	
	public function update_to_database_personal($redirect=0){
		$db= new database(); 
		$sql="UPDATE `students` SET  Name='".addslashes($this->Name)."', Surname='".addslashes($this->Surname)."', Date_of_birth='".addslashes($this->Date_of_birth)."', Country='".addslashes($this->Country)."', City='".addslashes($this->City)."', Address='".addslashes($this->Address)."', Phone_number='".addslashes($this->Phone_number)."', Email='".addslashes($this->Email)."', Nationality='".addslashes($this->Nationality)."', Fax='".addslashes($this->Fax)."', Gender='".$this->Gender."', Desired_employment='".addslashes($this->Desired_employment)."', Country_code='".$this->Country_code."', Postal_code='".$this->Postal_code."' WHERE ID='".$this->ID."'";
                
		
		list($a,$this->id)=$db->query($sql);
                $s="UPDATE users SET Name='".$this->Name."', Surname='".$this->Surname."', Date_of_birth='".$this->Date_of_birth."', Country='".$this->Country."', City='".$this->City."', Email='".$this->Email."' WHERE CV='".$this->ID."'";
                list($a,$b)=$db->query($s);
                if($redirect==0)
                    header("Location: index.php?cat=st&do=edit_cv_personal");
        }
        public function update_to_database_work($redirect=0){
            $db= new database();
            $this->ID=$_SESSION['cv_id'];
                for($i=0;$i<sizeof($this->work_id);$i++){  
                    if($this->work_id[$i]==-1){
                         $sql="INSERT INTO work_experience VALUES (NULL, '".$this->ID."','".addslashes($this->fday[$i])."','".addslashes($this->fmonth[$i])."','".addslashes($this->fyear[$i])."','".addslashes($this->tday[$i])."','".addslashes($this->tmonth[$i])."','".addslashes($this->tyear[$i])."','".addslashes($this->code_position[$i])."','".addslashes($this->position[$i])."','".addslashes($this->activities[$i])."','".addslashes($this->work_name[$i])."','".addslashes($this->work_adress[$i])."','".addslashes($this->work_city[$i])."','".addslashes($this->pcode[$i])."','".addslashes($this->work_country_code[$i])."','".addslashes($this->work_country[$i])."','".addslashes($this->sector_code[$i])."','".addslashes($this->sector[$i])."')";
                        list($a,$this->work_id[$i])=$db->query($sql);
                    }
                    else{
                        $s="UPDATE work_experience SET DAY_FROM='".addslashes($this->fday[$i])."', MONTH_FROM='".addslashes($this->fmonth[$i])."', YEAR_FROM='".addslashes($this->fyear[$i])."', DAY_TO='".addslashes($this->tday[$i])."', MONTH_TO='".addslashes($this->tmonth[$i])."',YEAR_TO='".addslashes($this->tyear[$i])."', CODE_POSITION='".addslashes($this->code_position[$i])."', WPOSITION='".addslashes($this->position[$i])."', ACTIVITIES='".addslashes($this->activities[$i])."', EMPLOYER_NAME='".addslashes($this->work_name[$i])."',EMPLOYER_ADDRESS='".  addslashes($this->work_adress[$i])."', EMPLOYER_MUNIC='".  addslashes($this->work_city[$i])."',EMPLOYER_ZCODE='".  addslashes($this->pcode[$i])."',CODE_COUNTRY='".  addslashes($this->work_country_code[$i])."',COUNTRY='".  addslashes($this->work_country[$i])."',CODE_SECTOR='".  addslashes($this->sector_code[$i])."', SECTOR='".  addslashes($this->sector[$i])."' WHERE ID='".$this->work_id[$i]."'";
                        $db->query($s);
                    }
                    
                }
                if($redirect==0)
                    header("Location: index.php?cat=st&do=edit_cv_work");
        }
        public function update_to_database_education($redirect=0){
            $db= new database();
            $this->ID=$_SESSION['cv_id'];
                for($i=0;$i<sizeof($this->education_id);$i++){
                     if($this->education_id[$i]==-1){
                         $sql="INSERT INTO education VALUES (NULL, '".$this->ID."','".addslashes($this->title[$i])."','".addslashes($this->subject[$i])."','".addslashes($this->org_name[$i])."','".addslashes($this->org_type[$i])."','".addslashes($this->org_address[$i])."','".addslashes($this->org_city[$i])."','".addslashes($this->org_country[$i])."','".addslashes($this->edu_level[$i])."','".addslashes($this->edu_field[$i])."','".addslashes($this->org_fday[$i])."','".addslashes($this->org_fmonth[$i])."','".addslashes($this->org_fyear[$i])."','".addslashes($this->org_tday[$i])."','".addslashes($this->org_tmonth[$i])."','".addslashes($this->org_tyear[$i])."')";
                        list($a,$this->education_id[$i])=$db->query($sql);
                    }
                    else{
                        $s="UPDATE education SET DAY_FROM='".$this->org_fday[$i]."', MONTH_FROM='".$this->org_fmonth[$i]."', YEAR_FROM='".$this->org_fyear[$i]."', DAY_TO='".$this->org_tday[$i]."', MONTH_TO='".$this->org_tmonth[$i]."',YEAR_TO='".$this->org_tyear[$i]."', TITLE='".addslashes($this->title[$i])."', SUBJECT='".addslashes($this->subject[$i])."', ORG_NAME='".$this->org_name[$i]."', ORG_TYPE='".addslashes($this->org_type[$i])."',ORG_ADDRESS='".  addslashes($this->org_address[$i])."', ORG_MUNIC='".  addslashes($this->org_city[$i])."',COUNTRY='".  addslashes($this->org_country[$i])."',EDULEVEL='".  addslashes($this->edu_level[$i])."',EDU_FIELD='".  addslashes($this->edu_field[$i])."' WHERE ID='".$this->education_id[$i]."'";
                        $db->query($s);
                    }
                }
                if($redirect==0)
                    header("Location: index.php?cat=st&do=edit_cv_education");
        }
        public function update_to_database_language($redirect=0){
            $db= new database();
            $this->ID=$_SESSION['cv_id'];
                 for($i=0;$i<sizeof($this->language_id);$i++){
                     if($this->language_id[$i]==-1){
                         $sql="INSERT INTO languagelist VALUES (NULL, '".$this->ID."','".addslashes($this->language_code[$i])."','".addslashes($this->olanguage[$i])."','".addslashes($this->listening[$i])."','".addslashes($this->reading[$i])."','".addslashes($this->spoken_interaction[$i])."','".addslashes($this->spoken_production[$i])."','".addslashes($this->writing[$i])."')";
                        list($a,$this->work_id[$i])=$db->query($sql);
                    }
                    else{
                        $s="UPDATE languagelist SET CODE_LANGUAGE='".addslashes($this->language_code[$i])."', OLANGUAGE='".addslashes($this->olanguage[$i])."', LISTENING='".addslashes($this->listening[$i])."', READING='".addslashes($this->reading[$i])."', SPOKEN_INTERACTION='".addslashes($this->spoken_interaction[$i])."', SPOKEN_PRODUCTION='".$this->spoken_production[$i]."', WRITING='".addslashes($this->writing[$i])."' WHERE ID='".$this->language_id[$i]."'";
                        $db->query($s);
                    }
                }
                //header("Location: index.php?cat=st&do=edit_cv_other");
        }
        public function update_to_database_other($redirect=0){
            $db= new database();
            $this->ID=$_SESSION['cv_id'];
            $sql="UPDATE students SET mother_tongue='".$this->Mother_tongue."', social_skills='".addslashes($this->Social_skills)."', organisational_skills='".addslashes($this->Organisational_skills)."', technical_skills='".addslashes($this->Technical_skills)."', computer_skills='".addslashes($this->Computer_skills)."', artistic_skills='".addslashes($this->Artistic_skills)."', other_skills='".addslashes($this->Other_skills)."', driving_licence='".$this->Driving_licence."', additional_information='".addslashes($this->Additional_information)."', annexes='".addslashes($this->Annexes)."' WHERE ID='".$this->ID."'";
            $db->query($sql);
            if($redirect==0)
                header("Location: index.php?cat=st&do=edit_cv_other");

        }
               
	
	
	public function load_from_database($id){
		$db= new database();
		$sql="SELECT * FROM students as s, users as u WHERE s.ID='".$id."' AND u.CV='".$id."'";
		list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0)
		while ($podaci = mysql_fetch_array($result))
		{
			$this->ID=$podaci['ID'];
			$this->Name=$podaci['Name'];
			$this->Surname=$podaci['Surname'];
                        $this->Photo=$podaci['Photo'];
			$this->Date_of_birth=$podaci['Date_of_birth'];
			$this->Country=$podaci['Country'];
			$this->City=$podaci['City'];
			$this->Address=$podaci['Address'];
			$this->Phone_number=$podaci['Phone_number'];
			$this->Email=$podaci['Email'];
			$this->Nationality=$podaci['Nationality'];
			$this->Fax=$podaci['Fax'];
			$this->Gender=$podaci['Gender'];
			$this->Desired_employment=$podaci['Desired_employment'];
			$this->Postal_code=$podaci['Postal_code'];
			$this->Country_code=$podaci['Country_code'];
			$this->Mother_tongue=$podaci['mother_tongue'];
			$this->Desired_code=$podaci['Desired_code'];
                        $this->Motherlang_code=$podaci['Motherlang_code'];
			$this->Social_skills=$podaci['social_skills'];
			$this->Organisational_skills=$podaci['organisational_skills'];
			$this->Technical_skills=$podaci['technical_skills'];
			$this->Computer_skills=$podaci['computer_skills'];
			$this->Artistic_skills=$podaci['artistic_skills'];
			$this->Other_skills=$podaci['other_skills'];
			$this->Driving_licence=$podaci['driving_licence'];
			$this->Additional_information=$podaci['additional_information'];
			$this->Annexes=$podaci['annexes'];
			
		}
                $sql="SELECT * FROM work_experience WHERE student_id='$id'";
                list($result,$a)=$db->query($sql);
                $i=0;
                while(@$row=  mysql_fetch_array($result)){
                    $this->work_id[$i]=$row['ID'];
                    $this->fday[$i]=$row['DAY_FROM'];
                    $this->fmonth[$i]=$row['MONTH_FROM'];
                    $this->fyear[$i]=$row['YEAR_FROM'];
                    $this->tday[$i]=$row['DAY_TO'];
                    $this->tmonth[$i]=$row['MONTH_TO'];
                    $this->tyear[$i]=$row['YEAR_TO'];
                    $this->code_position[$i]=$row['CODE_POSITION'];
                    $this->position[$i]=$row['WPOSITION'];
                    $this->activities[$i]=$row['ACTIVITIES'];
                    $this->work_name[$i]=$row['EMPLOYER_NAME'];
                    $this->work_adress[$i]=$row['EMPLOYER_ADDRESS'];
                    $this->work_city[$i]=$row['EMPLOYER_MUNIC'];
                    $this->pcode[$i]=$row['EMPLOYER_ZCODE'];
                    $this->work_country_code[$i]=$row['CODE_COUNTRY'];
                    $this->work_country[$i]=$row['COUNTRY'];
                    $this->sector_code[$i]=$row['CODE_SECTOR'];
                    $this->sector[$i]=$row['SECTOR'];
                    $i++;
                }
                $sql="SELECT * FROM education WHERE student_id='$id'";
                list($result,$a)=$db->query($sql);
                $i=0;
                while(@$row=  mysql_fetch_array($result)){
                    $this->education_id[$i]=$row['ID'];
                    $this->org_fday[$i]=$row['DAY_FROM'];
                    $this->org_fmonth[$i]=$row['MONTH_FROM'];
                    $this->org_fyear[$i]=$row['YEAR_FROM'];
                    $this->org_tday[$i]=$row['DAY_TO'];
                    $this->org_tmonth[$i]=$row['MONTH_TO'];
                    $this->org_tyear[$i]=$row['YEAR_TO'];
                    $this->title[$i]=$row['TITLE'];
                    $this->subject[$i]=$row['SUBJECT'];
                    $this->org_name[$i]=$row['ORG_NAME'];
                    $this->org_type[$i]=$row['ORG_TYPE'];
                    $this->org_address[$i]=$row['ORG_ADDRESS'];
                    $this->org_city[$i]=$row['ORG_MUNIC'];
                    $this->org_country[$i]=$row['COUNTRY'];
                    $this->edu_level[$i]=$row['EDULEVEL'];
                    $this->edu_field[$i]=$row['EDU_FIELD'];

                    $i++;
                }
                 $sql="SELECT * FROM languagelist WHERE student_id='$id'";
                list($result,$a)=$db->query($sql);
                $i=0;
                while(@$row=  mysql_fetch_array($result)){
                    $this->language_id[$i]=$row['ID'];
                    $this->language_code[$i]=$row['CODE_LANGUAGE'];
                    $this->olanguage[$i]=$row['OLANGUAGE'];
                    $this->listening[$i]=$row['LISTENING'];
                    $this->reading[$i]=$row['READING'];
                    $this->spoken_interaction[$i]=$row['SPOKEN_INTERACTION'];
                    $this->spoken_production[$i]=$row['SPOKEN_PRODUCTION'];
                    $this->writing[$i]=$row['WRITING'];


                    $i++;
                }
	}
	
	public function load_from_post(){
		$this->ID=$_POST['stud_cv_ID'];
		$this->Name=htmlentities(@$_POST['stud_cv_Name'],ENT_QUOTES, "UTF-8");
		$this->Surname=htmlentities(@$_POST['stud_cv_Surname'],ENT_QUOTES, "UTF-8");
		$this->Date_of_birth=htmlentities(@$_POST['stud_cv_Date_of_birth']);
		$this->Country=htmlentities(@$_POST['stud_cv_Country']);
		$this->City=htmlentities(@$_POST['stud_cv_City'],ENT_QUOTES, "UTF-8");
		$this->Address=htmlentities(@$_POST['stud_cv_Address'],ENT_QUOTES, "UTF-8");
		$this->Phone_number=htmlentities(@$_POST['stud_cv_Phone_number']);
		$this->Email=htmlentities(@$_POST['stud_cv_Email']);
		$this->Nationality=htmlentities(@$_POST['stud_cv_Nationality']);
		$this->Fax=htmlentities(@$_POST['stud_cv_Fax']);
		$this->Gender=@$_POST['stud_cv_Gender'];
		$number=@$_POST['work_number'];
               
                for($i=0;$i<$number;$i++){
                    $this->work_id[$i]=@$_POST['work_id'.$i];
                    $this->fday[$i]=@$_POST['fday'.$i];
                    $this->fmonth[$i]=@$_POST['fmonth'.$i];
                    $this->fyear[$i]=@$_POST['fyear'.$i];
                    $this->tday[$i]=@$_POST['tday'.$i];
                    $this->tmonth[$i]=@$_POST['tmonth'.$i];
                    $this->tyear[$i]=@$_POST['tyear'.$i];
                    $this->position[$i]=htmlentities(@$_POST['stud_cv_Occupation'.$i],ENT_QUOTES, "UTF-8");
                    $this->activities[$i]=htmlentities(@$_POST['stud_cv_Responsibilities'.$i],ENT_QUOTES, "UTF-8");
                    $this->work_name[$i]=htmlentities(@$_POST['stud_cv_Name'.$i],ENT_QUOTES, "UTF-8");
                    $this->work_adress[$i]=htmlentities(@$_POST['stud_cv_address'.$i],ENT_QUOTES, "UTF-8");
                    $this->work_city[$i]=htmlentities(@$_POST['stud_cv_work_city'.$i],ENT_QUOTES, "UTF-8");
                    $this->work_country[$i]=htmlentities(@$_POST['stud_cv_work_country'.$i],ENT_QUOTES, "UTF-8");
                    $this->sector[$i]=htmlentities(@$_POST['stud_cv_Type'.$i],ENT_QUOTES, "UTF-8");
                }

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
		$this->Mother_tongue=htmlentities(@$_POST['stud_cv_Mother_tongue']);
		$number=@$_POST['language_number'];

                for($i=0;$i<$number;$i++){
                    $this->language_id[$i]=htmlentities(@$_POST['language_id'.$i],ENT_QUOTES, "UTF-8");
                    $this->olanguage[$i]=@$_POST['stud_cv_Other_language'.$i];
                    $this->listening[$i]=@$_POST['stud_cv_listening'.$i];
                    $this->reading[$i]=@$_POST['stud_cv_reading'.$i];
                    $this->spoken_interaction[$i]=@$_POST['stud_cv_spoken_i'.$i];
                    $this->spoken_production[$i]=@$_POST['stud_cv_spoken_p'.$i];
                    $this->writing[$i]=@$_POST['stud_cv_writing'.$i];
                   
                }
		$this->Social_skills=htmlentities(@$_POST['stud_cv_Social_skills'],ENT_QUOTES, "UTF-8");
		$this->Organisational_skills=htmlentities(@$_POST['stud_cv_Organisational_skills'],ENT_QUOTES, "UTF-8");
		$this->Technical_skills=htmlentities(@$_POST['stud_cv_Technical_skills'],ENT_QUOTES, "UTF-8");
		$this->Computer_skills=htmlentities(@$_POST['stud_cv_Computer_skills'],ENT_QUOTES, "UTF-8");
		$this->Artistic_skills=htmlentities(@$_POST['stud_cv_Artistic_skills'],ENT_QUOTES, "UTF-8");
		$this->Other_skills=htmlentities(@$_POST['stud_cv_Other_skills'],ENT_QUOTES, "UTF-8");
		if(@$_POST['stud_cv_Driving_licence']==1)
                    $this->Driving_licence=1;
                else
                    $this->Driving_licence=0;
		$this->Additional_information=htmlentities(@$_POST['stud_cv_Additional_information'],ENT_QUOTES, "UTF-8");
		$this->Annexes=htmlentities(@$_POST['stud_cv_Annexes'],ENT_QUOTES, "UTF-8");
		$this->Desired_employment=htmlentities(@$_POST['stud_cv_Desired_employment'],ENT_QUOTES, "UTF-8");
		
	}

        private function valid_email($email){
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

	public function show_data(){
		echo '<div id="article-wall">
	     <center><table style="font-size: 13px; border-collapse:collapse;">
		 <trstyle="border:1px solid black;  padding:5px;"> <td colspan="2"><center><h3>Personal information</h3></center></td></tr>
                 <tr> <td style="border:1px solid black;  padding:5px;">Name</td><td>'.$this->Name.'</td>  </tr>
                     <tr style="border:1px solid black;  padding:5px;"> <td style="border:1px solid black;  padding:5px;">Surname</td><td width="370">'.$this->Surname.'</td>  </tr>
                         <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Photo</td><td width="370"><img width=100 src="'.$this->Photo.'"></td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Country</td><td width="370">'.$this->Country.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">City</td><td width="370">'.$this->City.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Address</td><td width="370">'.$this->Address.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Phone number</td><td width="370">'.$this->Phone_number.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Email</td><td width="370">'.$this->Email.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Nationality</td><td width="370">'.$this->Nationality.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Fax</td><td width="370">'.$this->Fax.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Gender</td><td width="370">'.$this->Gender.'</td>  </tr>
                     <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Desired employment</td><td width="370">'.$this->Desired_employment.'</td>  </tr>
                     <tr style="border:1px solid black;  padding:5px;"> <td colspan="2"><center><h3>Work experience</h3></center></td></tr>';
		 for($i=0;$i<sizeof($this->work_id);$i++){
                      echo '   <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Working dates</td><td width="370">From: '.$this->fday[$i].'.'.$this->fmonth[$i].'.'.$this->fyear[$i].' To: '.$this->tday[$i].'.'.$this->tmonth[$i].'.'.$this->tyear[$i].'</td>  </tr>
                     <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Occupation or position held</td><td width="370">'.$this->position[$i].'</td>  </tr>
                     <tr style="border:1px solid black;  padding:5px;"> <td width="180" align="left" valign="top">Main activities and responsibilities</td><td width="370">'.$this->activities[$i].'</td>  </tr>
                     <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Name of employer</td><td width="370">'.$this->work_name[$i].'</td>  </tr>
                     <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Address of employer</td><td width="370">'.$this->work_adress[$i].'</td>  </tr>
                      <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">City of employer</td><td width="370">'.$this->work_city[$i].'</td>  </tr>
                          <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Country of employer</td><td width="370">'.$this->work_country[$i].'</td>  </tr>

                     <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Type of business or sector</td><td width="370">'.$this->sector[$i].'</td>  </tr>
                     <tr style="border:1px solid black;  padding:5px;"><td colspan="2"></td></tr>';

                 }

                        
                     echo '<tr style="border:1px solid black;  padding:5px;"> <td colspan="2"><center><h3>Education and training</h3></center></td></tr>';
                     for($i=0;$i<sizeof($this->education_id);$i++){
                         echo '<tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Education dates</td><td width="370">From: '.$this->org_fday[$i].'.'.$this->org_fmonth[$i].'.'.$this->org_fyear[$i].'. To: '.$this->org_tday[$i].'.'.$this->org_tmonth[$i].'.'.$this->org_tyear[$i].'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Title of qualification awarded</td><td width="370">'.$this->title[$i].'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" align="left" valign="top">Principal subjects/occupational skills covered</td><td width="370">'.$this->subject[$i].'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" align="left" valign="top">Name and type of organisation providing education and training</td><td width="370">'.$this->org_name[$i].', '.$this->org_address[$i].', '.$this->org_city[$i].', '.$this->org_country[$i].'</td>  </tr>
		<tr style="border:1px solid black;  padding:5px;"> <td width="180" align="left" valign="top">Type of organisation providing education or training</td><td width="370">'.$this->org_type[$i].'</td>  </tr>
                <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Level in national or international classification</td><td width="370">'.$this->edu_level[$i].'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Education field</td><td width="370">'.$this->edu_field[$i].'</td>  </tr>
                     <tr style="border:1px solid black;  padding:5px;"><td colspan="2"></td></tr>';
                     }
		 
                   echo'  <tr style="border:1px solid black;  padding:5px;"> <td colspan="2"><center><h3>Personal skills and competences</h3></center></td></tr>';
		 echo '<tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Mother tongue(s)</td><td width="370">'.$this->Mother_tongue.'</td>  </tr>';
                 for($i=0;$i<sizeof($this->language_id);$i++){
                     echo '<tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Language</td><td width="370">'.$this->olanguage[$i].'; Listening: '.$this->listening[$i].'; Reading: '.$this->reading[$i].'; Spoken interaction: '.$this->spoken_interaction[$i].'; Spoken production: '.$this->spoken_production[$i].'; Writing: '.$this->writing[$i].'</td>  </tr>
                         <tr style="border:1px solid black;  padding:5px;"><td colspan="2"></td></tr>';
                 }
                 echo '
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top" colspan="2"><a href="http://europass.cedefop.europa.eu/LanguageSelfAssessmentGrid/en" target="_blank">Common European Framework of Reference for Languages</a></td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" align="left" valign="top">Social skills and competences</td><td width="370">'.$this->Social_skills.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" align="left" valign="top">Organisational skills and competences</td><td width="370">'.$this->Organisational_skills.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" align="left" valign="top">Technical skills and competences</td><td width="370">'.$this->Technical_skills.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" align="left" valign="top">Computer skills and competences</td><td width="370">'.$this->Computer_skills.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" align="left" valign="top">Artistic skills and competences</td><td width="370">'.$this->Artistic_skills.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" align="left" valign="top">Other skills and competences</td><td width="370">'.$this->Other_skills.'</td>  </tr>';
                if($this->Driving_licence==1){
                    echo '<tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Driving licence</td><td width="370">Yes</td>  </tr>';
                }
                else{
                    echo '<tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Driving licence</td><td width="370">No</td>  </tr>';
                }
                echo ' <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Additional information</td><td width="370">'.$this->Additional_information.'</td>  </tr>
		 <tr style="border:1px solid black;  padding:5px;"> <td width="180" valign="top">Annexes</td><td width="370">'.$this->Annexes.'</td>  </tr>';
	
	
	 echo' </table></center><br /> ';	
	}

        public function loadmenu($option){
            if($option=='personal')
             echo '<center><div id="hajde">
<a href=""><strong> Personal information </strong></a></div><div id="hajde"><a href=javascript:Show("work");> Work experience </a></div><div id="hajde"><a href=javascript:Show("education");> Education </a></div><div id="hajde1"><a href=javascript:Show("other");> Other skills </a></div></center><br>';
             else if($option=='work')
             echo '<center><div id="hajde">
<a href=javascript:Show("personal");> Personal information </a></div><div id="hajde"><a href=""><strong> Work experience </strong></a></div><div id="hajde"><a href=javascript:Show("education");> Education </a></div><div id="hajde1"><a href=javascript:Show("other");> Other skills </a></div></center><br>';
            else if($option=='education')
             echo '<center><div id="hajde">
<a href=javascript:Show("personal");> Personal information </a></div><div id="hajde"><a href=javascript:Show("work");> Work experience </a></div><div id="hajde"><a href=""><strong> Education </strong></a></div><div id="hajde1"><a href=javascript:Show("other");> Other skills </a></div></center><br>';
    else if($option=='other')
             echo '<center><div id="hajde">
<a href=javascript:Show("personal");> Personal information </a></div><div id="hajde"><a href=javascript:Show("work");> Work experience </a></div><div id="hajde"><a href=javascript:Show("education");> Education </a></div><div id="hajde1"><a href=""><strong> Other skills </strong></a></div></center><br>';

        }

        
	
	public function show_edit_cv_form_personal_info(){
            
		echo '<h3>Personal information</h3><form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form" class="studentform">
	     
            <div id="xmlcv"></div>
		 
                 <label>Name</label> <input name="stud_cv_Name" class="lykeion" type="text" id="stud_cv_Name"  value="'.$this->Name.'"/><input name="stud_cv_ID" class="lykeion" type="hidden" id="stud_cv_ID" value="'.$this->ID.'"/>
		 <label>Surname</label><input name="stud_cv_Surname" class="lykeion" type="text" id="stud_cv_Surname"  value="'.$this->Surname.'"/> 
		 <label>Country</label><input name="stud_cv_Country" class="lykeion" type="text" id="stud_cv_Country"  value="'.$this->Country.'"/> 
		 <label>City</label> <input name="stud_cv_City" class="lykeion" type="text" id="stud_cv_City"  value="'.$this->City.'"/> 
		 <label>Address</label> <input name="stud_cv_Address" class="lykeion" type="text" id="stud_cv_Address"  value="'.stripcslashes($this->Address).'"/>
		 <label>Phone number</label> <input name="stud_cv_Phone_number" class="lykeion" type="text" id="stud_cv_Phone_number" value="'.$this->Phone_number.'"/>
		 <label>E-mail</label> <input name="stud_cv_Email" class="lykeion" type="text" id="stud_cv_Email" value="'.$this->Email.'"/> 
		 <label>Nationality</label> <input name="stud_cv_Nationality" class="lykeion" type="text" id="stud_cv_Nationality"  value="'.$this->Nationality.'"/> 
		 <label>Date of birth</label> <input name="stud_cv_Date_of_birth" class="lykeion" type="date" id="stud_cv_Date_of_birth"  value="'.$this->Date_of_birth.'"/> 
                 <label>Fax</label> <input name="stud_cv_Fax" class="lykeion" type="text" id="stud_cv_Fax"  value="'.$this->Fax.'"/> <br>
		 <label>Gender</label><select name="stud_cv_Gender" ><option>'.$this->Gender.'</option><option>M</option><option>F</option></select><br>
		 <label>Desired employment</label> <input name="stud_cv_Desired_employment" class="lykeion" type="text" id="stud_cv_Desired_employment"  value="'.stripcslashes($this->Desired_employment).'"/> ';
                 echo ' 
                     <input type="submit" name="student_cv_edit_personal" class="btn" value="" />
		 
		</form>';
               
        }
        public function  show_edit_cv_form_work(){
             
            echo '<h3>Work experience</h3><form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form" class="studentform">
	     <div id="xmlcv"></div>';
                $number=0;
                
                for($i=0;$i<=sizeof($this->work_id);$i++){
                    echo '';
                    if($i==sizeof($this->work_id) && sizeof($this->work_id)!=0) break;
                    if(sizeof($this->work_id)==0) echo '<input type="hidden" name="work_id'.$i.'" id="work_id'.$i.'" value="-1">';
                    else echo '<input type="hidden" name="work_id'.$i.'" id="work_id'.$i.'" value="'.$this->work_id[$i].'">';
                    echo '
                        <div id="work'.$i.'">Dates when you worked<br><label>From:</label><select name="fday'.$i.'">
                        <option>'.$this->fday[$i].'</option>';
                    for($j=1;$j<=31;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="fmonth'.$i.'"><option>'.$this->fmonth[$i].'</option>';
                    for($j=1;$j<=12;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="fyear'.$i.'"><option>'.$this->fyear[$i].'</option>';
                    for($j=2020;$j>=1980;$j--) echo '<option>'.$j.'</option>';
                    echo '</select><br><label>To:</label><select name="tday'.$i.'"><option>'.$this->tday[$i].'</option><option>-></option>';
                    for($j=1;$j<=31;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="tmonth'.$i.'"><option>'.$this->tmonth[$i].'</option><option>-></option>';
                    for($j=1;$j<=12;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="tyear'.$i.'"><option>'.$this->tyear[$i].'</option><option>-></option>';
                    for($j=2020;$j>=1980;$j--) echo '<option>'.$j.'</option>';
                    echo '</select><br>
                    
		 <label>Occupation or position held</label> <textarea style="resize: none;" name="stud_cv_Occupation'.$i.'" class="lykeion" id="stud_cv_Occupation'.$i.'" rows="5" cols="48" >'.stripcslashes($this->position[$i]).'</textarea>
		 <label>Main activities and responsibilities</label> <textarea style="resize: none;" name="stud_cv_Responsibilities'.$i.'" class="lykeion" id="stud_cv_Responsibilities'.$i.'" rows="5" cols="48"  >'.stripcslashes($this->activities[$i]).'</textarea> 
                     <label>Name of employer</label> <input type="text" name="stud_cv_Name'.$i.'" class="lykeion" id="stud_cv_Name'.$i.'"  value="'.stripcslashes($this->work_name[$i]).'">
		 <label>Address of employer</label> <input type="text" name="stud_cv_address'.$i.'" class="lykeion" id="stud_cv_address'.$i.'"    value="'.stripcslashes($this->work_adress[$i]).'"> 
                 <label>City of employer</label> <input type="text" name="stud_cv_work_city'.$i.'" class="lykeion" id="stud_cv_work_city'.$i.'"  value="'.stripcslashes($this->work_city[$i]).'"> 
                 <label>Country of employer</label> <input type="text" name="stud_cv_work_country'.$i.'" class="lykeion" id="stud_cv_work_country'.$i.'"  value="'.stripcslashes($this->work_country[$i]).'"> 
                <label>Type of business or sector</label> <input name="stud_cv_Type'.$i.'" class="lykeion" type="text" id="stud_cv_Type'.$i.'"  value="'.stripcslashes($this->sector[$i]).'"/>
                <label><a href=javascript:showhide("work'.$i.'",'.$this->work_id[$i].');>Delete this work</a></label>
                </div><br><br><br>';
                
                    $number++;
                }
                echo '
                    <div id="new_work"></div><input type="hidden" name="work_number" id="work_number" value="'.$number.'"><a href=javascript:AddElement("work");>Add more work experience</a>';
                 echo ' <input type="submit" name="student_cv_edit_work" class="btn" value="" /> 
		
		</form>';
        }
        public function  show_edit_cv_form_education(){
            echo '<h3>Education and training</h3><form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form" class="studentform">
	    <div id="xmlcv"></div>';
                
		 
                $number=0;                
                for($i=0;$i<=sizeof($this->education_id);$i++){
                    echo "";
                    if($i==sizeof($this->education_id) && sizeof($this->education_id)!=0) break;
                    if(sizeof($this->education_id)==0) echo '<input type="hidden" name="education_id'.$i.'" id="education_id'.$i.'" value="-1">';
                    else echo '<input type="hidden" name="education_id'.$i.'" id="education_id'.$i.'" value="'.$this->education_id[$i].'">';
                    echo '
                        <div id="education'.$i.'">Dates of studying</td><td width="370"><br><label>From:</label> <select name="org_fday'.$i.'">
                        <option>'.$this->org_fday[$i].'</option>';
                    for($j=1;$j<=31;$j++) echo '<option>'.$j.'</option>';
                    echo '</select> <select name="org_fmonth'.$i.'"><option>'.$this->org_fmonth[$i].'</option>';
                    for($j=1;$j<=12;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="org_fyear'.$i.'"><option>'.$this->org_fyear[$i].'</option>';
                     for($j=2020;$j>=1980;$j--) echo '<option>'.$j.'</option>';
                    echo '</select><br><label>To:</label> <select name="org_tday'.$i.'"><option>'.$this->org_tday[$i].'</option><option>-></option>';
                    for($j=1;$j<=31;$j++) echo '<option>'.$j.'</option>';
                    echo '</select> <select name="org_tmonth'.$i.'"><option>'.$this->org_tmonth[$i].'</option><option>-></option>';
                    for($j=1;$j<=12;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="org_tyear'.$i.'"><option>'.$this->org_tyear[$i].'</option><option>-></option>';
                    for($j=2020;$j>=1980;$j--) echo '<option>'.$j.'</option>';
                    echo '</select><br>
                   
		 <label>Title of qualification awarded</label> <input type="text" name="stud_cv_title'.$i.'" class="lykeion" id="stud_cv_title'.$i.'"  value="'.stripcslashes($this->title[$i]).'">
		 <label>Principal subjects/occupational skills covered</label> <textarea style="resize: none;" name="stud_cv_subject'.$i.'" class="lykeion" id="stud_cv_subject'.$i.'" rows="5" cols="48"  >'.stripcslashes($this->subject[$i]).'</textarea>
		 <label>Name of organisation providing education or training</label> <input type="text" name="stud_cv_org_name'.$i.'" class="lykeion" id="stud_cv_org_name'.$i.'"   value="'.stripcslashes($this->org_name[$i]).'"> <br><br>
		<label>Type of organisation providing education or training</label> <input type="text" name="stud_cv_org_type'.$i.'" class="lykeion" id="stud_cv_org_type'.$i.'"  value="'.stripcslashes($this->org_type[$i]).'"> <br><br>
                <label>Address of organisation</label> <input type="text" name="stud_cv_org_address'.$i.'" class="lykeion" id="stud_cv_org_address'.$i.'"    value="'.stripcslashes($this->org_address[$i]).'"> 
                 <label>City of organisation</label> <input type="text" name="stud_cv_org_city'.$i.'" class="lykeion" id="stud_cv_org_city'.$i.'"  value="'.stripcslashes($this->org_city[$i]).'"> 
                     <label>Country of organisation</label> <input type="text" name="stud_cv_org_country'.$i.'" class="lykeion" id="stud_cv_org_country'.$i.'"  value="'.stripcslashes($this->org_country[$i]).'"> 
                <label>Level in national or international classification</label> <input type="text" name="stud_cv_level'.$i.'" class="lykeion" id="stud_cv_level'.$i.'"  value="'.stripcslashes($this->edu_level[$i]).'" list="level-list"/> <datalist id="level-list"> <option value="Bachelor"> <option value="Master"> <option value="PhD"> <option value="High School"></datalist><br><br>
                <label>Education field</label> <input name="stud_cv_field'.$i.'" class="lykeion" type="text" id="stud_cv_field'.$i.'"  value="'.stripcslashes($this->edu_field[$i]).'" list="field-list"/><datalist id="field-list"><option value="Computer Science and Informatics"><option value="Automatic Control and Electronics"><option value="Electric Power Engineering"><option value="Telecommunication"><option value="Civil Engineering"><option value="Mechanical Engineering"><option value="Chemical Engineering"></datalist> 
                <label><a href=javascript:showhide("education'.$i.'",'.$this->education_id[$i].');>Delete this education</a></label>
                </div><br><br><br>';
                
                    $number++;
                }
                echo '
                    <div id="new_education"></div><input type="hidden" name="education_number" id="education_number" value="'.$number.'"> <a href=javascript:AddElement("education");>Add more education</a>';
                 echo ' <input type="submit" name="student_cv_edit_education" class="btn" value="" /> 
		 
		</form>';
        }
        public function  show_edit_cv_form_other(){
            echo '<h3>Personal skills and competences</h3><form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form" class="studentform">
	    ';
	    
		 echo '<div id="xmlcv"></div> <a href="http://europass.cedefop.europa.eu/LanguageSelfAssessmentGrid/en" target="_blank">Common European Framework of Reference for Languages</a>
                     <label>Native language</label> <input name="stud_cv_Mother_tongue" class="lykeion" type="text" id="stud_cv_Mother_tongue"  value="'.$this->Mother_tongue.'"/> 
                     <label>Other languages:</label><br><br>';
                 $number=0;
                 for($i=0;$i<=sizeof($this->language_id);$i++){
                     echo '';
                     if($i==sizeof($this->language_id) && sizeof($this->language_id)!=0) break;
                    if(sizeof($this->language_id)==0) echo '<input type="hidden" name="language_id'.$i.'" id="language_id'.$i.'" value="-1">';
                    else echo '<input type="hidden" name="language_id'.$i.'" id="language_id'.$i.'" value="'.$this->language_id[$i].'">';
                     echo '<img id="piclanguage'.$i.'"  src="images/showhide.png" onclick=showhide("language'.$i.'",0)>
                         <div id="language'.$i.'">
                            
                             <label>Language</label> <input type="text" name="stud_cv_Other_language'.$i.'" class="lykeion" id="stud_cv_Other_language'.$i.'"  value="'.$this->olanguage[$i].'"> <br>
                      <label>Listening</label><select name="stud_cv_listening'.$i.'" class="lykeion" id="stud_cv_listening'.$i.'" ><option>'.$this->listening[$i].'</option><option>a1</option><option>a2</option><option>b1</option><option>b2</option><option>c1</option><option>c2</option> </select><br>
                      <label>Reading</label> <select name="stud_cv_reading'.$i.'" class="lykeion" id="stud_cv_reading'.$i.'" ><option>'.$this->reading[$i].'</option><option>a1</option><option>a2</option><option>b1</option><option>b2</option><option>c1</option><option>c2</option> </select><br>
                      <label>Spoken interaction</label> <select name="stud_cv_spoken_i'.$i.'" class="lykeion" id="stud_cv_spoken_i'.$i.'" ><option>'.$this->spoken_interaction[$i].'</option><option>a1</option><option>a2</option><option>b1</option><option>b2</option><option>c1</option><option>c2</option> </select><br>
                      <label>Spoken production</label> <select name="stud_cv_spoken_p'.$i.'" class="lykeion" id="stud_cv_spoken_p'.$i.'" ><option>'.$this->listening[$i].'</option><option>a1</option><option>a2</option><option>b1</option><option>b2</option><option>c1</option><option>c2</option> </select><br>
                      <label>Writing</label> <select name="stud_cv_writing'.$i.'" class="lykeion" id="stud_cv_writing'.$i.'" ><option>'.$this->writing[$i].'</option><option>a1</option><option>a2</option><option>b1</option><option>b2</option><option>c1</option><option>c2</option> </select><br><br>
                   <label><a href=javascript:showhide("language'.$i.'",'.$this->language_id[$i].');>Delete this language</a></label>
                        </div><br><br>
                    ';
                     $number++;
                 }
		 echo '
		 <div id="new_language"></div> <input type="hidden" name="language_number" id="language_number" value="'.$number.'"> <a href=javascript:AddElement("language");>Add more languages</a>
                 
                  
                    <label>Social skills and competences</label> <textarea style="resize: none;" name="stud_cv_Social_skills" class="lykeion" id="stud_cv_Social_skills" rows="5" cols="45">'.stripcslashes($this->Social_skills).'</textarea> 
		 <label>Organisational skills and competences</label> <textarea style="resize: none;" name="stud_cv_Organisational_skills" class="lykeion" id="stud_cv_Organisational_skills" rows="5" cols="45">'.stripcslashes($this->Organisational_skills).'</textarea> 
		 <label>Technical skills and competences</label> <textarea style="resize: none;" name="stud_cv_Technical_skills" class="lykeion" id="stud_cv_Technical_skills" rows="5" cols="45" >'.stripcslashes($this->Technical_skills).'</textarea>
		 <label>Computer skills and competences</label> <textarea style="resize: none;" name="stud_cv_Computer_skills" class="lykeion" id="stud_cv_Computer_skills" rows="5" cols="45">'.stripcslashes($this->Computer_skills).'</textarea> 
		 <label>Artistic skills and competences</label> <textarea style="resize: none;" name="stud_cv_Artistic_skills" class="lykeion" id="stud_cv_Artistic_skills" rows="5" cols="45" >'.stripcslashes($this->Artistic_skills).'</textarea> 
		 <label>Other skills and competences</label> <textarea style="resize: none;" name="stud_cv_Other_skills" class="lykeion" id="stud_cv_Other_skills" rows="5" cols="45" >'.stripcslashes($this->Other_skills).'</textarea> ';
		if($this->Driving_licence==1){
                    echo '<label>Driving licence</label> <input name="stud_cv_Driving_licence" class="lykeion" type="checkbox" id="stud_cv_Driving_licence"   value="1" checked="yes" /> ';
                }
                else{
                    echo '<label>Driving licence</label> <input name="stud_cv_Driving_licence" class="lykeion" type="checkbox" id="stud_cv_Driving_licence"   value="1"/> ';
                }

		 echo '<label>Additional information</label> <textarea style="resize: none;" name="stud_cv_Additional_information" class="lykeion" id="stud_cv_Additional_information" rows="5" cols="45" >'.stripcslashes($this->Additional_information).'</textarea> 
		 <label>Annexes</label> <textarea style="resize: none;" name="stud_cv_Annexes" class="lykeion" id="stud_cv_Annexes" rows="5" cols="45" style="width:98%" >'.stripcslashes($this->Annexes).'</textarea> ';
                 echo ' <input type="submit" name="student_cv_edit_other" class="btn" value="" /> 

		</form>';
        }
	
	 
	public function exportPDF(){
            require_once('CV2PDF.php');
            kreirajPDF($this);
        }
	
	public function exportXML () {
		$doc = new DomDocument('1.0', 'UTF-8');
                
                $doc->formatOutput = true;
                
		$europass = $doc->createElement("SkillsPassport");
                 $europass -> setAttribute ( 'xmlns' , 'http://europass.cedefop.europa.eu/Europass' );
                $europass -> setAttribute (  'xsi:schemaLocation' , 'http://europass.cedefop.europa.eu/Europass http://europass.cedefop.europa.eu/xml/EuropassSchema_V3.0-rc7.xsd' );
                //$europass -> setAttributeNS ("http://europass.cedefop.europa.eu/Europass/V2.0", 'xmlns:europass' , 'http://europass.cedefop.europa.eu/Europass/V2.0' );
                $europass -> setAttribute (  'xmlns:xsi' , 'http://www.w3.org/2001/XMLSchema-instance' );
                $europass -> setAttribute ( 'locale' , 'en' );
		$doc->appendChild( $europass ); //Append `EuroPass` Tag to Document
		
                $docinfo=$doc->createElement("DocumentInfo");
                $europass->appendChild($docinfo);
                $docinfo -> appendChild ( $doc->createElement( 'DocumentType' , "ECV" ) );
                $docinfo -> appendChild ( $doc->createElement( 'CreationDate' , "2011-11-03T00:00:00.000Z" ) );
                $docinfo -> appendChild ( $doc->createElement( 'XSDVersion' , "V3.0" ) );
                $docinfo -> appendChild ( $doc->createElement( 'Generator' , "EWA" ) );
                $docinfo -> appendChild ( $doc->createElement( 'Comment' , "Automatically generated Europass CV" ) );
		/*$europass = $doc->getElementsByTagNameNS("*", 'europass:learnerinfo' );
		$europass = $europass->item( 0 );*/
		
		/*Identification Start*/
                
		$identification = $doc -> createElement ( 'Identification' );
		$europass -> appendChild ( $identification ); //Append `identification` tag to `EuroPass` Tag
                $personname = $doc -> createElement ( 'PersonName' );
		$identification -> appendChild ( $personname );
		
		$personname -> appendChild ( $doc->createElement( 'FirstName' , $this->Name ) );
		$personname -> appendChild ( $doc->createElement( 'Surname' , $this->Surname ) );
		
		$contactinfo = $doc -> createElement( 'ContactInfo' );
		$identification -> appendChild ( $contactinfo ); //Append `contactinfo` tag to `identification` tag

		$address = $doc -> createElement ( 'Address' );
		$contactinfo -> appendChild ( $address );
                
                $contact = $doc -> createElement ( 'Contact' );
		$contactinfo -> appendChild ( $contact );
		
		$contact -> appendChild ( $doc -> createElement( 'AddressLine' , $this -> Address ) );
		$contact -> appendChild ( $doc -> createElement( 'Municipality' , $this -> City ) );
		$contact -> appendChild ( $doc -> createElement( 'PostalCode' , $this -> Postal_code ) );
		
		$country = $doc -> createElement ( 'Country' );
		$contact->appendChild($country);
		$country -> appendChild ( $doc -> createElement( 'Code' , $this->Country_code ) );
		$country -> appendChild ( $doc -> createElement( 'Label' , $this->Country ) );

		//$address -> appendChild ( $country );
                
                $use = $doc -> createElement ( 'Use' );
		$contactinfo -> appendChild ( $use );
		
		$use -> appendChild ( $doc -> createElement( 'telephone' , $this -> Phone_number ) );
		$use -> appendChild ( $doc -> createElement( 'fax' , $this -> Fax) );
		$use -> appendChild ( $doc -> createElement( 'email' , $this -> Email ) );
		
		$demographics = $doc -> createElement ( 'demographics' );
		$identification -> appendChild ( $demographics );
		
		$demographics -> appendChild ( $doc -> createElement('birthdate' , $this -> Date_of_birth) );
		$demographics -> appendChild ($doc -> createElement( 'gender' , $this -> Gender) );

		$nationality = $doc -> createElement ( 'nationality' );
		$demographics -> appendChild ( $nationality );
		
		$nationality -> appendChild ( $doc -> createElement( 'code' , $this -> Country_code ) );
		$nationality -> appendChild ( $doc -> createElement( 'label' , $this -> Country ) );
		/*Identification End*/
		
		/*Application Start*/
		$application = $doc -> createElement( 'application' );
		$europass -> appendChild ( $application );
		$application -> appendChild ( $doc-> createElement( 'label' , $this -> Desired_employment ) );
		/*Application End*/
		
		
		/*Work Experience Start*/
		$workexperiencelist = $doc -> createElement( 'workexperiencelist' );
		
		$i = 0; 
		while ( $i<  sizeof($this->work_id) ) {
			$workexperience = $workexperiencelist -> appendChild ( $doc -> createElement ( 'workexperience' ) );
			
			$period = $workexperience ->  appendChild ( $doc -> createElement ( 'period' ) );
			$from = $period -> appendChild ( $doc -> createElement ( 'from' ) );
			$from -> appendChild ( $doc -> createElement ( 'year' , $this -> fyear [ $i ] ) );
			$from -> appendChild ( $doc -> createElement ( 'month' , $this -> fmonth [ $i ] ) );
			$from -> appendChild ( $doc -> createElement ( 'day' , $this -> fday [ $i ] ) );
			
			$to = $period -> appendChild ( $doc -> createElement ( 'to' ) );
			$to -> appendChild ( $doc -> createElement ( 'year' , $this -> tyear [ $i ] ) );
			$to -> appendChild ( $doc -> createElement ( 'month' , $this -> tmonth [ $i ] ) );
			$to -> appendChild ( $doc -> createElement ( 'day' , $this -> tday [ $i ] ) );
			
			$position = $workexperience ->  appendChild ( $doc -> createElement ( 'position' ) );
			//$position -> appendChild ( 'code' , $this -> code_position [ $i ] );
			$position -> appendChild ( $doc -> createElement('label' , $this -> position [ $i ] ));
			
			$workexperience ->  appendChild ( $doc -> createElement ( 'activities' , $this -> activities [ $i ] ) );
			
			$employer = $workexperience ->  appendChild ( $doc -> createElement ( 'employer' ) );
			$employer -> appendChild ( $doc -> createElement ( 'name' , $this -> work_name [ $i ] ) );
			$address1 = $employer -> appendChild ( $doc -> createElement ( 'address' ) );
			
			$address1 -> appendChild ( $doc -> createElement ( 'addressLine' , $this -> work_adress[ $i ] ) );
			$address1 -> appendChild ( $doc -> createElement ( 'municipality' , $this -> work_city[ $i ] ) );
			$address1 -> appendChild ( $doc -> createElement ( 'postalCode' , $this -> pcode[ $i ] ) );
                        $country=$address1->appendChild($doc -> createElement ( 'country'  ));
			
			$country -> appendChild ( $doc -> createElement ( 'code' , $this -> work_country_code[ $i ] ) );
			$country -> appendChild ( $doc -> createElement ( 'label' , (string)$this -> work_country[$i] ) );
			
			$sector = $employer -> appendChild ( $doc -> createElement ( 'sector' ) );
			$sector -> appendChild ( $doc -> createElement ( 'label' , $this -> sector [ $i ] ) );

			$i++;
		}
		
		$europass -> appendChild ( $workexperiencelist );
		/*Work Experience End*/
		
		/*Education List Start*/
		$educationlist = $doc -> createElement( 'educationlist' );
		$i = 0;
		while ( $i<sizeof($this->education_id)) {
			$education = $educationlist -> appendChild ( $doc -> createElement ( 'education' ) );
			
			$period = $education -> appendChild ( $doc -> createElement ( 'period' ) );
			
			$from = $period -> appendChild ( $doc -> createElement ( 'from' ) );
			$from -> appendChild ( $doc-> createElement ( 'year' , $this -> org_fyear [ $i ] ) );
			$from -> appendChild ( $doc-> createElement ( 'month' , $this -> org_fmonth [ $i ] ) );
			$from -> appendChild ( $doc-> createElement ( 'day' , $this -> org_fday [ $i ] ) );
			
			$to = $period -> appendChild ( $doc -> createElement ( 'to' ) );
			$to -> appendChild ( $doc-> createElement ( 'year' , $this -> org_tyear [ $i ] ) );
			$to -> appendChild ( $doc-> createElement ( 'month' , $this -> org_tmonth [ $i ] ) );
			$to -> appendChild ( $doc-> createElement ( 'day' , $this -> org_tday [ $i ] ) );
			
			$education -> appendChild ( $doc -> createElement ( 'title' , $this -> title [ $i ] ) );
			$education -> appendChild ( $doc -> createElement ( 'skills' , $this -> subject [ $i ] ) );
			
			$organisation = $education -> appendChild ( $doc -> createElement ( 'organisation' ) );
			$organisation -> appendChild ( $doc -> createElement ( 'name' , $this -> org_name [ $i ] ) );
			
			$address2 = $organisation -> appendChild ( $doc -> createElement ( 'address' ) );
			$address2 -> appendChild ( $doc -> createElement ( 'addressLine' , $this -> org_address [ $i ] ) );
			$address2 -> appendChild ( $doc -> createElement ( 'municipality' , $this -> org_city [ $i ] ) );
			//$address -> appendChild ( $doc -. createElement ( 'postalCode' , $this -> epcode [ $i ] ) );
			
			$country = $address2 -> appendChild ( $doc -> createElement ( 'country' ) );
			//$country -> appendChild ( $doc -> createElement ( 'code' , $this -> educode [ $i ] ) );
			$country -> appendChild ( $doc -> createElement ( 'label' , $this -> org_country[ $i ] ) );
			
			$organisation -> appendChild ( $doc -> createElement ( 'type' , $this -> org_type [ $i ] ) );
			
			$level = $education -> appendChild ( $doc -> createElement ( 'level' ) );
			//$level -> appendChild ( $doc -> createElement ( 'code' , $this -> edulcode [ $i ] ) );
			$level -> appendChild ( $doc -> createElement ( 'label' , $this -> edu_level [ $i ] ) );
			
			$field = $education -> appendChild ( $doc -> createElement ( 'educationalfield' ) );
			//$field -> appendChild ( $doc -> createElement ( 'code' , $this -> edufcode [ $i ] ) );
			$field -> appendChild ( $doc -> createElement ( 'label' , $this -> edu_field [ $i ] ) );
			
			$i++;
		}
		
		$europass -> appendChild ( $educationlist );
		/*Education List End*/
		
		/*Language List Start*/
		$languagelist = $doc -> createElement( 'languagelist' );
		
		$mother = $languagelist -> appendChild ( $doc -> createElement ( 'language' ) );
		$mother -> setAttribute ( 'xsi:type' , 'europass:mother' );
		$mother -> appendChild (  $doc -> createElement('code' , $this -> Motherlang_code ));
		$mother -> appendChild ( $doc -> createElement('label' , $this ->Mother_tongue ));
		
		$i = 0;		
		while ($i< sizeof($this -> language_code  )) {
			$foreign = $languagelist -> appendChild ( $doc -> createElement ( 'language' ) );
			$foreign -> setAttribute ( 'xsi:type' , 'europass:foreign' );
			$foreign -> appendChild ( $doc->createElement('code' , $this -> language_code [ $i ] ));
			$foreign -> appendChild ( $doc->createElement('label' , $this -> olanguage [ $i ] ));
                        $level=$foreign->appendChild($doc->createElement('level'));
			$level -> appendChild ( $doc->createElement('listening' , $this -> listening [ $i ] ));
			$level -> appendChild ( $doc->createElement('reading' , $this -> reading [ $i ] ));
			$level -> appendChild ($doc->createElement( 'spokeninteraction' , $this -> spoken_interaction [ $i ] ));
			$level -> appendChild ( $doc->createElement('spokenproduction' , $this -> spoken_production [ $i ] ));
			$level -> appendChild ( $doc->createElement('writing' , $this -> writing [ $i ]));
			$i++;
		}
		
		$europass -> appendChild ( $languagelist );
		/*Language List End*/
		
		/*Skill List Start*/
		$skilllist = $doc -> createElement( 'skilllist' );
		
		$skill = $skilllist -> appendChild ( $doc -> createElement ( 'skill' , $this -> Social_skills ) );
		$skill -> setAttribute ( 'type' , 'social' );
		
		$skill = $skilllist -> appendChild ( $doc -> createElement ( 'skill' , $this -> Organisational_skills ) );
		$skill -> setAttribute ( 'type' , 'organisational' );
		
		$skill = $skilllist -> appendChild ( $doc -> createElement ( 'skill' , $this -> Technical_skills ) );
		$skill -> setAttribute ( 'type' , 'technical' );
		
		$skill = $skilllist -> appendChild ( $doc -> createElement ( 'skill' , $this -> Computer_skills ) );
		$skill -> setAttribute ( 'type' , 'computer' );
		
		$skill = $skilllist -> appendChild ( $doc -> createElement ( 'skill' , $this -> Artistic_skills ) );
		$skill -> setAttribute ( 'type' , 'artistic' );
		
		$skill = $skilllist -> appendChild ( $doc -> createElement ( 'skill' , $this -> Other_skills) );
		$skill -> setAttribute ( 'type' , 'other' );
		
		$struct = $skilllist -> appendChild ( $doc -> createElement ( 'structured-skill' ) );
                $struct -> setAttribute ( 'xsi:type' , 'europass:driving' );
		$dl = $struct -> appendChild ( $doc -> createElement ( 'drivinglicence' , $this ->Driving_licence ) );
		
		
		$europass -> appendChild ( $skilllist );
		/*Skill List End*/

		/*Misc List Start*/		
		$misclist = $doc -> createElement ( 'misclist' );
		$misc=$misclist -> appendChild ( $doc -> createElement ( 'misc' , $this -> Additional_information ) );
                $misc->SetAttribute('type','additional');
		$misc1=$misclist -> appendChild ( $doc -> createElement ( 'misc' , $this -> Annexes ) );
                $misc1->SetAttribute('type','annexes');
		$europass -> appendChild ( $misclist );
		/*Misc List End*/
		
                $name="LykeionCV.xml";
                $doc->saveXML();



                $doc->save($name);

                header('Content-type: application/xml');

                // It will be called downloaded.pdf
                header('Content-Disposition: Generated Europass XML file attachment; filename="'.$name.'"');

                // The PDF source is in original.pdf
                readfile($name);
                
		
                return $name;
                
	}
	
	public function readXML($xml){
                            /* @var DOMDocument
             * Load the XML File in a DOM Document.
             * */
            $doc = new DOMDocument();
            $doc->load($xml);
            $ok=0;
            /* Load the data of the first step, included in the <identification> tag.
             * The data are loaded in ecv_xml table.*/

            # Get from the XML all the elements with tag name 'identification' and load them in a list.
            $identifications = $doc->getElementsByTagName("Identification");
            foreach( $identifications as $identification )
            {
                $ok++;

            /* For each on of the list elements get the various elements included in the identification entity
             * and load them in the coresponding variables. */
                    if ($identification->getElementsByTagName("FirstName"))
                    { 
                            if(strlen($identification->getElementsByTagName("FirstName")->item(0)->nodeValue)>3)
                                $this->Name=$identification->getElementsByTagName("FirstName")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("Surname")) {
                            if(strlen( $identification->getElementsByTagName("Surname")->item(0)->nodeValue)>3)
                                    $this->Surname=$identification->getElementsByTagName("Surname")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("AddressLine")) {
                            $this->Address  = $identification->getElementsByTagName("AddressLine")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("Municipality")) {
                            $this->City = $identification->getElementsByTagName("Municipality")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("PostalCode")) {
                            $this->Postal_code   = $identification->getElementsByTagName("PostalCode")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("Country")) {
                            $countries    = $identification->getElementsByTagName("Country");
                            foreach ($countries as $country)
                            {
                                    if ($identification->getElementsByTagName("Code")->item(0)) {
                                            $this->Country_code  = $country->getElementsByTagName("Code")->item(0)->nodeValue;
                                    } else {}
                                    if ($identification->getElementsByTagName("Label")->item(0)) {
                                            $this->Country = $country->getElementsByTagName("Label")->item(0)->nodeValue;
                                    } else {}
                            }
                    } else {

                    }
                    if ($identification->getElementsByTagName("TelephoneList")->item(0)) {
                        foreach($identification->getElementsByTagName("Telephone") as $tel){
                            $this->Phone_number =$tel->getElementsByTagName("Contact")->item(0)->nodeValue; 
                        }
                    } else {}
                    if ($identification->getElementsByTagName("fax")) {
                            $this->Fax       = $identification->getElementsByTagName("fax")->item(0)->nodeValue;
                    } else {}
                    
                    if ($identification->getElementsByTagName("Email")) {
                            if(strlen($identification->getElementsByTagName("Contact")->item(0)->nodeValue)>5){ 
                                if($this->valid_email($identification->getElementsByTagName("Contact")->item(0)->nodeValue)==true)
                                        $this->Email=$identification->getElementsByTagName("Contact")->item(0)->nodeValue;
                            }
                    } else {}
                    if ($identification->getElementsByTagName("Gender")) {
                            $this->Gender    = $identification->getElementsByTagName("Code")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("Birthdate")->item(0)) {
                        
                            $year=$identification->getElementsByTagName("Birthdate")->item(0)->getAttribute("year"); 
                            $month=$identification->getElementsByTagName("Birthdate")->item(0)->getAttribute("month");
                            $day=$identification->getElementsByTagName("Birthdate")->item(0)->getAttribute("day");
                            $this->Date_of_birth  = $year.$month.$day;
                    } else {}


            

	/* Retrive the generated id for the insert.
	 * We will use it later to update the master table along with the detail ones with the rest of the data.
	 */

	$i=0;
	# Load the different nationalities in the coresponding variables
	$nationalities = $identification->getElementsByTagName("Nationality");
	/* For each on of the list elements get the various elements included in the nationality entity
 	* and load them in the coresponding variables. */
	foreach ($nationalities as $nationality)
	{
		if ($nationality->getElementsByTagName("Code")->item(0))
		{
			$ncode  = $nationality->getElementsByTagName("Code")->item(0)->nodeValue;
		} else
		{
			
		}
		if ($nationality->getElementsByTagName("Label")->item(0))
		{
			$this->Nationality = $nationality->getElementsByTagName("Label")->item(0)->nodeValue;
		} else
		{
			
		}
                
		$ok++;

	}

            }

# Get from the XML all the elements with tag name 'application' and load them in a list.
$applications = $doc->getElementsByTagName("Headline");
/* For each on of the list elements get the various elements included in the application entity
* and load them in the coresponding variables. */
foreach( $applications as $application )
{
    $ok++;
	if ($application->getElementsByTagName("Code")->item(0)) {
		$appcode  = $application->getElementsByTagName("Code")->item(0)->nodeValue;
	} else {}
	if ($application->getElementsByTagName("Description")->item(0)) {
            foreach($application->getElementsByTagName("Description") as $des){
                $this->Desired_employment=$des->getElementsByTagName("Label")->item(0)->nodeValue;
            }
		
	} else {}
	
}

$i=0;
# Get from the XML all the elements with tag name 'workexperience' and load them in a list.
$workexperiencelist = $doc->getElementsByTagName("WorkExperience"); 
if ($workexperiencelist->length > 0)
	/* For each on of the list elements get the various elements included in the workexperience entity
 	* and load them in the coresponding variables. */
	foreach ($workexperiencelist as $workexperience)
	{
                $ok++;
                $this->work_id[$i]=-1;
		$froms = $workexperience->getElementsByTagName("From");
                $date=0;
                $day=0;$month=0;$year=0;
		
                    

			if($workexperience->getElementsByTagName("From")->item(0)) {
				$this->fyear[$i] = $workexperience->getElementsByTagName("From")->item(0)->getAttribute("year");
                                $year++; $date++;
			} 
			if($workexperience->getElementsByTagName("From")->item(0)) {
				$this->fmonth[$i] = trim($workexperience->getElementsByTagName("From")->item(0)->getAttribute("month"),'-');
                                $month++;
			} 
			if($workexperience->getElementsByTagName("From")->item(0)) {
				$this->fday[$i] = trim($workexperience->getElementsByTagName("From")->item(0)->getAttribute("day"),'-');
                                $day++;
			} 
                        
		
                if($date==0){
                    $this->fyear[$i]="Y";
                    $this->fmonth[$i]="M";
                    $this->fday[$i]="D";
                }
                if($day==0) $this->fday[$i]="D";
                if($month==0) $this->fmonth[$i]="M";
                if($year==0) $this->fyear[$i]="Y";
                $date=0;
                $day=0;$month=0;$year=0;
			if($workexperience->getElementsByTagName("To")->item(0)) {
				$this->tyear[$i] = $workexperience->getElementsByTagName("To")->item(0)->getAttribute("year");
                                $year++; $date++;
			} 
			if($workexperience->getElementsByTagName("To")->item(0)) {
				$this->tmonth[$i] = trim($workexperience->getElementsByTagName("To")->item(0)->getAttribute("month"),'-');
                                $month++;
			} 
			if($workexperience->getElementsByTagName("To")->item(0)) {
				$this->tday[$i] = trim($workexperience->getElementsByTagName("To")->item(0)->getAttribute("day"),'-');
                                $day++;
			} 
                        
		
                if($date==0){
                    $this->tyear[$i]="Y";
                    $this->tmonth[$i]="M";
                    $this->tday[$i]="D";
                }
                if($day==0) $this->tday[$i]="D";
                if($month==0) $this->tmonth[$i]="M";
                if($year==0) $this->tyear[$i]="Y";
		$positions = $workexperience->getElementsByTagName("Position");
		foreach ($positions as $position)
		{
			if($position->getElementsByTagName("Code")->item(0)) {
				$pcode = $position->getElementsByTagName("Code")->item(0)->nodeValue;
			} 
			if($position->getElementsByTagName("Label")->item(0)) {
				$this->position[$i] = $position->getElementsByTagName("Label")->item(0)->nodeValue;
                                
			} 
		}
		if ($workexperience->getElementsByTagName("Activities")->item(0)) {
			$this->activities[$i] = $workexperience->getElementsByTagName("Activities")->item(0)->nodeValue;
                        
		} 
		if ($workexperience->getElementsByTagName("Name")->item(0)) {
			$this->work_name[$i] = $workexperience->getElementsByTagName("Name")->item(0)->nodeValue;
		} 
		if ($workexperience->getElementsByTagName("AddressLine")->item(0)) {
			$this->work_adress[$i] = $workexperience->getElementsByTagName("AddressLine")->item(0)->nodeValue;
		} 
		if ($workexperience->getElementsByTagName("Municipality")->item(0)) {
			$this->work_city[$i] = $workexperience->getElementsByTagName("Municipality")->item(0)->nodeValue;
		} 
		if ($workexperience->getElementsByTagName("PostalCode")->item(0)) {
			$this->pcode[$i] = $workexperience->getElementsByTagName("PostalCode")->item(0)->nodeValue;
		} 
		$countries = $workexperience->getElementsByTagName("Country");
		foreach ($countries as $country)
		{
			if($country->getElementsByTagName("Code")->item(0)) {
				$this->work_country_code[$i] = $country->getElementsByTagName("Code")->item(0)->nodeValue;
			} 
			if($country->getElementsByTagName("Label")->item(0)) {
				$this->work_country[$i] = $country->getElementsByTagName("Label")->item(0)->nodeValue;
			} 
		}
		$sectors = $workexperience->getElementsByTagName("Sector");
		foreach ($sectors as $sector)
		{
			if($sector->getElementsByTagName("Code")->item(0)) {
				$this->sector_code = $sector->getElementsByTagName("Code")->item(0)->nodeValue;
			} 
			if($sector->getElementsByTagName("Label")->item(0)) {
				$this->sector[$i] = $sector->getElementsByTagName("Label")->item(0)->nodeValue;
			} 
		}
                $i++;
		
	}
$i=0;
# Get from the XML all the elements with tag name 'education' and load them in a list.
$educationlist = $doc->getElementsByTagName("Education");
if ($educationlist->length > 0)
	/* For each on of the list elements get the various elements included in the education entity
 	* and load them in the coresponding variables. */
	foreach ($educationlist as $education)
	{
                $ok++;
                $this->education_id[$i]=-1;
		
                 $date=0;
                $day=0;$month=0;$year=0;
		
                    
			if($education->getElementsByTagName("From")->item(0)) {
				$this->org_fyear[$i] = $education->getElementsByTagName("From")->item(0)->getAttribute("year");
                                $year++;$date++;
			} else {}
			if($education->getElementsByTagName("From")->item(0)) {
				$this->org_fmonth[$i] = trim($education->getElementsByTagName("From")->item(0)->getAttribute("month"),'-');
                                $month++;
			} else {}
			if($education->getElementsByTagName("From")->item(0)) {
				$this->org_fday[$i] = trim($education->getElementsByTagName("From")->item(0)->getAttribute("day"),'-');
                                $day++;
			} else {}
		
                if($date==0){
                    $this->org_fyear[$i]="Y";
                    $this->org_fmonth[$i]="M";
                    $this->org_fday[$i]="D";
                }
                if($day==0) $this->org_fday[$i]="D";
                if($month==0) $this->org_fmonth[$i]="M";
                if($year==0) $this->org_fyear[$i]="Y";
		
                 $date=0;
                $day=0;$month=0;$year=0;
		
                  
			if($education->getElementsByTagName("To")->item(0)) {
				$this->org_tyear[$i] = $education->getElementsByTagName("To")->item(0)->getAttribute("year");
                                $year++;   $date++;
			} else {}
			if($education->getElementsByTagName("To")->item(0)) {
				$this->org_tmonth[$i] = trim($education->getElementsByTagName("To")->item(0)->getAttribute("month"),'-');
                                $month++;
			} else {}
			if($education->getElementsByTagName("To")->item(0)) {
				$this->org_tday[$i] = trim($education->getElementsByTagName("To")->item(0)->getAttribute("day"),'-');
                                $day++;
			} else {}
		
                 if($date==0){
                    $this->org_tyear[$i]="Y";
                    $this->org_tmonth[$i]="M";
                    $this->org_tday[$i]="D";
                }
                if($day==0) $this->org_tday[$i]="D";
                if($month==0) $this->org_tmonth[$i]="M";
                if($year==0) $this->org_tyear[$i]="Y";
		if ($education->getElementsByTagName("Title")->item(0)) {
			$this->title[$i] = $education->getElementsByTagName("Title")->item(0)->nodeValue;
		} else {}
		if ($education->getElementsByTagName("Activities")->item(0)) {
			$this->subject[$i] = $education->getElementsByTagName("Activities")->item(0)->nodeValue;
		} else {}

		if ($education->getElementsByTagName("Name")->item(0)) {
			$this->org_name[$i] = $education->getElementsByTagName("Name")->item(0)->nodeValue;
		} else {}
		if ($education->getElementsByTagName("AddressLine")->item(0)) {
			$this->org_address[$i] = $education->getElementsByTagName("AddressLine")->item(0)->nodeValue;
		} else {}
		if ($education->getElementsByTagName("Municipality")->item(0)) {
			$this->org_city[$i] = $education->getElementsByTagName("Municipality")->item(0)->nodeValue;
		} else {}
		if ($education->getElementsByTagName("PostalCode")->item(0)) {
			$epcode = $education->getElementsByTagName("PostalCode")->item(0)->nodeValue;
		} else {}

		$ecountries = $education->getElementsByTagName("Country");
		foreach ($ecountries as $ecountry)
		{
			if($ecountry->getElementsByTagName("Code")->item(0)) {
				$educcode = $ecountry->getElementsByTagName("Code")->item(0)->nodeValue;
			} else {}
			if($ecountry->getElementsByTagName("Label")->item(0)) {
				$this->org_country[$i] = $ecountry->getElementsByTagName("Label")->item(0)->nodeValue;
			} else {}
		}
		if ($education->getElementsByTagName("type")->item(0)) {
			$this->org_type[$i] = $education->getElementsByTagName("type")->item(0)->nodeValue;
		}

		$levels = $education->getElementsByTagName("Level");
		foreach ($levels as $level)
		{
			if($level->getElementsByTagName("Code")->item(0)) {
				$edulcode = $level->getElementsByTagName("Code")->item(0)->nodeValue;
			} else {}
			if($level->getElementsByTagName("Label")->item(0)) {
				$this->edu_level[$i] = $level->getElementsByTagName("Label")->item(0)->nodeValue;
			} else {}
		}

		$edufields = $education->getElementsByTagName("Field");
		foreach ($edufields as $edufield)
		{
			if($edufield->getElementsByTagName("Code")->item(0)) {
				$edufcode = $edufield->getElementsByTagName("Code")->item(0)->nodeValue;
			} else {}
			if($edufield->getElementsByTagName("Label")->item(0)) {
				$this->edu_field[$i] = $edufield->getElementsByTagName("Label")->item(0)->nodeValue;
			} else {}
		}
		#Insert the data in the ecv_education table
		$i++;
	}

# Get from the XML all the elements with tag name 'languagelist' and load them in a list.
$languagelists = $doc->getElementsByTagName("Linguistic");
$i=0;
/* For each on of the list elements get the various elements included in the languagelist entity
* and load them in the coresponding variables. */
foreach ($languagelists as $languagelist)
{
        $ok++;
	$monlang = $languagelist->getElementsByTagName("MotherTongue");
        foreach($monlang as $mon){
            foreach($mon->getElementsByTagName("Description") as $m){
                $this->Mother_tongue=$m->getElementsByTagName("Label")->item(0)->nodeValue; 
            }
        }
	$num = 0;
	foreach ($languagelist->getElementsByTagName("ForeignLanguage") as $language)
	{
            foreach($language->getElementsByTagName("Description") as $la){
                $this->olanguage[$i] =$la->getElementsByTagName("Label")->item(0)->nodeValue; 
            }
            $this->language_id[$i]=-1;
		
		
			
				
				$this->listening[$i]          = $language->getElementsByTagName("Listening")->item(0)->nodeValue;
				$this->reading[$i]            = $language->getElementsByTagName("Reading")->item(0)->nodeValue;
				$this->spoken_interaction[$i]  = $language->getElementsByTagName("SpokenInteraction")->item(0)->nodeValue;
				$this->spoken_production[$i]   = $language->getElementsByTagName("SpokenProduction")->item(0)->nodeValue;
				$this->writing[$i]            = $language->getElementsByTagName("Writing")->item(0)->nodeValue;
				#Insert the data in the ecv_language table
				$i++;
				break;
		
                

	}
}



$k = 0;
/* For each on of the list elements get the various elements included in the skilllist entity
* and load them in the coresponding variables. */

    $ok++;
	$skillitems = $doc->getElementsByTagName("Communication");
	foreach($skillitems as $skillitem)
	{
		$this->Social_skills= $skillitem->getElementsByTagName("Description")->item(0)->nodeValue;
                $ok++;
		
	}
        $skillitems = $doc->getElementsByTagName("Organisational");
	foreach($skillitems as $skillitem)
	{
            $this->Organisational_skills         = $skillitem->getElementsByTagName("Description")->item(0)->nodeValue;
            $ok++;
        }
         $skillitems = $doc->getElementsByTagName("Computer");
	foreach($skillitems as $skillitem)
	{
            $this->Computer_skills = $skillitem->getElementsByTagName("Description")->item(0)->nodeValue;
            $ok++;
        }
         $skillitems = $doc->getElementsByTagName("Other");
	foreach($skillitems as $skillitem)
	{
            $this->Other_skills          = $skillitem->getElementsByTagName("Description")->item(0)->nodeValue; 
            $ok++;
        }
        
         $this->Driving_licence=0;




# Get from the XML all the elements with tag name 'misclist' and load them in a list.
$misclists = $doc->getElementsByTagName("AchievementList");

/* For each on of the list elements get the various elements included in the misclist entity
* and load them in the coresponding variables. */
foreach( $misclists as $misclist )
{
    $this->Additional_information="";
	$miscitems = $misclist->getElementsByTagName("Achievement");
	foreach($miscitems as $miscitem)
	{
		$this->Additional_information = $this->Additional_information." ".$miscitem->getElementsByTagName("Label")->item(0)->nodeValue;
                $this->Additional_information=$this->Additional_information.":  ".$miscitem->getElementsByTagName("Description")->item(0)->nodeValue;
		
	}
	#Update the data in the ecv_xml table with the data of the misc skill section
	
}

$this->Annexes="";
#Delete the uploaded file

                  
		return $ok;
		  
	}
        
        public function readXMLold($xml)
        {
                            /* @var DOMDocument
             * Load the XML File in a DOM Document.
             * */
            $doc = new DOMDocument();
            $doc->load($xml);
            $ok=0;
            
            /* Load the data of the first step, included in the <identification> tag.
             * The data are loaded in ecv_xml table.*/

            # Get from the XML all the elements with tag name 'identification' and load them in a list.
            $identifications = $doc->getElementsByTagName("identification");
            foreach( $identifications as $identification )
            {
                $ok++;

            /* For each on of the list elements get the various elements included in the identification entity
             * and load them in the coresponding variables. */
                    if ($identification->getElementsByTagName("firstname"))
                    {
                            if(strlen($identification->getElementsByTagName("firstname")->item(0)->nodeValue)>3)
                                $this->Name=$identification->getElementsByTagName("firstname")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("lastname")) {
                            if(strlen( $identification->getElementsByTagName("lastname")->item(0)->nodeValue)>3)
                                    $this->Surname=$identification->getElementsByTagName("lastname")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("addressLine")) {
                            $this->Address  = $identification->getElementsByTagName("addressLine")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("municipality")) {
                            $this->City = $identification->getElementsByTagName("municipality")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("postalCode")) {
                            $this->Postal_code   = $identification->getElementsByTagName("postalCode")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("country")) {
                            $countries    = $identification->getElementsByTagName("country");
                            foreach ($countries as $country)
                            {
                                    if ($identification->getElementsByTagName("code")->item(0)) {
                                            $this->Country_code  = $country->getElementsByTagName("code")->item(0)->nodeValue;
                                    } else {}
                                    if ($identification->getElementsByTagName("label")->item(0)) {
                                            $this->Country = $country->getElementsByTagName("label")->item(0)->nodeValue;
                                    } else {}
                            }
                    } else {

                    }
                    if ($identification->getElementsByTagName("telephone")) {
                            $this->Phone_number  = $identification->getElementsByTagName("telephone")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("fax")) {
                            $this->Fax       = $identification->getElementsByTagName("fax")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("mobile")) {
                            $this->Phone_number     = $identification->getElementsByTagName("mobile")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("email")) {
                            if(strlen($identification->getElementsByTagName("email")->item(0)->nodeValue)>5){
                                if($this->valid_email($identification->getElementsByTagName("email")->item(0)->nodeValue)==true)
                                        $this->Email=$identification->getElementsByTagName("email")->item(0)->nodeValue;
                            }
                    } else {}
                    if ($identification->getElementsByTagName("gender")) {
                            $this->Gender    = $identification->getElementsByTagName("gender")->item(0)->nodeValue;
                    } else {}
                    if ($identification->getElementsByTagName("birthdate")->item(0)) {
                            $this->Date_of_birth  = $identification->getElementsByTagName("birthdate")->item(0)->nodeValue;
                    } else {}


            

	/* Retrive the generated id for the insert.
	 * We will use it later to update the master table along with the detail ones with the rest of the data.
	 */

	$i=0;
	# Load the different nationalities in the coresponding variables
	$nationalities = $identification->getElementsByTagName("nationality");
	/* For each on of the list elements get the various elements included in the nationality entity
 	* and load them in the coresponding variables. */
	foreach ($nationalities as $nationality)
	{
		if ($nationality->getElementsByTagName("code")->item(0))
		{
			$ncode  = $nationality->getElementsByTagName("code")->item(0)->nodeValue;
		} else
		{

		}
		if ($nationality->getElementsByTagName("label")->item(0))
		{
			$this->Nationality = $nationality->getElementsByTagName("label")->item(0)->nodeValue;
		} else
		{

		}
                
		$ok++;

	}

            }

# Get from the XML all the elements with tag name 'application' and load them in a list.
$applications = $doc->getElementsByTagName("application");
/* For each on of the list elements get the various elements included in the application entity
* and load them in the coresponding variables. */
foreach( $applications as $application )
{
    $ok++;
	if ($application->getElementsByTagName("code")->item(0)) {
		$appcode  = $application->getElementsByTagName("code")->item(0)->nodeValue;
	} else {}
	if ($application->getElementsByTagName("label")->item(0)) {
		$this->Desired_employment = $application->getElementsByTagName("label")->item(0)->nodeValue;
	} else {}

}

$i=sizeof($this->work_id);
# Get from the XML all the elements with tag name 'workexperience' and load them in a list.
$workexperiencelist = $doc->getElementsByTagName("workexperience"); 
if ($workexperiencelist->length > 0)
	/* For each on of the list elements get the various elements included in the workexperience entity
 	* and load them in the coresponding variables. */
	foreach ($workexperiencelist as $workexperience)
	{
                $ok++;
                $this->work_id[$i]=-1;
		$froms = $workexperience->getElementsByTagName("from");
                $date=0;
                $day=0;$month=0;$year=0;
		foreach ($froms as $from)
		{
                    $date++;

			if($from->getElementsByTagName("year")->item(0)) {
				$this->fyear[$i] = $from->getElementsByTagName("year")->item(0)->nodeValue;
                                $year++;
			} 
			if($from->getElementsByTagName("month")->item(0)) {
				$this->fmonth[$i] = trim($from->getElementsByTagName("month")->item(0)->nodeValue,'-');
                                $month++;
			} 
			if($from->getElementsByTagName("day")->item(0)) {
				$this->fday[$i] = trim($from->getElementsByTagName("day")->item(0)->nodeValue,'-');
                                $day++;
			} 
                        
		}
                if($date==0){
                    $this->fyear[$i]="Y";
                    $this->fmonth[$i]="M";
                    $this->fday[$i]="D";
                }
                if($day==0) $this->fday[$i]="D";
                if($month==0) $this->fmonth[$i]="M";
                if($year==0) $this->fyear[$i]="Y";
                $date=0;
                $day=0;$month=0;$year=0;
		$tos = $workexperience->getElementsByTagName("to");
		foreach ($tos as $to)
		{
                    $date++;
			if($to->getElementsByTagName("year")->item(0)) {
				$this->tyear[$i] = $to->getElementsByTagName("year")->item(0)->nodeValue;
                                $year++;
			} 
			if($to->getElementsByTagName("month")->item(0)) {
				$this->tmonth[$i] = trim($to->getElementsByTagName("month")->item(0)->nodeValue,'-');
                                $month++;
			} 
			if($to->getElementsByTagName("day")->item(0)) {
				$this->tday[$i] = trim($to->getElementsByTagName("day")->item(0)->nodeValue,'-');
                                $day++;
			} 
                        
		}
                if($date==0){
                    $this->tyear[$i]="Y";
                    $this->tmonth[$i]="M";
                    $this->tday[$i]="D";
                }
                if($day==0) $this->tday[$i]="D";
                if($month==0) $this->tmonth[$i]="M";
                if($year==0) $this->tyear[$i]="Y";
		$positions = $workexperience->getElementsByTagName("position");
		foreach ($positions as $position)
		{
			if($position->getElementsByTagName("code")->item(0)) {
				$pcode = $position->getElementsByTagName("code")->item(0)->nodeValue;
			} 
			if($position->getElementsByTagName("label")->item(0)) {
				$this->position[$i] = $position->getElementsByTagName("label")->item(0)->nodeValue;
                                
			} 
		}
		if ($workexperience->getElementsByTagName("activities")->item(0)) {
			$this->activities[$i] = $workexperience->getElementsByTagName("activities")->item(0)->nodeValue;
                        
		} 
		if ($workexperience->getElementsByTagName("name")->item(0)) {
			$this->work_name[$i] = $workexperience->getElementsByTagName("name")->item(0)->nodeValue;
		} 
		if ($workexperience->getElementsByTagName("addressLine")->item(0)) {
			$this->work_adress[$i] = $workexperience->getElementsByTagName("addressLine")->item(0)->nodeValue;
		} 
		if ($workexperience->getElementsByTagName("municipality")->item(0)) {
			$this->work_city[$i] = $workexperience->getElementsByTagName("municipality")->item(0)->nodeValue;
		} 
		if ($workexperience->getElementsByTagName("postalCode")->item(0)) {
			$this->pcode[$i] = $workexperience->getElementsByTagName("postalCode")->item(0)->nodeValue;
		} 
		$countries = $workexperience->getElementsByTagName("country");
		foreach ($countries as $country)
		{
			if($country->getElementsByTagName("code")->item(0)) {
				$this->work_country_code[$i] = $country->getElementsByTagName("code")->item(0)->nodeValue;
			} 
			if($country->getElementsByTagName("label")->item(0)) {
				$this->work_country[$i] = $country->getElementsByTagName("label")->item(0)->nodeValue;
			} 
		}
		$sectors = $workexperience->getElementsByTagName("sector");
		foreach ($sectors as $sector)
		{
			if($sector->getElementsByTagName("code")->item(0)) {
				$this->sector_code = $sector->getElementsByTagName("code")->item(0)->nodeValue;
			} 
			if($sector->getElementsByTagName("label")->item(0)) {
				$this->sector[$i] = $sector->getElementsByTagName("label")->item(0)->nodeValue;
			} 
		}
                $i++;

	}
$i=sizeof($this->education_id);
# Get from the XML all the elements with tag name 'education' and load them in a list.
$educationlist = $doc->getElementsByTagName("education");
if ($educationlist->length > 0)
	/* For each on of the list elements get the various elements included in the education entity
 	* and load them in the coresponding variables. */
	foreach ($educationlist as $education)
	{
                $ok++;
                $this->education_id[$i]=-1;
		$efroms = $education->getElementsByTagName("from");
                 $date=0;
                $day=0;$month=0;$year=0;
		foreach ($efroms as $efrom)
		{
                    $date++;
			if($efrom->getElementsByTagName("year")->item(0)) {
				$this->org_fyear[$i] = $efrom->getElementsByTagName("year")->item(0)->nodeValue;
                                $year++;
			} else {}
			if($efrom->getElementsByTagName("month")->item(0)) {
				$this->org_fmonth[$i] = trim($efrom->getElementsByTagName("month")->item(0)->nodeValue,'-');
                                $month++;
			} else {}
			if($efrom->getElementsByTagName("day")->item(0)) {
				$this->org_fday[$i] = trim($efrom->getElementsByTagName("day")->item(0)->nodeValue,'-');
                                $day++;
			} else {}
		}
                if($date==0){
                    $this->org_fyear[$i]="Y";
                    $this->org_fmonth[$i]="M";
                    $this->org_fday[$i]="D";
                }
                if($day==0) $this->org_fday[$i]="D";
                if($month==0) $this->org_fmonth[$i]="M";
                if($year==0) $this->org_fyear[$i]="Y";
		$etos = $education->getElementsByTagName("to");
                 $date=0;
                $day=0;$month=0;$year=0;
		foreach ($etos as $eto)
		{
                    $date++;
			if($eto->getElementsByTagName("year")->item(0)) {
				$this->org_tyear[$i] = $eto->getElementsByTagName("year")->item(0)->nodeValue;
                                $year++;
			} else {}
			if($eto->getElementsByTagName("month")->item(0)) {
				$this->org_tmonth[$i] = trim($eto->getElementsByTagName("month")->item(0)->nodeValue,'-');
                                $month++;
			} else {}
			if($eto->getElementsByTagName("day")->item(0)) {
				$this->org_tday[$i] = trim($eto->getElementsByTagName("day")->item(0)->nodeValue,'-');
                                $day++;
			} else {}
		}
                 if($date==0){
                    $this->org_tyear[$i]="Y";
                    $this->org_tmonth[$i]="M";
                    $this->org_tday[$i]="D";
                }
                if($day==0) $this->org_tday[$i]="D";
                if($month==0) $this->org_tmonth[$i]="M";
                if($year==0) $this->org_tyear[$i]="Y";
		if ($education->getElementsByTagName("title")->item(0)) {
			$this->title[$i] = $education->getElementsByTagName("title")->item(0)->nodeValue;
		} else {}
		if ($education->getElementsByTagName("skills")->item(0)) {
			$this->subject[$i] = $education->getElementsByTagName("skills")->item(0)->nodeValue;
		} else {}

		if ($education->getElementsByTagName("name")->item(0)) {
			$this->org_name[$i] = $education->getElementsByTagName("name")->item(0)->nodeValue;
		} else {}
		if ($education->getElementsByTagName("addressLine")->item(0)) {
			$this->org_address[$i] = $education->getElementsByTagName("addressLine")->item(0)->nodeValue;
		} else {}
		if ($education->getElementsByTagName("municipality")->item(0)) {
			$this->org_city[$i] = $education->getElementsByTagName("municipality")->item(0)->nodeValue;
		} else {}
		if ($education->getElementsByTagName("postalCode")->item(0)) {
			$epcode = $education->getElementsByTagName("postalCode")->item(0)->nodeValue;
		} else {}

		$ecountries = $education->getElementsByTagName("country");
		foreach ($ecountries as $ecountry)
		{
			if($ecountry->getElementsByTagName("code")->item(0)) {
				$educcode = $ecountry->getElementsByTagName("code")->item(0)->nodeValue;
			} else {}
			if($ecountry->getElementsByTagName("label")->item(0)) {
				$this->org_country[$i] = $ecountry->getElementsByTagName("label")->item(0)->nodeValue;
			} else {}
		}
		if ($education->getElementsByTagName("type")->item(0)) {
			$this->org_type[$i] = $education->getElementsByTagName("type")->item(0)->nodeValue;
		}

		$levels = $education->getElementsByTagName("level");
		foreach ($levels as $level)
		{
			if($level->getElementsByTagName("code")->item(0)) {
				$edulcode = $level->getElementsByTagName("code")->item(0)->nodeValue;
			} else {}
			if($level->getElementsByTagName("label")->item(0)) {
				$this->edu_level[$i] = $level->getElementsByTagName("label")->item(0)->nodeValue;
			} else {}
		}

		$edufields = $education->getElementsByTagName("educationalfield");
		foreach ($edufields as $edufield)
		{
			if($edufield->getElementsByTagName("code")->item(0)) {
				$edufcode = $edufield->getElementsByTagName("code")->item(0)->nodeValue;
			} else {}
			if($edufield->getElementsByTagName("label")->item(0)) {
				$this->edu_field[$i] = $edufield->getElementsByTagName("label")->item(0)->nodeValue;
			} else {}
		}
		#Insert the data in the ecv_education table
		$i++;
	}

# Get from the XML all the elements with tag name 'languagelist' and load them in a list.
$languagelists = $doc->getElementsByTagName("languagelist");
$i=sizeof($this->language_id);
/* For each on of the list elements get the various elements included in the languagelist entity
* and load them in the coresponding variables. */
foreach ($languagelists as $languagelist)
{
        $ok++;
	$languages = $languagelist->getElementsByTagName("language");
	$num = 0;
	foreach ($languages as $language)
	{
            $this->language_id[$i]=-1;
		#Check if the language is the mother language or a foreign language.
		switch ($language->getAttribute("xsi:type"))
		{
			case "europass:mother" :
				if ($language->getElementsByTagName("code")->item(0)) {
				$mlcode  = $language->getElementsByTagName("code")->item(0)->nodeValue;
				} else {}
				$this->Mother_tongue = $language->getElementsByTagName("label")->item(0)->nodeValue;
				#Update the data in the ecv_xml table with the mother_language

				break;
			case "europass:foreign" :
				$this->language_code[$i]            = $language->getElementsByTagName("code")->item($num)->nodeValue;
				$this->olanguage[$i]            = $language->getElementsByTagName("label")->item($num)->nodeValue;
				$this->listening[$i]          = $language->getElementsByTagName("listening")->item($num)->nodeValue;
				$this->reading[$i]            = $language->getElementsByTagName("reading")->item($num)->nodeValue;
				$this->spoken_interaction[$i]  = $language->getElementsByTagName("spokeninteraction")->item($num)->nodeValue;
				$this->spoken_production[$i]   = $language->getElementsByTagName("spokenproduction")->item($num)->nodeValue;
				$this->writing[$i]            = $language->getElementsByTagName("writing")->item($num)->nodeValue;
				#Insert the data in the ecv_language table
				$i++;
				break;
		}
                

	}
}


# Get from the XML all the elements with tag name 'skilllist' and load them in a list.
$skilllists = $doc->getElementsByTagName("skilllist");
$k = 0;
/* For each on of the list elements get the various elements included in the skilllist entity
* and load them in the coresponding variables. */
foreach( $skilllists as $skilllist )
{
    $ok++;
	$skillitems = $skilllist->getElementsByTagName("skill");
	foreach($skillitems as $skillitem)
	{
		$this->Social_skills         = $skillitems->item(0)->nodeValue;
		$this->Organisational_skills = $skillitems->item(1)->nodeValue;
		$this->Technical_skills      = $skillitems->item(2)->nodeValue;
		$this->Computer_skills       = $skillitems->item(3)->nodeValue;
		$this->Artistic_skills       = $skillitems->item(4)->nodeValue;
		$this->Other_skills          = $skillitems->item(5)->nodeValue;
	}
	#Update the data in the ecv_xml table with the data of the skill section

}

# Get from the XML all the elements with tag name 'drivinglicence' and load them in a list.
$drivinglist = $doc->getElementsByTagName("drivinglicence");
$drivingcnt = $drivinglist->length;

if ($drivingcnt > 0)
{
	for ($idx = 0; $idx < $drivingcnt; $idx++) {
		$driv = $drivinglist->item($idx)->nodeValue;
		#Insert the data in the ecv_driving_licence table


	}
        if($driv!="" || $driv!=NULL) $this->Driving_licence=1;
        else $this->Driving_licence=0;
}

# Get from the XML all the elements with tag name 'misclist' and load them in a list.
$misclists = $doc->getElementsByTagName("misclist");

/* For each on of the list elements get the various elements included in the misclist entity
* and load them in the coresponding variables. */
foreach( $misclists as $misclist )
{
	$miscitems = $misclist->getElementsByTagName("misc");
	foreach($miscitems as $miscitem)
	{
		$this->Additional_information = $miscitems->item(0)->nodeValue;
		$this->Annexes    = $miscitems->item(1)->nodeValue;
	}
	#Update the data in the ecv_xml table with the data of the misc skill section

}



                  
		return $ok;

	}
        public function upload($p){
            $upload_path = "/tmp/";
            $target_path = $upload_path.basename( $_FILES['xml_cv']['name']);
            $maxfilesize=1024000;
            if ($_FILES['xml_cv']['size'] > $maxfilesize) {
                
                    unlink($_FILES['xml_cv']['tmp_name']); #Delete the temp file
                    return 1;
            }
            else{
                            if ($_FILES['xml_cv']['type'] == NULL) {
                            
                            return 2;
            } else if ($_FILES['xml_cv']['type'] !="text/xml" ) {
                   
                    return 3;
                }
                else{
                    
                    if(move_uploaded_file($_FILES['xml_cv']['tmp_name'], $target_path)) {
                        $xml = $target_path;
                        $ok=$this->readXML($xml);
                        if($ok<2){ 
                            $ok=$this->readXMLold($xml);
                        }
                        #Delete uploaded file
                        unlink($xml);
                        if($ok<2)
                            return 99;
                        else return 0;
                    }
                    else
                       
                    return 4;
                }
            }
        }
	
}

	if(isset($_POST['student_cv_edit_personal'])) {
		$add_student= new Students_cv();
		$add_student->load_from_post();
		$add_student->update_to_database_personal();
        }
        else if(isset($_POST['student_cv_edit_work'])) {
		$add_student= new Students_cv();
		$add_student->load_from_post();
		$add_student->update_to_database_work();
	}
        else if(isset($_POST['student_cv_edit_education'])) {
		$add_student= new Students_cv();
		$add_student->load_from_post();
		$add_student->update_to_database_education();
	}
        else if(isset($_POST['student_cv_edit_other'])) {
		$add_student= new Students_cv();
		$add_student->load_from_post();
		$add_student->update_to_database_language();
                $add_student->update_to_database_other();
                
	}

        else if(isset($_POST['readxml'])) {
		$add_student= new Students_cv();
		$add_student->load_from_database($_SESSION['cv_id']);
                $number=$add_student->upload($_POST);
                if($number==1)
                         echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>The file is too large<br/><br/><a href="" onclick="errorhide()">Close</a><br/></div>';
		else if($number==2)
                        echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>The file is empty.<br/><br/><a href="" onclick="errorhide()">Close</a><br/></div>';
                else if($number==3)
                         echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>You can only upload XML file<br/><br/><a href="" onclick="errorhide()">Close</a><br/></div>';
                else if($number==4)
                         echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>An error occurred while uploading the file.<br/><br/><a href="" onclick="errorhide()">Close</a><br/></div>';
                 else if($number==99)
                         echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>An error occurred while reading the file. Probably, file is not a valid Europass XML CV.<br/><br/><a href="" onclick="errorhide()">Close</a><br/></div>';
                else{
                    $add_student->update_to_database_personal(1);
                $add_student->update_to_database_education(1);
                $add_student->update_to_database_work(1);
                $add_student->update_to_database_language(1);
                $add_student->update_to_database_other(1);
                 echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>CV updated..<br/><br/><a href="" onclick="errorhide()">Close</a><br/></div>';
                }
	}





?>
