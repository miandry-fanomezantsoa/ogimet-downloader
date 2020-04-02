<?php 
	
	require_once('header.php');
	require 'vendor/autoload.php';


	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\Shared\Date;
	use PhpOffice\PhpSpreadsheet\Document\Properties;
	use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

?>
<?php 

include('inc/Message.class.PHP');


function setFileHead(PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet) {
	$sheet->setCellValueByColumnAndRow(1, 2, 'type');
	$sheet->setCellValueByColumnAndRow(2, 2, 'correction');
	$sheet->setCellValueByColumnAndRow(3, 2, 'aérodrome');
	$sheet->setCellValueByColumnAndRow(4, 2, 'date [UTC]');
	$sheet->setCellValueByColumnAndRow(5, 2, 'auto');
	$sheet->setCellValueByColumnAndRow(6, 2, 'nil');
	$sheet->setCellValueByColumnAndRow(7, 2, 'avg dir [°]');
	$sheet->setCellValueByColumnAndRow(8, 2, 'min dir [°]');
	$sheet->setCellValueByColumnAndRow(9, 2, 'max dir');
	$sheet->setCellValueByColumnAndRow(10, 2, 'speed [KT]');
	$sheet->setCellValueByColumnAndRow(11, 2, 'gust [KT]');
	$sheet->setCellValueByColumnAndRow(12, 2, 'avg visi [m]');
	$sheet->setCellValueByColumnAndRow(13, 2, 'min visi [m]');
	$sheet->setCellValueByColumnAndRow(14, 2, 'sector');
	$sheet->setCellValueByColumnAndRow(15, 2, 'runway [10°]');
	$sheet->setCellValueByColumnAndRow(16, 2, 'PVP [m]');
	$sheet->setCellValueByColumnAndRow(17, 2, 'trend');
	$sheet->setCellValueByColumnAndRow(18, 2, 'pheno1');
	$sheet->setCellValueByColumnAndRow(19, 2, 'pheno2');
	$sheet->setCellValueByColumnAndRow(20, 2, 'pheno3');
	$sheet->setCellValueByColumnAndRow(21, 2, 'type');
	$sheet->setCellValueByColumnAndRow(22, 2, 'nebu');
	$sheet->setCellValueByColumnAndRow(23, 2, 'base [100ft]');
	$sheet->setCellValueByColumnAndRow(24, 2, 'type');
	$sheet->setCellValueByColumnAndRow(25, 2, 'nebu');
	$sheet->setCellValueByColumnAndRow(26, 2, 'base [100ft]');
	$sheet->setCellValueByColumnAndRow(27, 2, 'type');
	$sheet->setCellValueByColumnAndRow(28, 2, 'nebu');
	$sheet->setCellValueByColumnAndRow(29, 2, 'base [100ft]');
	$sheet->setCellValueByColumnAndRow(30, 2, 'air temp [°C]');
	$sheet->setCellValueByColumnAndRow(31, 2, 'dewpoint [°C]');
	$sheet->setCellValueByColumnAndRow(32, 2, 'pressure [hPa]');
	$sheet->setCellValueByColumnAndRow(33, 2, 'recent phenos');
	$sheet->setCellValueByColumnAndRow(34, 2, 'wind shear');
	$sheet->setCellValueByColumnAndRow(35, 2, 'type');
	$sheet->setCellValueByColumnAndRow(36, 2, 'from [UTC]');
	$sheet->setCellValueByColumnAndRow(37, 2, 'to [UTC]');
	$sheet->setCellValueByColumnAndRow(38, 2, 'at [UTC]');
	$sheet->setCellValueByColumnAndRow(39, 2, 'avg dir [°]');
	$sheet->setCellValueByColumnAndRow(40, 2, 'min dir [°]');
	$sheet->setCellValueByColumnAndRow(41, 2, 'max dir [°]');
	$sheet->setCellValueByColumnAndRow(42, 2, 'speed [KT]');
	$sheet->setCellValueByColumnAndRow(43, 2, 'gust [KT]');
	$sheet->setCellValueByColumnAndRow(44, 2, 'avg visi [m]');
	$sheet->setCellValueByColumnAndRow(45, 2, 'min visi [m]');
	$sheet->setCellValueByColumnAndRow(46, 2, 'sector');
	$sheet->setCellValueByColumnAndRow(47, 2, 'pheno 1');
	$sheet->setCellValueByColumnAndRow(48, 2, 'pheno 2');
	$sheet->setCellValueByColumnAndRow(49, 2, 'type');
	$sheet->setCellValueByColumnAndRow(50, 2, 'nebu');
	$sheet->setCellValueByColumnAndRow(51, 2, 'base [100ft]');
	$sheet->setCellValueByColumnAndRow(52, 2, 'type');
	$sheet->setCellValueByColumnAndRow(53, 2, 'nebu');
	$sheet->setCellValueByColumnAndRow(54, 2, 'base [100ft]');

	return $sheet;
}

