


function verifPseudo(champ)
{  
   if((champ.value.length < 2) || (document.f.pseudo.value.length > 8))
   {
      champ.style.backgroundColor = "#fba";
      return false ; 
   }
   else
   {
      champ.style.backgroundColor = "";  
      return true;   }
}

function verifage(champ)
{
   var age = parseInt(champ.value);
   if(isNaN(age) || age < 5 || age > 110)

   {
      champ.style.backgroundColor = "#fba";
      return false;
   }
   else
   {
      champ.style.backgroundColor = "";
      return false;
   }
}


function veriftel(champ)
{
   var tel = parseInt(champ.value);
   if(isNaN(tel) || champ.value.length!=10 || champ.value[0]!=0 )

   {
           champ.style.backgroundColor = "#fba";
      return false;
   }
   else
   {
           champ.style.backgroundColor = "";
      return true;
   }
}




function verifForm(f)
{
   var pseudoOk = verifPseudo(f.pseudo);
   var telOk = veriftel(f.tel);
   var ageOk = verifage(f.age);
   
 
   if(pseudoOk && telOk && ageOk)
      {return true;}
   else
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
}

