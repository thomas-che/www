<?php


if (!empty($_POST['birthday']) ){
	setcookie('birthday',$_POST['birthday'],time()+60);
	// sinon le cookie sera utile que au prochain chargement de la page
	$_COOKIE['birthday']=$_POST['birthday'];
}
$date=null;
if (!empty($_COOKIE['birthday'])) {
	$date=(int)$_COOKIE['birthday'];
}
if ($date && $date <= date('Y')-18 ){
	echo "+18";
}
else {
	echo 'enfant';
}

?>
<?php if ($date === null): ?>
	<form action="" method="POST">
		<label>votre date de naissance :</label>
		<select name="birthday">

			<?php for ($i=2010; $i>1919 ; $i--): ?>
				<option value="<?= $i ?>"> <?= $i ?></option>
			<?php endfor ?>

		</select> 
		<button>Envoyer</button>
	</form>
<?php endif ?>
