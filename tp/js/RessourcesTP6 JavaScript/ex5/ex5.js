var nb =Math.floor(Math.random()*99)+1;
alert(nb);
var nbEssaie=3; 

function verif(){
	var n= document.formul.nb.value;

	if (isNaN(n)){
		alert('enter un nb');
	}
	else{
		nbEssaie-=1;
		if (n==nb){
			document.formul.res.value ='BRAVO';
			document.formul.controle.disabled=true;
			return nbEssaie;
		}
		else {
			if (0<nbEssaie){
				var s='';
				if (n<nb){
					var s='trop petit';
				}
				else {
					var s='trop grand';
				}
				document.formul.res.value = 'il vous reste '+nbEssaie+' essai ; '+s;
				return nbEssaie;
			}
			else{
				document.formul.res.value ='PERDU';
				document.formul.controle.disabled=true;
				return nbEssaie;
			}
		}
	}
}