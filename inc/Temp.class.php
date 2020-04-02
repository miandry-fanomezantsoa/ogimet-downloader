<?php 

/**
 * 
 */
class Temp
{
	public $air_temp;
	public $dewpoint;
	
	function __construct($str)
	{
		preg_match('#^(M)?([0-9]{2})\/(M)?([0-9]{2})$#', $str, $result);
		
		$this->air_temp = !empty($result[1]) && !empty($result[2]) ? intval('-'. $result[2]) : intval($result[2]);
		$this->dewpoint = !empty($result[3]) && !empty($result[4]) ? intval('-'. $result[4]) : intval($result[4]);
	}
}

?>