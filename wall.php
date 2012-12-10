<?php
@session_start();
require_once('frontend.php');
require_once('cv.php');
if($_SESSION['loged']==true && @$_SESSION['ip']==$_SERVER['REMOTE_ADDR']){
    $fr=new frontend();
    $cv=new Students_cv();
    $sql="";
    if($_GET['to']=='all'){
        
        $fr->show_wall();
    }
    else if($_GET['to']=='study'){
        $sql="SELECT a.ID, a.image, a.title,a.intro,a.date_of_creation,a.scolarship,a.jobtype,a.user,a.user_type FROM `articles` as a, `publish_articles` as p WHERE a.status='Active' AND a.publish=p.ID and a.deleted=0 AND p.status='publish' AND a.scolarship<>-1 order by a.date_of_creation desc";
        $fr->show_wall($sql);
    }
    else if($_GET['to']=='jobs'){
        $sql="SELECT a.ID, a.image, a.title,a.intro,a.date_of_creation,a.scolarship,a.jobtype,a.user,a.user_type FROM `articles` as a, `publish_articles` as p WHERE a.status='Active' AND a.publish=p.ID and a.deleted=0 AND p.status='publish' AND a.jobtype<>-1 order by a.date_of_creation desc";
        $fr->show_wall($sql);
    }
    else if($_GET['to']=='research'){
        $sql="SELECT a.ID, a.image, a.title,a.intro,a.date_of_creation,a.scolarship,a.jobtype,a.user,a.user_type FROM `articles` as a, `publish_articles` as p, university_study as u WHERE a.status='Active' AND a.publish=p.ID and a.deleted=0 AND p.status='publish' AND a.scolarship<>-1 AND u.Research<>0 order by a.date_of_creation desc";
        $fr->show_wall($sql);
    }
    else if($_GET['to']=='companies'){
        $fr->show_wall_company();
    }
    else if($_GET['to']=='universities'){
        $fr->show_wall_university();
    }
    else if($_GET['to']=='students'){
        $fr->show_cv_wall();
    }
    else if($_GET['to']=='personal'){
       
        $cv->load_from_database($_SESSION['cv_id']);
        $cv->show_edit_cv_form_personal_info();
        
    }
    else if($_GET['to']=='work'){
       
        $cv->load_from_database($_SESSION['cv_id']);
        $cv->show_edit_cv_form_work();
        
    }
    else if($_GET['to']=='education'){
      
        $cv->load_from_database($_SESSION['cv_id']);
        $cv->show_edit_cv_form_education();

    }
    else if($_GET['to']=='other'){
       
        $cv->load_from_database($_SESSION['cv_id']);
        $cv->show_edit_cv_form_other();

    }
}


?>
