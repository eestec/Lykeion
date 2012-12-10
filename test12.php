<?php
require_once 'cv.php';
error_reporting(0);
$s=new Students_cv();
$s->load_from_database(30);
$s->exportXML();

/*$s=new Students_cv();
$s->load_from_database(30);
$s->exportPDF();*/

?>