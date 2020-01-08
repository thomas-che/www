<?php

require_once('controllers/controller.php');

try {


		 
}
	
catch (Exception $e) {
	$errorMessage = $e->getMessage();
	ctlError($errorMessage);
}

