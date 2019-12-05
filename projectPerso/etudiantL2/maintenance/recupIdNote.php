<?php


// abandon ....






try { 
    require_once('connect.php'); 
    $connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD); 
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $connexion->query("SET NAMES UTF8");
}
catch(PDOException $e) { 
    $msg = 'ERREUR dans ' . $e->getFile() . ' Ligne : ' . $e->getLine() . ' : ' . $e->getMessage();
    exit($msg); 
}


$idNote='';

$handle = fopen('tpA.txt','r');
$txt=fgets($handle);

$handle1 = fopen('tpA.txt','r');
$txt=fgets($handle1);
$nbchar=strlen($txt);
fclose($handle1);

for ($i=0; $i < $nbchar ; $i++) { 
	$t=fgets($handle,$i+9);
	echo $t;
	if ( preg_match( "#>[0-9]{7}<#", fgets($handle,$i+9) ) ){
		
		if ( preg_match( "#n#" , $idNote[-1])){
			$idNote.=fgets($handle,$i+8).';';
		}
		$idNote.='\n'.fgets($handle,$i+8).';';
	}
	if ( preg_match( "#>[0-9]([0-9])?(,[0-9]([0-9])?)?<#", fgets($handle,$i+7) )){
		$idNote.=fgets($handle,$i+6);
	}
}

$t=fgets($handle,$i+9);
echo $t;

echo 'idnote ='.$idNote;
	
fclose($handle);

