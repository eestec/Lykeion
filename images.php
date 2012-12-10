<?php

class images {
	private $image;
	private $description;
	private $image_name;
	private $thum_name;
	
	// default setting
	private $max_image_size;
	private $thumb_size;
	private $image_size;
	private $image_destination_folder;
	private $thum_destination_folder;
	private $image_orientation;
	private $image_extensions;
	
	
	public function __construct($thum_size=array(150,100),$img_size=array(450,300), $img_dest= "..\img\uploads\\" ,$thum_dest="../img/uploads/thumbs/",$orientation="yes"){
		$this->max_image_size=3145728; // 3Mb
		$this->thumb_size=$thum_size;
		$this->image_size=$img_size;
		$this->image_destination_folder=$img_dest;
		$this->thum_destination_folder=$thum_dest;
		$this->image_extensions=array('jpg','gif','.jpg', '.jpeg','.gif','.bmp','.png', '.ico','.JPG','.PNG','.JPEG','.GIF','.ICO','.BMP');
		$this->image_orientation=$orientation;
	}
	
	
	public function load_from_post($p){
                
		$tmp=$_FILES['image']['name']; 
		$this->image_destination_folder="img/";
		if($tmp!=""){
                $extension = $this->getExtension($tmp);
					if($extension=="jpg" || $extension=="jpeg" )
					{
						$src = imagecreatefromjpeg($_FILES['image']['tmp_name']);
					}
					else if($extension=="png")
					{
                                                
						$src = imagecreatefrompng($_FILES['image']['tmp_name']);
                                                
                                               
					}
					else
					{
						$src = imagecreatefromgif($_FILES['image']['tmp_name']);
					}
					list($width,$height)=getimagesize($_FILES['image']['tmp_name']);
					@$newwidth;
					@$newheight;
					if($width>$height)
					{
						$newwidth=350;
						$newheight=($height/$width)*$newwidth;
					}
					else
					{
						$newwidth=155;
						$newheight=($height/$width)*$newwidth;
					}

					$tmp1=imagecreatetruecolor($newwidth,$newheight);
                                         if($extension=="png"){
                                             imagealphablending($tmp1,false);
                                                imagesavealpha($tmp1, true);
                                         }
					imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
                                        $mjesto="img/";
					$filename = $mjesto.$tmp;
                                        if($extension=="png") imagepng ($tmp1, $filename, 9);
                                        else imagejpeg($tmp1,$filename,100);
                                        $this->image_destination_folder=$filename;
					imagedestroy($src);
					imagedestroy($tmp1);
		}
	}
	
	public function load_from_var($p){
		$this->image=$p;
	}
	public function getimage(){
            return $this->image_destination_folder;
        }
	public function show_uplod_form(){
		echo('<div class="image_upload_container" id="image_upload_form">      
      <div align="center">
        <p><br />
        Select file that you wont to upload
          <input type="file" name="image" id="image" />
          <br />
        (Maximum file size is 3MB and jpg, jpeg, gif and bmp files are supported)</p>
        <p>          <br />
          <input type="submit" name="button" id="button" value="Upload" />
        </p>
      </div>');
	}
	 public function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
	public function upload_image($picture_name=">>?<<"){

		if($this->image){
			@$errors;
			$filename = stripslashes($this->image);
	  		$extension = substr($filename, strpos($filename,'.'), strlen($filename)-1); 
 			$extension = strtolower($extension); 
			 if (!in_array($extension,$this->image_extensions)){
				//print error message
 				echo 'Selected file is not valid! Supported formats are: JPG, JPEG, GIF, BMP, PNG';
 				$errors=15;
 				$errors=$extension;
 			}
			$size=filesize($this->image);
			if ($size > $this->image_size)
			{
				echo 'Selected files is larger than 3Mb!';
				$errors=2;
			}
			if(!$errors){
				//$_FILES['image']['tmp_name'];
				if ($extension=='.jpg' or $extension=='.jpeg') $img_manip=imagecreatefromjpeg($this->image);
				if ($extension=='.gif') $img_manip=imagecreatefromgif($this->image);
				if ($extension=='.png') $img_manip=imagecreatefrompng($this->image);
				if ($extension=='.bmp') $img_manip=imagecreatefromwbmp($this->image);
				$img_size=getimagesize($this->image);
				
				// determine parametars to resize picutre
													
					$scale_factor_w=$img_size[0]/$this->image_size[0];
					if($this->image_size[1]==0)
						$this->image_size[1]=$img_size[1]/$scale_factor_w;
					$scale_factor_h=$img_size[1]/$this->image_size[1];
					if($scale_factor_h>$scale_factor_w) $scale_factor=$scale_factor_w;
												   else $scale_factor=$scale_factor_h;
					$neww=$img_size[0]/$scale_factor;
					$newh=$img_size[1]/$scale_factor;
					//if one dimension is zero than calculate size on proportions with other dimension
					
					// if orientation is yes check dimensions and change sacaling per sides
					/*if($this->image_orientation=="yes"){
						if($img_size[0]<$img_size[1]){
							$tmp=$img_size[0];$img_size[0]=$img_size[1];$img_size[1]=$tmp;
							$tmp=$this->image_size[0];$this->image_size[0]=$this->image_size[1];$this->image_size[1]=$tmp;
							$tmp=$neww;$neww=$newh;$newh=$tmp;
						}
					}*/
					
				//
				$tempImg = imagecreatetruecolor($neww, $newh) or die("Cant create temp image");
				//resize picture
				imagecopyresampled($tempImg,$img_manip,0,0,0,0,$neww ,$newh,$img_size[0],$img_size[1]) or die('Cant crop and resize copy');
				//crop extra parts
				$tempImg1= imagecreatetruecolor($this->image_size[0],$this->image_size[1]) or die('Cantre ceate temp image');
				imagecopyresampled($tempImg1, $tempImg, 0, 0, ( ($neww-$this->image_size[0])/2 )  , ( ($newh-$this->image_size[1])/2 ), $this->image_size[0], $this->image_size[1], $this->image_size[0], $this->image_size[1]) or die("Cant resize copy");
				
				//generate name
				if($picture_name==">>?<<") $this->image_name= uniqid("img").'.jpg'; else $this->image_name=$picture_name;
				imagejpeg($tempImg1,$this->image_destination_folder.$this->image_name,90);
				//imagejpeg($tempImg,$this->thum_destination_folder.$this->image_name,100);
				return $this->image_name;
			}
			return $errors;
			/*return "error";*/
		}
	}
	
	public function create_thumbnail(){
		
	}
	
	public function resize_image(){
		
	}
	
	public function crop_image(){
		
	}
        /*public function upload(&$_FILES){
            
        }*/
       
}

/*
echo('<form action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="multipart/form-data" name="form" id="form">');
$add= new images();
//$add->show_article_form();
$add->show_uplod_form();
echo('</form>');

if(isset($_POST['upload'])) {
	//$add->load_from_post($_POST);
	$add->load_from_post($_FILES);
	$add->upload_image();
}
*/
?>
