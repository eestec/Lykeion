<?php
@session_start();
require_once 'database.php';
require_once 'cv.php';
if($_SESSION['loged']=="true" &&  @$_SESSION['ip']==$_SERVER['REMOTE_ADDR'] ){
    $id=@$_GET['id']; 
    if(@$_GET["format"]=="XML"){
        $s=new Students_cv();
        $s->load_from_database($_SESSION['cv_id']);
        $s->exportXML();
    }
    if(@$_GET["format"]=="PDF"){
        $s=new Students_cv();
        $s->load_from_database($_SESSION['cv_id']);
		$s->exportPDF();
    }

}

?>