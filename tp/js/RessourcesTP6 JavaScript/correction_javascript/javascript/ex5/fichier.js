 function control() {
   nbEssais++;
   var S="";
   var n=document.formu.prop.value;
   if (nbEssais==10 && n!=secret) {S="Perdu !" ; document.formu.bouton.disabled=true;} 
   else{ 
      if (isNaN(n)) { alert("Entrer un nombre !");}
   	  else {
     	S="Essai "+nbEssais+" : ";
     	if (n==secret) {S+="Bonne réponse !!!";document.formu.bouton.disabled=true;}
     	else { if (n < secret) {S+="Trop petit.";}
               else {S+="Trop grand.";}
        }
	   }	       
       }
     document.formu.reponse.value=S;
}

