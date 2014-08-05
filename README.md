imagetext
=========

A simple Class to create images with TrueType fonts.

#### Includes demos.

- Dynamic images generation.
- TrueType fonts support.
- Change options on the fly, text, color, font, quality, format, angle...
- Display images in the browser.
- Save images to server.
- Centering options, horizontal and vertical.
- Centering relative to a container.

![Thumb](/demo/thumb.jpg?raw=true)

## How to use

```php
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

```
## Contact

[@intothenexo](https://twitter.com/intothenexo)