function writeToSheet(PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet, Message $metar){
	$row = $sheet->getHighestRow() + 1;

	$sheet->setCellValueByColumnAndRow(1, $row, $metar->type);
	$sheet->setCellValueByColumnAndRow(2, $row, $metar->correction);
	$sheet->setCellValueByColumnAndRow(3, $row, $metar->station);

	if(! is_null($metar->date)) {
		$excel_dt = Date::dateTimeToExcel($metar->date);
		$sheet->setCellValueByColumnAndRow(4, $row, $excel_dt);
		$sheet->getStyleByColumnAndRow(4, $row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DATETIME);
	}	

	$sheet->setCellValueByColumnAndRow(5, $row, $metar->auto);
	$sheet->setCellValueByColumnAndRow(6, $row, $metar->nil);
	$sheet->setCellValueByColumnAndRow(7, $row, $metar->winds->avg_dir);
	$sheet->setCellValueByColumnAndRow(8, $row, $metar->winds->min_dir);
	$sheet->setCellValueByColumnAndRow(9, $row, $metar->winds->max_dir);
	$sheet->setCellValueByColumnAndRow(10, $row, $metar->winds->avg_speed);
	$sheet->setCellValueByColumnAndRow(11, $row, $metar->winds->gust);
	$sheet->setCellValueByColumnAndRow(12, $row, $metar->visi->avg_visi);
	$sheet->setCellValueByColumnAndRow(13, $row, $metar->visi->min_visi);
	$sheet->setCellValueByColumnAndRow(14, $row, $metar->visi->sector);
	$sheet->setCellValueByColumnAndRow(15, $row, isset($metar->pvp) ? $metar->pvp->runway : null);
	$sheet->setCellValueByColumnAndRow(16, $row, isset($metar->pvp) ? $metar->pvp->pvp : null);
	$sheet->setCellValueByColumnAndRow(17, $row, isset($metar->pvp) ? $metar->pvp->trend : null);
	$sheet->setCellValueByColumnAndRow(18, $row, isset($metar->phenos[0]) ? $metar->phenos[0] : null);
	$sheet->setCellValueByColumnAndRow(19, $row, isset($metar->phenos[1]) ? $metar->phenos[1] : null);
	$sheet->setCellValueByColumnAndRow(20, $row, isset($metar->phenos[2]) ? $metar->phenos[2] : null);
	$sheet->setCellValueByColumnAndRow(21, $row, isset($metar->clouds[0]) && $metar->clouds[0] != 'NSC' ? $metar->clouds[0]->type : 'NSC');
	$sheet->setCellValueByColumnAndRow(22, $row, isset($metar->clouds[0]) && $metar->clouds[0] != 'NSC' ? $metar->clouds[0]->nebu : null);
	$sheet->setCellValueByColumnAndRow(23, $row, isset($metar->clouds[0]) && $metar->clouds[0] != 'NSC' ? $metar->clouds[0]->base_height : null);
	$sheet->setCellValueByColumnAndRow(24, $row, isset($metar->clouds[1]) ? $metar->clouds[1]->type : null);
	$sheet->setCellValueByColumnAndRow(25, $row, isset($metar->clouds[1]) ? $metar->clouds[1]->nebu : null);
	$sheet->setCellValueByColumnAndRow(26, $row, isset($metar->clouds[1]) ? $metar->clouds[1]->base_height : null);
	$sheet->setCellValueByColumnAndRow(27, $row, isset($metar->clouds[2]) ? $metar->clouds[2]->type : null);
	$sheet->setCellValueByColumnAndRow(28, $row, isset($metar->clouds[2]) ? $metar->clouds[2]->nebu : null);
	$sheet->setCellValueByColumnAndRow(29, $row, isset($metar->clouds[2]) ? $metar->clouds[2]->base_height : null);
	$sheet->setCellValueByColumnAndRow(30, $row, isset($metar->temp) ? $metar->temp->air_temp : null);
	$sheet->setCellValueByColumnAndRow(31, $row, isset($metar->temp) ? $metar->temp->dewpoint : null);
	$sheet->setCellValueByColumnAndRow(32, $row, $metar->pressure);
	$sheet->setCellValueByColumnAndRow(33, $row, $metar->recent_phenos);
	$sheet->setCellValueByColumnAndRow(34, $row, $metar->ws);
	$sheet->setCellValueByColumnAndRow(35, $row, isset($metar->trend) ? $metar->trend->evolution : null);
	$sheet->setCellValueByColumnAndRow(36, $row, isset($metar->trend) ? $metar->trend->from : null);
	$sheet->setCellValueByColumnAndRow(37, $row, isset($metar->trend) ? $metar->trend->to : null);
	$sheet->setCellValueByColumnAndRow(38, $row, isset($metar->trend) ? $metar->trend->at : null);
	$sheet->setCellValueByColumnAndRow(39, $row, isset($metar->trend) ? $metar->trend->wind->avg_dir : null);
	$sheet->setCellValueByColumnAndRow(40, $row, isset($metar->trend) ? $metar->trend->wind->min_dir : null);
	$sheet->setCellValueByColumnAndRow(41, $row, isset($metar->trend) ? $metar->trend->wind->max_dir : null);
	$sheet->setCellValueByColumnAndRow(42, $row, isset($metar->trend) ? $metar->trend->wind->avg_speed : null);
	$sheet->setCellValueByColumnAndRow(43, $row, isset($metar->trend) ? $metar->trend->wind->gust : null);
	$sheet->setCellValueByColumnAndRow(44, $row, isset($metar->trend) ? $metar->trend->visi->avg_visi : null);
	$sheet->setCellValueByColumnAndRow(45, $row, isset($metar->trend) ? $metar->trend->visi->min_visi : null);
	$sheet->setCellValueByColumnAndRow(46, $row, isset($metar->trend) ? $metar->trend->visi->sector : null);
	$sheet->setCellValueByColumnAndRow(47, $row, isset($metar->trend->phenos[0]) ? $metar->trend->phenos[0] : null);
	$sheet->setCellValueByColumnAndRow(48, $row, isset($metar->trend->phenos[1]) ? $metar->trend->phenos[1] : null);
	$sheet->setCellValueByColumnAndRow(49, $row, isset($metar->trend->clouds[0]) ? $metar->trend->clouds[0]->type : null);
	$sheet->setCellValueByColumnAndRow(50, $row, isset($metar->trend->clouds[0]) ? $metar->trend->clouds[0]->nebu : null);
	$sheet->setCellValueByColumnAndRow(51, $row, isset($metar->trend->clouds[0]) ? $metar->trend->clouds[0]->base_height : null);
	$sheet->setCellValueByColumnAndRow(52, $row, isset($metar->trend->clouds[1]) ? $metar->trend->clouds[1]->type : null);
	$sheet->setCellValueByColumnAndRow(53, $row, isset($metar->trend->clouds[1]) ? $metar->trend->clouds[1]->nebu : null);
	$sheet->setCellValueByColumnAndRow(54, $row, isset($metar->trend->clouds[1]) ? $metar->trend->clouds[1]->base_height : null);
}

