<?php
require_once 'database.php';
require_once 'images.php';

class avatar {
	private $id;
	private $name;
	private $rank;
	private $image;
	
	public function __construct(){
		$this->id=$_SESSION['id'];
		$this->rank=$_SESSION['rank'];
	}
        public function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
	
	public function avatar_change(){
		// check if image exist and upload it 
		if(!empty($_FILES['avatar_image'])){
                    list($width,$height)=getimagesize($_FILES['avatar_image']['tmp_name']);
                    if($_FILES['avatar_image']['size']/1024<=300){
			@$newwidth;
			@$newheight;

			$newwidth=150;
			$newheight=($height/$width)*$newwidth;

			//$img= new images(array($newwidth,$newheight),array($newwidth,$newheight),'img/thumbs/','img/');
			$tmp = $_FILES['avatar_image']['name'];
			$targetPath = 'img/thumbs/';
			$targetFile =  str_replace('//','/',$targetPath) . $_FILES['avatar_image']['name'];
			/*move_uploaded_file($tempFile,$targetFile);
			$img->load_from_var($targetFile);
			$this->image=$img->upload_image();
			if($this->image!='error') unlink($targetFile);
			if($this->image=='error') $this->image="avatar.jpg";
			$this->image="img/thumbs/".$this->image;*/
                        $extension = $this->getExtension($tmp);
					if($extension=="jpg" || $extension=="jpeg" )
					{
						$src = imagecreatefromjpeg($_FILES['avatar_image']['tmp_name']);
					}
					else if($extension=="png")
					{

						$src = imagecreatefrompng($_FILES['avatar_image']['tmp_name']);


					}
					else
					{
						$src = imagecreatefromgif($_FILES['avatar_image']['tmp_name']);
					}
					list($width,$height)=getimagesize($_FILES['avatar_image']['tmp_name']);



					$tmp1=imagecreatetruecolor($newwidth,$newheight);
                                         if($extension=="png"){
                                             imagealphablending($tmp1,false);
                                                imagesavealpha($tmp1, true);
                                         }
					imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                                       
					$filename = $targetFile;
                                        $this->image=$filename;
                                        if($extension=="png") imagepng ($tmp1, $filename, 9);
                                        else imagejpeg($tmp1,$filename,100);
                                        //$this->image_destination_folder=$filename;
					imagedestroy($src);
					imagedestroy($tmp1);
                    }
                    else{
                        echo '
					<script type="text/javascript">
						function errorhide(){
							$("#error_message").hide();
						}
					</script>
					<div id="error_message"><br/><br/>The image is too large. Maximum file size is 300KB.<br/><br/><a href="" onclick="errorhide()">Close</a><br/></div>';
                $this->image="avatar.jpg";
			$this->image="img/thumbs/".$this->image; 
                        
                }

                } else {
			$this->image="avatar.jpg";
			$this->image="img/thumbs/".$this->image; 
		}	
		
		//update database avatar image locations
		$db= new database();
			// update student profile
			if($this->rank=='student')
				$sql="UPDATE `users` SET Photo='".$this->image."' WHERE ID='".$this->id."'";
			// update university profile
			if($this->rank=='university')
				$sql="UPDATE `universitys` SET Logo='".$this->image."' WHERE ID='".$this->id."'";
			// update company profile
			if($this->rank=='company')
				$sql="UPDATE `companys` SET Logo='".$this->image."' WHERE ID='".$this->id."'";
		list($a,$a)=$db->query($sql);
	}	
	
	public function show_change_avatar_form(){
		echo('<br><div class="article"><form action="index.php" method="post" enctype="multipart/form-data" class="studentform" name="avatarform" id="avatarform">
		
        <label>
        Select image that will be used for your avatar:</label>
          <input type="file" name="avatar_image"  id="avatar_image" />
          <label>
        (Maximum file size is 300kb and jpg, jpeg, gif and bmp files are supported)
        </label>          
          <input type="submit" name="avatar_change_image" class="btn" value="" />
          
        
      
      </form></div>');
	}
	
}

if(isset($_POST['avatar_change_image'])) {
	$avatar= new avatar();
	$avatar->avatar_change();
}

?>