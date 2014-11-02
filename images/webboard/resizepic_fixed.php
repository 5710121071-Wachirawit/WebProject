<?

$file=$_REQUEST["file"];
$new_x =$_REQUEST["max_x"];
$new_y=$_REQUEST["max_y"];

$file_upload_name = strtolower($file) ;
$get_length = strlen($file_upload_name);
$get_ext=substr($file_upload_name,$get_length-3,3);

$size = GetImageSize($file);

$x = $size[0];
$y = $size[1];

	
	if ($get_ext=="jpg"){
	$src = imageCreateFromJpeg($file);
	}elseif($get_ext=="gif"){
	$src = imagecreatefromgif($file);
	}elseif($get_ext=="png"){
	$src = imagecreatefrompng($file);
	}

	$dst = ImageCreateTrueColor($new_x,$new_y);

	ImageCopyResampled($dst,$src,0,0,0,0,$new_x,$new_y,$x,$y);

	
	
	if ($get_ext=="jpg"){
		header("Content - type: image/jpeg");
		ImageJpeg($dst);
	}elseif($get_ext=="gif"){
		header ("Content-type: image/gif");
		imagegif($dst);
	}elseif($get_ext=="png"){
		header ("Content-type: image/png");
    		imagepng($dst);
	}

	imageDestroy($src);
	imageDestroy($dst);
?>