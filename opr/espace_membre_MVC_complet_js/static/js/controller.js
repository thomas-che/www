function surligne(champ,erreur){
	if(erreur){
		champ.style.backgroundColor = "" ;
		return true ;
	}else{
		champ.style.backgroundColor = "#fba" ;
		return false;
	}
}
function verifNonVide(champ){
	if(champ.value.length > 0){
		 return surligne(champ,true);
	}else{
		return surligne(champ,false);
	}
}
function verifForm(f){
	if(verifNonVide(f.pseudo)&&verifNonVide(f.mdp)&&verifNonVide(f.mdp_confirmation)&&verifNonVide(f.mail)){
		return true ;
	}else{
		alert('un ou plusieur champ vide');
		return false ;
	}
}

