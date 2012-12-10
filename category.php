<?php
require_once('database.php');

class category {
	private $id;
	private $name;
	private $description;
	private $date_of_creation;
	private $selected_category;
	
	public function __construct(){
		$this->id="";$this->name="";$this->description="";
		$this->date_of_creation="";$this->selected_category="";
	}
	
	public function restart(){
		$this->id="";$this->name="";$this->description="";
		$this->date_of_creation="";$this->selected_category="";
	}
	
	public function load_from_post($p){
		$this->id=@$p['category_id'];
		$this->name=@$p['category_name'];
		$this->description=@$p['category_description'];
		$this->selected_category=@$p['article_category'];
	}
	
	public function return_selected_category(){
		return $this->selected_category;
	}
	
	public function choose_category($category_id){
		$this->selected_category=$category_id;
	}
	
	public function show_category_form(){
		$db= new database();
		
		echo('<div id="article_category_comments">
	    <label></label>
	    <table width="100%" border="0" cellspacing="0" cellpadding="5">
	      <tr>
	        <td width="112">Category</td>
	        <td width="1244"><select name="article_category" id="article_category" style="width:60%">');
		$sql="SELECT * FROM `category_articles`";
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0){    
			while ($podaci = mysql_fetch_array($result)){
				if($podaci['ID']==$this->selected_category){
				 echo('<option value="'.$podaci['ID'].'" selected="selected">'.$podaci['name'].'</option>');
				} else {
				 echo('<option value="'.$podaci['ID'].'">'.$podaci['name'].'</option>');
				}
		    }
		}
	    echo('</select></td>
	      </tr>
	      </table>
	  	</div>');
	}
	
	public function show_category_listbox(){
		$db= new database();
		$sql="SELECT * FROM `category_articles`";
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0){   
		echo('<select name="category_select" id="category_select" style="width:60%">');
			while ($podaci = mysql_fetch_array($result)){
				if($podaci['ID']==$this->selected_category){
				 echo('<option value="'.$podaci['ID'].'" selected="selected">'.$podaci['name'].'</option>');
				} else {
				 echo('<option value="'.$podaci['ID'].'">'.$podaci['name'].'</option>');
				}
		    }
	    echo('</select>');
		}
	}
	
