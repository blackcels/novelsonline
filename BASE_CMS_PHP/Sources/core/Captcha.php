<?php
include("font.inc.php");
header("Content-Type: image/png");
session_start();
//création de l'image
$image = imagecreate(100, 50);

$background = imagecolorallocate($image, rand(0,100), rand(0,100), rand(0,100));

$char = "abcdefghijklmnopqrstuvwxyz0123456789";
$char = str_shuffle($char);
$length = rand(-8,-6);
$captcha = substr($char, $length) ;
$_SESSION["captcha"] = $captcha;

$size=rand(10,15);
$angle=rand(-30,30);

//list des fonts
$fonts = glob(PATH_FONT_PRIVATE."*.ttf");


$x = rand(10,15);

for($i=0;$i<strlen($captcha);$i++) {

    $colorFont= imagecolorallocate($image, rand(150,200), rand(150,200), rand(150,200));
    $fontKey = rand(0,count($fonts)-1);
    $y = rand(20, 50-20);
    imagettftext($image,$size,$angle,$x,$y,$colorFont,$fonts[$fontKey],$captcha[$i]);
    $x += $size + rand(1,5);
}

for($j=0; $j < rand(3,6); $j++){

    $color = imagecolorallocate($image, rand(150,200), rand(150,200), rand(150,200));
    $x1 = rand(0,100);
    $x2 = rand(0,100);
    $y1 = rand(0,50);
    $y2 = rand(0,50);


    switch (rand(0,2)){
        case 0:
            imageline($image,$x1,$y1,$x2,$y2,$color);
            break;
        case 1:
            imageellipse($image,$x1,$y1,$x2,$y2,$color);
            break;
        case 2:
            imagerectangle($image,$x1,$y1,$x2,$y2,$color);
            break;
    }
}


//affichage de l'image
imagepng($image);