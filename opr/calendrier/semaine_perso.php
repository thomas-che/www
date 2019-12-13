<?php

$numericDay=date('w');

$numberDay=date('d');
$numberMonth=date('n');
$numberYear=date('Y');
$numbercWeek=date('W');



if(isset($_POST['previousWeek'])){
	$numericDay=$numericDay-7;
}
if (isset($_POST['nextWeek'])) {
	$numericDay=$numericDay+7;
}

if (isset($_POST['previousWeek']) || isset($_POST['nextWeek'])){

	$numberMonth=date('n',mktime(0,0,0,date('n'),date('d')-$numericDay+1,date('Y')));
	$numberYear=date('Y',mktime(0,0,0,date('n'),date('d')-$numericDay+1,date('Y')));
	$numbercWeek=date('W',mktime(0,0,0,date('n'),date('d')-$numericDay+1,date('Y')));
}


// car on commence a 0=>dimanche
$dateWeekSart=date('d/m/Y',mktime(0,0,0,date('n'),date('d')-$numericDay+1,date('Y')));
$dateWeekEnd=date('d/m/Y',mktime(0,0,0,date('n'),date('d')-$numericDay+7,date('Y')));

$numberpreviousWeek=$numbercWeek-1;
$numbernextWeek=$numbercWeek+1;



$displayWeek='<form action="" method="POST">
				<div class="week" align="center">
					<label><< Semaine '.$numberpreviousWeek.'</label>
					<input type="submit" name="previousWeek" value="'.$numberpreviousWeek.'" >
					Semaine n° '.$numbercWeek.'
					<label>Semaine '.$numbernextWeek.' >></label>
					<input type="submit" name="nextWeek" value="'.$numbernextWeek.'">
					</br>
					<p>'.$dateWeekSart.' au '.$dateWeekEnd.'</p>
				</div>
			</form>';
echo $displayWeek;


function nameMonth($numberMonth){
	switch($numberMonth){
	    case 1 : $nameMonth = 'Janvier'; break;
	    case 2 : $nameMonth = 'Fevrier'; break;
	    case 3 : $nameMonth = 'Mars'; break;
	    case 4 : $nameMonth = 'Avril'; break;
	    case 5 : $nameMonth = 'Mai'; break;
	    case 6 : $nameMonth = 'Juin'; break;
	    case 7 : $nameMonth = 'Juillet'; break;
	    case 8 : $nameMonth = 'Aout'; break;
	    case 9 : $nameMonth = 'Septembre'; break;
	    case 10 : $nameMonth = 'Otobre'; break;
	    case 11 : $nameMonth = 'Novembre'; break;
	    case 12 : $nameMonth = 'Decembre'; break;
	}
	return $nameMonth;
}

$displayMonth='<div id="month" align="center">
				    <h3>'.nameMonth($numberMonth).' '.$numberYear.'</h3>
				</div>';

echo $displayMonth;


$displayTabDay='<table class="week" border="1" align="center">';

function tabDay($numericDay){
	$dayName=array(' ','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
	$content='<tr>';
	for ($i=0; $i < 8; $i++) {
		$content.='<th>'; 
		if ($i == 0){
			$content.=$dayName[$i];
		}
		else {
			$d=date('d',mktime(0,0,0,date('n'),date('d')-$numericDay+$i,date('Y')));
			$content.=$dayName[$i].' '.$d;
		}
		$content.='</th>';
	}
	$content.='</tr>';
	return $content;
}


function tabTime(){
	$content='';
	$timeSlot=array('08:00','09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00');
	foreach ($timeSlot as $t ) {
		$content.='<tr><td>'.$t.'</td>';
		for ($i=0; $i <7 ; $i++) { 
			$content.='<td> </td>';
		}
		$content.='</tr>';
	}
	return $content;
}




$displayTabDay.=tabDay($numericDay).''.tabTime().'</table>';

echo $displayTabDay;

?>


