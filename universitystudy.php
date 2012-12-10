<?php
require_once('database.php');

class universitystudy {
	private $ID;
	private $type;
	private $Bachelor;
	private $Master;
	private $Research;
	private $Taught;
	private $PhD;
	private $Academic_PhD;
	private $Professional_doctorate;
	private $Predefined_PhD_project;
	private $Open_PhD_programme;
	private $Both;
	private $Number_of_places;
	private $Department;
	private $Maximum_duration;
	private $Winter;
	private $Summer;
	private $Years;
	private $English;
	private $German;
	private $Franch;
	private $Spanish;
	private $Italian;
	private $Other;
	private $Topic;
	private $Required_average_grade;
	private $Out_of;
	private $Scjolarship;
	private $Full_funding_provided;
	private $Partially_funding_provided;
	private $Contact_person;
	private $Name_and_surname;
	private $CDepartment;
	private $Email;
	private $Telephone;
	private $Day;
	private $Month;
	private $Year;
	private $date_of_creation;

	
	public function __construct(){
		$this->id="";$this->article="";	$this->from_date= date("Y-m-d h:i:s");
		$this->to_date=date("Y-m-d h:i:s",mktime(0,0,0,date("m")+6,date("d")+1,date("Y")));
		$this->counts="";$this->publish="publish";
		$this->published="forever";
	}
	
	public function set_type($type){
		$this->type=$type;
	}
	public function restart(){
		$this->id="";$this->article="";
		$this->from_date="";$this->to_date="";
		$this->counts="";$this->publish="";
		$this->published="";
	}
	
