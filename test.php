<?php
//phpinfo();
$im = new imagick( 'test/34.jpg' );
// resize by 200 width and keep the ratio
$im->thumbnailImage( 0, 600);
// write to disk
$im->writeImage( 'B'.'wel.jpg' );
$im->thumbnailImage( 232, 0);
$im->writeImage( 'wel.jpg' );
//$a="吴迪,Lucy,silentHILL,";
//$b="Devil,";
//$c=$a.$b;
//$d = explode(",",$c );
//print_r($d);
//echo count($d);



?>