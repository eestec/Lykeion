<?php
@session_start();
require_once 'database.php';
require_once 'mm_messages/messages.php';

class frontend{
	private $user_id;
	private $status;
	
	public function __construct(){
		$this->user_id=@$_SESSION['id'];
		$this->status=@$_SESSION['status'];
	}
        
        public function menu($active){
            ?>
            <div id="nav">
		<ul>
			<li <?php if($active=='home') echo 'class="active"';?>><a href="index.php">Home</a></li>
			<li ><a href="http://eestec.net/" target="_blank">What is EESTEC</a></li>
			<li <?php if($active=='student') echo 'class="active"';?>><a href="index.php?to=student">Students</a></li>
			<li <?php if($active=='company') echo 'class="active"';?>><a href="index.php?to=company">Companies</a></li>
			<li <?php if($active=='university') echo 'class="active"';?>><a href="index.php?to=university">Universities</a></li>
			<li <?php if($active=='contact') echo 'class="active"';?>><a href="index.php?do=contact">Contact</a></li>
		</ul>
	</div>
<?php
        }
	
	public function show_left_column_students(){
		$db= new database();
		$sql="SELECT * FROM `users` as m WHERE m.ID='".$this->user_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0)
		    while ($podaci = mysql_fetch_array($result)){
				echo '
	                    <div id="logged-in-bar">';
			if(@$_SESSION['admin']=="true"){
                                echo '<p> <a href="admin.php" title="Administrator page"><img src="images/admin.png" height="20"></a>';
                            }
                            echo '
			<b><a href="" class="info-btn">'.$podaci['Name'].' '.$podaci['Surname'].'</a></b>
			<a href="?go=logout">Logout</a>
		</div>
	                    <div id="profile-box">
			<div id="left-column-students">
	                    <img class="avatar" alt="avatar" src="'.$podaci['Photo'].'"/>
	                    <h2>'.$podaci['Name'].' '.$podaci['Surname'].'</h2>
	                    <h6>'.$podaci['City'].'</h6>
	                    <h6>'.$podaci['Country'].'</h6>
	                    <h6>'.$podaci['Email'].'</h6>
	                    <h6>'.$podaci['Date_of_birth'].'</h6>
						<div id="icons">
							<a target="_blank" title="Export your CV to Europass XML file" href="work.php?format=XML"><img src="images/rsz_xml-icon.png"></a>
							<a target="_blank" title="Export your CV to PDF document" href="work.php?format=PDF"><img src="images/rsz_pdf-icon.png"></a>
							<span class="separator"><img src="images/separator-profile-box.png"/></span>
							<a href="index.php?do=report_bug" title="Found a bug? Report it"><img src="images/bug.png"></a>
							<a href="index.php?do=show_post&article_id=2" title="Instructions for writing your CV"><img src="images/logo-cv.png"></a>
						</div>
            </div>
			<div id="center-column-messages">
				<div id="latest-messages">
                                
				</div>
				<div id="favorites">
                                
				</div>
			</div>
			<div id="right-column-buttons">
                        ';
                            $m=new messages();
                            $m->show_side_info();
                            echo '
                       
			<a href="?cat=st&do=edit_cv_personal">My Curriculum Vitae</a>
			<a href="?cat=st&do=edit_profile">Edit profile</a>
			<a href="?cat=st&do=search">Search</a>
			</div>
	</div>
        
        <div id="menu">
		<ul>
			<li><a href=javascript:Show("all");>All Articles</a></li>
			<li><a href=javascript:Show("study");>Study Programs</a></li>
			<li><a href=javascript:Show("jobs");>Jobs and Internships</a></span></li>
			<li><a href=javascript:Show("research");>Researches</a></li>
			<li><a href=javascript:Show("companies");>Companies</a></li>
			<li><a href=javascript:Show("universities");>Universities</a></li>
		</ul>
		<div id="find-us-on">
			<h6><a href="?cat=st&do=favorites">Favorites</a></h6> 
			<a class="icon" href="http://www.facebook.com/lykeion.eestec"><img src="images/facebook-logo.png"/></a>
			<a class="icon"  href="https://twitter.com/EESTEC"><img src="images/twitter-logo.png"/></a>
			<a class="icon" href="https://plus.google.com/u/0/107902810588904084368/posts"><img src="images/google-plus-logo.png"/></a>
		</div>
		<div class="print"><a href="index.php?cat=st&do=favorites"><center><img width="20" src="images/favorites.png"></center></a></div>
	</div>
';
	                 
                                
                            
	                  
		    };
	}

        //Interface for deleting the students profile
        public function delete_profile(){
            
        }
	
	public function show_left_column_company(){
		$db= new database();
		$sql="SELECT * FROM `companys` as m WHERE m.ID='".$this->user_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0)
		    while ($podaci = mysql_fetch_array($result)){
				echo '
	                    <div id="logged-in-bar">';
                                 echo '
			<b><a href="" class="info-btn">'.$podaci['Name'].'</a></b>
			<a href="?go=logout">Logout</a>
		</div>
                

                 <div id="profile-box">
			<div id="left-column-students">
	                    <img class="avatar" alt="avatar" src="'.$podaci['Logo'].'"/>
	                    <h2>'.$podaci['Name'].'</h2>
	                    <h6>'.$podaci['City'].'</h6>
	                    <h6>'.$podaci['Country'].'</h6>
	                    
	                    <h6>'.$podaci['Web'].'</h6>
						<div id="icons">
							<a target="_blank" href="'.$podaci['Facebook'].'"><img src="images/rsz_fb.png"></a>
							<a target="_blank" href="'.$podaci['Linkedin'].'"><img src="images/rsz_in.png"></a>
							<span class="separator"><img src="images/separator-profile-box.png"/></span>
							<a href="index.php?do=report_bug"><img src="images/bug.png"></a>
						</div>
            </div>
			<div id="center-column-messages">
				<div id="latest-messages">
                                
				</div>
				
			</div>
			<div id="right-column-buttons">
			';
                            $m=new messages();
                            $m->show_side_info();
                            echo '
                        <a href="?cat=st&do=edit_profile">Edit profile</a>
			<a href="?cat=st&do=add_news">Articles</a>
			
			<a href="?cat=st&do=search">Search</a>
			</div>
	</div>
        <div id="menu">
		<ul>
			<li><a href=javascript:Show("all");>All Articles</a></li>
			<li><a href=javascript:Show("study");>Study Programs</a></li>
			<li><a href=javascript:Show("jobs");>Jobs and Internships</a></span></li>
			<li><a href=javascript:Show("research");>Researches</a></li>
			<li><a href=javascript:Show("companies");>Companies</a></li>
			<li><a href=javascript:Show("universities");>Universities</a></li>
		</ul>
		<div id="find-us-on">
			<h6><a href=javascript:Show("students");>Students</a></h6> 
			<a class="icon" href="http://www.facebook.com/lykeion.eestec"><img src="images/facebook-logo.png"/></a>
			<a class="icon"  href="https://twitter.com/EESTEC"><img src="images/twitter-logo.png"/></a>
			<a class="icon" href="https://plus.google.com/u/0/107902810588904084368/posts"><img src="images/google-plus-logo.png"/></a>
		</div>
		<div class="print"><a href=javascript:Show("students");><center><img width="20" src="images/favorites.png"></center></a></div>
	</div>
        ';




	               				
		    };
	}
	
	public function show_left_column_university(){
		$db= new database();
		$sql="SELECT * FROM `universitys` as m WHERE m.ID='".$this->user_id."'";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0)
		    while ($podaci = mysql_fetch_array($result)){
                        echo '
	                    <div id="logged-in-bar">';
                                 echo '
			<b><a href="" class="info-btn">'.$podaci['Name_of_University'].'</a></b>
			<a href="?go=logout">Logout</a>
		</div>
                

                 <div id="profile-box">
			<div id="left-column-students">
	                    <img class="avatar" alt="avatar" src="'.$podaci['Logo'].'"/>
	                    <h2>'.$podaci['Name_of_University'].'</h2>
                              <h2>  '.$podaci['Name_of_Faculty'].'</h2>
	                    
	                    <h6>'.$podaci['Web'].'</h6>
						<div id="icons">
							<a target="_blank" href="'.$podaci['Facebook'].'"><img src="images/rsz_fb.png"></a>
							<a target="_blank" href="'.$podaci['Linkedin'].'"><img src="images/rsz_in.png"></a>
							<span class="separator"><img src="images/separator-profile-box.png"/></span>
							<a href="index.php?do=report_bug"><img src="images/bug.png"></a>
						</div>
            </div>
			<div id="center-column-messages">
				<div id="latest-messages">
                                
				</div>
				
			</div>
				<div id="right-column-buttons">
			';
                            $m=new messages();
                            $m->show_side_info();
                            echo '
                        <a href="?cat=st&do=edit_profile">Edit profile</a>
			<a href="?cat=st&do=add_news">Articles</a>
			
			<a href="?cat=st&do=search">Search</a>
			</div>
	</div>
        <div id="menu">
		<ul>
			<li><a href=javascript:Show("all");>All Articles</a></li>
			<li><a href=javascript:Show("study");>Study Programs</a></li>
			<li><a href=javascript:Show("jobs");>Jobs and Internships</a></span></li>
			<li><a href=javascript:Show("research");>Researches</a></li>
			<li><a href=javascript:Show("companies");>Companies</a></li>
			<li><a href=javascript:Show("universities");>Universities</a></li>
		</ul>
		<div id="find-us-on">
			<h6><a href=javascript:Show("students");>Students</a></h6> 
			<a class="icon" href="http://www.facebook.com/lykeion.eestec"><img src="images/facebook-logo.png"/></a>
			<a class="icon"  href="https://twitter.com/EESTEC"><img src="images/twitter-logo.png"/></a>
			<a class="icon" href="https://plus.google.com/u/0/107902810588904084368/posts"><img src="images/google-plus-logo.png"/></a>
		</div>
		<div class="print"><a href=javascript:Show("students");><center><img width="20" src="images/favorites.png"></center></a></div>
	</div>';

                
                
                
                
                
							
		    };	
	}       
	
	public function show_wall($sql=''){
		$db= new database();$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		if(isset($_GET['page'])){
                    $page=$_GET['page'];
                }
                else{
                    $page=1;
                }
               $counter=0;
               
		if($sql=='') $sql="SELECT a.ID,a.title,a.intro,a.date_of_creation, a.image, a.scolarship,a.jobtype,a.user,a.user_type FROM `articles` as a, `publish_articles` as p WHERE a.status='Active' AND a.publish=p.ID and a.deleted=0 AND p.status='publish' order by a.date_of_creation desc";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
	    echo '<div id="article-wall">';
		    while ($podaci = mysql_fetch_array($result)){
				if($counter>=(($page-1)*10) && $counter<$page*10){
                                    $user_id=@$podaci['user'];
                                    echo'<div class="article">
                                      ';
                                    @s;
                                    if(@$podaci['user_type']=="university"){
                                            $s="SELECT Name_of_University, Name_of_Faculty, Logo, ID FROM universitys WHERE ID='$user_id'";
                                            list($r,$b)=$db->query($s);
                                            while($row=mysql_fetch_array($r)){
                                                if($podaci['image']!='img/' && $podaci['image']!='..\img\uploads\\')
                                                            echo '<a href="index.php?do=show_info&table=universitys&id='.$row['ID'].'"title="Announced by '.$row['Name_of_University'].', '.$row['Name_of_Faculty'].'. Click here to see the profile"> <img class="article-logo" alt="Article logo" src="'.$podaci['image'].'"></a>';
                                                else
                                                    echo '<a href="index.php?do=show_info&table=universitys&id='.$row['ID'].'"title="Announced by '.$row['Name_of_University'].', '.$row['Name_of_Faculty'].'. Click here to see the profile"> <img class="article-logo" alt="Article logo" src="'.$row['Logo'].'"></a>';

                                            }
                                    }
                                else {
                                            $s="SELECT Name, Field_of_work, Logo, ID FROM companys WHERE ID='$user_id'";
                                    list($r,$b)=$db->query($s);
                                    while($row=mysql_fetch_array($r)){
                                        if($podaci['image']!='img/' && $podaci['image']!='..\img\uploads\\')
                                                            echo '<a href="index.php?do=show_info&table=companys&id='.$row['ID'].'" title="Announced by '.$row['Name'].', '.$row['Field_of_work'].' Click here to see the profile"><img src="'.$podaci['image'].'" class="article-logo" alt="Article logo"> </a>';
                                    else
                                        echo '<a href="index.php?do=show_info&table=companys&id='.$row['ID'].'" title="Announced by '.$row['Name'].', '.$row['Field_of_work'].' Click here to see the profile"><img src="'.$row['Logo'].'" class="article-logo" alt="Article logo"> </a>';

                                    }
                                    }

                                    echo ' <h3><a href="index.php?do=show_post&article_id='.$podaci['ID'].'" >'.$podaci['title'].'</a></h3>

                                    <h6>'.$podaci['date_of_creation'].'</h6>
                                    <p>'.stripcslashes($podaci['intro']).'';
                                    if($_SESSION['loged']!='true') echo "<br><br><p><strong> Log in or <a href='index.php?cat=st&do=register'>Register</a> to read a full article.</strong></p>";
                                    echo '</div>';
                                    
                                }
                                $counter++; 
	            	
	    	};
                $num= (int) ($counter/10)+1; 
	    echo '<div id="pager">
				<ul>';
            for($i=1; $i<=$num; $i++){
                echo '
					<li '; if($page==$i)echo 'class="active"'; echo '><a href="index.php?page='.$i.'">'.$i.'</a></li>';
					
				} echo '</ul>
			</div></div>';				
	    }
	}
	
	
	public function show_wall_university($sql=''){
		$db= new database();
		if($sql=='') $sql="SELECT * FROM `universitys` WHERE CURDATE()<=Date_of_expire AND Status='Active' ORDER BY date_of_expire DESC";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
	    echo '<div id="article-wall">';
		    while ($podaci = mysql_fetch_array($result)){
				
				 echo '<div class="article"><img class="article-logo" alt="Article logo" src="'.$podaci['Logo'].'">' ;
				
				echo'<h3><a href="index.php?do=show_info&table=universitys&id='.$podaci['ID'].'">'.$podaci['Name_of_University'].'</a></h3>
				<h6>'.$podaci['City'].', '.$podaci['Country'].', Number of students: '.$podaci['Number_of_students'].'</h6>
				</div>';	
	            	
	    	};
	    echo '</div>';				
	    }
	}
	
	public function show_wall_company($sql=''){
		$db= new database();
		if($sql=='') $sql="SELECT * FROM `companys` WHERE Status='Active' AND CURDATE()<=Date_of_expire  ORDER BY date_of_expire DESC";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
	    echo '<div id="article-wall">';
		    while ($podaci = mysql_fetch_array($result)){
				
				 echo '<div class="article"><img class="article-logo" alt="Article logo" src="'.$podaci['Logo'].'">';
				
				echo'<h3><a href="index.php?do=show_info&table=companys&id='.$podaci['ID'].'">'.$podaci['Name'].'</a></h3>
				<h6>'.$podaci['City'].', '.$podaci['Country'].' Number of employees: '.$podaci['Number_of_emplyees'].'</h6>
				
				</div>';	
	            	
	    	};
	    echo '</div>';				
	    }
	}

        public function show_wall_favorites(){
            echo '<div id="article-wall">';
		$db= new database();
                $db->open_connection();
		$sql="SELECT * FROM `favorites` WHERE user_id='$this->user_id' order by id desc";
	    $result=mysql_query($sql);
            
	    if($result && mysql_num_rows($result)>0){
                while($row=mysql_fetch_array($result)){
                    $post_id=$row['post_id'];
                    $ID=$row['id'];
                    $table=$row['type'];
                    if($table=="companys"){
                        $sql1="SELECT ID,Name,City,Country, Number_of_emplyees FROM companys WHERE  ID='$post_id' AND Date_of_expire>NOW()  AND Status='Active'";
                        $result1=mysql_query($sql1);
                        while(@$row1=mysql_fetch_array($result1)){
                            
                            echo '<div class="article">';
                            echo'<h3><a href="index.php?do=show_info&table=companys&id='.$row1['ID'].'">'.$row1['Name'].'</a>
                                <a href=javascript:AddtoFavorites('.$_SESSION['id'].','.$ID.',"delete"); title="Delete from favorites"><img src="images/no.png" width="20"></a></h3>';
                            echo '<h6>'.$row1['City'].', '.$row1['Country'].' Number of employees: '.$row1['Number_of_emplyees'].'</h6>
                                    
                                    </div>';
                        }
                    }
                    else if($table=="universitys"){
                        $sql1="SELECT ID,Name_of_University,City,Country, Number_of_students FROM universitys WHERE ID='$post_id' AND Date_of_expire>NOW() AND Status='Active'";
                        $result1=mysql_query($sql1);
                        while(@$row1=mysql_fetch_array($result1)){
                            echo '<div class="article">';

				echo'<h3><a href="index.php?do=show_info&table=universitys&id='.$row1['ID'].'">'.$row1['Name_of_University'].'</a>
                                    <a href=javascript:AddtoFavorites('.$_SESSION['id'].','.$ID.',"delete"); title="Delete from favorites"><img src="images/no.png" width="20"></a></h3>
				<h6>'.$row1['City'].', '.$row1['Country'].' Number of students: '.$row1['Number_of_students'].'</h6>
				
				</div>';
                        }
                    }
                    else{
                        $sql1="SELECT a.ID,a.title,a.intro,a.date_of_creation FROM `articles` as a, `publish_articles` as p WHERE (a.ID='$post_id' and a.status='Active') AND (a.publish=p.ID and a.deleted=0 AND p.status='publish')";
                        $result1=mysql_query($sql1);
                        while(@$row1=mysql_fetch_array($result1)){
                            echo '<div class="article">';
                           echo'<h3><a href="index.php?do=show_post&article_id='.$row1['ID'].'">'.$row1['title'].'</a>
                                <a href=javascript:AddtoFavorites('.$_SESSION['id'].','.$ID.',"delete"); title="Delete from favorites"><img src="images/no.png" width="20"></a></h3>
				
				<h6>Date of creation: '.$row1['date_of_creation'].'</h6>
                                    <p>'.$row1['intro'].'</p>
				</div>';
                        }
                    }




                }
                
	    
	    }
            echo '</div>';
            
	}
	
	
	public function show_cv_wall($sql=''){
		$db= new database();
                
                if($_SESSION['rank']=='company' && $_SESSION['visible']==0) echo '<h3>You don not have privileges to browse students.</h3>';
                else{


		if($sql=='') $sql="SELECT * FROM `students` as s,`users` as u, education as e WHERE s.ID=u.CV AND e.student_id=s.ID  AND u.status='Active'  GROUP BY s.ID ORDER BY s.Name";
	    list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
	    echo '<div id="article-wall">';
		    while ($podaci = mysql_fetch_array($result)){
				echo '<div class="article"><img class="article-logo" alt="Article logo" src="'.$podaci['Photo'].'">';
				echo'<h3><a href="index.php?do=show_info&table=students&id='.$podaci['CV'].'">'.$podaci['Name'].' '.$podaci['Surname'].'</a></h3>
				<h6> Desired employment:'.$podaci['Desired_employment'].', Date of birth: '.$podaci['Date_of_birth'].' </h6>
				<p>'.$podaci['Country'].', '.$podaci['City'].'</p>
				</div>';	
	    	};
	    echo '</div>';				
	    }
                }
	}
	
	
	
	
	public function show_article($id){
		$db= new database();
                echo '<div id="article-wall">';
		$sql="SELECT * FROM `articles` as a, `publish_articles` as p WHERE (a.ID='".$id."' and a.status='Active') AND (a.publish=p.ID and a.deleted=0 AND p.status='publish') LIMIT 1";
		list($result,$a)=$db->query($sql);
	    if($result && mysql_num_rows($result)>0){
	    	//$share= new socialshare("title",$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		    while ($podaci = mysql_fetch_array($result)){
				
				echo'<div class="article">
		          	<h3>'.$podaci['title'].'';
                                    if($_SESSION['rank']=='student'){
                                        echo '<a href=javascript:AddtoFavorites('.$_SESSION['id'].','.$id.',"articles"); ><img src="images/addfavorites.gif" width="20" title="Add to favorites"></a></h3>';
                                        echo '<div id="inform"></div>';
                                    }
                                    else echo '</h3>';
		            echo '<br><br><p>'.stripcslashes($podaci['intro']).'</p><br>';
                             if($podaci['image']!="img/" && $podaci['image']!="..\img\uploads\\")  echo '<center><img src="'.$podaci['image'].'"></center>';
		           echo '<p>'.stripcslashes($podaci['tekst']).'</p><br>';
		        
				//check should it show jobtype or scholarship
				if($podaci['jobtype']!=-1){
					require_once 'jobstypes.php';
					$jobs= new jobstypes();
					$jobs->load_jobtype($podaci['jobtype']);
					$jobs->show_data();
				}
				if($podaci['scolarship']!=-1){
					require_once 'universitystudy.php';
					$university= new universitystudy();
					$university->load_universitystudy($podaci['scolarship']);
					$university->show_data();
					
				}
				//echo' <div id="article_footer" align="right">'; $share->social_share_form(); echo ' '.$podaci['date_of'].'</div>';
		        echo '</div>';
		    }
		    $sql="UPDATE `articles` SET views=views+1 WHERE ID=".$id;
		    $db->query($sql);
		}
                
                else {
                    echo '<div id="article_box"><strong>Selected Article is not active on Lykeion anymore.</strong></div>';
                }
                echo '</div>';
	}
	
	public function show_info($table,$id){
		$db= new database();
		if($table=="universitys")
		{
			$sql="SELECT * FROM universitys where id='$id' AND Date_of_expire>NOW() AND Status='Active' ";
		}
		else if($table=="companys")
		{
			$sql="SELECT * FROM companys where id='$id' AND Date_of_expire>NOW() AND Status='Active' ";
		}
		else if($table=="students")
		{

			$sql="SELECT * FROM students where id='$id' ";
		}
		list($result,$a)=$db->query($sql);
                echo '<div id="article-wall">';
	    if($result && mysql_num_rows($result)>0){
	    	//$share= new socialshare("title",$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		    while ($podaci = mysql_fetch_array($result)){
				if($table=="universitys")
				{
                                    $s="UPDATE universitys SET views=views+1 WHERE ID='$id'";
                                    $db->query($s);
					echo'<div class="article">
						<h3>'.$podaci['Name_of_University'].'';
                                                     if($_SESSION['rank']=='student'){
                                                        echo '<div id="inform"></div>';
                                                         echo '<a href=javascript:AddtoFavorites('.$_SESSION['id'].','.$id.',"universitys");><img src="images/addfavorites.gif" width="20" title="Add to favorites"></a></h3>';
                                                    }
                                                    else echo '</h3>';
						echo '<p><img src="'.$podaci['Logo'].'" height="100"></p><br><p><strong>Basic information</strong></p><br>';
						echo '<h3>'.$podaci['Name_of_Faculty'].'</h3><br><p>Address: '.$podaci['Address'].'<br>City: '.$podaci['City'].'<br>Country: '.$podaci['Country'].'<br>Contact person: '.$podaci['Contact_person'].'<br>Phone: '.$podaci['Phone_number'].'<br>Website: <a href="http://'.$podaci['Web'].'">link</a><br>Email: '.$podaci['Email'].'<br>';
                                                   if($podaci['Facebook']!="") echo '<a href="'.$podaci['Facebook'].'"><img src="images/fb.png" width="30"></a>';
                                                   if($podaci['Twitter']!="") echo '<a href="'.$podaci['Twitter'].'"><img src="images/tw.png" width="30"></a>';
                                                    echo '<p><strong>About University</strong></p><p>'.nl2br($podaci['About_University']).'</p><p><strong>About Faculty</strong></p><p>'.nl2br($podaci['About_Faculty']).'</p></div>';
				}
				else if($table=="companys")
				{
                                    $s="UPDATE companys SET views=views+1 WHERE ID='$id'";
                                    $db->query($s);
					echo'<div class="article">
						<h3>'.$podaci['Name'].'';
                                                if($_SESSION['rank']=='student'){
                                                    echo '<div id="inform"></div>';
                                                    echo '<a href=javascript:AddtoFavorites('.$_SESSION['id'].','.$id.',"companys");><img src="images/addfavorites.gif" width="20" title="Add to favorites"></a></h3>';
                                                    }
                                                    else echo '</h3>';
						echo '<p><img src="'.$podaci['Logo'].'" height="100"></p><br><p><strong>Basic information</strong></p><br>
						<p><strong>Field of work:</strong> '.$podaci['Field_of_work'].'<br><strong>About company: </strong><p align="justify">'.nl2br($podaci['About_company']).'</p><br><strong>Address:</strong> '.$podaci['Address'].'<br><strong>City: </strong>'.$podaci['City'].'<br><strong>Country: </strong>'.$podaci['Country'].'<br><strong>Contact person:</strong> '.$podaci['Contact_person'].'<br><strong>Phone number: </strong>'.$podaci['Phone_number'].'<br><strong>Website: </strong><a href="'.$podaci['Web'].'">'.$podaci['Web'].'</a><br><strong>Email:</strong> '.$podaci['Email'].'<br></div>';
                                                if($podaci['Facebook']!="") echo '<a href="'.$podaci['Facebook'].'"><img src="images/fb.png" width="30"></a>';
                                                   if($podaci['Twitter']!="") echo '<a href="'.$podaci['Twitter'].'"><img src="images/tw.png" width="30"></a>';
                                                   echo '</div>';
					
				}
				else if($table=="students")
				{
                                    if($_SESSION['rank']!="student"){
                                        if($_SESSION['rank']=='company' && $_SESSION['visible']==0) echo '<div class="article">You don not have privileges to browse students.</div>';
                                        else {
                                            @$_SESSION['cv_id']=$id;
                                            echo'<div class="article">
                                                    <h3>'.$podaci['Name'].' '.$podaci['Surname'].'</h3><br>
                                            <p>Export CV to <a href="work.php?format=XML" title="Export your CV to Europass XML file" target="_blank"><img src="images/xml-icon.png" width="40"></a> or <a href="work.php?format=PDF" title="Export your CV to PDF document" target="_blank"><img src="images/pdf-icon.png" width="40"></a><br><br>
                                                ';
                                            $cv= new Students_cv();
                                            $cv->load_from_database($id);
                                            $cv->show_data();
                                                    echo '<br></div>';
                                        }
				}
                                }
		        
				
		        echo '<br /><br /> </div>';
		    }
		    
		}
                else {
                    echo '<div id="article_box"><strong>Selected Comapny or University is not active on Lykeion anymore.</strong></div>';
                }

	}
	
	public function search_intership(){
		$criteria="";$criteria1="";$criteria2="";$criteria3="";$criteria4="";$criteria5="";$criteria6="";
		if(@$_POST['st_search_paid']=='1'){
			if(@$_POST['st_search_yes']=='1') $criteria1=" j.Paid_intership='1' ";
			if(@$_POST['st_search_no']=='1') $criteria1=" j.Paid_intership='0' ";
			if(@$_POST['st_search_yes']=='1' && @$_POST['st_search_no']=='1') $criteria1=" 1 ";
		}	else $criteria1=" 1 ";
		if(@$_POST['st_search_duration_ch']=='1'){
			$criteria2=" j.Duration='".addslashes($_POST['st_search_duration'])."' ";
		} else $criteria2= " 1 ";
		if(@$_POST['st_position']=='1'){
			$criteria3=" j.Position LIKE '%".addslashes($_POST['position'])."%' ";
		} else $criteria3=" 1 ";
                if(@$_POST['st_country']=='1'){
			$criteria4=" j.Country='".addslashes($_POST['country'])."' ";
		} else $criteria4=" 1 ";
                if(@$_POST['st_city']=='1'){
			$criteria5=" j.City='".addslashes($_POST['city'])."' ";
		} else $criteria5=" 1 ";
                if(@$_POST['st_company']=='1'){
			$criteria6=" c.Name='".addslashes($_POST['company'])."' ";
		} else $criteria6=" 1 ";
		
		$criteria=$criteria1. ' AND '.$criteria2.' AND '.$criteria3.' AND '.$criteria4.' AND '.$criteria5.' AND '.$criteria6;
		
		$sql="SELECT a.ID, a.title,a.intro, a.date_of_creation,a.jobtype,a.scolarship FROM `articles` as a,`jobs_intersips` as j, companys as c WHERE j.type='intership' AND a.status='Active' AND a.deleted=0 AND a.user=c.ID AND a.jobtype=j.ID AND ".$criteria."  ORDER BY a.date_of_creation DESC";
		$a= new frontend();
		$a->show_wall($sql);
	}
	
	public function search_job(){
		$criteria="";$criteria1="";$criteria2="";$criteria3="";$criteria4="";$criteria5="";$criteria6="";$criteria7="";
		if(@$_POST['st_search_academic_ch']=='1'){
			$criteria1=" j.Academic_level LIKE '%".addslashes($_POST['st_search_academic'])."%'";
		}	else $criteria1=" 1 ";
		if(@$_POST['st_search_position_ch']=='1'){
			$criteria2=" j.Position LIKE '%".addslashes($_POST['st_search_position'])."%' ";
		} else $criteria2= " 1 ";
		if(@$_POST['st_search_type_ch']=='1'){
			if(@$_POST['st_search_full_time']=='1') $criteria3=" j.Type_of='1' ";
			if(@$_POST['st_search_part_time']=='1') $criteria3=" j.Type_of='0' ";
			if(@$_POST['st_search_part_time']=='1' && $_POST['st_search_full_time']=='1') $criteria3=" 1 ";
		} else $criteria3=" 1 ";
                if(@$_POST['st_search_accomodation_ch']=='1'){
			if(@$_POST['st_search_yes']=='1') $criteria4=" j.Accomodation_costs='1' ";
			if(@$_POST['st_search_no']=='1') $criteria4=" j.Accomodation_costs='0' ";
			if(@$_POST['st_search_yes']=='1' && $_POST['st_search_no']=='1') $criteria4=" 1 ";
		} else $criteria4=" 1 ";
                if(@$_POST['job_country']=='1'){
			$criteria5=" j.Country='".addslashes($_POST['job_country_t'])."' ";
		} else $criteria5= " 1 ";
                if(@$_POST['job_city']=='1'){
			$criteria6=" j.City='".addslashes($_POST['job_city_t'])."' ";
		} else $criteria6= " 1 ";
		if(@$_POST['job_company']=='1'){
			$criteria7=" c.Name='".addslashes($_POST['job_company_t'])."' ";
		} else $criteria7= " 1 ";

		$criteria=$criteria1. ' AND '.$criteria2.' AND '.$criteria3.' AND '.$criteria4.' AND '.$criteria5.' AND '.$criteria6.' AND '.$criteria7;
		
		$sql="SELECT a.ID, a.title,a.intro, a.date_of_creation,a.jobtype,a.scolarship FROM `articles` as a,`jobs_intersips` as j, companys as c WHERE j.type='job' AND a.status='Active' AND a.deleted=0 AND a.user=c.ID AND a.jobtype=j.ID AND ".$criteria."  ORDER BY a.date_of_creation DESC";
		$a= new frontend();
		$a->show_wall($sql);
	
	}
	
	public function search_study(){
		$criteria="";$criteria1="";$criteria2="";$criteria3="";$criteria4="";$criteria5="";$criteria6="";$criteria7="";
		if(@$_POST['st_search_bcs']=='1'){
			$criteria1=" j.Bachelor=1 ";
		}	else $criteria1=" 1 ";
		if(@$_POST['st_search_masters']=='1'){
			$criteria2=" j.Master=1 ";
		} else $criteria2= " 1 ";
		if(@$_POST['st_search_phd']=='1'){
			$criteria3=" j.PhD=1 ";
		} else $criteria3= " 1 ";
                if(@$_POST['st_search_research']=='1'){
			$criteria4=" j.Research=1 ";
		} else $criteria4= " 1 ";
                if(@$_POST['st_search_country_ch']=='1'){
			$criteria5=addslashes($_POST['st_search_country']);
                        $criteria5="u.Country='$criteria5'";
		} else $criteria5= " 1 ";
                if(@$_POST['st_search_country_city']=='1'){
			$criteria6=addslashes($_POST['st_search_city']);
                        $criteria6="u.City='$criteria6'";
		} else $criteria6= " 1 ";
                if(@$_POST['st_search_university']=='1'){
			$criteria7=addslashes($_POST['st_search_u']);
                        $criteria7="u.Name_of_University='$criteria7'";
		} else $criteria7= " 1 ";
		/*
		if($_POST['st_search_country_ch']=='1'){
			$criteria4=" j.Country LIKE %".$_POST['st_search_position']."% ";
		} else $criteria4=" 1 ";
		*/
		$criteria=$criteria1. " AND ".$criteria2." AND ".$criteria3." AND ".$criteria4." AND ".$criteria6." AND ".$criteria5." AND ".$criteria7."";
		
		$sql="SELECT a.ID, a.title,a.intro, a.date_of_creation,a.jobtype,a.scolarship FROM `articles` as a,`university_study` as j, universitys as u WHERE a.deleted=0 AND a.status='Active' AND a.scolarship=j.ID AND a.user=u.ID AND  ".$criteria."  ORDER BY a.date_of_creation DESC";
		
                $a= new frontend();
		$a->show_wall($sql);
	}

        public function search_article(){
		$criteria="";$criteria1="";
		if(@$_POST['article_topic']==''){
			$criteria1=" 1 ";
		}
                else
                    $criteria1=$_POST['article_topic'];

		$criteria="title LIKE '%$criteria1%'";

		$sql="SELECT * FROM `articles`  WHERE deleted=0 AND status='Active'  AND   ".$criteria."  ORDER BY date_of_creation DESC";
		$a= new frontend();
		$a->show_wall($sql);
	}
	
	public function search_cv(){
		$criteria="";$criteria1="";$criteria2="";$criteria3="";$criteria4="";$criteria5="";$criteria6="";$criteria7="";$criteria8="";$criteria9="";$criteria10="";$criteria11="";$criteria12="";$criteria13="";$criteria14="";$criteria15="";
		if(@$_POST['cm_search_username_ch']=='1'){
			$criteria1=" u.Username LIKE '%".addslashes($_POST['cv_search_username'])."%' ";
		}	else $criteria1=" 1 ";
		if(@$_POST['cm_search_name_ch']=='1'){
			$criteria2=" CONCAT(s.Name,' ',s.Surname) LIKE '%".addslashes($_POST['cv_search_name'])."%' ";
		} else $criteria2= " 1 ";
		if(@$_POST['cm_search_city_ch']=='1'){
			$criteria3=" s.City LIKE '%".addslashes($_POST['cv_search_city'])."%' ";
		} else $criteria3= " 1 ";
		if(@$_POST['cm_search_country_ch']=='1'){
			$criteria4=" s.Country LIKE '%".addslashes($_POST['cv_search_country'])."%' ";
		} else $criteria4= " 1 ";
		if(@$_POST['cm_search_education_field']=='1'){
			$criteria5=" e.EDU_FIELD LIKE '%".addslashes($_POST['cv_search_education_field'])."%' ";
		} else $criteria5= " 1 ";
		if(@$_POST['cm_search_title']=='1'){
			$criteria6=" e.TITLE LIKE '%".addslashes($_POST['cv_search_title'])."%' ";
		} else $criteria6= " 1 ";
                if(@$_POST['cm_search_name_of_organisation']=='1'){
			$criteria7=" e.ORG_NAME LIKE '%".addslashes($_POST['cv_search_name_of_organisation'])."%' ";
		} else $criteria7= " 1 ";
                if(@$_POST['cm_search_social_skills']=='1'){
			$criteria8=" s.social_skills LIKE '%".addslashes($_POST['cv_search_organisational_skills'])."%' ";
		} else $criteria8= " 1 ";
                if(@$_POST['cm_search_organisational_skills']=='1'){
			$criteria9=" s.organisational_skills LIKE '%".addslashes($_POST['cv_search_name_of_organisation'])."%' ";
		} else $criteria9= " 1 ";
                if(@$_POST['cm_search_technical_skills']=='1'){
			$criteria10=" s.technical_skills LIKE '%".addslashes($_POST['cv_search_technical_skills'])."%' ";
		} else $criteria10= " 1 ";
                if(@$_POST['cm_search_other_skills']=='1'){
			$criteria11=" s.other_skills LIKE '%".addslashes($_POST['cv_search_other_skills'])."%' ";
		} else $criteria11= " 1 ";
                if(@$_POST['cm_search_annexes']=='1'){
			$criteria12=" s.annexes LIKE '%".addslashes($_POST['cv_search_annexes'])."%' ";
		} else $criteria12= " 1 ";
                if(@$_POST['cm_search_occupation']=='1'){
			$criteria13=" w.WPOSITION LIKE '%".addslashes($_POST['cv_search_occupation'])."%' ";
		} else $criteria13= " 1 ";
                if(@$_POST['cm_search_responsibilities']=='1'){
			$criteria14=" w.ACTIVITIES LIKE '%".addslashes($_POST['cv_search_responsibilities'])."%' ";
		} else $criteria14= " 1 ";
                if(@$_POST['cm_search_name_address']=='1'){
			$criteria15=" w.EMPLOYER_NAME LIKE '%".addslashes($_POST['cv_search_name_address'])."%' ";
		} else $criteria15= " 1 ";
		
		/*
		if($_POST['st_search_country_ch']=='1'){
			$criteria4=" j.Country LIKE %".$_POST['st_search_position']."% ";
		} else $criteria4=" 1 ";
		*/
		$criteria=$criteria1. ' AND '.$criteria2.' AND '.$criteria3.' AND '.$criteria4.' AND '.$criteria5.' AND '.$criteria6. ' AND '.$criteria7.' AND '.$criteria8.' AND '.$criteria9.' AND '.$criteria10.' AND '.$criteria11. ' AND '.$criteria12.' AND '.$criteria13.' AND '.$criteria14.' AND '.$criteria15;
		
		$sql="SELECT * FROM `students` as s,`users` as u, education as e, work_experience as w WHERE s.ID=u.CV AND s.ID = e.student_id AND s.ID = w.student_id AND u.status='Active' AND ".$criteria."  GROUP BY s.Name";
		
		$a= new frontend();
		$a->show_cv_wall($sql);
	}
	
	public function student_search(){
		echo '   
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
                                            <form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form" class="studentform">
		
                    <h3>Search by article topic</h3>
                    
                    
                    <label>Article topic:</label><input  type="text" name="article_topic" id="article_topic" >
                    <br>
                  <input class="search-btn" type="submit" name="student_search_article" id="student_search_article" value="Search"/>
    	 <br><h3>Search for Intership</h3>
    	
   	<label>Paid internship<input type="checkbox" name="st_search_paid" value="1" id="st_search_paid" /></label>
            
              <input type="checkbox" name="st_search_yes" value="1" id="st_search_yes" />Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" value="1" name="st_search_no" id="st_search_no" />No
          
            <label><input type="checkbox" name="st_search_duration_ch" value="1" id="st_search_duration_ch" />Duration of internship</label>
            <input name="st_search_duration" type="text" id="st_search_duration" size="40" maxlength="500"  />
          
            <label><input type="checkbox" name="st_position" value="1" id="st_position" />Position</label>
            <input name="position" type="text" id="position" size="40" maxlength="500"  />
         
            <label><input type="checkbox" name="st_country" value="1" id="st_country" />Country</label>
            <input name="country" type="text" id="country" size="40" maxlength="500"  />
          
            <label><input type="checkbox" name="st_city" value="1" id="st_city" />City</label>
            <input name="city" type="text" id="city" size="40" maxlength="500"  />
          
            <label><input type="checkbox" name="st_company" value="1" id="st_company" />Company</label>
            <input name="company" type="text" id="company" size="40" maxlength="500"  />
              <br>
            <input class="search-btn" type="submit" name="student_search_intership" id="student_search_intership" value="Search"/>
         <br>
          <h3>
          Search for Job</h3>
            <label><input type="checkbox" name="st_search_academic_ch" value="1" id="st_search_academic_ch" />Academic level/degree</label>
            <input name="st_search_academic" type="text" id="st_search_academic" size="40" maxlength="500"  />
         
            <label><input type="checkbox" name="st_search_position_ch" value="1" id="st_search_position_ch" />Position</label>
            <input name="st_search_position" type="text" id="st_search_position" size="40" maxlength="600"  />
          
            <label><input type="checkbox" name="job_country" value="1" id="job_country" />Country</label>
            <input name="job_country_t" type="text" id="job_country_t" size="40" maxlength="600"  />
         
            <label><input type="checkbox" name="job_city" value="1" id="job_city" />City</label>
            <input name="job_city_t" type="text" id="job_city_t" size="40" maxlength="600"  />
         
            <label><input type="checkbox" name="job_company" value="1" id="job_company" />Company Name</label>
            <input name="job_company_t" type="text" id="job_company_t" size="40" maxlength="600"  /><br>
         
            <label><input type="checkbox" name="st_search_accomodation_ch" value="1" id="st_search_accomodation_ch" />Paid Accomodation</label>
            <input type="checkbox" name="st_search_yes" value="1" id="st_search_yes" />Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" value="1" name="st_search_no" id="st_search_no" />No<br>
          
            <label><input type="checkbox" name="st_search_type_ch" value="1" id="st_search_type_ch" />Type</label>
            <input type="checkbox" name="st_search_full_time" value="1" id="st_search_full_time" />Full time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" value="1" name="st_search_part_time" id="st_search_part_time" />Part time
          <br> <input class="search-btn" type="submit" name="student_search_job" id="student_search_job" value="Search"/> <br>
 
       
          <h3>
          Search for Study programms
          </h3>
         
            <label><input type="checkbox" name="st_search_university" value="1" id="st_search_university" />Name of University</label>
            <input name="st_search_u" type="text" id="st_search_u" size="40" maxlength="200"  />
          
            <label><input type="checkbox" name="st_search_country_ch" value="1" id="st_search_country_ch" />Coutry</label>
            <input name="st_search_country" type="text" id="st_search_country" size="40" maxlength="200"  />
         
            <label><input type="checkbox" name="st_search_country_city" value="1" id="st_search_country_city" />City</label>
            <input name="st_search_city" type="text" id="st_search_city" size="40" maxlength="200"  /><br>
         
            <label>BCs</label><input type="checkbox" name="st_search_bcs" value="1" id="st_search_bcs" /><br>
            
            <label>Masters</label><input type="checkbox" name="st_search_masters" value="1" id="st_search_masters" /><br>
            
            <label>PhD</label><input type="checkbox" name="st_search_phd" value="1" id="st_search_phd" /><br>
            
            <label>Research</label><input type="checkbox" name="st_search_research" value="1" id="st_search_research" /><br>
             <br><input class="search-btn" type="submit" name="student_search_study" id="student_search_study" value="Search"/> <br>

       
          </form>
    </div></div>';
	}
	
	public function cv_search(){
            if($_SESSION['rank']=='company' && $_SESSION['visible']==0) echo '<div id="wall_article_cv">You don not have privileges to browse students.</div>';
            else{
	 echo'<center><h2>Search Students</h2></center>
		<form action="index.php" method="post" enctype="multipart/form-data" name="form" id="form" class="studentform">
	 
		      <center><h3>Basic information</h3></center>
                       
		        <label>By Username<input type="checkbox" name="cm_search_username_ch" value="1" id="cm_search_username_ch" />
		        </label>
		        <input name="cv_search_username" type="text" id="cv_search_username"   />
		      
		        <label>By Name and Surname<input type="checkbox" name="cm_search_name_ch" value="1" id="cm_search_name_ch" />
		        </label>
		        <input name="cv_search_name" type="text" id="cv_search_name"   />
		      
		        <label>By City<input type="checkbox" name="cm_search_city_ch" value="1" id="cm_search_city_ch" />
		        </label>
		        <input name="cv_search_city" type="text" id="cv_search_city" size="36" maxlength="200"  />
		      
		        <label>By Country<input type="checkbox" name="cm_search_country_ch" value="1" id="cm_search_country_ch" />
				</label>
		        <input name="cv_search_country" type="text" id="cv_search_country"   /><br>
		     
                      <center><h3>Education</h3></center>
		      
		        <label>By Title of qualification awarded<input type="checkbox" name="cm_search_title" value="1" id="cm_search_title" />
				</label>
		        <input name="cv_search_title" type="text" id="cv_search_title"   /><br>
		      
		        <label>By Organisation providing education<input type="checkbox" name="cm_search_name_of_organisation" value="1" id="cm_search_name_of_organisation" />
				</label>
		        <input name="cv_search_name_of_organisation" type="text" id="cv_search_name_of_organisation"  /><br>
		     
		        <label>By education field<input type="checkbox" name="cm_search_education_field" value="1" id="cm_search_education_field" />
				</label>
		        <input name="cv_search_education_field" type="text" id="cv_search_education_field" >
		      
                      <center><h3>Work experience</h3></center>
                     
		        <label>By Occupation or position held<input type="checkbox" name="cm_search_occupation" value="1" id="cm_search_occupation" />
				</label>
		        <input name="cv_search_occupation" type="text" id="cv_search_occupation" ><br>
		      
		        <label>By Main activities and responsibilities<input type="checkbox" name="cm_search_responsibilities" value="1" id="cm_search_responsibilities" />
				</label>
		        <input name="cv_search_responsibilities" type="text" id="cv_search_responsibilities" ><br>
		      
		        <label>By Name of employer<input type="checkbox" name="cm_search_name_address" value="1" id="cm_search_name_address" />
				</label>
		        <input name="cv_search_name_address" type="text" id="cv_search_name_address" >
		      
                      <center><h3>Personal skills and competences</h3></center>
                      
		        <label>By Social skills and competences<input type="checkbox" name="cm_search_social_skills" value="1" id="cm_search_social_skills" />
				</label>
		        <input name="cv_search_social_skills" type="text" id="cv_search_social_skills" ><br>
		      
		        <label>By Organisational skills and competences<input type="checkbox" name="cm_search_organisational_skills" value="1" id="cm_search_organisational_skills" />
				</label>
		        <input name="cv_search_organisational_skills" type="text" id="cv_search_organisational_skills" ><br>
		      
		        <label>By Technical skills and competences<input type="checkbox" name="cm_search_technical_skills" value="1" id="cm_search_technical_skills" />
				</label>
		        <input name="cv_search_technical_skills" type="text" id="cv_search_technical_skills"   /><br>
		      
		        <label>By Other skills and competences<input type="checkbox" name="cm_search_other_skills" value="1" id="cm_search_other_skills" />
				</label>
		        <input name="cv_search_other_skills" type="text" id="cv_search_other_skills"  /><br>
		      
		        <label>By Annexes<input type="checkbox" name="cm_search_annexes" value="1" id="cm_search_annexes" />
				</label>
		        <input name="cv_search_annexes" type="text" id="cv_search_annexes" size="36" maxlength="200"  />
		      <br><br>
                      <input class="search-btn" type="submit" name="cv_search_students" value="Search"/><br>
		</form>
		';
            }
	}
	
	public function check_search(){
		
		
		
		
	}
	
}

	
	

?>
