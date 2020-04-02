<?php 

/**
 * 
 */
class Visi
{
	
	public $avg_visi;
	public $min_visi;
	public $sector;

	function __construct($str)
	{
		preg_match('#^([0-9]{4})(?:\s([0-9]{4})(N|NE|E|SE|S|SW|W|NW))?$#', $str, $result);
		$this->avg_visi = empty($result[1]) ? null : intval($result[1]);
		$this->min_visi = empty($result[2]) ? null : intval($result[2]);
		$this->sector = empty($result[3]) ? null : $result[3];
	}
}

?>