?>

<?php 

?>



	<h1>Download meteorological data from OGIMET</h1>

	<form action="" id="request-form" method="post">
		<div id="icao-code">
			<label for="icao-code">ICAO code</label>
			<input type="text" name="icao-code" id="icao-code" placeholder="Example : FMMI" required>
			<span id="icao-code-error" class="error"></span>
		</div>		

		<fieldset>
			<legend>Begin date and time</legend>
				<label for="from-date">Date</label>
				<input type="date" name="from-date" id="from-date" required>
				<span id="from-date-error" class="error"></span>

				<label for="from-time">Time</label>
				<input type="time" name="from-time" id="from-time" required>
				<span id="from-time-error" class="error"></span>
		</fieldset>
		<fieldset>
			<legend>End date and time</legend>
				<label for="to-date">Date</label>
				<input type="date" name="to-date" id="to-date" required>
				<span id="to-date-error" class="error"></span>

				<label for="to-time">Time</label>
				<input type="time" name="to-time" id="to-time" id="to-time" required>
				<span id="to-time-error" class="error"></span>
		</fieldset>
		<button id="send-button" type="submit">Send</button>	
	</form>
	<div>
		<textarea name="result" id="result"></textarea>
	</div>
	
<?php require_once('footer.php'); ?>

<?php

