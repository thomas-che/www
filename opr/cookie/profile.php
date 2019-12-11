<?php
$nom=null;
if (!empty($_GET['action']) &&  $_GET['action']=== 'deco'){
	unset($_COOKIE['utilisateur']);
	// pour le sup vraiment alors temps dans le passer
	setcookie('utilisateur','',time()-10);
}
if (!empty($_COOKIE['utilisateur'])){
	$nom=$_COOKIE['utilisateur'];
}

if (!empty($_POST['nom'])){
	setcookie('utilisateur',$_POST['nom'],time()+60);
}

// stocker un tableau dans un cookie ; trasfomer le tableau en cahaine de char avec serialize
//$user=['prenom'=>'thomas','nom'=>'MICH','age'=>10];
//setcookie('utilisateur', serialize($user));
// recuperer le cookie , le deserialize ducoup on a le tableau initial
//$user=unserialize($_COOKIE['utilisateur']);

?>


<?php if ($nom): ?>
	<h1>Bonjour <?= htmlentities($nom) ?></h1>
	<a href="profile.php?action=deco">Se deco ?</a>
<?php else: ?>
	<form action="" method="POST">
		<input type="text" name="nom" placeholder="votre nom">  
		<button>se connecter</button>
	</form>
<?php endif ?>