	public function show_category_add(){
		echo('<div class="category_container">
			<div class="plugin_menu_box_main_container_header"><br />Article Manager: Add Category <br /><br /></div>
			      <form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form">
				  <div align="center">
			      <label><br />
			      Category Name 
			      <input name="category_name" type="text" id="category_name" size="50" maxlength="245" />
			      </label>
			      <p>Category description 
			        <label>
			        <br />
			        <textarea name="category_description" cols="100" rows="4" id="category_description"></textarea>
			        </label>
			      </p>
			      <p> 
			        <label>
			        <input type="submit" name="category_create" id="category_create" value="Create" />
			        </label>
			      </p>
			      </div>
			     </div>
			     </form>
			</div>');
		}
		
	public function show_category_edit(){
		echo('<div class="category_container">
			<div class="plugin_menu_box_main_container_header"><br />Article Manager: Edit Category <br /><br /></div>
			      <form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form">
				  <div align="center">
			      <label><br />
			      Category Name 
			      <input name="category_name" type="text" id="category_name" size="50" maxlength="245" value="'.$this->name.'"/>
			      <br />
			      <input name="category_id" type="text" id="category_id" size="50" style="visibility:hidden" maxlength="245" value="'.$this->id.'"/>
			      </label>
			      <p>Category description 
			        <label>
			        <br />
			        <textarea name="category_description" cols="100" rows="4" id="category_description">'.$this->description.'</textarea>
			        </label>
			      </p>
			      <p> 
			        <label>
			        <input type="submit" name="category_edit" id="category_edit" value="Edit" />
			        </label>
			      </p>
			      </div>
			     </div>
			     </form>
			</div>');
		}
		
	public function save_to_database(){
		$db= new database();
		$sql="INSERT INTO `category_articles` VALUES (NULL,'".$this->name ."','".$this->description."', NOW())";
		list($a,$this->id)=$db->query($sql);
		return $this->id;
	}
	
	public function update_to_database(){
		$db= new database();
		$sql="UPDATE `category_articles` SET name='".$this->name ."', description='".$this->description."' WHERE ID='".$this->id."'";
		$db->query($sql);
	}
	
	public function delete_from_database(){
		$db= new database();
		$sql="DELETE FROM `category_articles`  WHERE ID='".$this->id."'";
		$db->query($sql);
	}

	function delete_selected_categories() {
		$db= new database();
		$sql="DELETE FROM `category_articles`  WHERE";
	 	$p=1;
	 	//$sql="DELETE FROM `kategorija` WHERE ";
	 	foreach ($_POST['select'] as $vrijednost) {
		if ($p<count($_POST['select'])) {
		 $sql=$sql." ID='".$vrijednost."' OR ";	
		} else {
	     $sql=$sql." ID='".$vrijednost."' ";			
		};
	 	$p=$p+1;
	 	};   
	 	$p=$p-1;
	 	$sql=$sql." LIMIT ".$p;
     
	    $db->query($sql);
	}
	
	public function load_category_from_db($category_id){
		$db= new database();
		$sql="SELECT * FROM category_articles WHERE ID=".$category_id;
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0)
			while ($podaci = mysql_fetch_array($result)){
				$this->id=$podaci['ID'];
				$this->name=$podaci['name'];
				$this->description=$podaci['description'];
			}
	}
	
	public function show_category_form_list(){
		$db= new database();
		$sql="SELECT * FROM category_articles ORDER BY ID DESC";
		list($result,$a)=$db->query($sql);
		echo('<div class="article_list_container" id="article_list">
		<form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form">
		<div class="plugin_menu_box_main_container_header"><br />Article Manager: Category list <br /><br /></div>
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="38"><label>
            <div align="center">
              <input type="checkbox" name="all_checkbox" onclick="SetAllCheckBoxes(\'form\', \'select[]\',\'true\',\'all_checkbox\');" id="all_checkbox" />
              </div>
          </label></td>
          <td width="200"> <div align="left">Category</div></td>
          <td width="0%"><div align="left">Description</div></td>
          
        </tr>');
		if($result && mysql_num_rows($result)>0){
			$i=0;
			while ($podaci = mysql_fetch_array($result)){
				if($i % 2==0){ $class="article_management_first_line" ; } else { $class="article_management_scnd_line"; }
				echo('<tr class="'.$class.'" onmouseover="this.className=\'article_management_selected_line\';" onmouseout="this.className=\''.$class.'\';" >
			          <td><div align="center">
			            <label><input type="checkbox" name="select[]" id="select" value="'.$podaci['ID'].'"/></label>
			          </div></td>
			          <td><a href="?menu=article&do=edit_category&category_id='.$podaci['ID'].'">'.$podaci['name'].'</a></td>
			          <td><div align="left">'.$podaci['description'].'</div></td>
			        </tr>');
				$i++;
			}
		}
		
		echo('<tr>
            <td colspan="7">
              <div id="article_form_buttons" align="center"><br />
		       <input type="submit" name="category_delete" id="category_delete" value="Delete" />
		      </div>
		  	</td>
              </tr>
              </table>
              </form>
              </div>');
	}
	
}

if(isset($_POST['category_create'])) {
	$add_category= new category();
	$add_category->load_from_post($_POST);
	$add_category->save_to_database();
}

if(isset($_POST['category_edit'])) {
	$add_category= new category();
	$add_category->load_from_post($_POST);
	$add_category->update_to_database();
}

if(isset($_POST['category_delete'])) {
	$add_category= new category();
	//$add_category->load_from_post($_POST);
	$add_category->delete_selected_categories();
}


?>