function monthsBetween(DateTime $date1, DateTime $date2) {
	$dY = abs(intval($date1->format('Y')) - intval($date2->format('Y')));
	$dM = abs(intval($date1->format('m')) - intval($date2->format('m')));

	return ($dY * 12) + $dM;
}

if(isset($_POST['icao-code']) && isset($_POST['from-date']) && isset($_POST['from-time']) && isset($_POST['to-date']) && isset($_POST['to-time'])) {

	$begin = new DateTime($_POST['from-date'] . ' ' . $_POST['from-time']);
	$end = new DateTime($_POST['to-date'] . ' ' . $_POST['to-time']);
	
	$lang = 'en';
	$lugar = isset($_POST['icao-code']) ? $_POST['icao-code'] : null;
	$tipo = 'ALL';
	$ord = 'DIR';
	$nil = 'SI';
	$fmt = 'txt';
	$send = 'send';

	$messages = "";

	
	$certificate = "C:/wamp64/cacert.pem";
	$months = monthsBetween($begin, $end);
	$props = new Properties();
	$props->setCreator("RATOVONJANAHARY Miandry Fanomezantsoa");
	$props->setTitle('METAR du '. $begin->format('D-M-Y'). ' à '. $end->format('D-M-Y'));
	$props->setDescription('These data are extracted from textual messages on OGIMET site, and transformed to meteorological parameters.');

	//$fichier_test = fopen('files/test.txt', 'a+');
	if($months == 0) {
		echo "Le mois est seulement 1 <br>";
		$ch = curl_init();
		echo 'La différence est '. $months.'<br/>';
		$ano = $begin->format('Y');
		$mes = $begin->format('m');
		$day = $begin->format('d');
		$hora = $begin->format('H');
		$anof = $end->format('Y');
		$mesf = $end->format('m');
		$dayf = $end->format('d');
		$horaf = $end->format('H');
		$minf = $end->format('i');

		$url = "https://www.ogimet.com/display_metars2.php?lang=${lang}&lugar=${lugar}&tipo=${tipo}&ord=${ord}&nil=${nil}&fmt=${fmt}&ano=${ano}&mes=${mes}&day=${day}&hora=${hora}&anof=${anof}&mesf=${mesf}&dayf=${dayf}&horaf=${horaf}&minf=${minf}&send=${send}";

		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_CAINFO, $certificate);
		curl_setopt($ch, CURLOPT_CAPATH, $certificate);
		curl_setopt($ch, CURLOPT_HEADER, 1);

		$data = curl_exec($ch);
	    $start = strpos($data, "\r\n\r\n") + 4;
	    $body = substr($data, $start, strlen($data) - $start);
	    $body = strip_tags($body);

	    $messages = explode('TAF', $body);

	    $liste = preg_split('/[0-9]{12}/', $messages[0]);
	    array_shift($liste);	    

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('METAR '. $begin->format('M-Y') );
		$spreadsheet->setProperties($props);
		
		$sheet = setFileHead($sheet);
		foreach ($liste as $key => $message) {
	    	if($key == (count($liste) - 1)) {
	    		$l = explode('=', $message);
	    		$message = $l[0];
	    	} else {
	    		$message = substr($message, 0, strlen($message) - 2);
	    	}
	    	$message = trim($message);
	    	$message_obj = new Message($message, $ano, $mes);
	    	writeToSheet($sheet, $message_obj);
	    }

		// (4) SAVE TO FILE
		$writer = new Xlsx($spreadsheet);
		$writer->save('METAR du '. $begin->format('D-M-Y'). ' à '. $end->format('D-M-Y').'.xlsx');

		curl_close($ch);

	} else {
		echo "Le mois est plusieurs <br>";
		$ch = curl_init();
		// (2) CREATE A NEW SPREADSHEET
		$spreadsheet = new Spreadsheet();

		for($i=0, $j = $months; $i <= $j; ++$i) {
			
			$currentDate = $begin->add(new DateInterval("P${i}M"));
			$ano = $currentDate->format('Y');
			$mes = $currentDate->format('m');
			$day = ($i == 0) ? $begin->format('d') : '01';
			$hora = ($i == 0) ? $begin->format('H') : '00';
			$anof = $currentDate->format('Y');
			$mesf = $currentDate->format('m');
			$dayf = ($i == $j) ? $end->format('d') : $currentDate->format('t');
			$horaf = ($i == $j) ? $end->format('H') : '23';
			$minf = ($i == $j) ? $end->format('i') : '59';

			$url = "https://www.ogimet.com/display_metars2.php?lang=${lang}&lugar=${lugar}&tipo=${tipo}&ord=${ord}&nil=${nil}&fmt=${fmt}&ano=${ano}&mes=${mes}&day=${day}&hora=${hora}&anof=${anof}&mesf=${mesf}&dayf=${dayf}&horaf=${horaf}&minf=${minf}&send=${send}";
			echo 'Le lien est : '. $url . '<br/>';

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_CAINFO, $certificate);
			curl_setopt($ch, CURLOPT_CAPATH, $certificate);
			curl_setopt($ch, CURLOPT_HEADER, 1);

			$data = curl_exec($ch);
		    $start = strpos($data, "\r\n\r\n") + 4;
		    $body = substr($data, $start, strlen($data) - $start);
		    $body = strip_tags($body);

		    $messages = explode('TAF', $body);

		    $liste = preg_split('/[0-9]{12}/', $messages[0]);
		    array_shift($liste);	    
			
			$sheet = $spreadsheet->createSheet($i);
			//$spreadsheet->setActiveSheetIndex($i);
			$sheet->setTitle('METAR '. $currentDate->format('M-Y') );
		
			$sheet = setFileHead($sheet);
			foreach ($liste as $key => $message) {
		    	if($key == (count($liste) - 1)) {
		    		$l = explode('=', $message);
		    		$message = $l[0];
		    	} else {
		    		$message = substr($message, 0, strlen($message) - 2);
		    	}
		    	$message = trim($message);
		    	$message_obj = new Message($message, $ano, $mes);
		    	writeToSheet($sheet, $message_obj);
		    }

			echo $data;
			sleep(180);
			echo '<br/><br/> MESSAGE SUIVANT <br/><br/>';
		}

		// (4) SAVE TO FILE
		$writer = new Xlsx($spreadsheet);
		$writer->save('METAR du '. $begin->format('D-M-Y'). ' à '. $end->format('D-M-Y').'.xlsx');

		curl_close($ch);
		
	}
	

	/*$file = fopen('files/Metar.txt', 'r+');
	$metar = '';
	while ($line = fgets($file)) {
		$metar .= $line;
	}
	fclose($file);*/
	
	?>

	<!-- <table>
		<th>
			<td>type</td>
			<td>aérodrome</td>
			<td>date</td>			
			<td>auto</td>	
			<td>nil</td>			
			<td>vent</td>			
			<td>visibilité</td>			
			<td>PVP</td>			
			<td>phénomènes</td>			
			<td>nuages</td>			
			<td>température</td>			
			<td>pression</td>			
			<td>phénos récents</td>			
			<td>cisaillement</td>			
			<td>Tendance</td>			
		</th>
		<th>
			<td>type</td>
			<td>correction</td>
			<td>aérodrome</td>
			<td>date</td>			
			<td>auto</td>	
			<td>nil</td>			
			<td>dir moyenne</td>			
			<td>dir mini</td>			
			<td>dir maxi</td>			
			<td>force</td>			
			<td>rafale</td>			
			<td>visi moyenne</td>	
			<td>visi mini</td>	
			<td>secteur</td>	
			<td>runway</td>			
			<td>pvp</td>			
			<td>pheno1</td>			
			<td>pheno2</td>			
			<td>pheno3</td>			
			<td>type nuage1</td>			
			<td>nebu nuage1</td>			
			<td>base nuage1</td>			
			<td>type nuage2</td>			
			<td>nebu nuage2</td>			
			<td>base nuage2</td>			
			<td>type nuage3</td>			
			<td>nebu nuage3</td>			
			<td>base nuage3</td>			
			<td>temp</td>			
			<td>dewpoint</td>			
			<td>pression</td>		
			<td>phéno récent</td>			
			<td>wind shear</td>			
			<td>type</td>						
			<td>from</td>						
			<td>to</td>
			<td>dir moyenne</td>			
			<td>dir mini</td>			
			<td>dir maxi</td>			
			<td>force</td>			
			<td>rafale</td>
			<td>visi moyenne</td>	
			<td>visi mini</td>	
			<td>secteur</td>		
			<td>phéno</td>		
			<td>Nuage</td>		
		</th>

		<?php $messages = explode('=', $metar); ?>
		<?php foreach ($messages as $el) { ?>
			<?php $el = preg_replace('#\s\s+#', ' ', $el); ?>
			<?php $metar = new Message($el); ?>

			<tr>
				<td><?php echo $metar->type ?></td>
				<td><?php echo $metar->correction ?></td>
				<td><?php echo $metar->station ?></td>
				<td><?php echo $metar->date ?></td>
				<td><?php echo $metar->auto ?></td>
				<td><?php echo $metar->nil ?></td>
				<td><?php echo $metar->winds->avg_dir ?></td>
				<td><?php echo $metar->winds->min_dir ?></td>
				<td><?php echo $metar->winds->max_dir ?></td>
				<td><?php echo $metar->winds->avg_speed ?></td>
				<td><?php echo $metar->winds->gust ?></td>
				<td><?php echo $metar->visi->avg_visi ?></td>
				<td><?php echo $metar->visi->min_visi ?></td>
				<td><?php echo $metar->visi->sector ?></td>
				<td><?php echo isset($metar->pvp) ? $metar->pvp->runway : null; ?></td>
				<td><?php echo isset($metar->pvp) ? $metar->pvp->pvp : null; ?></td>
				<td><?php echo isset($metar->pvp) ? $metar->pvp->trend : null; ?></td>
				<td><?php echo isset($metar->phenos[0]) ? $metar->phenos[0] : null; ?></td>
				<td><?php echo isset($metar->phenos[1]) ? $metar->phenos[1] : null; ?></td>
				<td><?php echo isset($metar->phenos[2]) ? $metar->phenos[2] : null; ?></td>
				<td><?php echo isset($metar->clouds[0]) && $metar->clouds[0] != 'NSC' ? $metar->clouds[0]->type : 'NSC' ?></td>
				<td><?php echo isset($metar->clouds[0]) && $metar->clouds[0] != 'NSC' ? $metar->clouds[0]->nebu : null ?></td>
				<td><?php echo isset($metar->clouds[0]) && $metar->clouds[0] != 'NSC' ? $metar->clouds[0]->base_height : null ?></td>
				<td><?php echo isset($metar->clouds[1]) ? $metar->clouds[1]->type : null ?></td>
				<td><?php echo isset($metar->clouds[1]) ? $metar->clouds[1]->nebu : null ?></td>
				<td><?php echo isset($metar->clouds[1]) ? $metar->clouds[1]->base_height : null ?></td>
				<td><?php echo isset($metar->clouds[2]) ? $metar->clouds[2]->type : null ?></td>
				<td><?php echo isset($metar->clouds[2]) ? $metar->clouds[2]->nebu : null ?></td>
				<td><?php echo isset($metar->clouds[2]) ? $metar->clouds[2]->base_height : null ?></td>
				<td><?php echo isset($metar->temp) ? $metar->temp->air_temp : null; ?></td>
				<td><?php echo isset($metar->temp) ? $metar->temp->dewpoint : null; ?></td>
				<td><?php echo $metar->pressure; ?></td>
				<td><?php echo $metar->recent_phenos; ?></td>
				<td><?php echo $metar->ws; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->evolution : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->from : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->to : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->at : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->wind->avg_dir : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->wind->min_dir : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->wind->max_dir : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->wind->avg_speed : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->wind->gust : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->visi->avg_visi : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->visi->min_visi : null; ?></td>
				<td><?php echo isset($metar->trend) ? $metar->trend->visi->sector : null; ?></td>
				<td><?php echo isset($metar->trend->phenos[0]) ? $metar->trend->phenos[0] : null ?></td>
				<td><?php echo isset($metar->trend->phenos[1]) ? $metar->trend->phenos[1] : null ?></td>
				<td><?php echo isset($metar->trend->clouds[0]) ? $metar->trend->clouds[0]->type : null ?></td>
				<td><?php echo isset($metar->trend->clouds[0]) ? $metar->trend->clouds[0]->nebu : null ?></td>
				<td><?php echo isset($metar->trend->clouds[0]) ? $metar->trend->clouds[0]->base_height : null ?></td>
				<td><?php echo isset($metar->trend->clouds[1]) ? $metar->trend->clouds[1]->type : null ?></td>
				<td><?php echo isset($metar->trend->clouds[1]) ? $metar->trend->clouds[1]->nebu : null ?></td>
				<td><?php echo isset($metar->trend->clouds[1]) ? $metar->trend->clouds[1]->base_height : null ?></td>
			</tr>
				
		<?php } ?>

		
	</table> -->

	<?php
}

?>