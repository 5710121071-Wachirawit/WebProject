<?

$file=$_REQUEST["file"];
$max_x =$_REQUEST["max_x"];
$max_y=$_REQUEST["max_y"];

$file_upload_name = strtolower($file) ;
$get_length = strlen($file_upload_name);
$get_ext=substr($file_upload_name,$get_length-3,3);

/*$max_x =130;
$max_y = 130;*/
$size = GetImageSize($file);
//return Array  0=width , 1=high
$x = $size[0];
$y = $size[1];
$x_ratio = $max_x / $x;
$y_ratio = $max_y / $y;
	//IF width and high < MAX
	if ( ($x <= $max_x) && ($y <= $max_y) )  {
			$new_x = $x;
			$new_y = $y;
	} else if ( ($x_ratio * $y) < $max_y){
			$new_x = $max_x;
			$new_y = ceil($x_ratio * $y);
	}
	else {
			$new_x = ceil($y_ratio * $x);
			$new_y = $max_y;
	}
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