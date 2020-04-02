<?php 

class Wind {

	public $avg_dir;
	public $avg_speed;
	public $gust;
	public $min_dir;
	public $max_dir;

	function __construct($str) {
		preg_match('#^(?:([0-9]{3})|(VRB))([0-9]{2}|P99)(?:G([0-9]{2}))?KT(?:\s([0-9]{3})V([0-9]{3}))?$#', $str, $result);

		$this->avg_dir = empty($result[1]) ? null : intval($result[1]);
		if(!empty($result[2])) {
			$this->avg_dir = $result[2];
		}
		$this->avg_speed = empty($result[3]) ? null : intval($result[3]);
		$this->gust = empty($result[4]) ? null : intval($result[4]);
		$this->min_dir = empty($result[5]) ? null : intval($result[5]);
		$this->max_dir = empty($result[6]) ? null : intval($result[6]);
	}
}

?>