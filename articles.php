<?php
require_once('database.php');
require_once('metatag.php');
require_once('category.php');
require_once('publish.php');
require_once('images.php');
require_once('jobstypes.php');
require_once('universitystudy.php');

class articles {
	private $id;
	private $title;
	private $intro;
	private $text;
	private $image;
	private $category; private $ctg;
	private $comments; 
	private $editable;
	private $views;
	private $publish; private $pbls;
	private $gallery; private $gall;
	private $metatags;private $mtg;
	private $date_of;
	private $deleted;
	private $selected_article;
	private $jobtype;private $jobtype_id;
	private $scolarship_id;private $scolarship;
	private $status;
	private $user;
	private $type;
	
	public function __construct(){
		$this->ctg= new category();$this->category=0;
		$this->pbls= new publish();$this->publish=0;
		$this->mtg= new metatag();$this->metatags=0;
		$this->gallery=0;
		$this->jobtype= new jobstypes();$this->jobtype_id=0;
		$this->scolarship= new universitystudy();$this->scolarship_id=0;
                $this->image=new images();
	}
	
	public function load_from_post($p){
		$this->title=addslashes($p['article_title']); 
		$this->intro=addslashes(strip_tags($p['article_intro_txt'],'<p><strong><span><em><ul><li><ol>'));
		$this->text=addslashes(strip_tags($p['article_main_txt'],'<p><strong><span><em><ul><li><ol><hr><sup><object><param><embed><a>'));
		$this->id=@$p['article_id'];
		$this->type=$p['article_type'];
                
	}
	
	public function select_article($article_id){
		$this->selected_article=$article_id;
	}
	
