<?php

require_once('controllers/controller.php');

try {
	if (isset($_POST['valider'])){
		ctlValidator();
	}
	else {
		ctlDisplayArticle();
	}

		 
}
	
catch (Exception $e) {
	$errorMessage = $e->getMessage();
	ctlError($errorMessage);
}

