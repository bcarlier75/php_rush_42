<?php

require_once 'Vertex.class.php';

Class Vector
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 0.0;
	static public $verbose = false;

	public function __construct(array $vc_params) {
		if (!isset($vc_params['dest']) || !($vc_params['dest'] instanceof Vertex))
			return false;
		if (isset($vc_params['orig']) && !($vc_params['orig'] instanceof Vertex))
			return false;
		else if (!isset($vc_params['orig']))
			$vc_params['orig'] = new Vertex(['x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0]);
		$this->_x = $vc_params['dest']->getX() - $vc_params['orig']->getX();
		$this->_y = $vc_params['dest']->getY() - $vc_params['orig']->getY();
		$this->_z = $vc_params['dest']->getZ() - $vc_params['orig']->getZ();
		if (self::$verbose)
			echo $this->__toString() . ' constructed' . PHP_EOL;
	}

	public function __destruct() {
		if (self::$verbose)
			echo $this->__toString() . ' destructed' . PHP_EOL;
	}

	static function doc() {
		if (file_exists('Vector.doc.txt'))
		return file_get_contents('Vector.doc.txt');
	}

	public function __toString() {
		return 'Vector( x:' . number_format($this->_x, 2, ".", "") .
				', y:' . number_format($this->_y, 2, ".", "") .
				', z:' . number_format($this->_z, 2, ".", "") .
				', w:' . number_format($this->_w, 2, ".", "") . ' )';
	}

	public function magnitude() {
		return sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2));
	}

	private function _divide($nb) {
		$nb = ($nb > 0 ? $nb : 1);
		$x = $this->_x / $nb;
		$y = $this->_y / $nb;
		$z = $this->_z / $nb;
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}

	public function normalize() {
		return $this->_divide($this->magnitude());
	}

	public function add(Vector $rhs) {
		$x = $this->_x + $rhs->getX();
		$y = $this->_y + $rhs->getY();
		$z = $this->_z + $rhs->getZ();
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}

	public function sub(Vector $rhs) {
		$x = $this->_x - $rhs->getX();
		$y = $this->_y - $rhs->getY();
		$z = $this->_z - $rhs->getZ();
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}

	public function opposite() {
		$x = $this->_x * -1;
		$y = $this->_y * -1;
		$z = $this->_z * -1;
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}

	public function scalarProduct($k) {
		$x = $this->_x * $k;
		$y = $this->_y * $k;
		$z = $this->_z * $k;
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
	}

	public function dotProduct(Vector $rhs) {
		return ($this->_x * $rhs->getX() + $this->_y * $rhs->getY() + $this->_z * $rhs->getZ());
	}

	public function cos(Vector $rhs) {
		return $this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude());
	}

	public function crossProduct(Vector $rhs) {
		$x = $this->_y * $rhs->getZ() - $this->_z * $rhs->getY();
		$y = $this->_z * $rhs->getX() - $this->_x * $rhs->getZ();
		$z = $this->_x * $rhs->getY() - $this->_y * $rhs->getX();
		return new Vector(['dest' => new Vertex(compact('x', 'y', 'z'))]);
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

	/*
	* No setters here.
	*/
}
?>
