<?php
// Full options example
require_once '../intothenexo.imageText.php';

$img = array(
	'angle' => 45, // Angle of text
	'coord_x' => 45, // Text coordinates
	'coord_y' => 90,
	'font' => './SourceSansPro-Bold.otf', // TrueType font
	'font_size' => 15, // Font size
	'text' => 'Hello Wolf!', // Text to generate over the image
	'path' => './bg.jpg', // Background image path
	'rgb' => array(255, 255, 255), // RGB color of text
);

$image = new \Intothenexo\imageText($img);
$image->create();
