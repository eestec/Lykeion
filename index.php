<?php
        ini_set("session.use_only_cookies",true);
	@session_start();
        if(!isset($_SESSION['generated']) || @$_SESSION['generated']<(time()-300000)){
            session_regenerate_id(true);
            $_SESSION['generated']=time();
        }
	require_once 'frontend.php';
	require_once 'user.php';
        require_once 'bugs.php';
	require_once 'cv.php';
	require_once 'articles.php';
	require_once 'universitys.php';
	require_once 'companys.php';
	require_once 'mm_messages/messages.php';
	require_once 'avatar.php';
	require_once 'password_change.php';
        require_once 'forgotpassword.php';
        require_once 'user_login.php';
	if(@$_GET['go']=='login'){ 
		require_once 'user_login.php';
	}
	if(@$_GET['go']=='logout'){
		require_once 'user_login.php';
		$user= new user_login();
		$user->logout();
	}
        if(@$_SESSION['rank']=='admin'){
            header("Location:admin.php");
        }
	$brojac=0;
	$kompanija=0;
	$student1=0;
        if(@$_SESSION['loged']=='true' && @$_SESSION['ip']!=$_SERVER['REMOTE_ADDR'])
            header("Location:index.php?go=logout");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="favicon.ico" rel="shortcut icon">
<title>Lykeion - A place where students, companies and universities can directly reach each other</title>
<link type="text/css" rel="stylesheet" href="css/styles.css">
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>

<link href="mm_messages/mm_messages_style.css" rel="stylesheet" type="text/css" />




<script type="text/javascript" src="js/jquery.validate.js"></script>


<link href="calendar.css" type="text/css" rel="stylesheet" />
<script src="js/calendar.js" type="text/javascript"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<script type="text/javascript" src="js/validacija.js"></script>
<script src="js/elements.js" type="text/javascript"></script>
<script type="text/javascript">

