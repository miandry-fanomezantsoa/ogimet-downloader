<?php 


/**
 * 
 */
class Cloud
{
	public $type;
	public $nebu;
	public $base_height;
	
	
	function __construct($str)
	{
		preg_match('#^(?:(FEW|SCT|BKN|OVC)|(VV))([0-9]{3})$#', $str, $result);
		$this->type = empty($result[2]) ? 'Cloud' : 'VV';
		$this->nebu = empty($result[1]) ? null : $result[1];
		$this->base_height = empty($result[3]) ? null : intval($result[3]);
	}
}

?>