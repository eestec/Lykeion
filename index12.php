<?php 
	@session_start();
	require_once 'frontend.php';
	require_once 'user.php';
	require_once 'cv.php';
	require_once 'articles.php';
	require_once 'companys.php';
	require_once 'universitys.php';
	require_once 'mm_messages/messages.php';
	require_once 'avatar.php';
	require_once 'password_change.php';
    require_once 'forgotpassword.php';
	
	if(@$_GET['go']=='login'){
		require_once 'user_login.php';
	}
	if(@$_GET['go']=='logout'){
		require_once 'user_login.php';
		$user= new user_login();
		$user->logout();
	}
	$brojac=0;
	$kompanija=0;
	$student1=0;
        if(@$_SESSION['rank']=='admin'){
            header("Location:admin.php");
        }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="shortcut icon" href="favicon.ico">
<title>Lykeion</title>
<link href="lykeion.css" rel="stylesheet" type="text/css" />
<link href="mm_messages/mm_messages_style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>


<script type="text/javascript" src="js/jquery.validate.js"></script>


<link href="calendar.css" type="text/css" rel="stylesheet" />
<script src="js/calendar.js" type="text/javascript"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="js/validacija.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#messages_send_to").autocomplete("get_course_list.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#st_search_u").autocomplete("get_search_u.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});



	$("#st_search_country").autocomplete("get_search_country.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#st_search_city").autocomplete("get_search_city.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#country").autocomplete("get_search_country.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#city").autocomplete("get_search_city.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#company").autocomplete("get_search_company.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});



	$("#st_search_duration").autocomplete("get_search_duration.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#article_topic").autocomplete("get_search_article.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#job_country_t").autocomplete("get_search_country.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#job_city_t").autocomplete("get_search_city.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#job_company_t").autocomplete("get_search_company.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});


	$("#st_search_academic").autocomplete("get_search_academic.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        

	$("#stud_cv_Country").autocomplete("countries.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#users_Country").autocomplete("countries.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
        $("#un_Country").autocomplete("countries.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
         $("#cm_Country").autocomplete("countries.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});

function init() {

	calendar.set("published_start");
        calendar.set("published_end");
        calendar.set("stud_cv_Date_of_birth");
	

        }
		function errorhide(){
				$("#error_message").hide();
}
var hide=0;
function showhide(object,id){
    if(id==0 || id==-1){
        if(hide%2==0){;
            $("div#"+object).slideUp(function() {});hide++;
        }
        else {$("div#"+object).slideDown();hide++;}
    }
    else{
        if(object.search("work")!=-1){
            jQuery.get("elements.php?type=delete_work&br="+id, function(info){
                $("div#"+object).slideUp();
            });
        }
        else if(object.search("education")!=-1){
            jQuery.get("elements.php?type=delete_education&br="+id, function(info){
                $("div#"+object).slideUp();
            });
        }
        else if(object.search("language")!=-1){
            jQuery.get("elements.php?type=delete_language&br="+id, function(info){
                $("div#"+object).slideUp();
            });
        }
    }
}

function ImportCV(){
    var file=document.createElement("input");
    file.setAttribute("type", "file");
    file.setAttribute("name", "xml_cv");
    file.setAttribute("id","xml_cv");
    var submit=document.createElement("input");
    submit.setAttribute("type", "submit");
    submit.setAttribute("name", "readxml");
    submit.setAttribute("value", "Submit");
    var text=document.createElement("span");
    text.innerHTML="Add XML CV file:";
    var upload=document.getElementById("xmlcv");
    upload.appendChild(text);
    upload.appendChild(file);
    upload.appendChild(submit);
}

function AddElement(type){
    //Create an input type dynamically.
    var br;
    if(type=="work") br=document.form.work_number.value;
    if(type=="education") br=document.form.education_number.value;
    if(type=="language") br=document.form.language_number.value;
    
    jQuery.get("elements.php?type="+type+"&br="+br, function(info){
    var element = document.createElement("div");
    var foo;
    //Assign different attributes to the element.
    if(type=="work"){
        foo = document.getElementById("new_work");
        element.innerHTML=info;
    }
    if(type=="education"){
        foo = document.getElementById("new_education");
        element.innerHTML=info;
    }
    if(type=="language"){
        foo = document.getElementById("new_language");
        element.innerHTML=info;
    }
    
    //Append the element in page (in span).
    foo.appendChild(element);
    //jQuery("#new_work").html(info);
  });
  br++;
  if(type=="work") document.form.work_number.value=br;
  if(type=="education") document.form.education_number.value=br;
  if(type=="language") document.form.language_number.value=br;
   
}
        
function AddtoFavorites(uid,pid,table){
    
    if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                
            	document.getElementById("nesto").innerHTML=xmlhttp.responseText;
            
            }
          }
          
        xmlhttp.open("GET","favorites.php?user_id="+uid+"&post_id="+pid+"&table="+table);
        xmlhttp.send();
        
    
}

</script>
<style type="text/css">
<!--
body {
	margin-top: 0px;
	margin-bottom: 0px;
}
-->
</style></head>

<body>
<div align="center">
	<div id="main_container">
		
        <div id="header_container">
        	<img src="images/header_menu.jpg" border="0" usemap="#Map2">
            <img src="images/header_main.jpg"  border="0" usemap="#Map">        
            <img src="images/header_down.jpg">        
        </div>
            
        <div id="central_container"><div id="nesto"></div>
        
        
		  <?php 
		  if(@$_GET['to']=='university'){
			  if(@$_SESSION['loged']==true)
			  {
				  $brojac++;
				  
			  }
			  else
			  {
				echo '<div align="left" style="margin-left:50px;">
				<p><strong>JOIN LYKEION!</strong></p>
				  <p>Dear Sir or Madam,</p>
				  <p>Lykeion is a portal, which aim is to <strong>improve chances for students</strong> of  technical science for searching internships and studies all over Europe. Of course, vice-versa, Lykeion offers you to <strong>seek students and promote your programs </strong>among  young engineers, who added their CV to Lykeion portal.</p>
				  <p>By entering in cooperation with EESTEC on Lykeion  project, your university will get chance to:</p>
				  <ul type="disc">
					<li><strong>announce Bachelor, Master       and PhD study programs</strong> on Lykeion portal</li>
					<li><strong>announce research       possibilities</strong> on your university on Lykeion portal</li>
					<li><strong>announce news</strong> and promotional activities of company on Lykeion portal</li>
					<li>access to<strong> Lykeion CV       database</strong> of students of technical sciences from whole Europe</li>
					<li>establish direct communication channel with most perspective       students of technical sciences and soft skills</li>
				  </ul>
				  <p>&nbsp;</p>
				  <p>Students who apply in Lykeion database are not just  ordinary students. Most of these students are/were active in international  students organizations, so they possess <strong>huge  motivation</strong> for pursuing international career, are conscious of <strong>internationality</strong>, they have <strong>experiences in teamwork</strong>, project management  and acquire wide <strong>knowledge of soft  skills</strong>.</p>
				  </div>';
			  }
		  }
		  if(@$_GET['to']=='company'){
			  if(@$_SESSION['loged']==true)
			  {
				 $kompanija++;
				  
			  }
			  else
			  {
				echo '<div align="left" style="margin-left:50px;">
				<p><strong>JOIN LYKEION!</strong></p>';
				
				  
				  echo '<p>Dear Sir or Madam,</p>
				  <p>Lykeion is a portal, which aim is to <strong>improve chances for students</strong> of  technical sciences for searching internships and studies all over Europe. Also, Lykeion offers you opportunity to <strong>seek your future employees</strong> among young  engineers, who have added their CV to Lykeion portal.</p>
				  <p>By cooperating with EESTEC on Lykeion project, your  company will get a chance to:</p>
				  <ul type="disc">
					<li><strong>announce       internships and jobs</strong> offers on Lykeion portal</li>
					<li><strong>announce news</strong> and promotional activities of the company on Lykeion portal</li>
					<li>access to <strong>Lykeion CV       database</strong> of students of technical sciences from whole Europe</li>
					<li>establish direct communication channel with most perspective       students of technical sciences and soft skills</li>
				  </ul>
				  <p>&nbsp;</p>
				  <p>Students who apply in Lykeion database are not just ordinary  future employees. Most of these students are/were active in international  students organizations such as EESTEC or IEEE student branches, so they  possess <strong>huge motivation</strong> for pursuing  international career, are conscious of <strong>internationality</strong>,  they have <strong>experiences in teamwork</strong>,  project management and acquire wide <strong>knowledge  of soft skills.</strong></p>
				  </div>';
			  }
		  }
		  if(@$_GET['to']=='student'){
			  if(@$_SESSION['loged']==true)
			  {
				  $student1++;
				  
			  }
			  else 
			  {
				echo '<div align="left" style="margin-left:50px;">
				<p><strong>JOIN LYKEION!</strong></p>
				  <p><strong>Why?</strong></p>
				  <ul type="disc">
					<li><strong>enter your CV in       unique database</strong>, which is viewed by companies AND universities       from whole world</li>
					<li>apply for <strong>internships and       jobs</strong> in high-tech companies</li>
					<li>apply for <strong>Bachelor,</strong> <strong>Master and PhD studies</strong> on technical       universities worldwide</li>
					<li>establish direct communication channel with most recognizable and       perspective universities, companies and experts worldwide</li>
					<li><strong>follow up the       latest news</strong> and notifications of your future employer</li>
				  </ul>
				  <p>&nbsp;</p>
				  <p>By registering on Lykeion you\'ll <strong>extend your chances</strong> to get noted by companies and got possibility  to search among <strong>hundreds of internships</strong> from technical science field and <strong>Bachelor,</strong> <strong>Master and PhD programs</strong> of technical  universities from whole world.</p>
				  <p><strong>Be  the master of your opportunities!</strong></p>
				  </div>';
			  }
		  }
		  
		   if(@$_GET['to']=='registered'){
			  
				echo '<div align="left" style="margin-left:50px;">
				<p><strong>Thank you for registering!</strong></p>';
				
				  
				  echo '<p>Your account will be activated by site Administrator. You will be informed by mail. </p>
				  </div>';
			  
		  }
		  if(@$_SESSION['status']=="not activated"){
                      echo '<div align="left" style="margin-left:50px;">
				<p><strong>Your account is not activated yet.</strong></p>';


				  echo '<p>If you are having problems with activating your account, contact website Administrator.</p>
                                      <p><a href="index.php?go=logout">Back</a>
				  </div>';
                  }
                  if(@$_GET['do']=="forgotpassword"){
                      $forgot=new forgot_password();
                      $forgot->show_form();

                  }
		  else if((@$_SESSION['loged']!='true' && @$_GET['to']=='') || @$_GET['go']=='logout') {
		   if(@$_GET['do']=='')
		  	echo '<div id="central_part_first_visit" align="left">
            	<div>
				<div id="central_part_first_visit_intro_text">
                <hd>Find your opportunity!</hd><br />
                Lykeion is joining highly qualified and motivated students, companies and universities in Europe inside a common platform, allowing them to advertise themselves, search the database for published information and as a result, establishing a new communication channel between all three.
                </div>
                <div id="login">
	                <div id="rnd_container">
    	                <b class="rnd_top"><b class="rnd_b1"></b><b class="rnd_b2"></b><b class="rnd_b3"></b><b class="rnd_b4"></b></b>
        	            <div class="rnd_content">
                            <table border="0"><tr><td colspan="2">
                        Log in to your Lykeion account</td></tr>
                        <form name="loginform" method="post" action="?go=login"> 
            	        <tr><td>Username: </td><td><input name="username" type="text" size="16" maxlength="50" /></td></tr>
                        <tr><td>Password:</td><td> <input name="password" type="password" size="16" maxlength="50" /></td></tr>
                        <tr><td></td><td><login_button><input name="user_login" type="submit" value="Log in" /></login_button></td></tr>
                        <tr><td colspan="2"><a href="?do=forgotpassword">Forgot your password?</a></td></tr>
                        </form>
                        </table>
                	    </div>
                    	<b class="rnd_bottom"><b class="rnd_b4"></b><b class="rnd_b3"></b><b class="rnd_b2"></b><b class="rnd_b1"></b></b>
                    </div>
                </div>
                </div>
                <br />
                <div id="join_row">
                <table width="100%" border="0" cellspace="1">
                <tr>
                    <td>
                	<div id="students_join">
                    <join><i><a href="?cat=st&do=register">JOIN NOW</a></i></join><br />
                    <hd><a href="?to=student">Students</a></hd><br />
                    Find information about jobs, internships and academic programs all over Europe!
                    </div>
                    </td>
                    <td>
                    <div id="company_join">
                    <join><i><a href="?cat=cm&do=register">JOIN NOW</a></i></join><br />
                    <hd><a href="?to=company">Company</a></hd><br />
                    Find highly qualified interns and employees all over Europe!
                    </div>
                    </td>
                    <td>
                    <div id="university_join">
                    <join><i><a href="?cat=un&do=register">JOIN NOW</a></i></join><br />
                    <hd><a href="?to=university">University</a></hd><br />
                    Promote your academic programs among technical students all over Europe!
                    </div>
                    </td>
                </tr>
                </table>
                </div>
                <div id="sponsor"></div>
            
        </div>';
		  	if(@$_GET['cat']=='st' && @$_GET['do']=='register'){
		  		echo '<div id="central_part_students" align="center">
		  			<div style="width:550px;">
		  			<h3>Student register</h3>';
		  		$reg= new Students_user();
		  		$reg->show_register_form();
		  		echo '</div></div>';
		  	}
		  	if(@$_GET['cat']=='un' && @$_GET['do']=='register'){
		  		echo '<div id="central_part_students" align="center">
		  			<div style="width:550px;">
		  			<h3>University register</h3>';
		  		$reg= new universitys();
		  		$reg->show_register_form();
		  		echo '</div></div>';
		  	}
		 	 if(@$_GET['cat']=='cm' && @$_GET['do']=='register'){
		  		echo '<div id="central_part_students" align="center">
		  			<div style="width:550px;">
		  			<h3>Company register</h3>';
		  		$reg= new companys();
		  		$reg->show_register_form();
		  		echo '</div></div>';
		  	}
		  } else {
		  	if(@$_SESSION['rank']=='student'){
			  	$student= new frontend();
		  		echo '<div id="left_part_students">';
		  		$student->show_left_column_students();	
				echo '</div><div id="central_column_students" align="left">';
				
				
				
		  		if(@$_GET['do']=='edit_cv'){
		  			echo '<div align="left"><br />
		  			<h3>Edit your Curriculum Vitae</h3>';
		  			$cv= new Students_cv();
		  			$cv->load_from_database($_SESSION['cv_id']);
		  			$cv->show_edit_cv_form();
		  			echo '<br /><br /></div>';
		  		}
		  		else if(@$_GET['do']=='show_inbox'){
		  			$msg=new messages();
		  			$msg->show_all_messsages();
		  		}
		  		else if(@$_GET['do']=='search'){
		  			$search= new frontend();
		  			$search->student_search();
		  		}
				else if(@$_GET['do']=='send_message'){
		  			$msg= new messages();
		  			$msg->show_start_conversation();
		  		}
		  		else if(@$_GET['do']=='show_message'){
		  			$msg= new messages();
		  			$msg->show_conversation($_GET['id'],$_SESSION['chat_id']);
		  		}
		  		else if(@$_GET['do']=='change_avatar'){
		  			$avatar= new avatar();
		  			$avatar->show_change_avatar_form();
		  		}
		  		else if(@$_GET['do']=='change_password'){
		  			$pass= new password_change();
		  			$pass->show_password_change_form();
		  		}
		  		else if(@$_GET['do']=='favorites'){
		  			$show=new frontend();
                    $show->show_wall_favorites();
		  		}
		  		else if(@$_GET['do']=='show_post'){
		  			$show= new frontend();
		  			$show->show_article($_GET['article_id']);
		  		}
				else if(@$_GET['do']=='show_info'){
		  			$show= new frontend();
		  			$show->show_info($_GET['table'],$_GET['id']);
		  		}
				else if(isset($_POST['student_search_intership'])) {
					$a= new frontend();
					$a->search_intership();
				}
                                else if(isset($_POST['student_search_article'])) {
					$a= new frontend();
					$a->search_article();
				}
				else if(isset($_POST['student_search_job'])) {
					$a= new frontend();
					$a->search_job();
				}
				else if(isset($_POST['student_search_study'])) {
					$a= new frontend();
					$a->search_study();
				}
		  		
		  		else if(@$_GET['do']==''){
					if($brojac>0)
					{
						$wall= new frontend();
		  				$wall->show_wall_university();
					}
					else if($kompanija>0)
					{
						$wall= new frontend();
		  				$wall->show_wall_company();
					}
					else
					{
						$wall= new frontend();
						$wall->show_wall();
					}
		  		}
		  		echo '</div>';
				echo '<div id="right_column_students" align="center">
	                  <div style="width:160px">	
	                  	<br />
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content"> 
						<a href="?do=" ><img align="left" src="images/home.png" width="20"> Home</a><br/></div>
                                                 <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
	                   <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content"> 
                            <a href="?cat=st&do=edit_cv" ><img align="left" src="images/cv.png" width="20"> My Curriculum Vitae</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=st&do=change_avatar"><img align="left" src="img/thumbs/avatar.jpg" height="15"> Change Picture</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=st&do=change_password"><img align="left" src="images/pass.png" height="15"> Change Password</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=st&do=search" ><img align="left" src="images/search-icon1.png" height="15"> Search</a>
	                    </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    

	                    
	                    
						
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content"> 
	                    <a href="?cat=st&do=favorites" ><img align="left" src="images/favorites.png" width="15"> Display favorites</a>
	                    </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
						<br /><br />
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">';
				$msg= new messages();
				$msg->show_side_info();
				echo'   </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
						
	                    <br /><br /><div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content"> 
	                    <a href="?go=logout" ><img align="left" src="images/logout.png" width="15"> Log out</a>
                            </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
		                
						<br /><br />
					 </div>
	                </div>
	            </div>';		  		
		  	}
		  	
		  if(@$_SESSION['rank']=='university'){
			  $usao=0;
			  	$student= new frontend();
		  		echo '<div id="left_part_students">';
		  		$student->show_left_column_university();	
				echo '</div><div id="central_column_students" align="left">';
				
				$a= new frontend();
				$a->check_search();
				
		  		if(@$_GET['do']=='edit_profile'){
		  			echo '<div align="left"><br />
		  			<h3>Edit your Profile</h3>';
		  			$cv= new Universitys();
		  			$cv->load_university($_SESSION['id']);
		  			$cv->editData();
		  			echo '<br /><br /></div>';
		  		}
				else if(@$_GET['do']=='change_avatar'){
		  			$avatar= new avatar();
		  			$avatar->show_change_avatar_form();
		  		}
		  		else if(@$_GET['do']=='change_password'){
		  			$pass= new password_change();
		  			$pass->show_password_change_form();
		  		}
		 		else if(@$_GET['do']=='show_inbox'){
		  			$msg=new messages();
		  			$msg->show_all_messsages();
		  		}
				else if(@$_GET['do']=='search'){
		  			$search= new frontend();
		  			$search->cv_search();
		  		}
				else if(@$_GET['do']=='send_message'){
		  			$msg= new messages();
		  			$msg->show_start_conversation();
		  		}
		  		else if(@$_GET['do']=='show_message'){
		  			$msg= new messages();
		  			$msg->show_conversation($_GET['id'],$_SESSION['chat_id']);
		  		}
		  		else if(@$_GET['do']=='add_news'){
		  			$article= new articles();
		  			echo '<div align="left"><br />
		  			<h3>Add news</h3>';
		  			$article->show_article_form();
		  			echo '<br /><br /></div>';
		  		}
		  		else if(@$_GET['do']=='show_article_list'){
		  			$article= new articles();
		  			echo '<div align="left"><br />
		  			<h3>Edit article</h3>';
		  			$article->show_management_list('user');
		  			echo '<br /><br /></div>';
		  		}
		  		else if(@$_GET['do']=='add_scolarship'){
		  			$article= new articles();
		  			echo '<div align="left"><br />
		  			<h3>Announce Master/PhD</h3>';
		  			$article->show_article_form('scolarship');
		  			echo '<br /><br /></div>';
		  		}
		  		else if(@$_GET['do']=='edit_article'){
		  			$article= new articles();
		  			echo '<div align="left"><br />
		  			<h3>Edit article</h3>';
		  			$article->load_article($_GET['article_id']);
		  			$article->show_article_form_edit();
		  			echo '<br /><br /></div>';	
		  		}
		  		else if(@$_GET['do']=='show_post'){
		  			$show= new frontend();
		  			$show->show_article($_GET['article_id']);
		  		}
				else if(isset($_POST['cv_search_students'])) {
					$a= new frontend();
					$a->search_cv();
				}
				else if(@$_GET['do']=='show_info'){
		  			$show= new frontend();
		  			$show->show_info($_GET['table'],$_GET['id']);
		  		}
		  		else if(@$_GET['do']==''){
					if($student1>0)
					{
						$wall= new frontend();
		  				$wall->show_cv_wall();
					}
					else
					{
						$wall= new frontend();
						$wall->show_wall();
					}
		  		}
				
		  		echo '</div>';
				echo '<div id="right_column_students" align="center">
	                  <div style="width:160px">	
	                  	<br />
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content"> 
						<a href="?do=" ><img align="left" src="images/home.png" width="20"> Home</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=un&do=edit_profile" ><img align="left" src="images/profile_edit.png" height="15"> Edit profile</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=un&do=change_avatar"><img align="left" src="img/thumbs/avatar.jpg" height="15"> Change Picture</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=un&do=change_password"><img align="left" src="images/pass.png" height="15"> Change Password</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=st&do=search" ><img align="left" src="images/search-icon1.png" height="15"> Search</a>
	                    </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
						<br /><br />
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content"> 
	                    <a href="?cat=un&do=add_news" ><img align="left" src="images/news_add.png" height="15"> Add news</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=un&do=add_scolarship" ><img align="left" src="images/news_add.png" height="15"> Add study program</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=un&do=show_article_list" ><img align="left" src="images/ico_edit.png" height="15"> Edit articles</a>
	                    </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
						<br /><br />
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">';
				$msg= new messages();
				$msg->show_side_info();
				echo'   </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
						<br /><br />
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content"> 
	                    <a href="?go=logout" ><img align="left" src="images/logout.png" width="20"> Log out</a>
	                    </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
						<br /><br />
					 </div>
	                </div>
	            </div>';		  		
		  	}
			if(@$_SESSION['rank']=='company'){
				$student= new frontend();
		  		echo '<div id="left_part_students">';
		  		$student->show_left_column_company();	
				echo '</div><div id="central_column_students" align="left">';
				
				$a= new frontend();
				$a->check_search();
				
		  		if(@$_GET['do']=='edit_profile'){
		  			echo '<div align="left"><br />
		  			<h3>Edit your Profile</h3>';
		  			$cv= new Companys();
		  			$cv->load_company($_SESSION['id']);
		  			$cv->editData();
		  			echo '<br /><br /></div>';
		  		}
		  		else if(@$_GET['do']=='show_inbox'){
		  			$msg=new messages();
		  			$msg->show_all_messsages();
		  		}
				else if(@$_GET['do']=='send_message'){
		  			$msg= new messages();
		  			$msg->show_start_conversation();
		  		}
		  		else if(@$_GET['do']=='show_message'){
		  			$msg= new messages();
		  			$msg->show_conversation($_GET['id'],$_SESSION['chat_id']);
		  		}
				else if(@$_GET['do']=='search'){
		  			$search= new frontend();
		  			$search->cv_search();
		  		}
		  		else if(@$_GET['do']=='add_news'){
		  			$article= new articles();
		  			echo '<div align="left"><br />
		  			<h3>Add news</h3>';
		  			$article->show_article_form();
		  			echo '<br /><br /></div>';
		  		}
		  		else if(@$_GET['do']=='show_article_list'){
		  			$article= new articles();
		  			echo '<div align="left"><br />
		  			<h3>Edit article</h3>';
		  			$article->show_management_list('user');
		  			echo '<br /><br /></div>';
		  		}
				else if(@$_GET['do']=='change_avatar'){
		  			$avatar= new avatar();
		  			$avatar->show_change_avatar_form();
		  		}
		  		else if(@$_GET['do']=='change_password'){
		  			$pass= new password_change();
		  			$pass->show_password_change_form();
		  		}
		  		else if(@$_GET['do']=='add_job'){
		  			$article= new articles();
		  			echo '<div align="left"><br />
		  			<h3>Announce Master/PhD</h3>';
		  			$article->show_article_form('job');
		  			echo '<br /><br /></div>';
		  		}
				else if(@$_GET['do']=='add_intership'){
		  			$article= new articles();
		  			echo '<div align="left"><br />
		  			<h3>Announce Master/PhD</h3>';
		  			$article->show_article_form('intership');
		  			echo '<br /><br /></div>';
		  		}
		  		else if(@$_GET['do']=='edit_article'){
		  			$article= new articles();
		  			echo '<div align="left"><br />
		  			<h3>Edit article</h3>';
		  			$article->load_article($_GET['article_id']);
		  			$article->show_article_form_edit();
		  			echo '<br /><br /></div>';	
		  		}
		  		else if(@$_GET['do']=='show_post'){
		  			$show= new frontend();
		  			$show->show_article($_GET['article_id']);
		  		}
				else if(isset($_POST['cv_search_students'])) {
					$a= new frontend();
					$a->search_cv();
				}
				else if(@$_GET['do']=='show_info'){
		  			$show= new frontend();
		  			$show->show_info($_GET['table'],$_GET['id']);
		  		}
		  		else if(@$_GET['do']==''){
					if($student1>0)
					{
						$wall= new frontend();
		  				$wall->show_cv_wall();
					}
					else
					{
						$wall= new frontend();
						$wall->show_wall();
					}
		  		}
		  		echo '</div>';
				echo '<div id="right_column_students" align="center">
	                  <div style="width:160px">
	                  	<br />
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
						<a href="?do=" ><img align="left" src="images/home.png" width="20"> Home</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=un&do=edit_profile" ><img align="left" src="images/profile_edit.png" height="15"> Edit profile</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=un&do=change_avatar"><img align="left" src="img/thumbs/avatar.jpg" height="15"> Change Picture</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=un&do=change_password"><img align="left" src="images/pass.png" height="15"> Change Password</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=st&do=search" ><img align="left" src="images/search-icon1.png" height="15"> Search</a>
	                    </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
						<br /><br />
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content"> 
	                    <a href="?cat=un&do=add_news" ><img align="left" src="images/news_add.png" height="15"> Add news</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=un&do=add_job" ><img align="left" src="images/news_add.png" height="15"> Add job</a></div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
                            <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?cat=un&do=add_intership" ><img align="left" src="images/news_add.png" height="15"> Add intership</a><br />
	                    <a href="?cat=un&do=show_article_list" ><img align="left" src="images/ico_edit.png" height="15"> Edit articles</a>
	                    </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
						<br /><br />
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content"> ';
				$msg= new messages();
				$msg->show_side_info();
				echo'   </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
						<br /><br />
		                <div id="rnd1_container">
	                    <b class="rnd1_top"><b class="rnd1_b1"></b><b class="rnd1_b2"></b><b class="rnd1_b3"></b><b class="rnd1_b4"></b></b>
	                    <div class="rnd1_content">
	                    <a href="?go=logout" ><img align="left" src="images/logout.png" width="20"> Log out</a>
	                    </div>
	                    <b class="rnd1_bottom"><b class="rnd1_b4"></b><b class="rnd1_b3"></b><b class="rnd1_b2"></b><b class="rnd1_b1"></b></b>
	                    </div>
						<br /><br />
					 </div>
	                </div>
	            </div>';		  		
		  	}
		  	
		  };
          ?>                                                
        
         
         <div id="footer_container" align="left">
        	<img src="images/footer_top.jpg">
			<div id="footer_content">
            	<div id="footer_estec_information">
                	<b>EESTEC International</b><br />
                	<i>Power your future!</i><br />
                    Eletrical Engineering STudents' European assoCiation<br /><br />
                    Mekelweg 4,<br />
                    2628 CD Delft, <a href="http://www.eestec.net">www.eestec.net</a><br />
                    The Netherlands <a href="mailto:board@eestec.net">board@eestec.net</a>
            </div>
            <div id="footer_social">
            	Get social with us:<br />
            	<a href="http://www.facebook.com/pages/Electrical-Engineering-Students-European-assoCiation/154927151189732"><img vspace="5px" src="images/fb.png" border="0" /></a> <a href="http://twitter.com/%20EESTEC_tweets"><img vspace="5px" src="images/tw.png" border="0"/></a> <a href="http://www.flickr.com/photos/eestec/"><img vspace="5px" src="images/ln.png" border="0"/></a> 
            </div><br /><br />
            <div id="footer_break_line">
            </div>
            <br /> <br />
            <div id="footer_lykeion_information">
            <br />
            	<estec>EESTEC Lykeion Portal<br />
                Copyright&copy;2011 EESTEC All rights reserved.</estec> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<links>Terms of use | Branding & Autorship | Contact</links>
            </div>
        </div>
        	
    </div>
</div>
<map name="Map2" id="Map2">
  <area shape="rect" coords="318,10,395,24" href="?to=university" />
  <area shape="rect" coords="231,10,312,24" href="?to=company" />
  <area shape="rect" coords="163,10,227,24" href="?to=student" />
  <area shape="rect" coords="51,10,158,24" href="http://www.eestec.net/" /><area shape="rect" coords="-1,10,46,24" href="index.php" />
</map>
<map name="Map" id="Map">
  <area shape="rect" coords="796,17,948,137" href="?to=university" />
  <area shape="rect" coords="649,18,794,136" href="?to=company" /><area shape="rect" coords="527,19,645,135" href="?to=student" />
</map>
</body>
</html>
         

 
