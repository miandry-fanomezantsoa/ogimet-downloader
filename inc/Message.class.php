<?php 
include_once('Tools.class.php');
include_once('Wind.class.php');
include_once('Visi.class.php');
include_once('PVP.class.php');
include_once('Cloud.class.php');
include_once('Temp.class.php');
include_once('Trend.class.php');
?>

<?php 
	/**
	 * 
	 */
	class Message
	{
		public $type;
		public $correction;
		public $station;
		public $date;
		public $auto;
		public $nil;
		public $winds; 
		public $visi;
		public $pvp;
		public $phenos = array();
		public $clouds = array();
		public $temp;
		public $pressure;
		public $recent_phenos;
		public $ws;
		public $trend;

		function __construct($message, $year, $month)
		{
			$message = trim($message);
			$wind_text = "";
			$visi_text = "";

			$params = explode(' ', $message);

			foreach($params as $el) {
				$el = trim($el);
				if(isType($el)) {
					$this->type = $el;
				} else if(isCorrection($el)) {
					$this->correction = $el;
				} else if(isStation($el)) {
					$this->station = $el;
				} else if(isSendTime($el)) {
					$el = substr($el, 0, strlen($el) -1);
					$day_txt = substr($el, 0, 2);
					$hour_txt = substr($el, 2, 2);
					$min_txt = substr($el, 4, 2);
					$dt_txt = "${year}-${month}-${day_txt} ${hour_txt}:${min_txt}";
					$this->date = new DateTime($dt_txt, new DateTimeZone('UTC'));
				} else if(isAUTO($el)) {
					$this->auto = $el;
				} else if(isNIL($el)) {
					$this->nil = $el;
				} else if(isWind($el)) {
					$wind_text .= empty($wind_text) ? $el : ' '. $el;
				} else if(isVisi($el)) {
					$visi_text .= empty($visi_text) ? $el : ' '. $el;
				} else if(isPVP($el)) {
					$this->pvp = new PVP($el);
				} else if(isCAVOK($el)) {
					$this->visi = new Visi('9999');
					$this->clouds = array(new Cloud('NSC'));
					$this->phenos = array('NSW');
				} else if(isRecentPhenos($el)) {
					$this->recent_phenos = $el;
				} else if(isPheno($el)) {
					array_push($this->phenos, $el);
				} else if(isCloud($el)) {
					if($el == 'NSC') {
						$this->clouds = array('NSC');
					} else {
						array_push($this->clouds, new Cloud($el));
					}
				} else if(isTemp($el)) {
					$this->temp = new Temp($el);
				} else if(isPressure($el) == 1) {
					$this->pressure = intval(substr($el, 1));
				} else if(isTrend($el)) {
					$this->trend = new Trend(substr($message, stripos( $message, $el )));
					break;
				}
			}
			$this->winds = new Wind($wind_text);
			$this->visi = new Visi($visi_text);
			//echo 'La durée du boucle foreach est :'. ($end - $start);

			/*$start2 = time();
			for($i = 0, $j = count($params); $i < $j; ++$i) {
				$el = trim($params[$i]);
				if(isType($el)) {
					$this->type = $el;
				} else if(isCorrection($el)) {
					$this->correction = $el;
				} else if(isStation($el)) {
					$this->station = $el;
				} else if(isSendTime($el)) {
					$this->date = $el;
				} else if(isAUTO($el)) {
					$this->auto = $el;
				} else if(isNIL($el)) {
					$this->nil = $el;
				} else if(isWind($el)) {
					$this->winds = $el;
				} else if(isVisi($el)) {
					$this->visi = $el;
				} else if(isPVP($el)) {
					$this->pvp = $el;
				} else if(isCAVOK($el)) {
					$this->visi = '9999';
					$this->clouds = 'NSC';
					$this->phenos = 'NSW';
				} else if(isPheno($el)) {
					$this->phenos = $el;
				} else if(isClouds($el)) {
					array_push($this->clouds, $el);
				} else if(isTemp($el)) {
					$this->temp = $el;
				} else if(isPressure($el) == 1) {
					$this->pressure = $el;
				} else if(isRecentPhenos($el)) {
					$this->recent_phenos = $el;
				} else if(isTrend($el)) {
					$this->trend = substr($message, stripos( $message, $el ));
					break;
				}
			}
			$end2 = time();
			echo 'La durée du boucle for est :'. ($end2 - $start2);*/
		}
	}
?>