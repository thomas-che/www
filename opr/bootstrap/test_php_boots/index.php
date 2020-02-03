<?php

require_once('controllers/controller.php');

try {
	

	if (isset($_GET['page'])){
		switch ($_GET['page']){
			case 'login':
				ctlDisplayLogin();
				break;
			default:
				echo '404 error';
				break;

		}
	}
	else{
		ctlDisplayAceuil();
	}
}
	
catch (Exception $e) {
	$errorMessage = $e->getMessage();
	ctlError($errorMessage);
}

