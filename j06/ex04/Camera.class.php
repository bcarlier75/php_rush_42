<?php

class Camera
{
	private $_tT;
	private $_tR;
	private $_width;
	private $_origin;
	private $_height;
	private $_ratio;
	private $_proj;
	static $verbose = false;

	function __construct($cam_params)
	{
		$this->_origin = $cam_params['origin'];
		$this->_tT = new Matrix(array('preset' => Matrix::TRANSLATION, 'vtc' => $this->_origin->opposite()));
		$this->_tR = $this->_transpose($cam_params['orientation']);
		$this->_width = (float)$cam_params['width'];
		$this->_height = (float)$cam_params['height'];
		$this->_ratio = $this->_width / $this->_height;
		$this->_proj = new Matrix(array(
			'preset' => Matrix::PROJECTION,
			'fov' => $cam_params['fov'],
			'ratio' => $this->_ratio,
			'near' => $cam_params['near'],
			'far' => $cam_params['far']));
		if (self::$verbose) {
			echo "Camera instance constructed\n";
		}
	}

	function __destruct() {
		if (self::$verbose)
			printf("Camera instance destructed\n");
	}

	function __toString() {
		return "Camera( \n+ Origine: " . $this->_origin .
				"\n+ tT:\n" . $this->_tT .
				"\n+ tR:\n" . $this->_tR .
				"\n+ tR->mult( tT ):\n" . $this->_tR->mult($this->_tT) .
				"\n+ Proj:\n" . $this->_proj."\n)";
	}

	public static function doc() {
		if (file_exists('Camera.doc.txt'))
			return file_get_contents('Camera.doc.txt');
	}

	public function watchVertex(Vertex $worldVertex){
		$vx = $this->_proj->transformVertex($this->_tR->transformVertex($worldVertex));
		$vx->setX($vx->getX() * $this->_ratio);
		$vx->setY($vx->getY());
		$vx->setColor($worldVertex->getColor());
		return ($vx);
	}

	private function _transpose(Matrix $m){
		$new_m[0] = $m->matrix[0];
		$new_m[1] = $m->matrix[4];
		$new_m[2] = $m->matrix[8];
		$new_m[3] = $m->matrix[12];
		$new_m[4] = $m->matrix[1];
		$new_m[5] = $m->matrix[5];
		$new_m[6] = $m->matrix[9];
		$new_m[7] = $m->matrix[13];
		$new_m[8] = $m->matrix[2];
		$new_m[9] = $m->matrix[6];
		$new_m[10] = $m->matrix[10];
		$new_m[11] = $m->matrix[14];
		$new_m[12] = $m->matrix[3];
		$new_m[13] = $m->matrix[7];
		$new_m[14] = $m->matrix[11];
		$new_m[15] = $m->matrix[15];
		$m->matrix = $new_m;
		return ($m);
	}
}
?>
