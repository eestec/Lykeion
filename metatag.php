<?php
require_once('database.php');


class metatag {
	private $title;
	private $description;
	private $keywords;
	private $custom_metatags;
	private $metatag_id; 
	
	public function __construct(){
		$this->title="";$this->description="";
		$this->keywords="";$this->custom_metatags="";
		$this->metatag_id="";
	}
	public function restart_metatags(){
		$this->title="";$this->description="";
		$this->keywords="";$this->custom_metatags="";
		$this->metatag_id="";
	}
	
	public function load_from_post($p){
		$this->title=addslashes($p['metatag_title']);
		$this->description=addslashes($p['metatag_description']);
		$this->keywords=addslashes($p['metatag_keywords']);
		$this->custom_metatags=addslashes($p['metatags_custom']);
	}
	
	public function return_metatag_id(){
		return $this->metatag_id;
	}
		
	public function show_metatag_form(){
		echo('<div class="MetaTag_containter">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td width="10%" height="34" valign="top">Title</td>
	        <td width="90%"><input name="metatag_title" type="text" id="metatag_title" style="width:98%" size="100" value="'.$this->title.'"/></td>
	      </tr>
	      <tr>
	        <td height="80" valign="top">Keywords</td>
	        <td><textarea name="metatag_keywords" cols="100" rows="4" style="width:98%" id="metatag_keywords">'.$this->keywords.'</textarea></td>
	      </tr>
	      <tr>
	        <td height="80" valign="top">Description</td>
	        <td><textarea name="metatag_description" cols="100" rows="4" style="width:98%" id="metatag_description">'.$this->description.'</textarea></td>
	      </tr>
	      <tr>
	        <td height="80" valign="top">Custom metatags</td>
	        <td><textarea name="metatags_custom" cols="100" rows="4" style="width:98%" id="metatags_custom">'.$this->custom_metatags.'</textarea></td>
	      </tr>
	    </table>
	    <label></label>
	    <p>
	      <label></label>    
	    </p>
	    <p>
	      <label></label>
	    </p>
	    <p>&nbsp;</p>
		</div>');	
	}
	
	public function load_metatags($metatag_serch_id){
		$db= new database();
		$sql="SELECT * FROM `metatags` as m WHERE m.ID='".$metatag_serch_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
		    while ($podaci = mysql_fetch_array($result)){
				$this->title=$podaci['title'];
				$this->keywords=$podaci['keywords'];
				$this->description=$podaci['description'];
				$this->custom_metatags=$podaci['custom_metatags'];
		    }
	    }
	}
	
	public function save_to_database(){
		$db= new database();
		$sql="INSERT INTO `metatags` VALUES (NULL,'".htmlentities($this->title) ."','".htmlentities($this->keywords)."', '".htmlentities($this->description)."', '".$this->custom_metatags."')";
	    list($a,$this->metatag_id)=$db->query($sql);
	    return $this->metatag_id;
	}
	
	public function update_to_database(){
		$db= new database();
		$db->open_connection();
		$sql="UPDATE `metatags` SET title='".htmlentities($this->title) ."',keywords='".htmlentities($this->keywords)."', description='".htmlentities($this->description)."', custom_metatags='".htmlentities($this->custom_metatags)."' WHERE ID='".$this->metatag_id."'";
	    $db->query($sql);
	}
	
}

?>