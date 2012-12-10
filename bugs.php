<?php
@session_start();
require_once 'database.php';
require_once 'mail.php';
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class bug{
    private $id;
    private $title;
    private $description;
    private $type;
    private $when;
    private $input;
    private $user_type;
    private $user_id;

    public function _construct(){}
    public function load_from_post(){
        $this->title=htmlentities($_POST['bug_title'],ENT_QUOTES, "UTF-8");
        $this->description=htmlentities($_POST['bug_description'],ENT_QUOTES, "UTF-8");
        $this->type=htmlentities($_POST['bug_type'],ENT_QUOTES, "UTF-8");
        $this->when=htmlentities($_POST['bug_when'],ENT_QUOTES, "UTF-8");
        $this->input=htmlentities($_POST['bug_input'],ENT_QUOTES, "UTF-8");
        $this->user_id=$_SESSION['id'];
        $this->user_type=$_SESSION['rank'];

    }
    public function load_from_db($id){
        $db=new database();
        $sql="SELECT * FROM bugs where id='$id'";
        list($result,$a)=$db->query($sql);
        while($row=  mysql_fetch_array($result)){
            $this->id=$row['id'];
            $this->title=$row['title'];
            $this->description=$row['description'];
            $this->type=$row['type'];
            $this->when=$row['when'];
            $this->input=$row['input'];
            $this->user_id=$row['user_id'];
            $this->user_type=$row['user_type'];

        }
    }
    public function show_form(){
        echo '<div id="article-wall">
                                            <div id="edit-cv-container">
            <form action="index.php" method="post" enctype="multipart/form-data" name="bug_form" id="bug_form" class="studentform">
            <h3>Report a bug</h3>
	     
            
            <label title="For example:Article error, Activating error ... ">Bug title:</label><input name="bug_title" class="lykeion" type="text" id="bug_title" > 
            <label title="">Description of the bug:</label><textarea name="bug_description" class="lykeion"  id="bug_description" rows="5" cols="48" ></textarea> 
            <label title="For example: Articles bug, Interface bug, Profile info bug ...  ">Type of bug:</label> <input name="bug_type" class="lykeion" type="text" id="bug_type" >
            <label title="For example: 1. Clicked on Add news option, 2. Typed the fields 3. My article is not added to database ">When the bug appears?</label><textarea name="bug_when" class="lykeion"  id="bug_when" rows="5" cols="48" ></textarea> 
            <label title="If the bug appears while entering some data, type those data here">Input values:</label><textarea name="bug_input" class="lykeion"  id="bug_input" rows="5" cols="48" ></textarea> 
            
<input type="submit" name="bug_submit" class="btn" value="" /> 
            
            </form></div></div>';
    }
    public function save_to_db(){
        $db=new database();

        $sql="INSERT INTO bugs VALUES (NULL,'$this->title','$this->description','$this->type','$this->when','$this->input','$this->user_type','$this->user_id')";
        $db->query($sql);
         echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>Thank you for submitting the bug. It will be fixed as soon as possible.<br/><br/><a href="" onclick="errorhide()">Close</a><br/></div>';
         $subject="A bug has been reported";
                            $message="
                            <html>
                            <body bgcolor='#DCEEFC'>
                            <center>
                                <table border='1'>
                                <tr><td><strong>Bug title:</strong></td><td>".$this->title."</td></tr>
                                <tr><td><strong>Bug description:</strong></td><td>".$this->description."</td></tr>
                                <tr><td><strong>Bug type:</strong></td><td>".$this->type."</td></tr>
                                <tr><td><strong>When bug appears:</strong></td><td>".$this->when."</td></tr>
                                <tr><td><strong>Input values:</strong></td><td>".$this->input."</td></tr>
                                    </table>
                            </center>
                            <br><br>

                            <p><a href='http://lykeion.eestec.net'>lykeion.eestec.net</a></p>
                             </body></html>";
                            $m=new mail();
                            
                            $m->SendMail(1, 'admin', $subject, $message);

    }
}

if(isset($_POST['bug_submit'])) {
		$bug= new bug();
		$bug->load_from_post();
                $bug->save_to_db();
	}
?>