	public function load_article($article_id){
		$db= new database();
		$sql="SELECT * FROM `articles` as m WHERE m.ID='".$article_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
		    while ($podaci = mysql_fetch_array($result)){
				$this->id=$podaci['ID'];
		    	$this->title=$podaci['title'];
		    	$this->intro=$podaci['intro'];
		    	$this->text=$podaci['tekst'];
				$this->image=$podaci['image'];
				$this->category=$podaci['category'];
				$this->comments=$podaci['comments'];
				$this->editable=$podaci['editable'];
				$this->views=$podaci['views'];
				$this->publish=$podaci['publish'];
				$this->gallery=$podaci['gallery'];
				$this->metatags=$podaci['metatags'];
				$this->jobtype_id=$podaci['jobtype'];
				$this->date_of=$podaci['date_of_creation'];
				$this->deleted=$podaci['deleted'];
				$this->user=$podaci['user'];
				$this->status=$podaci['status'];
				$this->scolarship_id=$podaci['scolarship'];
				$this->user_type=$podaci['user_type'];
		    };
	    };
	    if($this->scolarship_id==-1 && $this->jobtype_id==-1) $this->type='news';
	    if($this->scolarship_id==-1 && $this->jobtype_id!=-1) $this->type='job';
	    if($this->jobtype_id==-1 && $this->scolarship_id!=-1) $this->type='scolarship'; 
	}
	
	public function save_to_database(){
		$db= new database();
		//$this->load_from_post($_POST);
		$db->open_connection();
		$this->ctg->load_from_post($_POST);
		$this->pbls->load_from_post($_POST);
		
		$this->jobtype->load_from_post($_POST);
		$this->scolarship->load_from_post($_POST);
		$this->category=@$_POST['article_category'];
        $this->image->load_from_post(@$_POST);
		$this->gallery=$_POST['article_gallery'];
		$this->publish=$this->pbls->save_to_database();
		//$this->metatags=$this->mtg->save_to_database();
		if($this->type=='intership' || $this->type=='job' ){ $this->jobtype_id=$this->jobtype->save_to_database(); } else { $this->jobtype_id=-1; };
		if($this->type=='scolarship') { $this->scolarship_id=$this->scolarship->save_to_database(); } else {$this->scolarship_id=-1;};
		$sql="INSERT INTO `articles` VALUES(NULL,'".htmlentities($this->title)."','".$this->intro."','".$this->text."','".$this->image->getimage()."','".$this->category."','".$this->comments."','".$this->editable."','0','".$this->publish."','".$this->gallery."','".$this->metatags."','".$this->jobtype_id."','".$this->scolarship_id."','Pending','".$_SESSION['id']."','".$_SESSION['rank']."',NOW(),0)";
                $db->query($sql);
                echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>
				<div id="error_message"><br/>Article added, but it needs to be approved by Administrator.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
                
	}
	
	public function update_to_database(){
		$db= new database();
		$db->open_connection();
		//$this->load_from_post($_POST);
		$this->ctg->load_from_post($_POST);
		$this->pbls->load_from_post($_POST);
		//$this->mtg->load_from_post($_POST);
		//$this->gall->load_from_post($_POST);
		$this->category=$_POST['article_category'];
		$this->gallery=$_POST['article_gallery'];
		$this->pbls->update_to_database();
		//$this->mtg->update_to_database();
                if(isset($_POST['article_edit_thumb_change'])=='yes'){
                     $this->image->load_from_post($p);
                     //echo $this->category;
                     $im="image='".addslashes($this->image->getimage())."', ";
                }
                else $im="";


                

		if($this->jobtype_id!=-1){
			$this->jobtype->load_from_post($_POST);
			$this->jobtype->update_to_database();
		}
		if($this->scolarship_id!=-1){
			$this->scolarship->load_from_post($_POST);
			$this->scolarship->update_to_database();
		}
		$sql="UPDATE `articles` SET title='".htmlentities($this->title)."', intro='".$this->intro."', tekst='".$this->text."', ".$im."  category='".$this->category."' WHERE ID='".$this->id."'";
		$db->query($sql);
                echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>Your article is updated now.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
	}
	
	public function show_article_form($typ='news'){
		//$ctg= new category();
		//$pbls=new publish();
		$db=new database();
                $db->open_connection();
                @$number;
                $s="SELECT number FROM posts WHERE type='".$_SESSION['rank']."' AND type_id='".$_SESSION['id']."'";
                $res=mysql_query($s);
                while(@$row=  mysql_fetch_array($res)){
                    $number=$row['number'];
                }
                echo '';
					if($number>0){
						echo'<br><br>
					<h3> You have '.$number.' more articles to add.</h3>';
					}
					else{
						echo '<h2>You have '.$number.' articles to add. Contact Administrator if you want to extend the number of announcments.</h2>';
					}
		$this->ctg->choose_category($this->category);
		$this->pbls->load_publish($this->publish);
		//$this->mtg->load_metatags($this->metatags);
		$this->jobtype->load_jobtype($this->jobtype_id);
		$this->scolarship->load_universitystudy($this->scolarship_id);
		echo ('<form action="index.php" method="post" enctype="multipart/form-data" name="form_article" id="form_article" class="addarticlesform">
		
		  <h2>Article Manager: Add Article</h2>  
		 
		        <label><strong>Title</strong></label>
		          <input name="article_type" type="hidden"  id="article_type" value="'.$typ.'">
		          <input name="article_title" type="text" id="article_title" value="'.$this->title.'"/>
		        
		    
		      
		        <label>Intro</label>
		        <textarea name="article_intro_txt" cols="100" rows="5" id="article_intro_txt" style="width:98%" >'.$this->intro.'</textarea>
		      
		        <label>Text </label>
		        
		        <textarea name="article_main_txt" cols="100" rows="30" id="article_main_txt" style="width:98%">'.$this->text.'</textarea>
					<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
			        <script type="text/javascript">
			            tinyMCE.init({
							// General options
							//mode : "textareas",
							theme : "advanced",
							plugins : "youtube,safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
							mode : "exact",
							elements : "article_main_txt",
							relative_urls: false,
                    		remove_script_host : false,
							
							// Theme options
							theme_advanced_buttons1 : "bold,italic,underlitheme_advanced_buttonsne,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontsizeselect",
							theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,link,unlink,code,media",
							
							
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : false,
					        
					        
							// Example content CSS (should be your site CSS)
							content_css : "css/content.css",
					
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "lists/template_list.js",
							external_link_list_url : "lists/link_list.js",
							external_image_list_url : "lists/image_list.js",
							media_external_list_url : "lists/media_list.js",
					
							// Replace values for the template plugin
							template_replace_values : {
								username : "Some User",
								staffid : "991234"
							}
   			            });
   			            
   			            tinyMCE.init({
							// General options
							//mode : "textareas",
							theme : "simple",
							plugins : "youtube,safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
							mode : "exact",
							elements : "article_intro_txt",
							relative_urls: false,
                    		remove_script_host : false,
							
							// Theme options
							theme_advanced_layout_manager : "SimpleLayout",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
					        
					        
							// Example content CSS (should be your site CSS)
							content_css : "css/content.css",
					
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "lists/template_list.js",
							external_link_list_url : "lists/link_list.js",
							external_image_list_url : "lists/image_list.js",
							media_external_list_url : "lists/media_list.js",
					
							// Replace values for the template plugin
							template_replace_values : {
								username : "Some User",
								staffid : "991234"
							}
   			            });
		            </script>
	          <br>
		        <label>Intro image</label>
		        <input type="file" name="image" id="image" />
		      
		  ');		  
		if($typ=='intership' || $typ=='job'){
			$this->jobtype->set_type($typ);	
			echo '
					<h3>Internships/Job deteails</h3>';
			$this->jobtype->show_publish_form();
			
		}
		if($typ=='scolarship'){
			echo '
					<h3>Scholarship</h3>';
			$this->scolarship->show_publish_form();
			
		}
		echo '
				<h3>Publish</h3>';
		$this->pbls->show_publish_form();
		
		echo('
		  <input type="submit" name="article_save" class="btn" value="" />
		   </form>
		');	
	}
	
	public function show_article_form_edit($typ='news'){
		//$ctg= new category();
		//$pbls=new publish();
		
		$this->ctg->choose_category($this->category);
		$this->pbls->load_publish($this->publish);
		//$this->mtg->load_metatags($this->metatags);
		$this->jobtype->load_jobtype($this->jobtype_id);
		$this->scolarship->load_universitystudy($this->scolarship_id); 
		echo ('<form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form" class="addarticlesform">
		
		  <h3>Article Manager: Edit Article </h3>  
		        <label>Title</label>
		        
		          <input name="article_title" type="text" id="article_titl"  value="'.str_replace('"','\"',$this->title).'"/>
				  <input name="article_id" type="text" id="article_id"  style="visibility:hidden" value="'.$this->id.'"/>
				  <input name="article_type" type="hidden"  id="article_type" value="'.$this->type.'">
		        
		        <label>Intro</label>
		        <textarea name="article_intro_txt" cols="100" rows="5" id="article_intro_txt"  style="width:98%">'.$this->intro.'</textarea>
		      
		    
		        <label>Text </label>
		        <textarea name="article_main_txt" cols="100" rows="30" id="article_main_txt"  style="width:98%">'.$this->text.'</textarea>
					<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
			        <script type="text/javascript">
			            tinyMCE.init({
							// General options
							//mode : "textareas",
							theme : "advanced",
							plugins : "youtube,safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
							mode : "exact",
							elements : "article_main_txt",
							document_base_url : "http://www.fondacijacure.org/cms/",
							relative_urls: false,
                    		remove_script_host : false,
							
							// Theme options
							theme_advanced_buttons1 : "bold,italic,underlitheme_advanced_buttonsne,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontsizeselect,search,replace",
							theme_advanced_buttons2 : "bullist,numlist,|,link,unlink,code,media,youtube",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
					        
					        
							// Example content CSS (should be your site CSS)
							content_css : "css/content.css",
					
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "lists/template_list.js",
							external_link_list_url : "lists/link_list.js",
							external_image_list_url : "lists/image_list.js",
							media_external_list_url : "lists/media_list.js",
					
							// Replace values for the template plugin
							template_replace_values : {
								username : "Some User",
								staffid : "991234"
							}
   			            });

   			            tinyMCE.init({
							// General options
							//mode : "textareas",
							theme : "simple",
							plugins : "youtube,safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
							mode : "exact",
							elements : "article_intro_txt",
							document_base_url : "http://www.fondacijacure.org/cms/",
							relative_urls: false,
                    		remove_script_host : false,
                    		
							// Theme options
							theme_advanced_layout_manager : "SimpleLayout",
							theme_advanced_toolbar_location : "top",
							theme_advanced_toolbar_align : "left",
							theme_advanced_statusbar_location : "bottom",
							theme_advanced_resizing : true,
					        
					        
							// Example content CSS (should be your site CSS)
							content_css : "css/content.css",
					
							// Drop lists for link/image/media/template dialogs
							template_external_list_url : "lists/template_list.js",
							external_link_list_url : "lists/link_list.js",
							external_image_list_url : "lists/image_list.js",
							media_external_list_url : "lists/media_list.js",
					
							// Replace values for the template plugin
							template_replace_values : {
								username : "Some User",
								staffid : "991234"
							}
   			            });
		            </script>
	           <br>
		        <label><strong>Intro image</strong></label><br><br>
		        <label>Change picture</label> <input type="checkbox" value="yes" name="article_edit_thumb_change"> <input type="file" name="image" id="image" />
		     <br>');
		//$this->ctg->show_category_form();
		  
		if($this->type=='intership' || $this->type=='job'){
			echo '
					<h3>Internships/Jobs deteails</h3>';
			$this->jobtype->show_publish_form();
			
		}
		if($this->type=='scolarship'){
			echo '
					<h3>Scholarship</h3>';
			$this->scolarship->show_publish_form();
		}
		
		$this->pbls->show_publish_form();
		
		//$this->mtg->show_metatag_form();
		echo '
		  <input type="submit" name="article_edit" class="btn" value="" />
		   </form>
		';	
	}
	
	public function manage_article_selected_changes(){
		$db= new database();
		
		if($_POST['article_list_todo']=='delete'){
			$sql="UPDATE `articles` SET deleted=1  WHERE";
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
		
		if($_POST['article_list_todo']=='publish'){
			$sql="UPDATE `publish_articles` AS p, `articles` AS a SET p.status='publish'  WHERE";
		 	$p=1;
		 	//$sql="DELETE FROM `kategorija` WHERE ";
		 	foreach ($_POST['select'] as $vrijednost) {
			if ($p<count($_POST['select'])) {
			 $sql=$sql." (a.ID='".$vrijednost."' AND p.ID=a.publish)  OR ";	
			} else {
		     $sql=$sql." (a.ID='".$vrijednost."' AND p.ID=a.publish) ";			
			};
		 	$p=$p+1;
		 	};   
		 	$p=$p-1;
		 	//$sql=$sql." LIMIT ".$p;
	        $db->query($sql);
		}
		
		if($_POST['article_list_todo']=='unpublish'){
			$sql="UPDATE `publish_articles` AS p, `articles` AS a SET p.status='unpublish'  WHERE";
		 	$p=1;
		 	//$sql="DELETE FROM `kategorija` WHERE ";
		 	foreach ($_POST['select'] as $vrijednost) {
			if ($p<count($_POST['select'])) {
			 $sql=$sql." (a.ID='".$vrijednost."' AND p.ID=a.publish) OR ";	
			} else {
		     $sql=$sql." (a.ID='".$vrijednost."' AND p.ID=a.publish) ";			
			};
		 	$p=$p+1;
		 	};   
		 	$p=$p-1;
		 	//$sql=$sql." LIMIT ".$p;
	        $db->query($sql);
		}
		
		if($_POST['article_list_todo']=='draft'){
			$sql="UPDATE `publish_articles` AS p, `articles` AS a SET p.status='draft'  WHERE";
		 	$p=1;
		 	//$sql="DELETE FROM `kategorija` WHERE ";
		 	foreach ($_POST['select'] as $vrijednost) {
			if ($p<count($_POST['select'])) {
			 $sql=$sql." (a.ID='".$vrijednost."' AND p.ID=a.publish)  OR ";	
			} else {
		     $sql=$sql." (a.ID='".$vrijednost."' AND p.ID=a.publish) ";			
			};
		 	$p=$p+1;
		 	};   
		 	$p=$p-1;
		 	//$sql=$sql." LIMIT ".$p;
	        $db->query($sql);
		}
	}
	
	public function show_management_list($status=""){
		$db= new database();
		if($status=='published') $status=" p.status='publish' AND";
		if($status=='unpublished') $status=" p.status='unpublish' AND";
		if($status=='draft') $status=" p.status='draft' AND";
		if($status=='user') $status=" user='".$_SESSION['id']."' AND user_type='".$_SESSION['rank']."'  AND ";
                
		$sql="SELECT a.ID,a.title,a.deleted,p.status as publish,a.status,a.date_of_creation,a.views,a.jobtype,a.scolarship FROM articles AS a, publish_articles AS p WHERE ".$status." a.deleted=0 AND a.publish=p.ID ORDER BY a.ID DESC";
		list($result,$a)=$db->query($sql);
		echo('<form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form" class="studentform">
		
		<h3>Article Manager: Article list </h3>
		
              
              <table border="0"><tr><p>
              <td></td>
          <td > <div align="center"><strong>Title</strong></div></td>
          <td ><div align="center"><strong>Type</strong></div></td>
          <td ><div align="center"><strong>Status</strong></div></td>
         <td ><div align="center"><strong>Views</strong></div></td>
          <td ><div align="center"><strong>Date</strong></div></td>
          
        </tr>');
		if($result && mysql_num_rows($result)>0){
			$i=0;
			while ($podaci = mysql_fetch_array($result)){
				if($i % 2==0){ $class="article_management_first_line" ; } else { $class="article_management_scnd_line"; }
				if($podaci['publish']=='publish') $status='Published';
				if($podaci['publish']=='unpublish') $status='Unpublished';
				if($podaci['publish']=='draft') $status='Draft';
				if($podaci['status']=='Pending') $status1='Pending';
				if($podaci['status']=='Active') $status1='Active';
				if($podaci['deleted']==0) $deleted='<img src="graphics/icons/remove_24x24.png" width="16" heigth="16">';
				if($podaci['deleted']==1) $deleted='<img src="graphics/icons/check_24x24.png" width="16" heigth="16">';
				if($podaci['jobtype']!=-1 && $podaci['scolarship']==-1) $type='Job/Intership';
				if($podaci['jobtype']==-1 && $podaci['scolarship']!=-1) $type='Master/PhD';
				if($podaci['jobtype']==-1 && $podaci['scolarship']==-1) $type='News';
				echo('<tr>
			          <td><div align="center">
			            <input type="checkbox" name="select[]" id="select" value="'.$podaci['ID'].'"/>
			          </div></td>
			          <td><a href="?do=edit_article&article_id='.$podaci['ID'].'">'.substr($podaci['title'],0,28).'..</a></td>
			          <td align="center">'.$type.'</td>');
					  if($status1=="Active")
					  	echo '<td><div align="center">'.$status.'</div></td>';
					  else
					  	echo '<td><div align="center">'.$status1.'</div></td>';
					  echo ('<td><div align="center">'.$podaci['views'].'</div></td>
			          <td><div align="center">'.date_format(date_create($podaci['date_of_creation']),"d.m.y") .'</div></td>
			          
			        </tr>');
				$i++;
			}
		}
		
		echo('<tr>
              <td colspan="7"> 
               <div id="article_form_buttons" align="left"><br />
		        With selected <select name="article_list_todo" id="article_list_todo" style="width:30%">
		        <option value="publish">Publish</option>
		        
		        <option value="draft">Draft</option>
		        <option value="delete">Delete</option></select>
                         <input type="submit" name="article_submit_list" id="article_submit_list" class="btn" value="" />
    			
		       </div></td></p>
              </tr>
              
              </table>
              </form>
              </div>');
	}
	
	public function show_sidemenu_article_panel(){
		echo '
			
				<div id="article_mini_menu">
				  <div class="plugin_menu_box_main_container_header">Article Manager</div>	
			      <table width="98%" border="0" cellpadding="3" cellspacing="2" class="plugin_menu_box_main_container">
			        <tr>
			          <td><a href="?menu=article&do=add_article"><img src="graphics/icons/Article_24x24.png" align="absmiddle"/>Add Article</a></td>
			        </tr>
			        <tr>
			          <td><a href="?menu=article&do=show_article"><img src="graphics/icons/text-edit_24x24.png" align="absmiddle"/>Edit Article</a></td>
			        </tr>
			        <tr>
			          <td><a href="?menu=article&do=show_article"><img src="graphics/icons/recycle_24x24.png" align="absmiddle"/>Delete Article</a></td>
			        </tr>
			        <tr>
			          <td><a href="?menu=article&do=add_category"><img src="graphics/icons/add_24x24.png" align="absmiddle"/>Add Category</a></td>
			        </tr>
			        <tr>
			          <td><a href="?menu=article&do=list_category"><img src="graphics/icons/edit_24x24.png" align="absmiddle"/>Rename Category</a></td>
			        </tr>
			        <tr>
			          <td><a href="?menu=article&do=list_category"><img src="graphics/icons/delete_24x24.png" align="absmiddle"/>Delete Category</a></td>
			        </tr>
			      </table>
				</div>
		';
		
	}
	
	// stats for this module
	
	
	public function stats_all_articles(){
		$db= new database();
		echo('
		<div id="article_stats_all_articles" align="center">
			<div align="left"><b>Articles stats</b></div>
			<table width="100%" border="0" cellpadding="2" cellspacing="1">
				<tr>
					<td width="0%"> <div align="left">Status</div></td>
					<td width="90px"><div align="center">Articles</div></td>
					<td width="80px"><div align="center">Reads</div></td>
				</tr>');
		
		$sql="SELECT p.status,COUNT(a.ID),SUM(a.views) FROM articles AS a,publish_articles AS p WHERE a.publish=p.ID AND a.deleted=0 GROUP BY p.status ORDER BY p.status";
		list($result,$a)=$db->query($sql);		
		if($result && mysql_num_rows($result)>0){
		$i=0;
		while ($podaci = mysql_fetch_array($result)){
			if($i % 2==0){ $class="article_management_first_line" ; } else { $class="article_management_scnd_line"; }
			if($podaci['status']=='publish') $status='<img src="graphics/icons/check_24x24.png" width="16" heigth="16"> Published';
			if($podaci['status']=='unpublish') $status='<img src="graphics/icons/analysis16.png" width="16" heigth="16"> Unpublished';
			if($podaci['status']=='draft') $status='<img src="graphics/icons/tests16.png" width="16" heigth="16"> Draft';
			echo('<tr class="'.$class.'">
			          <td>'.$status.'</td>
			          <td><div align="center">'.$podaci['COUNT(a.ID)'].'</div></td>
			          <td><div align="center">'.$podaci['SUM(a.views)'].'</div></td>
			        </tr>');
				$i++;
			}
		}		
				
		echo('</table>
		</div>
		');
	}
	
	public function stats_last_published_articles($num=5){
		$db= new database();
		echo('
		<div id="article_stats_all_articles" align="center">
			<div align="left"><b>Last published articles</b></div>
			<table width="100%" border="0" cellpadding="2" cellspacing="1">
				<tr>
					<td width="0%"> <div align="left">Title</div></td>
					<td width="80px"><div align="center">Reads</div></td>
				</tr>');
		
		$sql="SELECT a.title,a.views FROM articles AS a,publish_articles AS p WHERE p.status='publish' AND a.publish=p.ID AND a.deleted=0  ORDER BY a.ID DESC LIMIT ".$num;
		list($result,$a)=$db->query($sql);		
		if($result && mysql_num_rows($result)>0){
		$i=0;
		while ($podaci = mysql_fetch_array($result)){
			if($i % 2==0){ $class="article_management_first_line" ; } else { $class="article_management_scnd_line"; }
			echo('<tr class="'.$class.'">
			          <td>'.$podaci['title'].'</td>
			          <td><div align="center">'.$podaci['views'].'</div></td>
			        </tr>');
				$i++;
			}
		}		
				
		echo('</table>
		</div>
		');
	}
	
	public function stats_last_unpublished_articles($num=5){
		$db= new database();
		echo('
		<div id="article_stats_all_articles" align="center">
			<div align="left"><b>Last unpublished articles</b></div>
			<table width="100%" border="0" cellpadding="2" cellspacing="1">
				<tr>
					<td width="0%"> <div align="left">Title</div></td>
					<td width="80px"><div align="center">Reads</div></td>
				</tr>');
		
		$sql="SELECT a.title,a.views FROM articles AS a,publish_articles AS p WHERE p.status='unpublish' AND a.publish=p.ID AND a.deleted=0  ORDER BY a.ID DESC LIMIT ".$num;
		list($result,$a)=$db->query($sql);		
		if($result && mysql_num_rows($result)>0){
		$i=0;
		while ($podaci = mysql_fetch_array($result)){
			if($i % 2==0){ $class="article_management_first_line" ; } else { $class="article_management_scnd_line"; }
			echo('<tr class="'.$class.'">
			          <td>'.$podaci['title'].'</td>
			          <td><div align="center">'.$podaci['views'].'</div></td>
			        </tr>');
				$i++;
			}
		}		
				
		echo('</table>
		</div>
		');
	}	

	public function stats_last_draft_articles($num=5){
		$db= new database();
		echo('
		<div id="article_stats_all_articles" align="center">
			<div align="left"><b>Last draft articles</b></div>
			<table width="100%" border="0" cellpadding="2" cellspacing="1">
				<tr>
					<td width="0%"> <div align="left">Title</div></td>
					<td width="80px"><div align="center">Reads</div></td>
				</tr>');
		
		$sql="SELECT a.title,a.views FROM articles AS a,publish_articles AS p WHERE p.status='draft' AND a.publish=p.ID AND a.deleted=0  ORDER BY a.ID DESC LIMIT ".$num;
		list($result,$a)=$db->query($sql);		
		if($result && mysql_num_rows($result)>0){
		$i=0;
		while ($podaci = mysql_fetch_array($result)){
			if($i % 2==0){ $class="article_management_first_line" ; } else { $class="article_management_scnd_line"; }
			echo('<tr class="'.$class.'">
			          <td>'.$podaci['title'].'</td>
			          <td><div align="center">'.$podaci['views'].'</div></td>
			        </tr>');
				$i++;
			}
		}		
				
		echo('</table>
		</div>
		');
	}

	public function stats_moast_readed_articles($num=5){
		$db= new database();
		echo('
		<div id="article_stats_all_articles" align="center">
			<div align="left"><b>Moast viewed articles</b></div>
			<table width="100%" border="0" cellpadding="2" cellspacing="1">
				<tr>
					<td width="0%"> <div align="left">Title</div></td>
					<td width="80px"><div align="center">Reads</div></td>
				</tr>');
		
		$sql="SELECT a.title,a.views FROM articles AS a,publish_articles AS p WHERE a.publish=p.ID AND a.deleted=0  ORDER BY a.views DESC LIMIT ".$num;
		list($result,$a)=$db->query($sql);		
		if($result && mysql_num_rows($result)>0){
		$i=0;
		while ($podaci = mysql_fetch_array($result)){
			if($i % 2==0){ $class="article_management_first_line" ; } else { $class="article_management_scnd_line"; }
			echo('<tr class="'.$class.'">
			          <td>'.$podaci['title'].'</td>
			          <td><div align="center">'.$podaci['views'].'</div></td>
			        </tr>');
				$i++;
			}
		}		
				
		echo('</table>
		</div>
		');
	}
	
	public function show_article_listbox($status=""){
		$db= new database();
		if($status=='published') $status=" p.status='publish' AND";
		if($status=='unpublished') $status=" p.status='unpublish' AND";
		if($status=='draft') $status=" p.status='draft' AND";
		$sql="SELECT a.ID,a.title FROM articles AS a,publish_articles AS p WHERE ".$status." a.deleted=0 AND a.publish=p.ID ORDER BY a.ID DESC";
		list($result,$a)=$db->query($sql);
		if($result && mysql_num_rows($result)>0){
			echo '<select name="article_select" id="article_select" style="width:60%">';
			while ($podaci = mysql_fetch_array($result)){
				if($podaci['ID']==$this->selected_article){
				 echo('<option value="'.$podaci['ID'].'" selected="selected">'.$podaci['title'].'</option>');
				} else {
				 echo('<option value="'.$podaci['ID'].'">'.$podaci['title'].'</option>');
				}
			}
			echo '</select>';
		}	
	}
	
}
//ubaciti dio koji provjerava get varijable 'akcija' i u zavisnosti od nje poziva funkciju po potrebi
/*if($_GET['do']=='add_article'){ 
	$add_article= new articles();
	$add_article->show_article_form();
}*/
if(isset($_POST['article_save'])) {
	$add_article= new articles();
	$add_article->load_from_post(@$_POST);
	$add_article->save_to_database();
}

if(isset($_POST['article_edit'])) {
	$add_article= new articles();
	$add_article->load_from_post($_POST);
	$add_article->update_to_database();
}


if(isset($_POST['article_submit_list'])) {
	$add_article= new articles();
	$add_article->manage_article_selected_changes();
}


?>