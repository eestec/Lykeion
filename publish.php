<?php
require_once('database.php');

class publish {
	private $id;
	private $article;
	private $publish;
	private $published;
	private $from_date;
	private $to_date;
	private $counts;
	
	public function __construct(){
		$this->id="";$this->article="";	$this->from_date= date("Y-m-d h:i:s");
		$this->to_date=date("Y-m-d h:i:s",mktime(0,0,0,date("m")+6,date("d")+1,date("Y")));
		$this->counts="";$this->publish="publish";
		$this->published="forever";
	}
	
	public function restart(){
		$this->id="";$this->article="";
		$this->from_date="";$this->to_date="";
		$this->counts="";$this->publish="";
		$this->published="";
	}
	
	public function load_publish($publish_id){
		$db= new database();
		$sql="SELECT * FROM `publish_articles` as m WHERE m.ID='".$publish_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
		    while ($podaci = mysql_fetch_array($result)){
				$this->id=$podaci['ID'];
				$this->article=$podaci['article'];
				$this->from_date=$podaci['from'];
				$this->to_date=$podaci['to'];
				$this->publish=$podaci['status'];
				$this->published=$podaci['published'];
				$this->counts=$podaci['reads'];
		    };
	    };
	}
	
	public function load_from_post($p){
		$this->from_date=$p['published_start'];
		$this->to_date=$p['published_end'];
		$this->publish=$p['publish_group'];
		$this->published=$p['published_group'];
		//$this->counts=$p['published_appearances'];
	}
	
	public function save_to_database(){
		$db= new database();
		$sql="INSERT INTO `publish_articles` VALUES(NULL,'".$this->article."','".$this->from_date."','".$this->to_date."','".$this->counts."','".$this->publish."','".$this->published."')";
		list($a,$this->id)=$db->query($sql);
		return $this->id;
	}
	
	public function update_to_database(){
		$db= new database();
		$sql="UPDATE `publish_articles` SET article='".$this->article."',from='".$this->from_date."',to='".$this->to_date."',reads='".$this->counts."',status='".$this->publish."',published='".$this->published."' WHERE ID='".$this->id."'";
		$db->query($sql);
	}
	
	public function delete_from_database(){
		$db= new database();
		$sql="DELETE FROM `publish_articles`  WHERE ID='".$this->id."'";
		$db->query($sql);
	}
	
	public function show_publish_form(){
		echo('
		        <label>Publish</label>
		        ');
		          
		    if($this->publish=="publish"){  
		    	echo('<input name="publish_group" type="radio" id="publish_group_0" value="publish" checked="checked" />
		            Published');
		    } else{
		    	echo('<input name="publish_group" type="radio" id="publish_group_0" value="publish" />
		            Published');
		    }
			
			if($this->publish=="draft"){  
		    	echo('<input name="publish_group" type="radio" id="publish_group_0" value="draft" checked="checked" />
		            Draft');
		    } else{
		    	echo('<input name="publish_group" type="radio" id="publish_group_0" value="draft" />
		            Draft');
		    }
		    
		echo('<br>
		        <label>Published</label>
		        ');
		
		if($this->published =="forever"){  
		    	echo('
		          <input name="published_group" type="radio" id="published_group_0" value="forever" checked="checked" />
		Forever');
		    } else{
		    	echo('
		          <input name="published_group" type="radio" id="published_group_0" value="forever" />
		Forever');
		    }
		    
		
		if($this->published =="from"){  
		    	echo('
		          <input name="published_group" type="radio" id="published_group_0" value="from" checked="checked" />
		From date');
		    } else{
		    	echo('
		          <input name="published_group" type="radio" id="published_group_0" value="from" />
		From date');
		    };
		    
		
	
		echo('
		                  <label>Start publishing</label>
		                  <input  value="'.$this->from_date.'" name="published_start" id="published_start" onFocus="init()" style="background: url(&quot;/js/dtp/calendar.png&quot;) no-repeat scroll right center rgb(255, 255, 255); padding-right: 20px;" size="15" />
		                
		                  <label>Finish publishing </label>
		                  <input  value="'.$this->to_date.'" name="published_end" id="published_end" onFocus="init()" style="background: url(&quot;/js/dtp/calendar.png&quot;) no-repeat scroll right center rgb(255, 255, 255); padding-right: 20px;" size="15" />
		               
		        
		      
		  ');
	}
	
}

?>