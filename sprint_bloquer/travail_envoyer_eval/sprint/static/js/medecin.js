/*#############################*/
/*                             */
/*                             */
/*   Bloquer Creneau Medecin   */ // tom
/*                             */
/*                             */
/*#############################*/

function afficher_nb_creneaux(){
	var nb=parseInt(document.getElementById('nbCreneaux').value);
	if (!(isNaN(nb) || nb<0)){
		var noeudPere=document.getElementById('monFds');
		var noeudDerP=document.getElementById('derP');
		var noeud=document.getElementById('creneaux');
		if (noeud==null){
			noeud=document.createElement('div');
			noeud.id='creneaux';
			noeudPere.insertBefore(noeud,noeudDerP);
		}
		noeud.innerHTML='';
		var maintenant=new Date();
		var y=maintenant.getFullYear();
		var m=maintenant.getMonth()+1;
		var d=maintenant.getDate();
		s='';
		for (i=1;i<nb+1;i++){
			
			s+='<p><label>Créneau '+i+' : </label>'
				+'<input value="date" type="date" id="d'+i+'" name="d'+i+'" min="'+y+'-'+m+'-'+d+'" onblur="checkDateCreneau(this);"/> '
				+'<input type="time" value="heure" id="h'+i+'" name="h'+i+'" onblur="checkHeureCreneau(this);"/></p>';
		}
		noeud.innerHTML=s;
	}
}

function highlight (champ,erreur){
	if (erreur) champ.style.backgroundColor="#fba";
	else champ.style.backgroundColor="";
	return !erreur;
 }

function checkNbCreneaux(champ){
	var nb=parseInt(champ.value);
	if (isNaN(nb)||nb<0){
		return highlight(champ,true);
	}
	return highlight(champ,false);
}

function checkDateCreneau(champ){
	var date=champ.value;
	var y=date.substring(0,4);
	var m=date.substring(5,7);
	var d=date.substring(8,10);

	if (y=="" || d=="" || m==""){
		return highlight(champ,true);
	}
	return highlight(champ,false);
}

function checkHeureCreneau(champ){
	var heure=champ.value;
	var h=heure.substring(0,2);
	var m=heure.substring(3,5);

	if (h=="" || m=="" || m!="00"){
		return highlight(champ,true);
	}
	return highlight(champ,false);
}

function checkForm(f){
	var nb=parseInt(document.getElementById('nbCreneaux').value);
	var checkCreneaux=true;
	var champHeure;
	var champDate;
	for (i=1;i<nb+1;i++){
		champHeure=document.getElementById('h'+i);
		champDate=document.getElementById('d'+i);
		checkCreneaux=checkDateCreneau(champDate)&& checkCreneaux;
		checkCreneaux=checkHeureCreneau(champHeure) && checkCreneaux;
	}
	if (!checkCreneaux) alert('Au moins un des champs est invalide');
	return checkCreneaux;
	
}

