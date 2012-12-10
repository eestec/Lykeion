<?php
require_once('database.php');

class jobstypes {
	private $id;
	private $article;
	private $type;
	private $Number_of_interns;
	private $Duration;
	private $Paid_intership;
	private $Accomodation_costs;
	private $Country;
	private $City;
	private $Position;
	private $Deadline;
	private $Forgein_language;
	private $Internduties;
	private $Academic_level;
	private $Driving_licence;
	private $Type_of;
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
	
	public function load_jobtype($publish_id){
		$db= new database();
		$sql="SELECT * FROM `jobs_intersips` as m WHERE m.ID='".$publish_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
		    while ($podaci = mysql_fetch_array($result)){
				$this->ID=$podaci['ID'];
				$this->type=$podaci['type'];
				$this->Number_of_interns=$podaci['Number_of_interns'];
				$this->Duration=$podaci['Duration'];
				$this->Paid_intership=$podaci['Paid_intership'];
				$this->Accomodation_costs=$podaci['Accomodation_costs'];
				$this->Country=$podaci['Country'];
				$this->City=$podaci['City'];
				$this->Position=$podaci['Position'];
				$this->Deadline=$podaci['Deadline'];
				$this->Forgein_language=$podaci['Forgein_language'];
				$this->Internduties=$podaci['Internduties'];
				$this->Academic_level=$podaci['Academic_level'];
				$this->Driving_licence=$podaci['Driving_licence'];
				$this->Type_of=$podaci['Type_of'];
				$this->date_of_creation=$podaci['date_of_creation'];
		    };
	    };
	}
	
	public function load_from_post($p){
		$this->ID=@$_POST['jb_ID'];
		$this->type=@$_POST['jb_type'];
		$this->Number_of_interns=@$_POST['jb_Number_of_interns'];
		$this->Duration=@$_POST['jb_Duration'];
		$this->Paid_intership=@$_POST['jb_Paid_intership'];
		$this->Accomodation_costs=@$_POST['jb_Accomodation_costs'];
		$this->Country=addslashes(@$_POST['jb_Country']);
		$this->City=addslashes(@$_POST['jb_City']);
		$this->Position=addslashes(@$_POST['jb_Position']);
		$this->Deadline=@$_POST['jb_Deadline'];
		$this->Forgein_language=addslashes(@$_POST['jb_Forgein_language']);
		$this->Internduties=@$_POST['jb_Internduties'];
		$this->Academic_level=addslashes(@$_POST['jb_Academic_level']);
		$this->Driving_licence=@$_POST['jb_Driving_licence'];
		$this->Type_of=addslashes(@$_POST['jb_Type_of']);
		$this->date_of_creation=@$_POST['jb_date_of_creation'];
	}
	
	public function save_to_database(){
		$db= new database();
		$sql="INSERT INTO `jobs_intersips` VALUES 
        (NULL,'".$this->type."','".$this->Number_of_interns."','".htmlentities($this->Duration)."','".$this->Paid_intership."','".$this->Accomodation_costs."','".$this->Country."','".$this->City."','".$this->Position."',NOW(),'".$this->Forgein_language."','".$this->Internduties."','".$this->Academic_level."','".$this->Driving_licence."','".$this->Type_of."',NOW() )";
		list($a,$this->id)=$db->query($sql);
		return $this->id;
	}
	
	public function update_to_database(){
		$db= new database();echo $this->Number_of_interns;
		$sql="UPDATE `jobs_intersips` SET type='".$this->type."', Number_of_interns='".$this->Number_of_interns."', Duration='".$this->Duration."', Paid_intership='".$this->Paid_intership."', Accomodation_costs='".$this->Accomodation_costs."', Country='".$this->Country."', City='".$this->City."', Position='".$this->Position."', Deadline='".$this->Deadline."', Forgein_language='".$this->Forgein_language."', Internduties='".$this->Internduties."', Academic_level='".$this->Academic_level."', Driving_licence='".$this->Driving_licence."', Type_of='".$this->Type_of."'  WHERE ID='".$this->id."'";
		$db->query($sql);
	}
	
	public function delete_from_database(){
		$db= new database();
		$sql="DELETE FROM `jobs_intersips`  WHERE ID='".$this->id."'";
		$db->query($sql);
	}
	
	public function show_data(){
		echo '<div class="article"><ul>
			  <li>Number of Interns:'.$this->Number_of_interns;
		echo '</li>
			  <li>Duration: '.$this->Duration.'</li>
			  <li>Paid internship ';
		if($this->Paid_intership==0) {
			echo '<img src="images/yes.png" wspace="1" hspace="1">';
		}	else {
			echo '<img src="images/no.png" wspace="1" hspace="1">';
		};
			  
		echo '</li>
			  <li>Accommodation costs covered: ';
			  
		if($this->Accomodation_costs==0) {
			echo '<img src="images/yes.png" wspace="1" hspace="1">';
		}	else {
			echo '<img src="images/no.png" wspace="1" hspace="1">';
		};
			  
			  
		echo '</li>
			  <li>Country: '.$this->Country.'</li>
			  <li>City: '.$this->City.'</li>
			  <li>Position :'.$this->Position.'</li>
			  <li>Foreign language :'.$this->Forgein_language.'</li>
			  <li>Intern duties: '.$this->Internduties.'</li>
			  <li>Academic level: '.$this->Academic_level.'</li>
			  <li>Driving licence';
	
		if($this->Driving_licence==0) {
			echo '<img src="images/yes.png" wspace="1" hspace="1">';
		}	else {
			echo '<img src="images/no.png" wspace="1" hspace="1">';
		};
			  
		echo '</li>';
		
		if($this->type=='job'){
			echo ' <li>';
			if($this->Type_of==0) {
				echo 'Full time';
			}	else {
				echo 'Part time';
			};
		};
		
		echo '</li>
			  </ul><br></div>';
	
	}
	
	public function show_publish_form(){

		echo '
			  <label>Number of interns</label><input name="jb_type" class="lykeion_textbox" type="hidden" id="jb_type" value="'.$this->type.'"/><input name="jb_ID" class="lykeion_textbox" type="hidden" id="jb_ID"  value="'.@$this->ID.'"/>';
		
		echo '<select name="jb_Number_of_interns"  id="jb_Number_of_interns" >';
		for( $i=1;$i<101;$i++)
			if($i==$this->Number_of_interns){
				echo('<option value="'.$i.'" selected="selected">'.$i.'</option>');
			} else {
				echo('<option value="'.$i.'">'.$i.'</option>');
			};
		
		
		echo '</select><br>
			  <label>Duration</label><input name="jb_Duration" class="lykeion_textbox" type="text" id="jb_Duration" value="'.$this->Duration.'"/> 
			  <label>Paid internship</label>';
			  
		echo '<select name="jb_Paid_intership" id="jb_Paid_intership" >';
		if($this->Paid_intership==0) {
			echo '<option value="0" selected="selected">Yes</option>';
			echo '<option value="1" >No</option>';
		}	else {
			echo '<option value="0">Yes</option>';
			echo '<option value="1" selected="selected">No</option>';
		};
			  
		echo '</select><br>
			  <label>Accomodation costs covered</label>';
			  
		echo '<select name="jb_Accomodation_costs" class="lykeion_textbox" id="jb_Accomodation_costs"  />';
		if($this->Accomodation_costs==0) {
			echo '<option value="0" selected="selected">Yes</option>';
			echo '<option value="1" >No</option>';
		}	else {
			echo '<option value="0">Yes</option>';
			echo '<option value="1" selected="selected">No</option>';
		};
			  
			  
		echo '</select> <br>
			  <label>Country</label><input name="jb_Country" class="lykeion_textbox" type="text" id="jb_Country"  value="'.$this->Country.'"/> 
			  <label>City</label><input name="jb_City" class="lykeion_textbox" type="text" id="jb_City"  value="'.$this->City.'"/> 
			  <label>Position</label><input name="jb_Position" class="lykeion_textbox" type="text" id="jb_Position"  value="'.$this->Position.'"/> 
			  <label>Foreign language</label><textarea name="jb_Forgein_language" class="lykeion_textbox" type="text" id="jb_Forgein_language" cols="48" rows="4"  >'.$this->Forgein_language.'</textarea>
			  <label>Intern duties</label><textarea name="jb_Internduties" class="lykeion_textbox" type="text" id="jb_Internduties" cols="48" rows="4"  >'.$this->Internduties.'</textarea> 
			  <label>Driving licence</label>';
	
		echo '<select name="jb_Driving_licence" class="lykeion_textbox" id="jb_Driving_licence"  />';
		if($this->Driving_licence==0) {
			echo '<option value="0" selected="selected">Yes</option>';
			echo '<option value="1" >No</option>';
		}	else {
			echo '<option value="0">Yes</option>';
			echo '<option value="1" selected="selected">No</option>';
		};
		echo '</select><br>';
		
		if($this->type=='job'){
			echo ' <label>Type of work </label><select name="jb_Type_of" class="lykeion_textbox" id="jb_Type_of"  />';
			if($this->Type_of==0) {
				echo '<option value="0" selected="selected">Full time</option>';
				echo '<option value="1" >Part time</option>';
			}	else {
				echo '<option value="0">Full time</option>';
				echo '<option value="1" selected="selected">Part time</option>';
			};
			echo '</select><br>';
		};	
	}	
}

?>
