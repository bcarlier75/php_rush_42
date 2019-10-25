<?php

require_once 'Color.class.php';

Class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 1.0;
	private $_color = false;
	static public $verbose = false;

	public function __construct(array $v_params) {
		if (!isset($v_params['x']) || !isset($v_params['y']) || !isset($v_params['z']))
			return false;
		if (isset($v_params['color']) && !($v_params['color'] instanceof Color))
			return false;
		if (!isset($v_params['color']))
			$v_params['color'] = new Color(['red' => 255, 'green' => 255, 'blue' => 255]);
		foreach (['x', 'y', 'z', 'w', 'color'] as $tab)
			if (isset($v_params[$tab]))
				$this->{"_$tab"} = $v_params[$tab];
		if (self::$verbose)
			echo $this->__toString() . ' constructed' . PHP_EOL;
		return true;
	}
	
	public function __destruct() {
		if (self::$verbose)
			echo $this->__toString() . ' destructed' . PHP_EOL;
	}
	
	public function __toString() {
		return "Vertex( x: " . number_format($this->_x, 2) .
				", y: " . number_format($this->_y, 2) .
				", z:" . number_format($this->_z, 2) .
				", w:" . number_format($this->_w, 2) .
				(self::$verbose ? ", " .$this->_color : "") . " )";
	}

	static function doc() {
		if (file_exists('Vertex.doc.txt'))
			return file_get_contents('Vertex.doc.txt');
	}

	public function opposite() {
		return new Vector(array('dest' => new Vertex(array('x' => $this->_x * -1, 'y' => $this->_y * -1, 'z' => $this->_z * -1))));
		}

	public function __get($param) {
		return false;
	}

	public function __set($param, $value) {
		return false;
	}

	public function getX() {
		return $this->_x;
	}

	public function getY() {
		return $this->_y;
	}

	public function getZ() {
		return $this->_z;
	}

	public function getW() {
		return $this->_w;
	}
	
	public function getColor() {
		return $this->_color;
	}

	public function setX($x) {
		$this->_x = $x;
	}

	public function setY($y) {
		$this->_y = $y;
	}

	public function setZ($z) {
		$this->_z = $z;
	}

	public function setW($w) {
		$this->_w = $w;
	}

	public function setColor(Color $color) {
		$this->_color = $color;
	}
}
?>
