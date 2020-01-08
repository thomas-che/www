 
function verif() {
 rep=document.formu.reponse.value;
  
  if ((rep=='')|| (isNaN(rep) && rep!='')) { // car isNaN sur une chaine vide renvoie le vrai !!!!
  alert("Entrer un nombre pour répondre !");
 }
 else {
  if (eval(rep)==n1*n2) {
   alert("Bonne réponse. Bravo !\n"+n1+"x"+n2+"="+rep);
   document.location.href="ex4.html";
  }
  else {
  document.formu.reponse.style.backgroundColor="red"	
   alert("Réponse inexacte !");
   document.formu.reponse.value="";
   document.formu.reponse.style.backgroundColor="";
   document.formu.reponse.focus();
   
  }
 }
}