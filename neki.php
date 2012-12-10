<?php
require_once 'user.php';
require_once 'companys.php';
require_once 'universitys.php';
$s=new Students_user();
$c=new companys();
$u=new universitys();
if(@$_POST['users_Username']){
    $t1=$s->user_exist($_POST['users_Username']);
    $t2=$s->valid_username($_POST['users_Username']);
    $t3=$c->user_exist($_POST['users_Username']);
    $t4=$u->user_exist($_POST['users_Username']);
    if($t1==true && $t2==true && $t3==true && $t4==true) echo "true";
    else echo "false";
}
if(@$_POST['users_Email']){
    $t=$s->mail_exist($_POST['users_Email']);
    if($t==true) echo "true";
    else echo "false";
}
if(@$_POST['cm_Login_email']){
    $t=$c->mail_exist($_POST['cm_Login_email']);
    if($t==true) echo "true";
    else echo "false";
}

if(@$_POST['un_Login_email']){
    $t=$u->mail_exist($_POST['un_Login_email']);
    if($t==true) echo "true";
    else echo "false";
}

if(@$_POST['cm_Username']){
    $t1=$s->user_exist($_POST['cm_Username']);
    $t2=$s->valid_username($_POST['cm_Username']);
    $t3=$c->user_exist($_POST['cm_Username']);
    $t4=$u->user_exist($_POST['cm_Username']);
    if($t1==true && $t2==true && $t3==true && $t4==true) echo "true";
    else echo "false";
}

if(@$_POST['un_Username']){
    $t1=$s->user_exist($_POST['un_Username']);
    $t2=$s->valid_username($_POST['un_Username']);
    $t3=$c->user_exist($_POST['un_Username']);
    $t4=$u->user_exist($_POST['un_Username']);
    if($t1==true && $t2==true && $t3==true && $t4==true) echo "true";
    else echo "false";
}

?>
