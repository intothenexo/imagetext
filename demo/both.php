<?php
// Full options example
require_once '../intothenexo.imageText.php';

$img = array(
	'container_height' => 99, // Container used to center text
	'container_width' => 150,
	'font' => './SourceSansPro-Bold.otf', // TrueType font
	'font_size' => 15, // Font size
	'text' => 'Hello Wolf!', // Text to generate over the image
	'path' => './bg.jpg', // Background image path
	'rgb' => array(255, 255, 255), // RGB color of text
);

$image = new \Intothenexo\imageText($img);
$image->create();
