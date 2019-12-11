<?php

function displayDiscusion($discussion){
	$contenu='<form class="discussion">
    			<fieldset>
    				<legend>Discussion</legend>';
	foreach ($discussion as $ligne){
		$contenu.='<p><strong>'.$ligne->pseudo.'</strong> : '.$ligne->message.' </p>';
	}
	$contenu.='    	</fieldset>
    			</form>';
	require_once('gabarit.php');
}

function displayError($error){
	$contenu='<form class="error">
    			<fieldset>
    				<legend>/!\ MSG ERROR /!\</legend>';
	$contenu.='<p><strong>'.$error.'</strong></p>';
	$contenu.=' </fieldset>
    		   </form>';
	require_once('gabarit.php');
}