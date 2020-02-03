<?php

require_once('models/model.php');
require_once('views/view.php');

function ctlDisplayAceuil(){
	displayAceuil();
}

function ctlDisplayM(){
	displayMenu();
}

function ctlDisplayLogin(){
	displayLogin();
}

function ctlError($error){
	displayError($error);
}
