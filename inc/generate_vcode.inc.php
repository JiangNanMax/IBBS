<?php
/**
 * Created by PhpStorm.
 * User: jiangnan
 * Date: 2019/3/26
 * Time: 13:21
 */
function generate_vcode($width=120, $height=40, $fontSize=30, $countElement=4, $countPixel=100, $countLine=6) {
    header('Content-type:image/jpeg');
    $elements = array('a','b','c','d','e','f','g','h','i','j','k','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    $string = '';
    for ($i = 0; $i < $countElement; $i++) {
        $string .= $elements[rand(0, count($elements) - 1)];
    }

    $img = imagecreatetruecolor($width, $height);
    $colorBackground = imagecolorallocate($img, rand(200, 255), rand(200, 255), rand(200, 255));
    $colorBorder = imagecolorallocate($img, rand(200, 255), rand(200, 255), rand(200, 255));
    $colorString = imagecolorallocate($img, rand(10, 100), rand(10, 100), rand(10, 100));
    imagefill($img, 0, 0, $colorBackground);

    for ($i = 0; $i < $countPixel; $i++) {
        imagesetpixel($img, rand(0, $width - 1), rand(0, $height - 1), imagecolorallocate($img, rand(100, 200), rand(100, 200), rand(100, 200)));
    }
    for ($i = 0; $i < $countLine; $i++) {
        imageline($img, rand(0, $width / 2), rand(0, $height), rand($width / 2, $height), rand(0, $height), imagecolorallocate($img, rand(100, 200), rand(100, 200), rand(100, 200)));
    }

    imagettftext($img, $fontSize, rand(-5, 5), rand(5, 15), rand(30, 35), $colorString, 'font/ManyGifts.ttf', $string);
    imagejpeg($img);
    imagedestroy($img);
    return $string;
}
?>