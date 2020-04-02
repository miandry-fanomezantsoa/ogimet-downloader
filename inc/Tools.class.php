<?php 

function isType($str) {
	return ($str == 'METAR' || $str == 'SPECI');
}

function isCorrection($str) {
	return ($str == 'COR');
}

function isStation($str) {
	return (preg_match('#^[A-Z]{4}$#', $str) == 1 && substr($str, 0, 2) == 'FM');
}

function isSendTime($str) {
	return (preg_match('#^[0-9]{6}Z$#', $str) == 1);
}

function isAUTO($str) {
	return ($str == 'AUTO');
}

function isNIL($str) {
	return ($str == 'NIL');
}

function isWind($str) {
	return (preg_match('#^(([0-9]{3})|(VRB))([0-9]{2}|P99)(G[0-9]{2})?KT$#', $str) == 1 || preg_match('#[0-9]{3}V[0-9]{3}#', $str) == 1);
}

function isVisi($str) {
	return (preg_match('#^[0-9]{4}(N|NE|E|SE|S|SW|W|NW)?$#', $str) == 1);
}

function isPVP($str) {
	return (preg_match('#^R[0-9]{2}\/[0-9]{4}(D|U|N)$#', $str) == 1);
}

function isCAVOK($str) {
	return ($str == 'CAVOK');
}

function isCloud($str) {
	return (preg_match('#^(((FEW|SCT|BKN|OVC)|VV)[0-9]{3}|NSC)$#', $str) == 1);
}

function isTemp($str) {
	return (preg_match('#^M?[0-9]{2}\/M?[0-9]{2}$#', $str) == 1);
}

function isPressure($str) {
	return (preg_match('#^Q[0-9]{4}$#', $str) == 1);
}

function isRecentPhenos($str) {
	return (preg_match('#^RE[A-Z]{2,7}$#', $str));
}

function isTrend($str) {
	return ($str == 'NOSIG' || $str == 'TEMPO' || $str == 'BECMG');
}

function isPheno($str) {
	return (preg_match('#^BR|SQ|FU|IC|(VC)?(PO|FC|SS|DS|VA)|[-]?HZ|(DR|(VC)?BL)?(DU|SA)|(VC)?(MI|BC|PR)?(FZ)?FG|[-+]?((SH|TS)?(GR|GS)|PL|SG|(DR|(VC)?BL)?(SH|TS)?SN|(SH|TS|FZ)?RA|(FZ)?DZ|(VC)?TS)$#', $str) == 1 && $str != 'TEMPO');
}


?>
