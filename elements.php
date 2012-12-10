<?php
session_start();
require_once 'database.php';
$type=$_GET['type'];
/*if($type=="education"){
            echo '<div id="education'.$number.'">
                <table width="100%" height="22" border="0" cellpadding="5" cellspacing="0">
                <tr><td><input type="hidden" name="education_id'.$number.'" id="education_id'.$number.'" value="-1"></td></tr>';
                    echo '
                        <tr><td width="180" valign="top">Dates of studying</td><td width="370">From: <select name="org_fday'.$number.'">
                        <option>D</option>';
                    for($j=1;$j<=31;$j++) echo '<option>'.$j.'</option>';
                    echo '</select> <select name="org_fmonth'.$number.'"><option>M</option>';
                    for($j=1;$j<=12;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="org_fyear'.$number.'"><option>Y</option>';
                    for($j=1940;$j<=2020;$j++) echo '<option>'.$j.'</option>';
                    echo '</select> To: <select name="org_tday'.$number.'"><option>D</option><option>-></option>';
                    for($j=1;$j<=31;$j++) echo '<option>'.$j.'</option>';
                    echo '</select> <select name="org_tmonth'.$number.'"><option>M</option><option>-></option>';
                    for($j=1;$j<=12;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="org_tyear'.$number.'"><option>Y</option><option>-></option>';
                    for($j=1940;$j<=2020;$j++) echo '<option>'.$j.'</option>';
                    echo '</select>
                    </td>  </tr>
		 <tr> <td width="180" valign="top">Title of qualification awarded</td><td width="370"><label> <input type="text" name="stud_cv_title'.$number.'" class="lykeion" id="stud_cv_title'.$number.'" size="75" maxlength="249" style="width:98%" value=""> </label></td>  </tr>
		 <tr> <td width="180" valign="top">Principal subjects/occupational skills covered</td><td width="370"><label> <textarea style="resize: none;" name="stud_cv_subject'.$number.'" class="lykeion" id="stud_cv_subject'.$number.'" row="5" cols="50" style="width:98%" value=""></textarea> </label></td>  </tr>
		 <tr> <td width="180" valign="top">Name organisation providing education or training</td><td width="370"><label> <input type="text" name="stud_cv_org_name'.$number.'" class="lykeion" id="stud_cv_org_name'.$number.'"  size="75" maxlength="249" style="width:98%" value=""> </label></td>  </tr>
		<tr> <td width="180" valign="top">Type of organisation providing education or training</td><td width="370"><label> <input type="text" name="stud_cv_org_type'.$number.'" class="lykeion" id="stud_cv_org_type'.$number.'"  size="75" maxlength="249" style="width:98%" value=""> </label></td>  </tr>
                <tr> <td width="180" valign="top">Address of organisation</td><td width="370"><label> <input type="text" name="stud_cv_org_address'.$number.'" class="lykeion" id="stud_cv_org_address'.$number.'"   style="width:98%" size="75" maxlength="249" value=""> </label></td>  </tr>
                 <tr> <td width="180" valign="top">City of organisation</td><td width="370"><label> <input type="text" name="stud_cv_org_city'.$number.'" class="lykeion" id="stud_cv_org_city'.$number.'" size="75" maxlength="249" style="width:98%" value=""> </label></td>  </tr>
                     <tr> <td width="180" valign="top">Country of organisation</td><td width="370"><label> <input type="text" name="stud_cv_org_country'.$number.'" class="lykeion" id="stud_cv_org_country'.$number.'" size="75" maxlength="249" style="width:98%" value=""> </label></td>  </tr>
                <tr> <td width="180" valign="top">Level in national or international classification</td><td width="370"><label> <input name="stud_cv_level'.$number.'" class="lykeion" type="text" id="stud_cv_level'.$number.'" size="75" maxlength="249" style="width:98%" value="" list="level-list"/><datalist id="level-list"> <option value="Bachelor"> <option value="Master"> <option value="PhD"> <option value="High School"></datalist> </label></td>  </tr>
                <tr> <td width="180" valign="top">Education field</td><td width="370"><label> <input name="stud_cv_field'.$i.'" class="lykeion" type="text" id="stud_cv_field'.$number.'" size="75" maxlength="249" style="width:98%" value=""list="field-list"/> <datalist id="field-list"><option value="Computer Science and Informatics"><option value="Automatic Control and Electronics"><option value="Electric Power Engineering"><option value="Telecommunication"><option value="Civil Engineering"><option value="Mechanical Engineering"><option value="Chemical Engineering"></datalist> </label></td>  </tr>
                <tr><td></td><td align="right"><a href=javascript:showhide("education'.$number.'",-1);>Delete this education</a></td></tr>
                <tr><td colspan="2">------------------------------------------------------------------------------------------------------------------------------------</td></tr></table></div>';

        }*/
