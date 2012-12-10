<?php
require dirname(ABSPATH) . '/local-config.php';

@session_start();
class database {
	private $hostname;
	private $username;
	private $password;
	private $database;
	private $connect;
	private $select_db;
	
	public function __construct(){
		    $this->hostname = DB_HOSTNAME;
		  $this->username = DB_USERNAME;
		  $this->password = DB_PASSWORD;
		  $this->database = DB_DATABASE;
	}
	public function db()
	 {
		       $this->hostname = DB_HOSTNAME;
		  $this->username = DB_USERNAME;
		  $this->password = DB_PASSWORD;;
		  $this->database = DB_DATABASE;
	 }
	 
	public function open_connection()
	{
		  try
		  {
			   $this->connect = mysql_connect($this->hostname,$this->username,$this->password);
			   $this->select_db = mysql_select_db($this->database);
                           return $this->connect;
		  }
		  catch(exception $e)
		  {
			   return $e;
		  }
	}

	public function close_connection()
	{
	  try
	  {
		   mysql_close($this->connect);
	  }
	  catch(exception $e)
	  {
		   return $e;
	  }
	}

	public function query($sql)
	{
            
            $error=NULL;
	try{
             $query=addslashes($sql);
		  $this->open_connection();
		  $sql = mysql_query($sql); 
                  $error=addslashes(mysql_error ());
                   $lst_id=mysql_insert_id();
        }
     catch (Exception $e){ 
         $error=addslashes($e);
     }
                  
		 
	

	             
	if($error!=NULL){
             $q="INSERT INTO log VALUES(NULL,'".$_SESSION['id']."','".$_SESSION['rank']."','$query','$error',NOW())";
             mysql_query($q);
             return array($error,-1);
        }
         
	 $this->close_connection();
	 return array($sql,$lst_id);
	}
	
}

?>
