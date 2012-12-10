<?php
require_once 'images.php';
require_once 'database.php';

class gallery {
	private $id;
	private $name;
	private $description;
	private $image_location;
	private $image_name;
	private $image_description;
	private $selected_gallery;
	
	public function __construct(){
		$this->name="";$this->description="";
		$this->image_location='';
	}
	
	public function select_gallery($gallery_id){
		$this->selected_gallery=$gallery_id;
	}
	
	public function load_from_post($p){
		$this->id=$p['gallery_id'];
		$this->name=$p['gallery_name'];
		$this->description=$p['gallery_description'];
	}
	
	public function enter_image_data($name,$description,$gallery){
		$this->image_name=$name;
		$this->image_description=$description;
				$this->id=$gallery;
	}
	
	public function load_gallery_from_database($gallery_id){
		$db= new database();
		$sql="SELECT * FROM `gallerys`  WHERE ID='".$gallery_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
		    while ($podaci = mysql_fetch_array($result)){
				$this->id=$podaci['ID'];
				$this->name=$podaci['name'];
				$this->description=$podaci['description'];
		    };
	    };
	}
	
	public function save_gallery_to_database(){
		$db= new database();
		$sql="INSERT INTO `gallerys` VALUES(NULL,'".$this->name."','".$this->description."',NOW())";
		list($a,$this->id)=$db->query($sql);
		return $this->id;
	}
	
	public function save_image_to_database(){
		$db= new database();
		$sql="INSERT INTO `gallery_images` VALUES(NULL,'".$this->id."','".$this->image_name."','".$this->image_description."',NOW())";
		list($a,$a1)=$db->query($sql);
		return $a1;
	}
	
	public function update_gallery_to_database(){
		$db= new database();
		$sql="UPDATE `gallerys` SET name='".$this->name ."', description='".$this->description."' WHERE ID='".$this->id."'";
		$db->query($sql);
	}
	
	public function delete_selected_gallerys(){
		$db= new database();
		$sql="DELETE FROM `gallerys`  WHERE";
	 	$p=1;
	 	//$sql="DELETE FROM `kategorija` WHERE ";
	 	foreach ($_POST['select'] as $vrijednost) {
		if ($p<count($_POST['select'])) {
		 $sql=$sql." ID='".$vrijednost."' OR ";	
		} else {
	     $sql=$sql." ID='".$vrijednost."' ";			
		};
	 	$p=$p+1;
	 	
	 	//delete images from gallery
	 	$sql1="SELECT name FROM `gallery_images` WHERE gallery='".$vrijednost."'"; 
		list($result,$a)=$db->query($sql1);
		if($result && mysql_num_rows($result)>0)    
			while ($podaci = mysql_fetch_array($result)){
				unlink("gallery/".$podaci['name']);
	 			unlink("gallery/thumbs/".$podaci['name']);
			};
		$sql1="DELETE FROM `gallery_images` WHERE gallery=".$vrijednost."";
		$db->query($sql1);
		//end of image removing
	 	};   
	 	$p=$p-1;
	 	$sql=$sql." LIMIT ".$p;
     
	    $db->query($sql);
	}
	
	public function delete_selected_images(){
		$db= new database();
		$sql="DELETE FROM `gallery_images`  WHERE";
	 	$p=1;
	 	//$sql="DELETE FROM `kategorija` WHERE ";
	 	foreach ($_POST['select'] as $vrijednost) {
		if ($p<count($_POST['select'])) {
		 $sql=$sql." name='".$vrijednost."' OR ";	
		} else {
	     $sql=$sql." name='".$vrijednost."' ";			
		};
	 	$p=$p+1;
	 	
	 	//delete image from folder;
	 	unlink("gallery/".$vrijednost);
	 	unlink("gallery/thumbs/".$vrijednost);
	 	};   
	 	$p=$p-1;
	 	//$sql=$sql." LIMIT ".$p;
     
	    $db->query($sql);
	}
	
	public function show_sidemenu_gallery_panel(){
		echo '
			
				<div id="article_mini_menu">
			    <div class="plugin_menu_box_main_container_header">Gallery Manager</div>  
				<table width="98%" border="0" cellpadding="3" cellspacing="2" class="plugin_menu_box_main_container">
			        <tr>
			          <td><a href="?menu=gallery&do=add_gallery"><img src="graphics/icons/open_24x24.png" align="absmiddle"/>Add Gallery</a></td>
			        </tr>
			        <tr>
			          <td><a href="?menu=gallery&do=add_gallery_images"><img src="graphics/icons/Picture_24x24.png" align="absmiddle"/>Add Images</a></td>
			        </tr>
			        <tr>
			          <td><a href="?menu=gallery&do=gallery_list"><img src="graphics/icons/delete_24x24.png" align="absmiddle"/>Delete Gallery</a></td>
			        </tr>
			        <tr>
			          <td><a href="?menu=gallery&do=gallery_list_images"><img src="graphics/icons/recycle_24x24.png" align="absmiddle"/>Delete Image</a></td>
			        </tr>
			      </table>
				</div>
		';
		
	}

	public function choose_gallery($category_id){
		$this->selected_category=$category_id;
	}
	
	public function show_gallery_chooser_form($id=-1){
		$db= new database();
		
		echo('<div id="article_gallery_chooser">
	    <label></label>
	    <table width="100%" border="0" cellspacing="0" cellpadding="5">
	      <tr>
	        <td width="112">Gallery</td>
	        <td width="1244"><select name="article_gallery" id="article_gallery" style="width:60%">
	        <option value="-1">No gallery attached</option>');
		$sql="SELECT * FROM `gallerys`";
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0){    
			while ($podaci = mysql_fetch_array($result)){
				if($podaci['ID']==$this->selected_category || $id==$podaci['ID']){
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
	
	public function show_gallery_form(){
		echo('<div class="gallery_container">
		<div class="plugin_menu_box_main_container_header"><br />Gallery Manager: Add Gallery <br /><br /></div>
			      <form action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="multipart/form-data" name="form" id="form">
				  <div align="center">
			      <label><br />
			      Gallery Name 
			      <input name="gallery_name" type="text" id="gallery_name" size="50" maxlength="245" />
			      </label>
			      <p>Gallery description 
			        <label>
			        <br />
			        <textarea name="gallery_description" cols="100" rows="4" id="gallery_description"></textarea>
			        </label>
			      </p>
			      <p> 
			        <label>
			        <input type="submit" name="gallery_create" id="gallery_create" value="Create" />
			        </label>
			      </p>
			      </div>
			     </div>
			     </form>
			</div>');	
	}
	
	public function show_gallery_form_edit(){
		echo('<div class="gallery_container">
		<div class="plugin_menu_box_main_container_header"><br />Gallery Manager: Edit Gallery <br /><br /></div>
			      <form action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="multipart/form-data" name="form" id="form">
				  <div align="center">
			      <input name="gallery_id" style="visibility:hidden" type="text" id="gallery_id" size="50" maxlength="245" value="'.$this->id.'"/>
				  <label><br />
			      Gallery Name 
			      <input name="gallery_name" type="text" id="gallery_name" size="50" maxlength="245" value="'.$this->name.'"/>
			      </label>
			      <p>Gallery description 
			        <label>
			        <br />
			        <textarea name="gallery_description" cols="100" rows="4" id="gallery_description">'.$this->description.'</textarea>
			        </label>
			      </p>
			      <p> 
			        <label>
			        <input type="submit" name="gallery_edit" id="gallery_edit" value="Edit" />
			        </label>
			      </p>
			      </div>
			     </div>
			     </form>
			</div>');	
	}
	
	public function show_gallery_form_add_pictures(){
		$db= new database();
		echo('<div id="gallery_images_uploader" class="gallery_container">
		<div class="plugin_menu_box_main_container_header"><br />Gallery Manager: Add Images <br /><br /></div>      
		<div align="center">
		      <script language="javascript"> 
		      	function OnChange()
				{
				    var myindex=document.getElementById("gallery_name").selectedIndex;
				    var SelValue = document.getElementById("gallery_name").options[myindex].value
					document.getElementById("name").value=SelValue;
				}
						      
		      	function toggle() {
					var ele = document.getElementById("gallery_image_uploader_browser");
						ele.style.display = "block";
				 
				}
			  </script>
		      
		        <label><br />
		        Select Gallery 
		        <select name="gallery_name" style="width:35%" id="gallery_name" onchange="OnChange()" >');

		$sql="SELECT * FROM `gallerys`";
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0)    
			while ($podaci = mysql_fetch_array($result))
				 echo '<option value="'.$podaci['ID'].'">'.$podaci['name'].'</option>';
				 
		echo('  </select><br />
				<input name="name" id="name" style="visibility:hidden" type="text" maxlength="255" size="50" />
				<br />
				<div id="gallery_image_uploader_browser" >
				<p>Select images
				<div id="fileQueue"></div>
				<input type="file" name="uploadify" id="uploadify" />
				<p><a href="javascript:startUpload(\'uploadify\', document.getElementById(\'name\'))">Start Upload</a> | <a href="javascript:jQuery(\'#uploadify\').uploadifyClearQueue()">Cancel All Uploads</a></p>
		          <br />
		          </label>
		        </p>
		        </div>
		      </div>
		    </div>');
	}
	
	public function show_gallery_images_remover(){
		$db= new database();
		$sql="SELECT * FROM `gallery_images` WHERE gallery='".$this->id."'";
		list($result,$a)=$db->query($sql);
		echo'<div id="gallery_images_remover">
		<form action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="multipart/form-data" name="form" id="form">
		<div class="plugin_menu_box_main_container_header"><br />Gallery Manager: Delete Images <br /><br /></div>
		<div>Gallery: '.$this->name.'</div>
		<br /><div align="center">
		<table width="500" border="0" cellspacing="5" cellpadding="5">
		<tr>';
		if($result && mysql_num_rows($result)>0){
			$i=1;
			while ($podaci = mysql_fetch_array($result)){
				echo '<td align="center"><img src="gallery/thumbs/'.$podaci['name'].'"><br /><input type="checkbox" name="select[]" id="select" value="'.$podaci['name'].'"/> </td>';
				if($i%5==0)
					echo '</tr><tr>';
				$i++;
			};
		};
		echo'</tr></table></div>
		<br />
		<div align="center"><input type="submit" name="gallery_image_delete" id="gallery_image_delete" value="Delete" /><br /></div>
		</form></div>';
	}
	
	public function show_gallery_form_list(){
		$db= new database();
		$sql="SELECT * FROM gallerys ORDER BY ID DESC";
		list($result,$a)=$db->query($sql);
		echo('<div class="article_list_container" id="article_list">
		<form action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="multipart/form-data" name="form" id="form">
		<div class="plugin_menu_box_main_container_header"><br />Gallery Manager: Gallery list <br /><br /></div>
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="38"><label>
            <div align="center">
              <input type="checkbox" name="all_checkbox" onclick="SetAllCheckBoxes(\'form\', \'select[]\',\'true\',\'all_checkbox\');" id="all_checkbox" />
              </div>
          </label></td>
          <td width="200"> <div align="left">Gallery</div></td>
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
			          <td><a href="?menu=gallery&do=edit_gallery&gallery_id='.$podaci['ID'].'">'.$podaci['name'].'</a></td>
			          <td><div align="left">'.$podaci['description'].'</div></td>
			        </tr>');
				$i++;
			}
		}
		
		echo('<tr>
            <td colspan="7">
              <div id="article_form_buttons" align="center"><br />
		       <input type="submit" name="gallery_delete" id="gallery_delete" value="Delete" />
		      </div>
		  	</td>
              </tr>
              </table>
              </form>
              </div>');
	}
	
	public function show_gallery_form_list_images(){
		$db= new database();
		$sql="SELECT * FROM gallerys ORDER BY ID DESC";
		list($result,$a)=$db->query($sql);
		echo('<div class="article_list_container" id="article_list">
		<form action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="multipart/form-data" name="form" id="form">
		<div class="plugin_menu_box_main_container_header"><br />Gallery Manager: Gallery list <br /><br /></div>
		<table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="38"><label>
            <div align="center">
              <input type="checkbox" name="all_checkbox" onclick="SetAllCheckBoxes(\'form\', \'select[]\',\'true\',\'all_checkbox\');" id="all_checkbox" />
              </div>
          </label></td>
          <td width="200"> <div align="left">Gallery</div></td>
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
			          <td><a href="?menu=gallery&do=delete_gallery_images&gallery_id='.$podaci['ID'].'">'.$podaci['name'].'</a></td>
			          <td><div align="left">'.$podaci['description'].'</div></td>
			        </tr>');
				$i++;
			}
		}
		
		echo('<tr>
            <td colspan="7">
              <div id="article_form_buttons" align="center"><br />
		       <input type="submit" name="gallery_delete" id="gallery_delete" value="Delete" />
		      </div>
		  	</td>
              </tr>
              </table>
              </form>
              </div>');
	}
	
	public function show_gallery_listbox(){
		$db= new database();
		$sql="SELECT a.ID,a.name FROM gallerys AS a ORDER BY a.ID DESC";
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0){
			echo '<select name="gallery_select" id="gallery_select" style="width:60%">';
			while ($podaci = mysql_fetch_array($result)){
				if($podaci['ID']==$this->selected_gallery){
				 echo('<option value="'.$podaci['ID'].'" selected="selected">'.$podaci['name'].'</option>');
				} else {
				 echo('<option value="'.$podaci['ID'].'">'.$podaci['name'].'</option>');
				}
			}
			echo '</select>';
		}	
	}
	
}

if(isset($_POST['gallery_create'])) {
	$add_gallery= new gallery();
	$add_gallery->load_from_post($_POST);
	$add_gallery->save_gallery_to_database();
}

if(isset($_POST['gallery_edit'])) {
	$edit_gallery= new gallery();
	$edit_gallery->load_from_post($_POST);
	$edit_gallery->update_gallery_to_database();
}

if(isset($_POST['gallery_delete'])) {
	$add_gallery= new gallery();
	$add_gallery->delete_selected_gallerys();
}

if(isset($_POST['gallery_image_delete'])) {
	$add_gallery= new gallery();
	$add_gallery->delete_selected_images();
}


?>