</script>
<style type="text/css">
<!--
body {
	margin-top: 0px;
	margin-bottom: 0px;
}
-->
</style>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26753711-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>
<div id="container">

	<div id="header">
		<h1><a href="index.php"><img src="images/logo.png" alt="Lykeion"/></a></h1>
		
		<div id="statistics">
		<?php include ("front_stats.php");?>
		</div>
                <?php
                if(@$_SESSION['loged']==true){
                    
                ?>
		<form id="search" action="index.php" method="post">
			<input type="text" name="article_topic" id="article_topic" class="textBox" placeholder="Type your search here..."/>
		</form>
                <?php
                }
                ?>
                
                <div id="nesto"></div>
        
        
		  <?php
                  $account=0;
		  if(@$_GET['to']=='university'){
			  if(@$_SESSION['loged']==true)
			  {
				  $brojac++;
				  
			  }
			  else
			  {
                              ?>
                <div id="login-closed">
			<a href="#" class="login-btn"><img src="images/login-btn.png"/></a>
		</div>
		<div id="login-box">
			<div id="login-opened"><a href="#" class="login-btn"><img src="images/login-btn-opened.png"/></a></div>
			<div id="login-box-content">
				<form id="login-form" action="index.php" method="post">
					<label>Username:</label>
					<input type="text" name="username" />
					<label>Password:</label>
					<a href="index.php?do=forgotpassword">Forgot your password?</a>
					<input type="password" name="password" />
					<div id="login-form-bottom">
					<div class="keepmeloggedin"><input type="checkbox"  name="keeploggedin" value="KeepLoggedIn"/>  Keep me logged in</div>
					
                                        <input class="btn" type="submit" value="" name="user_login" >
					</div>
				</form>
			</div>
		</div>
                <?php
                              $f=new frontend();
                              $f->menu("university");
				?>
                
                                 <div id="featured">
		<ul>
			<li class="ss1"><img src="images/featured-image-1.png" alt="Featured image 1" width="100%"/></li>
		</ul>
		
	</div>
	
	<div id="shadow-up"></div>
	
	<div id="content">
		<div id="info-container">
			<div class="col">
				 <a href="index.php?to=student#content"><img src="images/icon-students.png" alt="Students" />
				<h2>STUDENTS</h2></a>
				<p>Interships and Jobs</p>
			</div>
			<div class="col">
				 <a href="index.php?to=company#content"><img src="images/icon-companies.png" alt="Companies" />
				<h2>COMPANIES</h2></a>
				<p>Seek you future employees</p>
			</div>
			<div class="col active">
				 <a href="index.php?to=university#content"><img src="images/icon-universities.png" alt="Universities" />
				<h2>UNIVERSITIES</h2></a>
				<p>Research and Study Programs possibilities</p>
			</div>
			<div class="clear"></div>
			
			<div id="left-section">
				
                                <p>Lykeion is a portal  which connects students of technical fields, searching for internships and study programs, with universities who are looking to promote their programs amongst students and young engineers.</p>
                                <p>By entering in cooperation with EESTEC on the Lykeion project, your university will be able to:</p>
                                <ul>
					<li>announce Bachelor, Master and PhD study programs to students;</li>
					<li>announce your university’s research possibilities to student;</li>
					<li>announce news and promotional activities of companies on Lykeion;</li>
					<li>access Lykeion’s CV database of students of technical sciences;</li>
					<li>    establish contact with the most perspective students of technical sciences;</li>
				</ul>
				
				<p>Students who register on Lykeion are not just ordinary students; most are/were active in international students organizations, so they possess huge motivation for pursuing international careers, are conscious of internationality, have experiences in teamwork, project management and acquire a wide knowledge of soft skills.
				</p>
				<form id="joinnow" action="index.php?cat=un&do=register" method="post">
                                    <a href="index.php?cat=un&do=register"><input class="btn" type="image" src="images/joinnow-btn.png"/></a>
				</form>
			</div>
		</div>
	</div>
	
	<div id="shadow-down"></div>
	
	<div id="testimonials">
		<p>Lykeion is connecting highly qualified and motivated students, companies and universities across the world inside a common platform, allowing them to advertise themselves, search the database for published information and as a result, establishing a new communication channel between all three. </p>
		<div class="author"><a href="index.php?do=more">Read more</a></div>
	</div>
	
</div>
                                <?php
			  }
		  }
		  if(@$_GET['to']=='company'){
			  if(@$_SESSION['loged']==true)
			  {
				 $kompanija++;
				  
			  }
			  else
			  {
                              ?>
    <div id="login-closed">
			<a href="#" class="login-btn"><img src="images/login-btn.png"/></a>
		</div>
		<div id="login-box">
			<div id="login-opened"><a href="#" class="login-btn"><img src="images/login-btn-opened.png"/></a></div>
			<div id="login-box-content">
				<form id="login-form" action="index.php" method="post">
					<label>Username:</label>
					<input type="text" name="username" />
					<label>Password:</label>
					<a href="index.php?do=forgotpassword">Forgot your password?</a>
					<input type="password" name="password" />
					<div id="login-form-bottom">
					<div class="keepmeloggedin"><input type="checkbox"  name="keeploggedin" value="KeepLoggedIn"/>  Keep me logged in</div>
					
                                        <input class="btn" type="submit" value="" name="user_login" >
					</div>
				</form>
			</div>
		</div>
    <?php
                                 $f=new frontend();
                              $f->menu("company");
				?>
                                 <div id="featured">
		<ul>
			<li class="ss1"><img src="images/featured-image-1.png" alt="Featured image 1" width="100%"/></li>
		</ul>
		
	</div>
	
	<div id="shadow-up"></div>
	
	<div id="content">
		<div id="info-container">
			<div class="col">
				 <a href="index.php?to=student#content"><img src="images/icon-students.png" alt="Students" />
				<h2>STUDENTS</h2></a>
				<p>Interships and Jobs</p>
			</div>
			<div class="col active">
				 <a href="index.php?to=company#content"><img src="images/icon-companies.png" alt="Companies" />
				<h2>COMPANIES</h2></a>
				<p>Seek you future employees</p>
			</div>
			<div class="col">
				 <a href="index.php?to=university#content"><img src="images/icon-universities.png" alt="Universities" />
				<h2>UNIVERSITIES</h2></a>
				<p>Research and Study Programs possibilities</p>
			</div>
			<div class="clear"></div>
			
			<div id="left-section">
				
                                <p>Lykeion is a portal  which connects students of technical fields, searching for internships and study programs, with companies seeking new employees amongst young engineers.
                               By entering in cooperation with EESTEC on the Lykeion project, your university will be able to:</p>
                                <ul>
					<li>announce internships and jobs offers to students;</li>
					<li>announce news and promotional activities of the company to the students;</li>
					<li>access to the Lykeion CV database of students of technical sciences from the whole Europe;</li>
					<li>establish a direct communication channel with the most perspective students of technical sciences and soft skills;</li>
					
				</ul>
				
				<p>Students who register on Lykeion are not just ordinary students; most are/were active in international students organizations, so they possess huge motivation for pursuing international careers, are conscious of internationality, have experiences in teamwork, project management and acquire a wide knowledge of soft skills.
				</p>
				<form id="joinnow" action="index.php?cat=cm&do=register" method="post">
                                    <a href="index.php?cat=cm&do=register"><input class="btn" type="image" src="images/joinnow-btn.png"/></a>
				</form>
			</div>
		</div>
	</div>
	
	<div id="shadow-down"></div>
	
	<div id="testimonials">
		<p>Lykeion is connecting highly qualified and motivated students, companies and universities across the world inside a common platform, allowing them to advertise themselves, search the database for published information and as a result, establishing a new communication channel between all three. </p>
		<div class="author"><a href="index.php?do=more">Read more</a></div>
	</div>
	
</div>
				<?php
			  }
		  }
		 else if(@$_GET['to']=='student'){
			  if(@$_SESSION['loged']==true)
			  {
				  $student1++;
				  
			  }
			  else 
			  {
                              ?>
    <div id="login-closed">
			<a href="#" class="login-btn"><img src="images/login-btn.png"/></a>
		</div>
		<div id="login-box">
			<div id="login-opened"><a href="#" class="login-btn"><img src="images/login-btn-opened.png"/></a></div>
			<div id="login-box-content">
				<form id="login-form" action="index.php" method="post">
					<label>Username:</label>
					<input type="text" name="username" />
					<label>Password:</label>
					<a href="index.php?do=forgotpassword">Forgot your password?</a>
					<input type="password" name="password" />
					<div id="login-form-bottom">
					<div class="keepmeloggedin"><input type="checkbox"  name="keeploggedin" value="KeepLoggedIn"/>  Keep me logged in</div>
					
                                        <input class="btn" type="submit" value="" name="user_login" >
					</div>
				</form>
			</div>
		</div>
    <?php
				$f=new frontend();
                                $f->menu("student");
                ?>
    <div id="featured">
		<ul>
			<li class="ss1"><img src="images/featured-image-1.png" alt="Featured image 1" width="100%"/></li>
		</ul>
		<form id="signup" action="index.php?cat=st&do=register" method="post">
                    <a href="index.php?cat=st&do=register"><input class="btn" type="image" src="images/signup-btn.png"/></a>
		</form>
	</div>
	
	<div id="shadow-up"></div>
	
	<div id="content">
		<div id="info-container">
			<div class="col active">
                            <a href="index.php?to=student#content"><img src="images/icon-students.png" alt="Students" />
				<h2>STUDENTS</h2></a>
				<p>interships and jobs</p>
			</div>
			<div class="col">
				 <a href="index.php?to=company#content"><img src="images/icon-companies.png" alt="Companies" />
				<h2>COMPANIES</h2></a>
				<p>seek you future employees</p>
			</div>
			<div class="col noMargin">
				 <a href="index.php?to=university#content"><img src="images/icon-universities.png" alt="Universities" />
				<h2>UNIVERSITIES</h2></a>
				<p>research possibilities</p>
			</div>
			<div class="clear"></div>
			
			<div id="left-section">
				<h4>Join Lykeion!</h4>
				<h5>Why</h5>
				<ul>
					<li>    Enter and update your CV to be viewed by companies and universities from all over the world;</li>
					<li>    Apply for internships and jobs in various companies;</li>
					<li>    Apply for Bachelor, Master and PhD studies on technical universities worldwide;</li>
					<li>    Establish direct contact with most the recognizable and perspective universities, companies and experts worldwide;</li>
					<li>    Follow  the latest news and notifications of your future employer.</li>
				</ul>
				
				<p>By registering on Lykeion you'll not only increase your chances to get noticed by companies, but will also have the possibility to search among hundreds of internships from technical field and Bachelor, Master and PhD programs of technical universities across the world.
				</p>
				<form id="joinnow" action="index.php?cat=st&do=register"  method="post">
                                    <a href="index.php?cat=st&do=register"><input class="btn" type="image" src="images/joinnow-btn.png"/></a>
				</form>
			</div>
		</div>
	</div>
	
	<div id="shadow-down"></div>
	
	<div id="testimonials">
		<p>Lykeion is connecting highly qualified and motivated students, companies and universities across the world inside a common platform, allowing them to advertise themselves, search the database for published information and as a result, establishing a new communication channel between all three. </p>
		<div class="author"><a href="index.php?do=more">Read more</a></div>
	</div>
	
</div>
<?php
			  }
		  }
                  else if((@$_GET['do']=='show_post' || @$_GET['do']=='show_info') && $_SESSION['loged']!='true'){
                      ?>
                      <div id="login-closed">
					<a href="#" class="login-btn"><img src="images/login-btn.png"/></a>
					</div>
					<div id="login-box">
					<div id="login-opened"><a href="#" class="login-btn"><img src="images/login-btn-opened.png"/></a></div>
					<div id="login-box-content">
					<form id="login-form" action="index.php" method="post">
					<label>Username:</label>
					<input type="text" name="username" />
					<label>Password:</label>
					<a href="index.php?do=forgotpassword">Forgot your password?</a>
					<input type="password" name="password" />
					<div id="login-form-bottom">
					<div class="keepmeloggedin"><input type="checkbox"  name="keeploggedin" value="KeepLoggedIn"/>  Keep me logged in</div>
					<input class="btn" type="submit" value="" name="user_login" >
					</div>
					</form>
					</div>
					</div>

					<?php 
					
								$f=new frontend();
                                $f->menu("home");
                ?>
 

 
	<div id="content">
		<div id="simple-page-container">
			<div id="head-section">
				<img src="images/contact-us-icon.jpg" alt="Contact us" />
				<h2>Log in or Register</h2>
				<p>get involved</p>
			</div>

			<div class="clear"></div>
			
			<div id="main-section">
				<h4>EESTEC International</h4>
				<h5>Power your future!</h5>
                                <p>You are not logged in. Log in by pressing the button on the top right corner. You are not register yet. <a href="index.php?cat=st&do=register">Click here</a> to register.
				<p>Electrical Engineering STudents' European assoCiation</p>
				<p>Mekelweg 4,<br/>2628 CD Delft,<br/>The Netherlands</p>
				<p><a href="http://www.eestec.net">www.eestec.net</a><br/><a href="mailto:lykeion@eestec.net">lykeion@eestec.net</a></p>
				
				<p>Find us on social networks:<br/>
					<a class="icon" href="http://www.facebook.com/lykeion.eestec"><img src="images/facebook-logo.png"/></a>
					<a class="icon"  href="https://twitter.com/EESTEC"><img src="images/twitter-logo.png"/></a>
					<a class="icon" href="https://plus.google.com/u/0/107902810588904084368/posts"><img src="images/google-plus-logo.png"/></a>
				</p>
				
			</div>
		</div>
	</div>
<?php
                  }
                  else if(@$_GET['do']=='preview'){
                      ?>
<div id="login-closed">
			<a href="#" class="login-btn"><img src="images/login-btn.png"/></a>
		</div>
		<div id="login-box">
			<div id="login-opened"><a href="#" class="login-btn"><img src="images/login-btn-opened.png"/></a></div>
			<div id="login-box-content">
				<form id="login-form" action="index.php" method="post">
					<label>Username:</label>
					<input type="text" name="username" />
					<label>Password:</label>
					<a href="index.php?do=forgotpassword">Forgot your password?</a>
					<input type="password" name="password" />
					<div id="login-form-bottom">
					<div class="keepmeloggedin"><input type="checkbox"  name="keeploggedin" value="KeepLoggedIn"/>  Keep me logged in</div>
					
                                        <input class="btn" type="submit" value="" name="user_login" >
					</div>
				</form>
			</div>
		</div>
<?php
                      $f=new frontend();
                      $f->menu("home");
                      if(@$_GET['wt']=='study'){
                           $sql="SELECT a.ID, a.image, a.title,a.intro,a.date_of_creation,a.scolarship,a.jobtype,a.user,a.user_type FROM `articles` as a, `publish_articles` as p WHERE a.status='Active' AND a.publish=p.ID and a.deleted=0 AND p.status='publish' AND a.scolarship<>-1 order by a.date_of_creation desc";
                            $f->show_wall($sql);
                      }
                      else if(@$_GET['wt']=='job'){
                           $sql="SELECT a.ID, a.image, a.title,a.intro,a.date_of_creation,a.scolarship,a.jobtype,a.user,a.user_type FROM `articles` as a, `publish_articles` as p WHERE a.status='Active' AND a.publish=p.ID and a.deleted=0 AND p.status='publish' AND a.jobtype<>-1 order by a.date_of_creation desc";
                            $f->show_wall($sql);
                      }
                      else if(@$_GET['wt']=='article'){
                          $id_article=$_GET['id'];
                           $sql="SELECT a.ID, a.image, a.title,a.intro,a.date_of_creation,a.scolarship,a.jobtype,a.user,a.user_type FROM `articles` as a, `publish_articles` as p WHERE a.status='Active' AND a.publish=p.ID and a.deleted=0 AND p.status='publish' AND a.ID=".$id_article." order by a.date_of_creation desc";
                            $f->show_wall($sql);
                      }
                      else if(@$_GET['wt']=='companies'){
                          $f->show_wall_company();
                      }
                      else if($_GET['wt']=='universities'){
                        $f->show_wall_university();
                       }
                      else
                        $f->show_wall();
                  }
		  else if(@$_GET['do']=='terms'){
                      $f=new frontend();
                                $f->menu("home");
                      ?>
<div id="content">
		<div id="simple-page-container">
			<div id="head-section">
				<img src="images/terms-of-use-icon.jpg" alt="Contact us" />
				<h2>TERMS OF USE</h2>
				<p>know your rights</p>
			</div>

			<div class="clear"></div>
			
			<div id="main-section">
				
            <h3>Uses of personal information</h3>
			<p>We use the information you provide to:</p>
			<ul>
			<li>	Enable you to share your information and communicate with other Users, or provide your personal details to third parties offering combined services with Lykeion;</li>
			<li>	Administer your account with us and customize the service we provide to you and other Users;</li>
			<li>	Send you service or promotional communications through email and notices on the Lykeion website;</li>
			<li>	Connect you to opportunities by enabling companies and universities to get in contact with you through Lykeion;</li>
			<li>	Enable companies to view the CV in order to find appropriate students for the internships and job offers.</li>
			</ul>

			<h3>Your obligations</h3>

			<h5>Service Eligibility</h5>
			<p>To be eligible to use the Service, you must meet the following criteria and represent and warrant that you:</p>
			<ul type="disc">
			<li> are 18 years of age or older;</li><li> are not currently restricted from the Services, or not otherwise prohibited from having a Lykeion account;</li><li> are not a competitor of Lykeion or are not using the Services for reasons that are in competition with Lykeion;</li><li> will only maintain one Lykeion account at any given time;</li><li> have full power and authority to enter into this Agreement and doing so will not violate any other agreement to which you are a party;</li><li> will not violate any rights of Lykeion, including intellectual property rights such as copyright or trademark rights; </li><li> agree to provide at your cost all equipment, software, and internet access necessary to use the Services.
			</li></ul>
			<h5>Sign-In Credentials</h5>
			<p>You agree to:</p>
			<ul type="disc">
			<li>Keep your password secure and confidential;</li><li> not permit others to use your account;</li><li> refrain from using other Usersâ€™ accounts;</li>
			<li> refrain from selling, trading, or otherwise transferring your Lykeion account to another party;</li>
			<li> refrain from charging anyone for access to any portion of Lykeion, or any information therein.</li>
			</ul>

			<h5>Security</h5>
			<ul type="disc">
			<li>Personal information you provide will be secured in accordance with industry standards and technology. Since the internet is not a 100% secure environment, we cannot ensure or warrant the security of any information you transmit to Lykeion. There is no guarantee that information may not be accessed, copied, disclosed, altered, or destroyed by breach of any of our physical, technical, or managerial safeguards.</li>
			<li>You are responsible for maintaining the secrecy of your unique password and account information, and for controlling access to your email communications at all times.</li>
			</ul>

			<h3>Our rights and obligations</h3>
			<h5>Services Availability</h5>
			<p align="justify">For as long as Lykeion continues to offer the Services, Lykeion shall provide and seek to update, improve and expand the Services. As a result, we allow you to access Lykeion as it may exist and be available on any given day and have no other obligations, except as expressly stated in this Agreement. We may modify, replace, refuse access to, suspend or discontinue Lykeion, partially or entirely, or change and modify prices for all or part of the Services for you or for all our users in our sole discretion. All of these changes shall be effective upon their posting on our site or by direct communication to you unless otherwise noted. Lykeion further reserves the right to withhold, remove and or discard any content available as part of your account, with or without notice if deemed by Lykeion to be contrary to this Agreement. For avoidance of doubt, Lykeion has no obligation to store, maintain or provide you a copy of any content that you or other Users provide when using the Services.</p>
			<h3>Lykeion USER DOs and DON'Ts</h3>
			<p>
			As a condition to access Lykeion, you agree to this Terms of use and to strictly observe the following DOs and DON'Ts:</p>
			<p>Do undertake the following:</p>
			<ul type="disc">

			<li>Comply with all applicable laws, including, without limitation, privacy laws, intellectual property laws, export control laws, tax laws, and regulatory requirements;</li>
			<li>Provide accurate information to us and update it as necessary;</li>
			<li>Review and comply with our Terms of Use;</li>
			<li>Review and comply with notices sent by Lykeion concerning the Services;</li>
			<li>Use the Services in a professional manner.</li>

			<li>Act dishonestly or unprofessionally by engaging in unprofessional behavior by posting inappropriate, inaccurate, or objectionable content to Lykeion;</li>
			<li>Publish inaccurate information in the designated fields on the profile form. Please also protect sensitive personal information;</li>
			<li>Create a user profile for anyone other than a natural person;</li>
			<li>Harass, abuse or harm another person, including sending unwelcomed communications to others using Lykeion;</li>
			<li>Invite people you do not know to join your network;</li>
			<li>Upload a profile image that is not your likeness or a head-shot photo;</li>
			<li>Use or attempt to use anothers account without authorization from the Company, or create a false identity on Lykeion;</li>
			<li>Participate, directly or indirectly, in the setting up or development of a network that seeks to implement practices that are similar to sales by network or the recruitment of independent home salespeople to the purposes of creating a pyramid scheme or other similar practices.</li>
			<li>Duplicate, license, sublicense, publish, broadcast, transmit, distribute, perform, display, sell, rebrand, or otherwise transfer information found on Lykeion;</li>
			<li>Reverse engineer, decompile, disassemble, decipher or otherwise attempt to derive the source code for any underlying intellectual property used to provide the Services, or any part thereof ;</li>
			<li>Utilize or copy information, content or any data you view on and/or obtain from Lykeion to provide any service that is competitive, in Lykeionâ€™s sole discretion, with Lykeion;</li>
			<li>Adapt, modify or create derivative works based on Lykeion or technology underlying the Services, or other Usersâ€™ content, in whole or part, except as permitted under Lykeionâ€™s developer program;</li>
			<li>Rent, lease, loan, trade, sell/re-sell access to Lykeion or any information therein, or the equivalent, in whole or part;</li>
			<li>Deep-link to the Site for any purpose, (i.e. including a link to a Lykeion web page other than Lykeionâ€™s home page) unless expressly authorized in writing by Lykeion or for the purpose of promoting your profile on Lykeion as set forth in Branding and Autorship;</li>
			<li>Remove any copyright, trademark or other proprietary rights notices contained in or on Lykeion, including those of both Lykeion;</li>
			<li>Remove, cover or otherwise obscure any form of advertisement included on Lykeion;</li>
			<li>Collect, use, copy, or transfer any information, including, but not limited to, personally identifiable information obtained from Lykeion except as expressly permitted in this Terms of Use or as the owner of such information may expressly permit;</li>
			<li>Share information of non-Users without their express consent;</li>
			<li>Infringe or use Lykeion's brand, logos and/or trademarks, including, without limitation, using the word Lykeion in any business name, email, or URL or including Lykeion's trademarks and logos except as provided in the â€œBranding and Autorship;</li>
			<li>Use manual or automated software, devices, scripts robots, other means or processes to access, scrape or "spider" any web pages or other services contained in the site;</li>
			<li>Use bots or other automated methods to access Lykeion, add or download contacts, send or redirect messages, or perform other activities through Lykeion, unless explicitly permitted by Lykeion;</li>
			<li>Access, via automated or manual means or processes, Lykeion for purposes of monitoring Lykeion's availability, performance or functionality for any competitive purpose;</li>
			<li>Attempt to or actually access Lykeion by any means other than through the interfaces provided by Lykeion such as its mobile application or by navigating to lykeion.eestec.net using a web browser. This prohibition includes accessing or attempting to access Lykeion using any third-party service, including software-as-a-service platforms that aggregate access to multiple services, including Lykeion;</li>
			<li>Attempt to or actually override any security component included in or underlying Lykeion;</li>
			<li>Interfere with or disrupt or game Lykeion or the Services, including, but not limited to, any servers or networks connected to Lykeion, in particular Lykeions search algorithms.</li>
			</ul>
			<p></p>
			</div>
		</div>
	</div>
<?php

                  }
		   else if(@$_GET['to']=='registered'){
			  
				echo '<div align="left" style="margin-left:50px;">
				<p><strong>Thank you for registering!</strong></p>';
				
				  
				  echo '<p>Please check you email. </p>
				  </div>';
			  
		  }
                  else if(@$_GET['do']=='contact'){

                      if(@$_SESSION['loged']==false) {
						?>
					<div id="login-closed">
					<a href="#" class="login-btn"><img src="images/login-btn.png"/></a>
					</div>
					<div id="login-box">
					<div id="login-opened"><a href="#" class="login-btn"><img src="images/login-btn-opened.png"/></a></div>
					<div id="login-box-content">
					<form id="login-form" action="index.php" method="post">
					<label>Username:</label>
					<input type="text" name="username" />
					<label>Password:</label>
					<a href="index.php?do=forgotpassword">Forgot your password?</a>
					<input type="password" name="password" />
					<div id="login-form-bottom">
					<div class="keepmeloggedin"><input type="checkbox"  name="keeploggedin" value="KeepLoggedIn"/>  Keep me logged in</div>
					<input class="btn" type="submit" value="" name="user_login" >
					</div>
					</form>
					</div>
					</div>

					<?php 
					}
								$f=new frontend();
                                $f->menu("contact");
                ?>
 

 
	<div id="content">
		<div id="simple-page-container">
			<div id="head-section">
				<img src="images/contact-us-icon.jpg" alt="Contact us" />
				<h2>CONTACT US</h2>
				<p>get involved</p>
			</div>

			<div class="clear"></div>
			
			<div id="main-section">
				<h4>EESTEC International</h4>
				<h5>Power your future!</h5>
				<p>Electrical Engineering STudents' European assoCiation</p>
				<p>Mekelweg 4,<br/>2628 CD Delft,<br/>The Netherlands</p>
				<p><a href="http://www.eestec.net">www.eestec.net</a><br/><a href="mailto:lykeion@eestec.net">lykeion@eestec.net</a></p>
				
				<p>Find us on social networks:<br/>
					<a class="icon" href="http://www.facebook.com/lykeion.eestec"><img src="images/facebook-logo.png"/></a>
					<a class="icon"  href="https://twitter.com/EESTEC"><img src="images/twitter-logo.png"/></a>
					<a class="icon" href="https://plus.google.com/u/0/107902810588904084368/posts"><img src="images/google-plus-logo.png"/></a>
				</p>
				
			</div>
		</div>
	</div>

			
		
	
	
	

    <?php
                     
                  }
                  else if(@$_GET['do']=='more'){
                      $f=new frontend();
                                $f->menu("home");
                ?>

	<div id="login-closed">
		<a href="#" class="login-btn"><img src="images/login-btn.png"/></a>
	</div>
	<div id="login-box">
		<div id="login-opened"><a href="#" class="login-btn"><img src="images/login-btn-opened.png"/></a></div>
		<div id="login-box-content">
			<form id="login-form" action="index.php" method="post">
				<label>Username:</label>
				<input type="text" name="username" />
				<label>Password:</label>
				<a href="index.php?do=forgotpassword">Forgot your password?</a>
				<input type="password" name="password" />
				<div id="login-form-bottom">
				<div class="keepmeloggedin"><input type="checkbox"  name="keeploggedin" value="KeepLoggedIn"/>  Keep me logged in</div>
					<input class="btn" type="submit" value="" name="user_login" >
				</div>
			</form>
		</div>
	</div>
	
	<div id="content">
		<div id="simple-page-container">
			<div id="head-section">
				<img src="images/terms-of-use-icon.jpg" alt="Contact us" />
				<h2>ABOUT LYKEION</h2>
				<p></p>
			</div>

			<div class="clear"></div>
			
			<div id="main-section">
			
			
				 
				
				
                            <br><br>
				  <p align="justify">Recognizing the lack of platforms where students, universities and companies from EECS branches can come together to find an adequate target group that matches their interests and needs, NGO EESTEC (Electrical Engineering Students European Association) created such a platform: one where students, companies and universities can directly reach each other. This platform is EESTEC's portal, Lykeion! </p>

                                    <p align="justify">Lykeion is connecting highly qualified and motivated students, companies and universities across the world inside a unique platform, allowing them to present themselves and search the database for needed information.

                                    <p align="justify">For students, Lykeion presents a service for them to search for internships, careers, Bachelor/Master/PhD programs. This, in turn, represents a new communication channel between all students and universities and companies. The huge advantage of this project is its internationality, interactivity and various study programs which are available simply by registering on the portal. </p>
                                    <p align="justify">Once registered, students can submit, store and edit their CV and profile page, view offers from international companies and universities and apply for internships, jobs or Bachelor/Master/PhD studies.

This portal acts as a tool to attract hardworking and motivated students in accordance with corporate culture and values.</p>
                                    <center><img src="images/lykeion.jpg" width="300"></center>
                                    <p align="justify">The Lykeion approach to academic opportunities provides students with a sophisticated, and yet more agile way to apply for Bachelor/Master/PhD study in one place.

                                    <p align="justify">All registered Universities have the opportunity to publish their Bachelor/Master/PhD programs and all other academic offers to Lykeion users.

                                    <p align="justify">This way, information announced by any registered University will be published on the portal, so all Lykeion members will be provided with an easy approach to academic offers. It will motivate students to apply for International educational programmes and make educational systems more powerful.</p>

                                     <p align="justify">By entering in cooperation with EESTEC on Lykeion project, universities and companies are able to:</p>
                                     <ul type="disc">
                                    <li>Announce Bachelor, Master and PhD study programs;</li>
                                    <li>Announce internships and jobs offers;</li>
                                    <li>Announce research possibilities on all universities and companies;</li>
                                    <li>Access to Lykeion CV database of students of technical sciences;</li>
                                    <li>Establish direct communication channel with most perspective students of technical sciences;</li>

                                    </ul></p>

                                    <p align="justify">Students who register on Lykeion are not just ordinary future employees. Most of these students are active in international students organizations such as EESTEC or IEEE student branches, so they possess huge motivation for pursuing international career. They are experienced in teamwork, project management and acquire a wide knowledge of soft skills. 

                                    
                                    </p>
				  <p><strong>JOIN NOW</strong></p>
                                    
			</div>
		</div>
	</div>
	
	
	
	
</div>
			  <?php
			  
		  }
                   else if(@$_GET['to']=='registered'){

				echo '<div align="left" style="margin-left:50px;">
				<p><strong>Thank you for registering!</strong></p>';


				  echo '<p>Please check your email. </p>
				  </div>';

		  }
                  else if(@$_GET['activate']){
                      $activation=$_GET['activate'];
                      $user=new Students_user();
					  $f=new frontend();
                              $f->menu("home");
                      $t=$user->activate($activation);
                      
                       echo $t;


                  }
		  else if(@$_SESSION['status']=="not activated"){
                      $account++;
                      echo '<div align="left" style="margin-left:50px;">
				<p><strong>Your account is not activated yet or your account expired.</strong></p>';


				  echo '<p>If you are having problems with activating your account, contact website Administrator: lykeion@eestec.net.</p>
                                      <p><a href="index.php?go=logout">Back</a>
				  </div>';
                                  @$_SESSION[username]='';
		@$_SESSION[status]='';
		@$_SESSION[rank]='';
		@$_SESSION[id]='';
		@$_SESSION[name]='';
		@$_SESSION[expire]='';
		@$_SESSION[chat_id]='';
		session_destroy();
                  }
                  
                  else if(@$_GET['do']=="forgotpassword"){
                      $f=new frontend();
                              $f->menu("home");
                      $forgot=new forgot_password();
                      $forgot->show_form();

                  }
		  else if((@$_SESSION['loged']!='true' && @$_GET['to']=='') || @$_GET['go']=='logout') {
		   if(@$_GET['do']=='')
                   {
                       ?>
                <div id="login-closed">
			<a href="#" class="login-btn"><img src="images/login-btn.png"/></a>
		</div>
		<div id="login-box">
			<div id="login-opened"><a href="#" class="login-btn"><img src="images/login-btn-opened.png"/></a></div>
			<div id="login-box-content">
				<form id="login-form" action="index.php" method="post">
					<label>Username:</label>
					<input type="text" name="username" />
					<label>Password:</label>
					<a href="index.php?do=forgotpassword">Forgot your password?</a>
					<input type="password" name="password" />
					<div id="login-form-bottom">
					<div class="keepmeloggedin"><input type="checkbox"  name="keeploggedin" value="KeepLoggedIn"/>  Keep me logged in</div>
					
                                        <input class="btn" type="submit" value="" name="user_login" >
					</div>
				</form>
			</div>
		</div>
                </div>
    
                <?php
                $f=new frontend();
                $f->menu("home");
                ?>
    <div id="featured">
		<ul>
			<li class="ss1"><img src="images/featured-image-1.png" alt="Featured image 1" width="100%"/></li>
		</ul>
		<form id="signup" action="index.php?cat=st&do=register" method="post">
                    <a href="index.php?cat=st&do=register"><input class="btn" type="image" src="images/signup-btn.png"/></a>
		</form>
	</div>
	
	<div id="shadow-up"></div>
	
	<div id="content">
		<div id="info-container">
			<div class="col active">
				 <a href="index.php?to=student#content"><img src="images/icon-students.png" alt="Students" />
				<h2>STUDENTS</h2></a>
				<p>interships and jobs</p>
			</div>
			<div class="col">
				 <a href="index.php?to=company#content"><img src="images/icon-companies.png" alt="Companies" />
				<h2>COMPANIES</h2></a>
				<p>seek you future employees</p>
			</div>
			<div class="col noMargin">
				 <a href="index.php?to=university#content"><img src="images/icon-universities.png" alt="Universities" />
				<h2>UNIVERSITIES</h2></a>
				<p>research possibilities</p>
			</div>
			<div class="clear"></div>
			
			<div id="left-section">
				<h4>Join Lykeion!</h4>
				<h5>Why</h5>
				<ul>
					<li>enter your CV in unique database, which is viewed by companies and universities from whole world</li>
					<li>apply for internships and jobs in high-tech companies</li>
					<li>apply for Bachelor, Master and PhD studies on technical universities worldwide</li>
					<li>establish direct communication channel with most recognizable and perspective universities, companies and experts worldwide</li>
					<li>follow up the latest news and notifications of your future employer</li>
				</ul>
				
				<p>By registering on Lykeion you'll extend your chances to get noted by companies and got possibility to search among hundreds 
					of internships from technical science field and Bachelor, Master and PhD programs of technical universities from whole world.
				</p>
				<form id="joinnow" action="index.php?cat=st&do=register"  method="post">
                                    <a href="index.php?cat=st&do=register"><input class="btn" type="image" src="images/joinnow-btn.png"/></a>
				</form>
			</div>
		</div>
	</div>
	
	<div id="shadow-down"></div>
	
	<div id="testimonials">
		<p>Lykeion is joining highly qualified and motivated students, companies and universities in Europe inside a common platform, allowing them to advertise themselves, search the database for published information and as a result, establishing a new communication channel between all three. </p>
		<div class="author"><a href="index.php?do=more">Read more</a></div>
	</div>
	
</div>
    <?php
                   }
		  	if(@$_GET['cat']=='st' && @$_GET['do']=='register'){
		  		$f=new frontend();
                                $f->menu("student");
                                if(@$_GET['err']==1){
                                     echo '
                                    <script type="text/javascript">
                                            function errorhide(){
                                                    $("#error_message").hide();
                                            }
                                    </script>
                                    <div id="error_message"><br/><br/>Wrong letters from image.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
                                }
                                $reg= new Students_user();
                                if(@$_GET['step']==2)
                                    $reg->show_education_form();
                                else if(@$_GET['step']==3){
                                    $reg->show_register_last();
                                }
                                else
                                    $reg->show_register_form();
		  		
		  	}
		  	if(@$_GET['cat']=='un' && @$_GET['do']=='register'){
		  		$f=new frontend();
                                $f->menu("university");
                                if(@$_GET['err']==1){
                                     echo '
                                    <script type="text/javascript">
                                            function errorhide(){
                                                    $("#error_message").hide();
                                            }
                                    </script>
                                    <div id="error_message"><br/><br/>Wrong letters from image.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
                                }
		  		$reg= new universitys();
                                 if(@$_GET['step']==2)
                                     $reg->show_register_step2 ();
                                 else if(@$_GET['step']==3)
                                    $reg->show_register_final ();
                                 else
                                    $reg->show_register_form();
		  		echo '</div></div>';
		  	}
		 	 if(@$_GET['cat']=='cm' && @$_GET['do']=='register'){
		  		$f=new frontend();
                                $f->menu("company");
                                
                                if(@$_GET['err']==1){
                                     echo '
                                    <script type="text/javascript">
                                            function errorhide(){
                                                    $("#error_message").hide();
                                            }
                                    </script>
                                    <div id="error_message"><br/><br/>Wrong letters from image.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
                                }
		  		$reg= new companys();
                                if(@$_GET['step']==2)
                                    $reg->show_register_final ();
                                else if(@$_GET['step']==3)
                                    $reg->show_register_last ();
                                else
                                    $reg->show_register_form();
		  		echo '</div></div>';
		  	}
		  }
                   if($account==0){
		  	if(@$_SESSION['rank']=='student'){

				// Escape to echo menu, profile-box and nav on these pages
				if(@$_GET['do']!='contact' && @$_GET['do']!='more' && @$_GET['do']!='terms') {				
				  	$student= new frontend();
			  		$student->menu("home");
			  		$student->show_left_column_students();
					echo '<div id="shadow-up"></div><div id="content"><div id="load"></div><div id="place">';
				}                               

				
				
				if(@$_GET['do']=='report_bug'){
                                    
                                    $b=new bug();
                                    $b->show_form();
                                    
                                    
                                }
		  		else if(@$_GET['do']=='edit_cv_personal'){
		  			echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Edit your Curriculum Vitae</h2>
			<a class="import-europass" href=javascript:ImportCV();>Import your europass CV</a>
		<ul>
			<li class="active first"><a href="index.php?cat=st&do=edit_cv_personal">Personal information</a></li>
			<li><a href="index.php?cat=st&do=edit_cv_work">Work experience</a></li>
			<li><a href="index.php?cat=st&do=edit_cv_education">Education</a></span></li>
			<li class="last"><a href="index.php?cat=st&do=edit_cv_other">Other skills</a></li>
		</ul>';
                                              
		  			$cv= new Students_cv();
		  			$cv->load_from_database($_SESSION['cv_id']);
                                        
                                         
		  			$cv->show_edit_cv_form_personal_info();
		  			echo '</div></div>';
		  		}
                                else if(@$_GET['do']=='edit_cv_work'){
		  			echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Edit your Curriculum Vitae</h2>
			<a class="import-europass" href=javascript:ImportCV();>Import your europass CV</a>
		<ul>
			<li ><a href="index.php?cat=st&do=edit_cv_personal">Personal information</a></li>
			<li class="active first"><a href="index.php?cat=st&do=edit_cv_work">Work experience</a></li>
			<li><a href="index.php?cat=st&do=edit_cv_education">Education</a></span></li>
			<li class="last"><a href="index.php?cat=st&do=edit_cv_other">Other skills</a></li>
		</ul>';
		  			$cv= new Students_cv();
		  			$cv->load_from_database($_SESSION['cv_id']);
                                         

                                         
		  			$cv->show_edit_cv_form_work();
		  			echo '</div></div>';
		  		}
                                else if(@$_GET['do']=='edit_cv_education'){
		  			echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Edit your Curriculum Vitae</h2>
			<a class="import-europass" href=javascript:ImportCV();>Import your europass CV</a>
		<ul>
			<li ><a href="index.php?cat=st&do=edit_cv_personal">Personal information</a></li>
			<li ><a href="index.php?cat=st&do=edit_cv_work">Work experience</a></li>
			<li class="active first"><a href="index.php?cat=st&do=edit_cv_education">Education</a></span></li>
			<li class="last"><a href="index.php?cat=st&do=edit_cv_other">Other skills</a></li>
		</ul>';
		  			$cv= new Students_cv();
		  			$cv->load_from_database($_SESSION['cv_id']);
                                         
                                         
		  			$cv->show_edit_cv_form_education();
		  			echo '</div></div>';
		  		}
                                else if(@$_GET['do']=='edit_cv_other'){
		  			echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Edit your Curriculum Vitae</h2>
			<a class="import-europass" href=javascript:ImportCV();>Import your europass CV</a><div id="xmlcv"></div>
		<ul>
			<li ><a href="index.php?cat=st&do=edit_cv_personal">Personal information</a></li>
			<li ><a href="index.php?cat=st&do=edit_cv_work">Work experience</a></li>
			<li ><a href="index.php?cat=st&do=edit_cv_education">Education</a></span></li>
			<li class="active first" class="last"><a href="index.php?cat=st&do=edit_cv_other">Other skills</a></li>
		</ul>';
		  			$cv= new Students_cv();
		  			$cv->load_from_database($_SESSION['cv_id']);
                                         
                                         
		  			$cv->show_edit_cv_form_other();
		  			echo '</div></div>';
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
                                else if(@$_GET['do']=='edit_profile'){
                                     echo '<div id="article-wall">';
                                        $avatar= new avatar();
		  			$avatar->show_change_avatar_form();
                                        $pass= new password_change();
		  			$pass->show_password_change_form();
                                        $s= new Students_user();
                                        $s->subscribe_form();
                                        echo '</div>';
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
                                else if(isset($_POST['article_topic'])) {
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
                               
                                   echo '
						
	            </div></div>';		  		
		  	}
		  	
		  if(@$_SESSION['rank']=='university'){
			  $usao=0;
			  	$student= new frontend();
		  		$student->menu("home");
		  		$student->show_left_column_university();	
				echo '<div id="shadow-up"></div><div id="content"><div id="load"></div><div id="place">';	
                                
				
				$a= new frontend();
				$a->check_search();
				if(@$_GET['do']=='report_bug'){
                                   $b=new bug();
                                    $b->show_form();

                                }
                                
		  		else if(@$_GET['do']=='edit_profile'){
		  			;
		  			
                                        
		  			 echo '<div id="article-wall">';
                                       echo '<center><h3>Change the logo</h3></center>';
                                        $avatar= new avatar();
		  			$avatar->show_change_avatar_form();
		  			echo '<center><h3>University information</h3></center>';
		  			$cv= new Universitys();
		  			$cv->load_university($_SESSION['id']);
		  			$cv->editData();
                                        echo '<center><h3>Change your password</h3></center>';
                                      
		  			$pass= new password_change();
		  			$pass->show_password_change_form();

		  			echo '</div>';
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
                                     echo '<div id="article-wall">';
		  			$search= new frontend();
		  			$search->cv_search();
                                        echo '</div>';
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
		  			 echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Add/Edit Articles</h2>
			<center>
		<ul>
			<li class="active first"><a href="index.php?cat=un&do=add_news">Add news</a></li>
			<li ><a href="index.php?cat=com&do=add_scolarship">Add study program</a></li>
			
                        <li class="last"><a href="index.php?cat=un&do=show_article_list">Edit articles</a></span></li>
		</ul></center>';
		  			$article= new articles();
		  			
		  			$article->show_article_form();
		  			echo '</div></div>';
		  		
		  		}
		  		else if(@$_GET['do']=='show_article_list'){
		  			 echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Add/Edit Articles</h2>
			<center>
		<ul>
			<li ><a href="index.php?cat=un&do=add_news">Add news</a></li>
			
			<li ><a href="index.php?cat=com&do=add_scolarship">Add study program</a></li>
                        <li class="active first" class="last"><a href="index.php?cat=un&do=show_article_list">Edit articles</a></li>
		</ul></center>';
		  			$article= new articles();
		  			
		  			$article->show_management_list('user');
		  			echo '</div></div>';
		  		}
		  		else if(@$_GET['do']=='add_scolarship'){
                                     echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Add/Edit Articles</h2>
			<center>
		<ul>
			<li ><a href="index.php?cat=un&do=add_news">Add news</a></li>
			
			<li class="active first"><a href="index.php?cat=com&do=add_scolarship">Add study program</a></li>
                        <li  class="last"><a href="index.php?cat=un&do=show_article_list">Edit articles</a></span></li>
		</ul></center>';
		  			$article= new articles();
		  			
		  			$article->show_article_form('scolarship');
		  			echo '</div></div>';
		  		}
		  		else if(@$_GET['do']=='edit_article'){
		  			  echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Add/Edit Articles</h2>
			
		<ul>
			<li ><a href="index.php?cat=un&do=add_news">Add news</a></li>
			<li ><a href="index.php?cat=com&do=add_job">Add job</a></li>
			<li><a href="index.php?cat=com&do=add_intership">Add internship</a></span></li>
                        <li class="active first" class="last"><a href="index.php?cat=un&do=show_article_list">Edit articles</a></span></li>
		</ul>';
		  			$article= new articles();
		  			
		  			$article->load_article($_GET['article_id']);
		  			$article->show_article_form_edit();
		  			echo '</div></div>';		
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
				
		  		echo '</div></div>';
				
	            
		  	}
			if(@$_SESSION['rank']=='company'){
				$student= new frontend();
		  		$student->menu("home");
		  		$student->show_left_column_company();
				echo '<div id="shadow-up"></div><div id="content"><div id="load"></div><div id="place">';	
				

				
				$a= new frontend();
				$a->check_search();

                                if(@$_GET['do']=='report_bug'){
                                    $b=new bug();
                                    $b->show_form();

                                }
                               

		  		else if(@$_GET['do']=='edit_profile'){
		  			 echo '<div id="article-wall">';
                                       echo '<center><h3>Change the logo</h3></center>';
                                        $avatar= new avatar();
		  			$avatar->show_change_avatar_form();
		  			echo '<center><h3>Company information</h3></center>';
		  			$cv= new Companys();
		  			$cv->load_company($_SESSION['id']);
		  			$cv->editData();
                                        echo '<center><h3>Change your password</h3></center>';
                                      
		  			$pass= new password_change();
		  			$pass->show_password_change_form();

		  			echo '</div>';
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
                                    echo '<div id="article-wall">';
		  			$search= new frontend();
		  			$search->cv_search();
                                        echo '</div>';
		  		}
		  		else if(@$_GET['do']=='add_news'){
                                    echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Add/Edit Articles</h2>
			
		<ul>
			<li class="active first"><a href="index.php?cat=un&do=add_news">Add news</a></li>
			<li ><a href="index.php?cat=com&do=add_job">Add job</a></li>
			<li><a href="index.php?cat=com&do=add_intership">Add internship</a></span></li>
                        <li class="last"><a href="index.php?cat=un&do=show_article_list">Edit articles</a></span></li>
		</ul>';
		  			$article= new articles();
		  			
		  			$article->show_article_form();
		  			echo '</div></div>';
		  		}
		  		else if(@$_GET['do']=='show_article_list'){
                                    echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Add/Edit Articles</h2>
			
		<ul>
			<li ><a href="index.php?cat=un&do=add_news">Add news</a></li>
			<li ><a href="index.php?cat=com&do=add_job">Add job</a></li>
			<li><a href="index.php?cat=com&do=add_intership">Add internship</a></span></li>
                        <li class="active first" class="last"><a href="index.php?cat=un&do=show_article_list">Edit articles</a></span></li>
		</ul>';
		  			$article= new articles();
		  			
		  			$article->show_management_list('user');
		  			echo '</div></div>';
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
                                     echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Add/Edit Articles</h2>
			
		<ul>
			<li ><a href="index.php?cat=un&do=add_news">Add news</a></li>
			<li class="active first"><a href="index.php?cat=com&do=add_job">Add job</a></li>
			<li><a href="index.php?cat=com&do=add_intership">Add internship</a></span></li>
                        <li class="last"><a href="index.php?cat=un&do=show_article_list">Edit articles</a></span></li>
		</ul>';
		  			$article= new articles();
		  			
		  			$article->show_article_form('job');
		  			echo '</div></div>';
		  		}
				else if(@$_GET['do']=='add_intership'){
                                    echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Add/Edit Articles</h2>
			
		<ul>
			<li ><a href="index.php?cat=un&do=add_news">Add news</a></li>
			<li ><a href="index.php?cat=com&do=add_job">Add job</a></li>
			<li class="active first"><a href="index.php?cat=com&do=add_intership">Add internship</a></span></li>
                        <li class="last"><a href="index.php?cat=un&do=show_article_list">Edit articles</a></span></li>
		</ul>';
		  			$article= new articles();
		  			
		  			$article->show_article_form('intership');
		  			echo '</div</div>';
		  		}
		  		else if(@$_GET['do']=='edit_article'){
                                     echo '
                                            <div id="article-wall">
                                            <div id="edit-cv-container">
			<h2>Add/Edit Articles</h2>
			
		<ul>
			<li ><a href="index.php?cat=un&do=add_news">Add news</a></li>
			<li ><a href="index.php?cat=com&do=add_job">Add job</a></li>
			<li><a href="index.php?cat=com&do=add_intership">Add internship</a></span></li>
                        <li class="active first" class="last"><a href="index.php?cat=un&do=show_article_list">Edit articles</a></span></li>
		</ul>';
		  			$article= new articles();
		  			
		  			$article->load_article($_GET['article_id']);
		  			$article->show_article_form_edit();
		  			echo '</div></div>';	
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
		  		echo '</div></div>';
				
		         
	                 
					
	               
		  	}
		  	
		  };
          ?>                                                
        <div id="shadow-down"></div>
         
         <div id="footer">

	<div id="footerContainer">
		<div id="footer-top">
		<a href="index.php"><img src="images/logo-footer.png" alt="Lykeion"/></a>
                
		<p><b>EESTEC Lykeion Portal</b><br>Electrical Engineering STudents' European assoCiation project</p>
		<p>Mekelweg 4,<br/>2628 CD Delft,<br/><a href="http://eestec.net/">www.eestec.net</a><br/>The Netherlands</p>
		</div>
		
		<div id="footer-bottom">
		
		<div class="terms"><a href="index.php?do=terms">Terms of use</a> | <a href="#">Branding & Authorship</a> | <a href="index.php?do=contact">Contact</a></div>
		</div>
		<div id="footer-menu">
			<div class="menu">
				<a href="index.php">Home</a>  |  <a href="http://eestec.net/">What is EESTEC</a>  |  <a href="index.php?to=student">Students</a>  |  <a href="index.php?to=company">Companies</a>  |  <a href="index.php?to=university">Universities</a>  |  <a href="index.php?do=contact">Contacts</a>
			</div>
			<div class="copyright">Copyright &copy; <?php echo date("Y") ?> EESTEC All rights reserved.</div>
		</div>
	</div>
</div>

</body>
</html>
         

 