	public function load_universitystudy($publish_id){
		$db= new database();
		$sql="SELECT * FROM `university_study` as m WHERE m.ID='".$publish_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
		    while ($podaci = mysql_fetch_array($result)){
				$this->ID=$podaci['ID'];
				$this->type=$podaci['type'];
				$this->Bachelor=$podaci['Bachelor'];
				$this->Master=$podaci['Master'];
				$this->Research=$podaci['Research'];
				$this->Taught=$podaci['Taught'];
				$this->PhD=$podaci['PhD'];
				$this->Academic_PhD=$podaci['Academic_PhD'];
				$this->Professional_doctorate=$podaci['Professional_doctorate'];
				$this->Predefined_PhD_project=$podaci['Predefined_PhD_project'];
				$this->Open_PhD_programme=$podaci['Open_PhD_programme'];
				$this->Both=$podaci['Both'];
				$this->Number_of_places=$podaci['Number_of_places'];
				$this->Department=$podaci['Department'];
				$this->Maximum_duration=$podaci['Maximum_duration'];
				$this->Winter=$podaci['Winter'];
				$this->Summer=$podaci['Summer'];
				$this->Years=$podaci['Years'];
				$this->English=$podaci['English'];
				$this->German=$podaci['German'];
				$this->Franch=$podaci['Franch'];
				$this->Spanish=$podaci['Spanish'];
				$this->Italian=$podaci['Italian'];
				$this->Other=$podaci['Other'];
				$this->Topic=$podaci['Topic'];
				$this->Required_average_grade=$podaci['Required_average_grade'];
				$this->Out_of=$podaci['Out_of'];
				$this->Scjolarship=$podaci['Scjolarship'];
				$this->Full_funding_provided=$podaci['Full_funding_provided'];
				$this->Partially_funding_provided=$podaci['Partially_funding_provided'];
				$this->Contact_person=$podaci['Contact_person'];
				$this->Name_and_surname=$podaci['Name_and_surname'];
				$this->CDepartment=$podaci['CDepartment'];
				$this->Email=$podaci['Email'];
				$this->Telephone=$podaci['Telephone'];
				$this->Day=$podaci['Day'];
				$this->Month=$podaci['Month'];
				$this->Year=$podaci['Year'];
				$this->date_of_creation=$podaci['date_of_creation'];
		    };
	    };
	}
	
	public function load_from_post($p){
		$this->ID=@$_POST['us_ID'];
		$this->type=@$_POST['us_type'];
		$this->Bachelor=@$_POST['us_Bachelor'];
		$this->Master=@$_POST['us_Master'];
		$this->Research=@$_POST['us_Research'];
		$this->Taught=@$_POST['us_Taught'];
		$this->PhD=@$_POST['us_PhD'];
		$this->Academic_PhD=@$_POST['us_Academic_PhD'];
		$this->Professional_doctorate=@$_POST['us_Professional_doctorate'];
		$this->Predefined_PhD_project=@$_POST['us_Predefined_PhD_project'];
		$this->Open_PhD_programme=@$_POST['us_Open_PhD_programme'];
		$this->Both=@$_POST['us_Both'];
		$this->Number_of_places=@$_POST['us_Number_of_places'];
		$this->Department=addslashes(@$_POST['us_Department']);
		$this->Maximum_duration=@$_POST['us_Maximum_duration'];
		$this->Winter=@$_POST['us_Winter'];
		$this->Summer=@$_POST['us_Summer'];
		$this->Years=@$_POST['us_Years'];
		$this->English=@$_POST['us_English'];
		$this->German=@$_POST['us_German'];
		$this->Franch=@$_POST['us_Franch'];
		$this->Spanish=@$_POST['us_Spanish'];
		$this->Italian=@$_POST['us_Italian'];
		$this->Other=@$_POST['us_Other'];
		$this->Topic=@$_POST['us_Topic'];
		$this->Required_average_grade=@$_POST['us_Required_average_grade'];
		$this->Out_of=@$_POST['us_Out_of'];
		$this->Scjolarship=@$_POST['us_Scjolarship'];
		$this->Full_funding_provided=@$_POST['us_Full_funding_provided'];
		$this->Partially_funding_provided=@$_POST['us_Partially_funding_provided'];
		$this->Contact_person=@$_POST['us_Contact_person'];
		$this->Name_and_surname=@$_POST['us_Name_and_surname'];
		$this->CDepartment=@$_POST['us_CDepartment'];
		$this->Email=@$_POST['us_Email'];
		$this->Telephone=@$_POST['us_Telephone'];
		$this->Day=@$_POST['us_Day'];
		$this->Month=@$_POST['us_Month'];
		$this->Year=@$_POST['us_Year'];
		$this->date_of_creation=@$_POST['us_date_of_creation'];
	}
	
	public function save_to_database(){
		$db= new database();
		$sql="INSERT INTO `university_study` VALUES 
 (NULL,'".$this->type."','".$this->Bachelor."','".$this->Master."','".$this->Research."','".$this->Taught."','".$this->PhD."','".$this->Academic_PhD."','".$this->Professional_doctorate."','".$this->Predefined_PhD_project."','".$this->Open_PhD_programme."','".$this->Both."','".$this->Number_of_places."','".$this->Department."','".$this->Maximum_duration."','".$this->Winter."','".$this->Summer."','".$this->Years."','".$this->English."','".$this->German."','".$this->Franch."','".$this->Spanish."','".$this->Italian."','".$this->Other."','".$this->Topic."','".$this->Required_average_grade."','".$this->Out_of."','".$this->Scjolarship."','".$this->Full_funding_provided."','".$this->Partially_funding_provided."','".$this->Contact_person."','".$this->Name_and_surname."','".$this->CDepartment."','".$this->Email."','".$this->Telephone."','".$this->Day."','".$this->Month."','".$this->Year."',NOW())";
		list($a,$this->id)=$db->query($sql);
		return $this->id;
	}
	
	public function update_to_database(){
		$db= new database();
		$sql="UPDATE `university_study` SET type='".$this->type."', Bachelor='".$this->Bachelor."', Master='".$this->Master."', Research='".$this->Research."', Taught='".$this->Taught."', PhD='".$this->PhD."', Academic_PhD='".$this->Academic_PhD."', Professional_doctorate='".$this->Professional_doctorate."', Predefined_PhD_project='".$this->Predefined_PhD_project."', Open_PhD_programme='".$this->Open_PhD_programme."', Both1='".$this->Both."', Number_of_places='".$this->Number_of_places."', Department='".$this->Department."', Maximum_duration='".$this->Maximum_duration."', Winter='".$this->Winter."', Summer='".$this->Summer."', Years='".$this->Years."', English='".$this->English."', German='".$this->German."', Franch='".$this->Franch."', Spanish='".$this->Spanish."', Italian='".$this->Italian."', Other='".$this->Other."', Topic='".$this->Topic."', Required_average_grade='".$this->Required_average_grade."', Out_of='".$this->Out_of."', Scjolarship='".$this->Scjolarship."', Full_funding_provided='".$this->Full_funding_provided."', Partially_funding_provided='".$this->Partially_funding_provided."', Contact_person='".$this->Contact_person."', Name_and_surname='".$this->Name_and_surname."', CDepartment='".$this->CDepartment."', Email='".$this->Email."', Telephone='".$this->Telephone."', Day='".$this->Day."', Month='".$this->Month."', Year='".$this->Year."' WHERE ID='".$this->ID."'";
		$db->query($sql);
	}
	
	public function delete_from_database(){
		$db= new database();
		$sql="DELETE FROM `jobs_intersips`  WHERE ID='".$this->id."'";
		$db->query($sql);
	}
	
	public function show_data(){
		echo '<br><div class="article"><ul>
	 <li>Master/PhD:';if($this->Master==1){ echo '<img src="images/yes.png" wspace="1" hspace="1"></li>';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>Bachelor
	 ';if($this->Bachelor==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li>
	 <li>Educational form:';if($this->Research==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>Research
	 ';if($this->Taught==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>Taught
	 PhD:';if($this->PhD==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>
	 <li>Educational form:';if($this->Academic_PhD==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>Academic PhD
	 ';if($this->Professional_doctorate==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>Professional doctorate
	 <li>Project type:';if($this->Predefined_PhD_project==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>Predefined PhD project
	 ';if($this->Open_PhD_programme==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>Open PhD programme
	 ';if($this->Both==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>Both
	 '.$this->Number_of_places.'</li> 
	 <li>Department '.$this->Department.'</li>
	 <li>';if($this->Maximum_duration==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo 'Maximum duration</li>
	 <li>';if($this->Winter==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>Winter
	 ';if($this->Summer==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li><li>Summer
	 '.$this->Years.'</li>
	 <li>';if($this->English==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo 'English</li>
	 <li>';if($this->German==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo 'German</li>
	 <li>';if($this->Franch==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">';  };echo 'Franch</li>
	 <li>';if($this->Spanish==1){  echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">';  };echo 'Spanish</li>
	 <li>';if($this->Italian==1){  echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">';  };echo 'Italian</li>
	 <li>Other '.$this->Other.'</li>
	 <li>Topic'.$this->Topic.'</li>
	 <li>Required average grade'.$this->Required_average_grade.' our of '.$this->Out_of.'</li>
	 ';if($this->Scjolarship==1){  echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; }; echo '<li>Scholarship/Funding
	 ';if($this->Full_funding_provided==1){  echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">';  };echo '</li><li>Full funding provided
	';if($this->Partially_funding_provided==1){  echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">';  };echo '</li><li>Partial funding provided
	 ';if($this->Contact_person==1){ echo '<img src="images/yes.png" wspace="1" hspace="1">';} else { echo '<img src="images/no.png" wspace="1" hspace="1">'; };echo '</li>Contact person
	 <li>Name and surname: '.$this->Name_and_surname.'</li>
	 <li>Department: '.$this->CDepartment.'</li>
	 <li>Email: '.$this->Email.'</li>
	 <li>Telephone: '.$this->Telephone.'</li>
	 <li>Deadline to apply:'.$this->Day.'.'.$this->Month.'.'.$this->Year.'</li></ul><br></div>';
	
	}
	
	public function show_publish_form(){

	echo '<br>
	 <label></label><input name="us_type" class="lykeion_textbox" type="hidden" id="us_type"  value="'.$this->type.'"/><input name="us_ID" class="lykeion_textbox" type="hidden" id="us_ID" size="65" maxlength="30" style="width:98%" value="'.$this->ID.'"/>';if($this->Bachelor==1){ echo ' <input name="us_Bachelor" value="1" class="lykeion_textbox" type="checkbox" id="us_Bachelor" checked="checked" >';} else { echo '<input name="us_Bachelor" value="1" class="lykeion_textbox" type="checkbox" id="us_Bachelor" >'; };echo 'Bachelor<br>
	<label></label>';if($this->Master==1){ echo ' <input name="us_Master" class="lykeion_textbox" type="checkbox" value="1" id="us_Master" checked="checked" >';} else { echo '<input name="us_Master" class="lykeion_textbox" type="checkbox" value="1" id="us_Master" >'; };echo 'Master<br>
	 <label></label>';if($this->Research==1){ echo ' <input name="us_Research" class="lykeion_textbox" value="1" type="checkbox" id="us_Research" checked="checked" >';} else { echo '<input name="us_Research" value="1" class="lykeion_textbox" type="checkbox" id="us_Research" >'; };echo 'Research<br>
	 
	 <label></label>';if($this->PhD==1){ echo ' <input name="us_PhD" class="lykeion_textbox" type="checkbox" id="us_PhD" value="1" checked="checked" >';} else { echo '<input name="us_PhD" class="lykeion_textbox" type="checkbox" value="1" id="us_PhD" >'; };echo 'PhD<br>
	 	 
	 
	 <label>Number of places</label><input name="us_Number_of_places" class="lykeion_textbox" type="text" id="us_Number_of_places"  value="'.$this->Number_of_places.'"/> 
	 <label>Department</label><input name="us_Department" class="lykeion_textbox" type="text" id="us_Department" value="'.$this->Department.'"/><br>
	 <label></label>';if($this->Maximum_duration==1){ echo ' <input value="1" name="us_Maximum_duration" class="lykeion_textbox" type="checkbox" id="us_Maximum_duration" checked="checked" >';} else { echo '<input value="1" name="us_Maximum_duration" class="lykeion_textbox" type="checkbox" id="us_Maximum_duration" >'; };echo 'Maximum duration<br>
	  <label></label>&nbsp;&nbsp;&nbsp;&nbsp;';if($this->Winter==1){ echo ' <input value="1" name="us_Winter" class="lykeion_textbox" type="checkbox" id="us_Winter" checked="checked" >';} else { echo '<input value="1" name="us_Winter" class="lykeion_textbox" type="checkbox" id="us_Winter" >'; };echo 'Winter<br>
	  <label></label>&nbsp;&nbsp;&nbsp;&nbsp;';if($this->Summer==1){ echo ' <input value="1" name="us_Summer" class="lykeion_textbox" type="checkbox" id="us_Summer" checked="checked" >';} else { echo '<input value="1" name="us_Summer" class="lykeion_textbox" type="checkbox" id="us_Summer" >'; };echo 'Summer<br>
	 <label>Years </label> <input name="us_Years" class="lykeion_textbox" type="text" id="us_Years"  value="'.$this->Years.'"/> <br>
	 <label>Language of tuition</label>';if($this->English==1){ echo ' <input value="1" name="us_English" class="lykeion_textbox" type="checkbox" id="us_English" checked="checked" >';} else { echo '<input value="1" name="us_English" class="lykeion_textbox" type="checkbox" id="us_English" >'; };echo 'English<br>
	  <label></label>';if($this->German==1){ echo ' <input value="1" name="us_German" class="lykeion_textbox" type="checkbox" id="us_German" checked="checked" >';} else { echo '<input name="us_German" value="1" class="lykeion_textbox" type="checkbox" id="us_German" >'; };echo 'German<br>
	  <label></label>';if($this->Franch==1){ echo ' <input value="1" name="us_Franch" class="lykeion_textbox" type="checkbox" id="us_Franch" checked="checked" >';} else { echo '<input name="us_Franch" value="1" class="lykeion_textbox" type="checkbox" id="us_Franch" >'; };echo 'Franch<br>
	  <label></label>';if($this->Spanish==1){ echo ' <input value="1" name="us_Spanish" class="lykeion_textbox" type="checkbox" id="us_Spanish" checked="checked" >';} else { echo '<input name="us_Spanish" value="1" class="lykeion_textbox" type="checkbox" id="us_Spanish" >'; };echo 'Spanish<br>
	  <label></label>';if($this->Italian==1){ echo ' <input value="1" name="us_Italian" class="lykeion_textbox" type="checkbox" id="us_Italian" checked="checked" >';} else { echo '<input name="us_Italian" value="1" class="lykeion_textbox" type="checkbox" id="us_Italian" >'; };echo 'Italian<br>
	 <label>Other </label> <input name="us_Other" class="lykeion_textbox" type="text" id="us_Other" value="'.$this->Other.'"/> 
	 <label>Topic</label><input name="us_Topic" class="lykeion_textbox" type="text" id="us_Topic"  value="'.$this->Topic.'"/> 
	 <label>Required average grade</label><input name="us_Required_average_grade" class="lykeion_textbox" type="text" id="us_Required_average_grade"  value="'.$this->Required_average_grade.'"/> 
	 <label>out of </label> <input name="us_Out_of" class="lykeion_textbox" type="text" id="us_Out_of" value="'.$this->Out_of.'"/> <br>
	 <label></label>';if($this->Scjolarship==1){ echo ' <input name="us_Scjolarship" value="1" class="lykeion_textbox" type="checkbox" id="us_Scjolarship" checked="checked" >';} else { echo '<input value="1" name="us_Scjolarship" class="lykeion_textbox" type="checkbox" id="us_Scjolarship" >'; };echo 'Scholarship/Funding<br>
	  <label></label>';if($this->Full_funding_provided==1){ echo ' <input value="1" name="us_Full_funding_provided" class="lykeion_textbox" type="checkbox" id="us_Full_funding_provided" checked="checked" >';} else { echo '<input value="1" name="us_Full_funding_provided" class="lykeion_textbox" type="checkbox" id="us_Full_funding_provided" >'; };echo 'Full funding provided<br>
	  <label></label>';if($this->Partially_funding_provided==1){ echo ' <input value="1" name="us_Partially_funding_provided" class="lykeion_textbox" type="checkbox" id="us_Partially_funding_provided" checked="checked" >';} else { echo '<input value="1" name="us_Partially_funding_provided" class="lykeion_textbox" type="checkbox" id="us_Partially_funding_provided" >'; };echo 'Partial funding provided<br>
	  <label></label>';if($this->Contact_person==1){ echo ' <input value="1" name="us_Contact_person" class="lykeion_textbox" type="checkbox" id="us_Contact_person" checked="checked" >';} else { echo '<input value="1" name="us_Contact_person" class="lykeion_textbox" type="checkbox" id="us_Contact_person" >'; };echo 'Contact person<br>
	 <label>Name and surname </label> <input name="us_Name_and_surname" class="lykeion_textbox" type="text" id="us_Name_and_surname"  value="'.$this->Name_and_surname.'"/> 
	 
	 <label>Email </label> <input name="us_Email" class="lykeion_textbox" type="text" id="us_Email"  value="'.$this->Email.'"/> 
	 <label>Telephone </label> <input name="us_Telephone" class="lykeion_textbox" type="text" id="us_Telephone"  value="'.$this->Telephone.'"/>
	 <label>Deadline to apply:</label><select name="us_Day" class="lykeion_textbox" id="us_Day"  />'; 
	  for( $i=1;$i<32;$i++)
			if($i==$this->Day){
				echo('<option value="'.$i.'" selected="selected">'.$i.'</option>');
			} else {
				echo('<option value="'.$i.'">'.$i.'</option>');
			};
	echo '</select><select name="us_Month" class="lykeion_textbox" id="us_Month"  />';
	for( $i=1;$i<13;$i++)
			if($i==$this->Month){
				echo('<option value="'.$i.'" selected="selected">'.$i.'</option>');
			} else {
				echo('<option value="'.$i.'">'.$i.'</option>');
			};
	echo '</select><select name="us_Year" class="lykeion_textbox" id="us_Year" />';
	for( $i=2011;$i<2026;$i++)
			if($i==$this->Month){
				echo('<option value="'.$i.'" selected="selected">'.$i.'</option>');
			} else {
				echo('<option value="'.$i.'">'.$i.'</option>');
			};
	echo '</select>';
	}
		
}
 
?>