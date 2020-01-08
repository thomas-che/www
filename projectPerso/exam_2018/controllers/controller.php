<?php

require_once('models/model.php');
require_once('views/view.php');

function ctlDisplayArticle(){
	$listeArticle=getArticle();
	displayArticle($listeArticle);
}

function ctlValidator(){
	$isCheckboxNotEmpty=false;
	$sum=0;
	foreach ($_POST as $key => $value){
		if ($value =='on'){
			$isCheckboxNotEmpty=true;
			
			$prix=getPriceById($key);
			$sum=$sum+$prix;
			updateStock($key);
		}
	}
	if ($isCheckboxNotEmpty){
		throw new Exception('tt ='.$sum.'€');
	}
	else{
		throw new Exception('pas d article choisie');
	}
}

function ctlError($error){
	displayError($error);
}