if($_SESSION['loged']=='true' || $_SESSION['state']=='registration'){
    if($_GET['type']){
        $db=new database();
        $number=$_GET['br'];
        
        if($type=="work"){
            echo '<div id="work'.$number.'">
               
                
               <input type="hidden" name="work_id'.$number.'" id="work_id'.$number.'" value="-1">
                <label>Dates when you worked</label> <select name="fday'.$number.'">
                        <option>D</option>';
                    for($j=1;$j<=31;$j++) echo '<option>'.$j.'</option>';
                    echo '</select> <select name="fmonth'.$number.'"><option>M</option>';
                    for($j=1;$j<=12;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="fyear'.$number.'"><option>Y</option>';
                    for($j=1940;$j<=2020;$j++) echo '<option>'.$j.'</option>';
                    echo '</select>-<select name="tday'.$number.'"><option>D</option><option>-></option>';
                    for($j=1;$j<=31;$j++) echo '<option>'.$j.'</option>';
                    echo '</select> <select name="tmonth'.$number.'"><option>M</option><option>-></option>';
                    for($j=1;$j<=12;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="tyear'.$number.'"><option>Y</option><option>-></option>';
                    for($j=1940;$j<=2020;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><br>
                    
		 <label>Occupation or position held</label> <textarea style="resize: none;" name="stud_cv_Occupation'.$number.'" class="lykeion" id="stud_cv_Occupation'.$number.'" rows="5" cols="45" /></textarea> 
		 <label>Main activities and responsibilities</label> <textarea style="resize: none;" name="stud_cv_Responsibilities'.$number.'" class="lykeion" id="stud_cv_Responsibilities'.$number.'" rows="5" cols="45"/></textarea> 
		 <label>Name of employer</label> <input type="text" name="stud_cv_Name'.$number.'" class="lykeion" id="stud_cv_Name'.$number.'"  /> 
		 <label>Address of employer</label> <input type="text" name="stud_cv_address'.$number.'" class="lykeion" id="stud_cv_address'.$number.'"  />
                 <label>City of employer</label> <input type="text" name="stud_cv_work_city'.$number.'" class="lykeion" id="stud_cv_work_city'.$number.'" /> 
                 <label>Country of employer</label> <input type="text" name="stud_cv_work_country'.$number.'" class="lykeion" id="stud_cv_work_country'.$number.'"  /> 
                <label>Type of business or sector</label> <input name="stud_cv_Type'.$number.'" class="lykeion" type="text" id="stud_cv_Type'.$number.'"  /> 
                <label><a href=javascript:showhide("work'.$number.'",-1);>Delete this work</a></label>
                
                </div><br><br><br>';
        }
        if($type=="education"){
            echo '<div id="education'.$number.'">
                
                <input type="hidden" name="education_id'.$number.'" id="education_id'.$number.'" value="-1">';
                    echo '
                        <label>Dates of studying</label><select name="org_fday'.$number.'">
                        <option>D</option>';
                    for($j=1;$j<=31;$j++) echo '<option>'.$j.'</option>';
                    echo '</select> <select name="org_fmonth'.$number.'"><option>M</option>';
                    for($j=1;$j<=12;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="org_fyear'.$number.'"><option>Y</option>';
                    for($j=1940;$j<=2020;$j++) echo '<option>'.$j.'</option>';
                    echo '</select> - <select name="org_tday'.$number.'"><option>D</option><option>-></option>';
                    for($j=1;$j<=31;$j++) echo '<option>'.$j.'</option>';
                    echo '</select> <select name="org_tmonth'.$number.'"><option>M</option><option>-></option>';
                    for($j=1;$j<=12;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><select name="org_tyear'.$number.'"><option>Y</option><option>-></option>';
                    for($j=1940;$j<=2020;$j++) echo '<option>'.$j.'</option>';
                    echo '</select><br>
                    
		 <label>Title of qualification awarded</label> <input type="text" name="stud_cv_title'.$number.'" class="lykeion" id="stud_cv_title'.$number.'"  value="">
		 <label>Principal subjects/occupational skills covered</label> <textarea style="resize: none;" name="stud_cv_subject'.$number.'" class="lykeion" id="stud_cv_subject'.$number.'" row="5" cols="45"  value=""></textarea> <br><br>
		 <label>Name organisation providing education or training</label> <input type="text" name="stud_cv_org_name'.$number.'" class="lykeion" id="stud_cv_org_name'.$number.'"  value=""><br><br>
		<label>Type of organisation providing education or training</label> <input type="text" name="stud_cv_org_type'.$number.'" class="lykeion" id="stud_cv_org_type'.$number.'"  value=""> <br><br>
                <label>Address of organisation</label> <input type="text" name="stud_cv_org_address'.$number.'" class="lykeion" id="stud_cv_org_address'.$number.'"   value=""> 
                 <label>City of organisation</label> <input type="text" name="stud_cv_org_city'.$number.'" class="lykeion" id="stud_cv_org_city'.$number.'"  value=""> 
                     <label>Country of organisation</label> <input type="text" name="stud_cv_org_country'.$number.'" class="lykeion" id="stud_cv_org_country'.$number.'"  value="">
                <label>Level in national or international classification</label> <input name="stud_cv_level'.$number.'" class="lykeion" type="text" id="stud_cv_level'.$number.'" value="" list="level-list"/> <datalist id="level-list"> <option value="Bachelor"> <option value="Master"> <option value="PhD"> <option value="High School"></datalist> <br><br>
                <label>Education field</label> <input name="stud_cv_field'.$i.'" class="lykeion" type="text" id="stud_cv_field'.$number.'"  value="" list="field-list"/><datalist id="field-list"><option value="Computer Science and Informatics"><option value="Automatic Control and Electronics"><option value="Electric Power Engineering"><option value="Telecommunication"><option value="Civil Engineering"><option value="Mechanical Engineering"><option value="Chemical Engineering"></datalist>  
                <label><a href=javascript:showhide("education'.$number.'",-1);>Delete this education</a></label>
                </div><br><br><br>';

        }
        if($type=="language"){
            echo '
                <input type="hidden" name="language_id'.$number.'" id="language_id'.$number.'" value="-1">
                <label>Language</label> <input type="text" name="stud_cv_Other_language'.$number.'" class="lykeion" id="stud_cv_Other_language'.$number.'"  value=""> <br>
                      <label>Listening</label> <select name="stud_cv_listening'.$number.'" class="lykeion" id="stud_cv_listening'.$number.'"  value=""> <option>Level</option><option>a1</option><option>a2</option><option>b1</option><option>b2</option><option>c1</option><option>c2</option> </select><br>
                      <label>Reading</label><select name="stud_cv_reading'.$number.'" class="lykeion" id="stud_cv_reading'.$number.'" value=""><option>Level</option><option>a1</option><option>a2</option><option>b1</option><option>b2</option><option>c1</option><option>c2</option> </select><br>
                      <label>Spoken interaction</label> <select name="stud_cv_spoken_i'.$number.'" class="lykeion" id="stud_cv_spoken_i'.$number.'" value=""> <option>Level</option><option>a1</option><option>a2</option><option>b1</option><option>b2</option><option>c1</option><option>c2</option> </select><br>
                      <label>Spoken production</label> <select name="stud_cv_listening'.$number.'" class="lykeion" id="stud_cv_listening'.$number.'"  value=""><option>Level</option><option>a1</option><option>a2</option><option>b1</option><option>b2</option><option>c1</option><option>c2</option> </select><br>
                    
                    <label>Writing</label> <select name="stud_cv_writing'.$number.'" class="lykeion" id="stud_cv_writing'.$number.'"  value=""><option>Level</option><option>a1</option><option>a2</option><option>b1</option><option>b2</option><option>c1</option><option>c2</option> </select><br>
                    <label><a href=javascript:showhide("language'.$number.'",-1);>Delete this language</a></label>
                    </div>';
        }
        if($type=="delete_work"){
            $sql="DELETE FROM work_experience WHERE ID='$number'";
            $db->query($sql);
        }
        if($type=="delete_education"){
            $sql="DELETE FROM education WHERE ID='$number'";
            $db->query($sql);
        }
        if($type=="delete_language"){
            $sql="DELETE FROM languagelist WHERE ID='$number'";
            $db->query($sql);
        }

    }
}
?>