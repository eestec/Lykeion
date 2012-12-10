<?php
session_start();
require_once('database.php');
require_once('mail.php');
if($_SESSION['loged']=="true" && $_SESSION['admin']=="true"){
	if(@$_GET['id']){
		$id=$_GET['id'];
		$table=$_GET['table'];
                $option=@$_GET['option'];
		$db=new database();
		$db->open_connection();
                if($option=="deactivate"){
                    $sql="UPDATE ".$table." SET Status='Deactivated' WHERE ID='$id'";
                    mysql_query($sql);
                
                        echo '
				<script type="text/javascript">
					function errorhide(){
						$("#error_message").hide();
					}
				</script>';
                        if($table=="universitys")
				echo '<div id="error_message"><br/>Account deactivated.<br/><br/><a href="?do=university" onclick="errorhide()">Close</a><br/></div>';
                        else
                            echo '<div id="error_message"><br/>Account deactivated.<br/><br/><a href="?do=company" onclick="errorhide()">Close</a><br/></div>';
                    
                }
                else if($table=='change'){
                     $sql="SELECT * FROM companys WHERE ID='$id'";
                            $result=mysql_query($sql);
                            while(@$row=mysql_fetch_array($result)){
                                    echo "Change company's option.<br><form name='au' id='au' method='post' action='admin.php'><p>".$row['Name'].", ".$row['Field_of_work']."<br>
                                    <p>Extends on period of (NOTE: Months selected will add active period starting from today's date)<select name='period' id='period'><option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>12</option></select> months.<br>Number of announcments: (NOTE: The number will be added to the existing number) <select name='number'><option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>10</option>
                                    <option>20</option>
                                    <option>30</option></select><br>
                                    Company can see students CV's (NOTE: if selected, company will see all registered students and their CV's) <input type='checkbox' name='visible' value='-99'>
                                    <input type='hidden' name='id' value='".$row['ID']."'>
                                        <input type='hidden' name='change' value='1'>
                                    <input type='submit' name='activate_c' value='Activate'>
                                    </form>";
                            }
                }
                else{
                    if($table=="university"){
                            $sql="SELECT * FROM universitys WHERE ID='$id'";
                            $result=mysql_query($sql);
                            while(@$row=mysql_fetch_array($result)){
                                    echo "<form name='au' id='au' method='post' action='admin.php'><p>".$row['Name_of_University'].", ".$row['Name_of_Faculty']."<br>
                                    <p>Activating on period of <select name='period' id='period'><option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>12</option></select> months.<br>Number of announcments: <select name='number'><option>1</option>
                                    <option>10</option>
                                    <option>20</option>
                                    <option>30</option></select><br>
                                    <input type='hidden' name='id' value='".$row['ID']."'>
                                    <input type='submit' name='activate_u' value='Activate'>
                                    </form>";
                            }
                    }

                    else if($table=="company"){

                            $sql="SELECT * FROM companys WHERE ID='$id'";
                            $result=mysql_query($sql);
                            while(@$row=mysql_fetch_array($result)){
                                    echo "<form name='au' id='au' method='post' action='admin.php'><p>".$row['Name'].", ".$row['Field_of_work']."<br>
                                    <p>Activating on period of <select name='period' id='period'><option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>12</option></select> months.<br>Number of announcments: <select name='number'><option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>10</option>
                                    <option>20</option>
                                    <option>30</option></select><br>
                                    Company can see students CV's (NOTE: if selected, company will see all registered students and their CV's) <input type='checkbox' name='visible' value='-99'>                                  
                                    <input type='hidden' name='id' value='".$row['ID']."'>
                                        <input type='hidden' name='change' value='0'>
                                    <input type='submit' name='activate_c' value='Activate'>
                                    </form>";
                            }
                    }
                }
	}
}
?>