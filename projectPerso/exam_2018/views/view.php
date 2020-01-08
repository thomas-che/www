<?php

function displayArticle($listAllArticle){
	$contents='<form action="index.php" method="POST" ><table>
				<tr><th>Titre</th><th>Prix</th><th>Stock</th><th>validation</th></tr>';
	foreach ($listAllArticle as $line){
		if (0<$line->stock){
			$contents.='<tr><td>'.$line->titre.'</td><td>'.$line->prix.'</td><td>'.$line->stock.'</td><td><input type="checkbox" name="'.$line->id.'" ></td></tr>';
		}
		else{
			$contents.='<tr class="zeroStock" ><td>'.$line->titre.'</td><td>'.$line->prix.'</td><td>'.$line->stock.'</td><td> </td></tr>';
		}
		
	}
	$contents.='</table>
	<input type="submit" name="valider" value="valider la comande" ></form>';
	require_once('gabarit.php');
}

function displayError($error){
	$contents='<form id="displayError"  action="" method="post">
	  <fieldset>
	  	<legend> Erreurs détectées </legend>
	  		<p>'. $error. '</p>
	  		<p>cliquer <a href="index.php">ici</a> pr revenir aceuil</p>
	  </fieldset>  
	</form>';
	require_once('gabarit.php');
}
