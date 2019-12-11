<?php

require_once('controller/controller.php');
try {
	if (isset($_POST) && !empty($_POST['pseudo']) && !empty($_POST['message']) ){
		$pseudo=htmlspecialchars($_POST['pseudo']);
		$message=htmlspecialchars($_POST['message']);
		ctlAddMessage($pseudo,$message);
	}
	else{
		ctlHome();
	}
}
catch (Exception $e) {
	$messageError = $e->getMessage() ;
	ctlError($messageError);
}

