<?php
/**
 * imageText
 *
 * A simple Class to create images with TrueType fonts.
 *
 * @author      Daniel Castro <intothenexo@outlook.com>
 * @copyright   2014 Daniel Castro
 * @link        https://github.com/intothenexo/imagetext
 * @version     1.0.0
 * @license     MIT
 *
 */
namespace Intothenexo;

class imageText
{
	/** Angle of text */
	private $angle = 0;

	/** Image color allocate */
	private $color = false;

	/** Container used to center text */
	private $container_height = 0;
	private $container_width = 0;

	/** Debug messages */
	private $debug = false;

	/** Quality of JPEG files generated */
	private $jpeg_quality = 85;

	/** The generated image */
	private $image;

	/** Filename */
	private $filename = null;

	/** Font family */
	private $font;

	/** Font size */
	private $font_size;

	/** Image format, PNG as default because the great quality */
	private $format = 'PNG';

	/** Background image path */
	private $path;

	/** Text coordinates */
	private $coord_x = 0;
	private $coord_y = 0;

	/** Exception messages */
	private $msg = array(
		'You have to pass an array with the image data.',
		'Background image "path" must be a GIF, JPG, JPEG, PNG or WMBP file.'
	);

	/** RGB color of text */
	private $rgb = array(0, 0, 0);

	/** Text to generate over the image */
	private $text;

	/** Supported files formats */
	private $supported_formats = array('GIF', 'JPG', 'JPEG', 'PNG', 'WMBP');

	/**
	 * Sets the initial configuration
	 *
	 * @param array Image information
	 *
	 */
    public function __construct($data)
    {
    	if (is_array($data)) {
			if (isset($data['angle'])) $this->angle = $data['angle'];
			if (isset($data['container_height'])) $this->container_height = $data['container_height'];
			if (isset($data['container_width'])) $this->container_width = $data['container_width'];
			if (isset($data['coord_x'])) $this->coord_x = $data['coord_x'];
			if (isset($data['coord_y'])) $this->coord_y = $data['coord_y'];
			if (isset($data['debug'])) $this->debug = $data['debug'];
			$this->font = $data['font'];
			$this->font_size = $data['font_size'];
			if (isset($data['format'])) $this->format = $data['format'];
			if (isset($data['jpeg_quality'])) $this->jpeg_quality = $data['jpeg_quality'];
			$this->text = $data['text'];
			$this->path = $data['path'];
			if (isset($data['rgb'])) $this->rgb = $data['rgb'];
    	} else {
			throw new \Exception($this->msg[0]);
    	}

    	if (! $this->isValidFormat($this->path))
			throw new \Exception($this->msg[1]);

		$this->image = imagecreatefromjpeg($this->path);
    }

	/**
	 * Creates the image
	 *
	 * @return Image
	 *
	 */
	public function create()
	{
		if (! $this->debug) header("Content-type: image/" . $this->format);
		if (! $this->color) $this->setColor($this->rgb[0], $this->rgb[1], $this->rgb[2]);

		$this->center();

		imagettftext($this->image, $this->font_size, $this->angle, $this->coord_x, $this->coord_y, $this->color, $this->font, $this->text);

		switch ($this->format) {
			case "GIF":
				imagegif($this->image, $this->filename);
				break;
			case "JPEG":
				imagejpeg($this->image, $this->filename, $this->jpeg_quality);
				break;
			case "PNG":
				imagepng($this->image, $this->filename);
				break;
			case "WBMP":
				imagewbmp($this->image, $this->filename);
				break;
			default:
				imagepng($this->image, $this->filename);
		}

		imagedestroy($this->image);
	}

	/**
	 * Gets the text dimensions
	 *
	 * @return array Text dimensions
	 *
	 */
	public function getTextDimension()
	{
		$d = imagettfbbox($this->font_size, 0, $this->font, $this->text);
		$min_x = min(array($d[0], $d[2], $d[4], $d[6]));
		$max_x = max(array($d[0], $d[2], $d[4], $d[6]));
		$min_y = min(array($d[1], $d[3], $d[5], $d[7]));
		$max_y = max(array($d[1], $d[3], $d[5], $d[7]));

		return array('width' => $max_x - $min_x, 'height' => $max_y - $min_y);
	}

	/**
	 * Setters
	 */
	public function setAngle($a)
	{
		$this->angle = $a;
	}

	public function setColor($r = 0, $g = 0, $b = 0)
	{
		$this->color = imagecolorallocate($this->image, $r, $g, $b);
	}

	public function setFilename($filename)
	{
    	$this->filename = $filename;
    }

	public function setFont($font)
	{
    	$this->font = $font;
    }

	public function setFontSize($size)
	{
    	$this->font_size = $size;
    }

	public function setFormat($format)
	{
    	$this->format = $format;
    }

    public function setJpegQuality($q)
	{
    	$this->jpeg_quality = $q;
    }

	public function setText($text)
	{
		$this->text = $text;
	}

	/**
	 * Center the text relative to a container
	 *
	 */
	private function center()
	{
    	if ($this->container_height || $this->container_width) {
			$dim = $this->getTextDimension($this->font_size, $this->font, $this->text);
			$margin_top = ($this->container_height) ? ((($this->container_height - $dim['height']) / 2) + $dim['height']) : 0;
			$margin_left = ($this->container_width) ? (($this->container_width - $dim['width']) / 2) : 0;
			$this->coord_x += $margin_left;
			$this->coord_y += $margin_top;
    	}
	}

	/**
	 * Validates if the filepath have a supported extension
	 *
	 * @param string File path
	 * @return bool true if the format is supported
	 *
	 */
	private function isValidFormat($path)
	{
    	$e = strtoupper(pathinfo($path, PATHINFO_EXTENSION));
    	return (in_array($e, $this->supported_formats)) ? true : false;
	}
}
