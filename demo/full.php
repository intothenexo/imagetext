<?php
// Full options example
require_once '../intothenexo.imageText.php';

$img = array(
	'angle' => 0, // Angle of text
	'container_height' => 99, // Container used to center text
	'container_width' => 150,
	'coord_x' => 0, // Text coordinates
	'coord_y' => 0,
	'font' => './SourceSansPro-Bold.otf', // TrueType font
	'font_size' => 15, // Font size
	'format' => 'JPEG', // Generated image format
	'jpeg_quality' => 90, // JPEG quality, only if the format is JPEG
	'text' => 'Hello Wolf!', // Text to generate over the image
	'path' => './bg.jpg', // Background image path
	'rgb' => array(255, 255, 255), // RGB color of text
	// 'debug' => true // To see the error messages and RAW data (here we not send headers)
);

$image = new \Intothenexo\imageText($img);
// Here we overwrite some options for example purposes
$image->setAngle(0);
$image->setColor(0, 255, 252);
$image->setFont('SourceSansPro-Light.otf');
$image->setFontSize(25);
$image->setJpegQuality(100);
$image->setText('Hello Cat!');
$image->setFormat('GIF');
// $image->setFilename('./test.jpg'); // Saves the file in the server
$image->create();
