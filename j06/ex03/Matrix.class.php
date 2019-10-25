<?php

require_once 'Vector.class.php';

Class Matrix
{
 	const IDENTITY = 'IDENTITY';
	const SCALE = 'SCALE';
	const RX = 'Ox ROTATION';
	const RY = 'Oy ROTATION';
	const RZ = 'Oz ROTATION';
	const TRANSLATION = 'TRANSLATION';
	const PROJECTION = 'PROJECTION';

	private $_coords = ['x', 'y', 'z', 'w'];
	private $_matrix = [
		[0.00, 0.00, 0.00, 0.00],
		[0.00, 0.00, 0.00, 0.00],
		[0.00, 0.00, 0.00, 0.00],
		[0.00, 0.00, 0.00, 0.00],
	];
	private $_mx_params = array();
	static public $verbose = false;
	
   public function __construct(array $mx_params, $new = true)
	{
		if (!isset($mx_params['preset']) || !in_array($mx_params['preset'], [
			self::IDENTITY, self::SCALE, self::RX, self::RY, self::RZ, self::TRANSLATION, self::PROJECTION]))
			return false;
		if (!isset($mx_params['scale']) && $mx_params['preset'] === self::SCALE)
			return false;
		if (!isset($mx_params['angle']) && in_array($mx_params['preset'], [self::RX, self::RY, self::RZ]))
			return false;
		if ((!isset($mx_params['vtc']) || !($mx_params['vtc'] instanceof Vector)) && $mx_params['preset'] === self::TRANSLATION)
			return false;
		if ((!isset($mx_params['fov']) || !isset($mx_params['ratio']) || !isset($mx_params['near'])|| !isset($mx_params['far']))
		&& $mx_params['preset'] === self::PROJECTION)
			return false;
		if (self::$verbose && $new)
			echo "Matrix {$mx_params['preset']} " . ($mx_params['preset'] !== self::IDENTITY ? 'preset ' : '') . "instance constructed" . PHP_EOL;
		$fct_matrix = '_' . str_replace(' ', '', ucwords(strtolower($mx_params['preset'])));
		$this->{$fct_matrix}($mx_params);
		$this->_mx_params = $mx_params;
		return true;
	}

	public function __destruct() {
		if (self::$verbose)
			echo 'Matrix instance destructed' . PHP_EOL;
	}

	static function doc() {
		if (file_exists('Matrix.doc.txt'))
			return file_get_contents('Matrix.doc.txt');
	}

	public function __toString() {
		$str = '';
		for ($i = 0; $i < count($this->_matrix); $i++) {
			$str .= PHP_EOL . "{$this->_coords[$i]}";
			for ($j = 0; $j < count($this->_matrix[$i]); $j++)
				$str .= ' | ' . number_format($this->_matrix[$i][$j], 2, '.', '');
		}
		return 'M | vtcX | vtcY | vtcZ | vtxO' . PHP_EOL .
				'-----------------------------' . $str;
	}

	public function mult(Matrix $rhs) {
		$coords = array();
		for ($i = 0; $i < count($this->_matrix); $i++) {
			$coords[$i] = [];
			for ($j = 0; $j < count($this->_matrix[$i]); $j++) {
				$sum = 0;
				for ($k = 0; $k < count($rhs->get()); $k++) {
					$sum += $this->_matrix[$i][$k] * $rhs->get()[$k][$j];
				}
				$coords[$i][$j] = $sum;
			}
		}
		$matrix = new Matrix($this->_mx_params, false);
		$matrix->set($coords);
		return $matrix;
	}

	public function transformVertex(Vertex $vx)
	{
		$matrix = $this->get();
		$x = ($vx->getX() * $matrix[0][0]) + ($vx->getY() * $matrix[0][1]) + ($vx->getZ() * $matrix[2][2]) + ($vx->getW() * $matrix[0][3]);
		$y = ($vx->getX() * $matrix[1][0]) + ($vx->getY() * $matrix[1][1]) + ($vx->getZ() * $matrix[1][2]) + ($vx->getW() * $matrix[1][3]);
		$z = ($vx->getX() * $matrix[2][0]) + ($vx->getY() * $matrix[2][1]) + ($vx->getZ() * $matrix[2][2]) + ($vx->getW() * $matrix[2][3]);
		$w = ($vx->getX() * $matrix[2][3]) + ($vx->getY() * $matrix[3][0]) + ($vx->getZ() * $matrix[3][2]) + ($vx->getW() * $matrix[3][3]);
		$color = $vx->getColor();
		$new_vx = new Vertex(compact('x', 'y', 'z', 'w', 'color'));
		return $new_vx;
	}

	private function _Identity(array $mx_params) {
		$this->set([
			[1.00, 0.00, 0.00, 0.00],
			[0.00, 1.00, 0.00, 0.00],
			[0.00, 0.00, 1.00, 0.00],
			[0.00, 0.00, 0.00, 1.00],
		]);
	}

	private function _Translation(array $mx_params) {
		$this->_Identity($mx_params);
		$matrix = $this->get();
		$matrix[0][3] = $mx_params['vtc']->getX();
		$matrix[1][3] = $mx_params['vtc']->getY();
		$matrix[2][3] = $mx_params['vtc']->getZ();
		$this->set($matrix);
	}

	private function _Scale(array $mx_params) {
		$this->set([
			[$mx_params['scale'], 0.00, 0.00, 0.00],
			[0.00, $mx_params['scale'], 0.00, 0.00],
			[0.00, 0.00, $mx_params['scale'], 0.00],
			[0.00, 0.00, 0.00, 1.00],
		]);
	}

	private function _OxRotation(array $mx_params) {
		$this->_Identity($mx_params);
		$matrix = $this->get();
		$matrix[1][1] = cos($mx_params['angle']);
		$matrix[1][2] = -sin($mx_params['angle']);
		$matrix[2][1] = sin($mx_params['angle']);
		$matrix[2][2] = cos($mx_params['angle']);
		$this->set($matrix);
	}

	private function _OyRotation(array $mx_params) {
		$this->_Identity($mx_params);
		$matrix = $this->get();
		$matrix[0][0] = cos($mx_params['angle']);
		$matrix[0][2] = sin($mx_params['angle']);
		$matrix[2][0] = -sin($mx_params['angle']);
		$matrix[2][2] = cos($mx_params['angle']);
		$this->set($matrix);
	}

	private function _OzRotation(array $mx_params) {
		$this->_Identity($mx_params);
		$matrix = $this->get();
		$matrix[0][0] = cos($mx_params['angle']);
		$matrix[0][1] = -sin($mx_params['angle']);
		$matrix[1][0] = sin($mx_params['angle']);
		$matrix[1][1] = cos($mx_params['angle']);
		$this->set($matrix);
	}

	private function _Projection(array $mx_params) {
		$this->_Identity($mx_params);
		$matrix = $this->get();
		$matrix[1][1] = 1 / tan(0.5 * deg2rad($mx_params['fov']));
		$matrix[0][0] = $matrix[1][1] / $mx_params['ratio'];
		$matrix[2][2] = -1 * (-$mx_params['near'] - $mx_params['far']) / ($mx_params['near'] - $mx_params['far']);
		$matrix[2][3] = (2 * $mx_params['near'] * $mx_params['far']) / ($mx_params['near'] - $mx_params['far']);
		$matrix[3][2] = -1;
		$matrix[3][3] = 0;
		$this->set($matrix);
	}

	public function __get($name) {
		return false;
	}

	public function __set($name, $value) {
		return false;
	}

	public function set($matrix) {
		$this->_matrix = $matrix;
	}

	public function get() {
		return $this->_matrix;
	}
}
?>
