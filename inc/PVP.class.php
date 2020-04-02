<?php 


/**
 * 
 */
class PVP
{

	public $runway;
	public $pvp;
	public $trend;
	
	function __construct($str)
	{
		preg_match('#^(R[0-9]{2})\/([0-9]{4})(D|U|N)$#', $str, $result);
		$this->runway = $result[1];
		$this->pvp = intval($result[2]);
		$this->trend = $result[3];
	}
}

?>