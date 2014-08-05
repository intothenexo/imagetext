<?php
// Full options example
require_once '../intothenexo.imageText.php';

$img = array(
	'container_width' => 150,
	'coord_y' => 20,
	'font' => './SourceSansPro-Bold.otf', // TrueType font
	'font_size' => 15, // Font size
	'text' => 'Hello Wolf!', // Text to generate over the image
	'path' => './bg.jpg', // Background image path
	'rgb' => array(255, 255, 255), // RGB color of text
);

$image = new \Intothenexo\imageText($img);
$image->create();
