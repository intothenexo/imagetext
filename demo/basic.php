<?php
// Basic example
require_once '../intothenexo.imageText.php';

$img = array(
	'coord_x' => 8, // Text coordinates
	'coord_y' => 80,
	'font' => './SourceSansPro-Bold.otf', // TrueType font
	'font_size' => 20, // Font size
	'text' => 'Hello Wolf!', // Text to generate over the image
	'path' => './bg.jpg', // Background image path
	'rgb' => array(255, 255, 255) // RGB color of text
);

$image = new \Intothenexo\imageText($img);
$image->create();
