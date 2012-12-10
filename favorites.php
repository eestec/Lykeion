<?php
session_start();
require_once('database.php');
if(@$_GET['user_id']){
    $user_id=$_GET['user_id'];
    $post_id=$_GET['post_id'];
    $table=$_GET['table'];
    if($_SESSION['id']==$user_id &&  @$_SESSION['ip']==$_SERVER['REMOTE_ADDR']){
        
        $db=new database();
        $db->open_connection();
        if($table=='delete'){
            $s="DELETE FROM favorites WHERE id='$post_id'";
            $db->query($s);
            echo '
                                            <script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>Deleted from favorites.<br/><br/><a href="index.php?do=favorites" onclick="errorhide()">Close</a><br/></div>';
        }
        else{
            $s="SELECT * FROM favorites WHERE user_id='$user_id' AND post_id='$post_id' AND type='$table'";
            $r=mysql_query($s);
            if(mysql_num_rows($r)>0){
                echo '
                                            <script type="text/javascript">
                                                    function errorhide(){
                                                            $("#error_message").hide();
                                                    }
                                            </script>
                                            <div id="error_message"><br/><br/>You have this add in your favorites.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
            }
            else{
                $t=addslashes($table);
                $p=addslashes($post_id);
                $s="SELECT * FROM ".$t." WHERE ID='$p'";
                list($result,$a)=$db->query($s);
                if(mysql_num_rows($result)>0){
                    $db->open_connection();
                    $sql="INSERT INTO favorites VALUES ('null','$user_id','$p','$t')";
                    if(mysql_query($sql)){
                        echo '
                                                <script type="text/javascript">
                                                        function errorhide(){
                                                                $("#error_message").hide();
                                                        }
                                                </script>
                                                <div id="error_message"><br/><br/>Added to favorites.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
                    }
                    else{
                        echo '
                                                <script type="text/javascript">
                                                        function errorhide(){
                                                                $("#error_message").hide();
                                                        }
                                                </script>
                                                <div id="error_message"><br/><br/>An error occurred.<br/><br/><a href="#" onclick="errorhide()">Close</a><br/></div>';
                    }
                }
            }
        }
    }
}
?>