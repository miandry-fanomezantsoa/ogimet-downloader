<?php 

include_once('Wind.class.php');
include_once('Visi.class.php');
include_once('Cloud.class.php');

?>

<?php
/**
 * 
 */
class Trend
{
	public $evolution;
	public $from;
	public $to;
	public $at;
	public $wind;
	public $visi;
	public $phenos = array();
	public $clouds = array();
	
	function __construct($str)
	{
		$wind_text = "";
		$visi_text = "";

		$params = explode(' ', $str);
		foreach ($params as $el) {
			if(isTrend($el)) {
				$this->evolution = $el;
			} else if(preg_match('#^(FM|TL|AT)([0-9]{4})$#', $el, $result) == 1) {
				$this->from = !empty($result[1]) && $result[1] == 'FM' ? new DateTime($result[2]) : null;
				$this->to = !empty($result[1]) && $result[1] == 'TL' ? new DateTime($result[2]) : null;
				$this->at = !empty($result[1]) && $result[1] == 'AT' ? new DateTime($result[2]) : null;
			} else if(isWind($el)) {
				$wind_text .= empty($wind_text) ? $el : ' '. $el;
			} else if(isVisi($el)) {
				$visi_text .= empty($visi_text) ? $el : ' '. $el;
			} else if(isCAVOK($el)) {
				$this->visi = new Visi('9999');
				$this->phenos = new Pheno('NSW');
				$this->clouds = array(new Cloud('NSC'));
			} else if(isPheno($el)) {
				array_push($this->phenos, $el);
			} else if(isCloud($el)) {
				array_push($this->clouds, new Cloud($el));
			}
		}

		$this->wind = new Wind($wind_text);
		$this->visi = new Visi($visi_text);
	}
}


?>