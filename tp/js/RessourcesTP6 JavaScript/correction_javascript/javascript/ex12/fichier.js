

function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "";
}

function verifPseudo(champ)
{
   if((champ.value.length < 2) || (champ.value.length > 8))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifage(champ)
{
   var age = parseInt(champ.value);
   if(isNaN(age) || age < 5 || age > 110)

   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}


function veriftel(champ)
{
   var age = parseInt(champ.value);
   if(isNaN(age) || champ.value.length!=10 || champ.value[0]!=0 )

   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}




// function verifForm(f)
// {
//    var pseudoOk = verifPseudo(f.pseudo);
//    var telOk = veriftel(f.tel);
//    var ageOk = verifage(f.age);
   
 
//    if(pseudoOk && telOk && ageOk)
//       {return true;}
//    else
//    {
//       alert("Veuillez remplir correctement tous les champs");
//       return false;
//    }
// }

function verifForm(f)
{

   if(verifPseudo(f.pseudo) && veriftel(f.tel) && verifage(f.age))
      {return true;}
   else
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
}