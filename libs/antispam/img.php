<?
function UPCAbarcode($code) {
	/* Generate the Barcode Image */
	$img = ImageCreate(130,18);
	$fg = ImageColorAllocate($img, 70, 50, 150);
	$fg2 = ImageColorAllocate($img, 150, 180, 200);
	$fg3 = ImageColorAllocate($img, 190, 180, 170);
	$bg = ImageColorAllocate($img, 255, 242, 229);
	$bg2 = ImageColorAllocate($img, 240, 232, 219);	
	ImageFilledRectangle($img, 0, 0, 130, 18, $bg);
	ImageFilledRectangle($img, 5, 1, 175, 6, $bg2);
	ImageFilledRectangle($img, 5, 11, 175, 17, $bg2);
	//Horizontal line
	ImageFilledRectangle($img, 5, 1, 175, 1, $fg2);
	ImageFilledRectangle($img, 5, 6, 175, 6, $fg3);
	ImageFilledRectangle($img, 5, 11, 175, 11, $fg2);
	ImageFilledRectangle($img, 5, 17, 175, 17, $fg3);
	//Vertical line
	for($v = 0; $v<=130; $v+=15) {
		ImageFilledRectangle($img, $v+7, 0, $v+7, 18, $fg2);
		ImageFilledRectangle($img, $v+15, 0, $v+15, 18, $fg3);
	}
	
	
	/* Add the Human Readable Label */
	ImageString($img,5,12,1,$code[0],$fg);
	ImageString($img,5,32,1,$code[1],$fg);
	ImageString($img,5,52,1,$code[2],$fg);
	ImageString($img,5,72,1,$code[3],$fg);
	ImageString($img,5,92,1,$code[4],$fg);
	ImageString($img,5,112,1,$code[5],$fg);
	/* Output the Header and Content. */
	header("Content-Type: image/png");
	ImagePNG($img);	
	ImageDestroy($img);	
}
//require ("rand_image.php"); 
//UPCAbarcode(SCode($_GET['sd']));
UPCAbarcode($_GET['sd']);
?> 