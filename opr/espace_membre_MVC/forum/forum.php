<?php

require_once('controller/controller.php');

try{
	if (isset($_POST['envoyer'])) {
		$nom=htmlspecialchars($_POST['nom']);
		$msg=htmlspecialchars($_POST['msg']);
		CtlAjouterMessage($nom,$msg);
		unset($_POST);
	}
	elseif (isset($_POST['supprimer'])) {
		$id=htmlspecialchars($_POST['idmsg']);
		CtlSupprimerMessage($id);
		unset($_POST);
	}
	else{
		CtlAcceuil();
	}
}
catch(Exception $e) {
    $msg=$e->getMessage();
    CtlErreur($msg);
}