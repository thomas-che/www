
/*#############################*/
/*                             */
/*                             */
/*            RDV              */ // thomas
/*                             */
/*                             */
/*#############################*/

function highlights(path,error){
    if(error){
        path.style.backgroundColor = "" ;
        return true ;
    }else{
        path.style.backgroundColor = "#fba" ;
        return false;
    }
}
function checkNotEmpty(path){
    if(path.value.length > 0){
         return highlights(path,true);
    }else{
        return highlights(path,false);
    }
}

function checkNss(path){
    if( checkNotEmpty(path) && 14<path.value.length &&  path.value.length<16){
         return highlights(path,true);
    }else{
        return highlights(path,false);
    }
}

function checkForm(form){
    if( checkNss(form.nss) && checkNotEmpty(form.doctorName) && checkNotEmpty(form.specialize) && checkNotEmpty(form.dateFuturAppointment) && checkNotEmpty(form.hoursFuturAppointment) && checkHour(form.hoursFuturAppointment)){
        return true ;
    }else{
        alert('Toutes les conditions ne sont pas remplies');
        return false ;
    }
}

function checkHour(path){
    var futurDate = getElementById('dateFuturAppointment');
    var date= new Date();

    var year=date.getFullYear();
    var month=date.getMonth();
    var day= date.getDate();

    var d=year+'-'+month+'-'+day;

    var hours= date.getHours();
    hours+=':00';
    if(d==futurDate && path.value<=hours){
        highlights(path,false);
        alert('Ne peux pas choisir une heure inferieur ou egal a l heure actuel');
        return false;
    }
    else{
        return true;
    }
}

function addAppointmentSuccess(form){
    if( checkNss(form.nss) && checkNotEmpty(form.doctorName) && checkNotEmpty(form.specialize) && checkNotEmpty(form.dateFuturAppointment) && checkNotEmpty(form.hoursFuturAppointment) && checkHour(form.hoursFuturAppointment)){
        alert('Rdv enregister');
        return true ;
    }else{
        alert('Toutes les conditions ne sont pas remplies');
        return false ;
    }
}

function checkPrix(path){
    if (checkNotEmpty(path)){
        var prix_into_int = parseInt(path.value);   
        if ( !isNaN(prix_into_int) && 0<path.value){
            return highlights(path,true);
        }
        else{
            return highlights(path,false);
        }
    }
    else{
        return highlights(path,false);
    }
}

function addPayementSuccess(form){
    if( checkNss(form.nss) && checkPrix(form.prix) ){
        alert('Payement realiser avec succes');
        return true ;
    }else{
        alert('Toutes les conditions ne sont pas remplies');
        return false ;
    }
}

function addDepotSuccess(form){
    if( checkNss(form.nss) && checkPrix(form.depot) ){
        alert('Depot realiser avec succes');
        return true ;
    }else{
        alert('Toutes les conditions ne sont pas remplies');
        return false ;
    }
}

/*#############################*/
/*                             */
/*                             */
/*         SYNTHESE            */ // tom
/*                             */
/*                             */
/*#############################*/

// function highlightSynthese (champ,erreur){
//     if (erreur) champ.style.backgroundColor="#fba";
//     else champ.style.backgroundColor="";
//     return !erreur;
//  }
 
// function checkNssSynthese(champ){
//     var nss=champ.value;
//     var erreur = nss.length!=15 || isNaN(nss)
//     return highlightSynthese(champ,erreur);
// }

// function checkFormSynthese(f){
//     var test=checkNssSynthese(f.nss_synthese);
//     if (!test) alert('Champ invalide');
//     return test;
// }

function highlight (champ,erreur){
    if (erreur) champ.style.backgroundColor="#fba";
    else champ.style.backgroundColor="";
    return !erreur;
 }
 
function checkNssSynthese(champ){
    var nss=champ.value;
    var erreur = nss.length!=15 || isNaN(nss)
    return highlight(champ,erreur);
}

function checkFormSynthese(f){
    var test=checkNssSynthese(f.nss_synthese);
    if (!test) alert('Champ invalide');
    return test;
}

function checkNomRechercher(champ){
    var nom=champ.value;
    var erreur = nom=="";
    return highlight(champ,erreur);
}

function checkDateRechercher(champ){
    var date=champ.value;
    var erreur = date=="";
    return highlight(champ,erreur);
}

function checkFormRechercher(f){
    var test=checkNomRechercher(f.nom_patient);
    test=checkDateRechercher(f.date_patient) && erreur;
    if (!test) alert('Un des champs est invalide');
    return test;
}

function activModif(){
    document.getElementById('nom').disabled=false;
    document.getElementById('prenom').disabled=false;
    document.getElementById('adresse').disabled=false;
    document.getElementById('numTel').disabled=false;
    document.getElementById('date').disabled=false;
    document.getElementById('dep').disabled=false;
    document.getElementById('pays').disabled=false;
    
    var noeud=document.getElementById('buttons');
    s='<input type="submit" value="Modifier" id="modifier" />';
    noeud.innerHTML=s;
}

/*#############################*/
/*                             */
/*                             */
/*         AJOUTER/MODIFIER    */ // tom
/*           PATIENT           */
/*                             */
/*#############################*/

function ajouterPays(){
   var nb=document.getElementById('departement_patient').value;
   if (nb=='99'){
      var noeudPere=document.getElementById('fds_ajouter');
      var noeudDerP=document.getElementById('derP_ajouter');
      var noeud=document.getElementById('pays_ajouter');
      if (noeud==null){
         noeud=document.createElement('div');
         noeud.id='pays_ajouter';
         noeudPere.insertBefore(noeud,noeudDerP);
      }
      noeud.innerHTML='';
      var s='<p><label>Pays de naissance : </label><input type="text" id="pays_patient" name="pays_patient" onBlur="checkTextAjouter(this)"/></p>';
      noeud.innerHTML=s;
   }
   else {
      var noeud=document.getElementById('pays_ajouter');
      if (noeud!=null) noeud.innerHTML='';
   }
}

function checkTextAjouter(champ){
    var texte=champ.value;
    var erreur = texte=="";
    return highlight(champ,erreur);
}

function checkNumTelAjouter(champ){
    var num=champ.value;
    var erreur = (num=="" || isNaN(num) || num.substring(0,1)!=0);
    return highlight(champ,erreur);
}

function checkDateAjouter(champ){
    var date=champ.value;
   if (date!=null){
      var y=parseInt(date.substring(0,4));
      var m=parseInt(date.substring(5,7));
      var d=parseInt(date.substring(8,10));
      var erreur= (isNaN(y) || isNaN(m) || isNaN(d));
   }
    else {
      var erreur=true;
   }
   return highlight(champ,erreur);
}

function checkDepartementAjouter(champ){
    var dep=champ.value;
    var erreur = dep=="";
    return highlight(champ,erreur);
}

function checkFormAjouter(f){
   var test=checkNssSynthese(f.nss);
   test=checkTextAjouter(f.nom_patient) && test;
   test=checkTextAjouter(f.prenom_patient) && test;
   test=checkTextAjouter(f.adresse_patient) && test;
   test=checkNumTelAjouter(f.num_tel_patient) && test;
   test=checkDateAjouter(f.date_patient) && test;
   test=checkDepartementAjouter(f.departement_patient) && test;
   if (f.departement_patient.value=='99'){

      test=checkTextAjouter(f.pays_patient) && test;
   }
    if (!test) alert('Un des champs est invalide');
    return test;
}

function checkFormModifier(f){
   var test=checkTextAjouter(f.nom_patient);
   test=checkTextAjouter(f.prenom_patient) && test;
   test=checkTextAjouter(f.adresse_patient) && test;
   test=checkNumTelAjouter(f.num_tel_patient) && test;
   test=checkDateAjouter(f.date_patient) && test;
   test=checkDepartementAjouter(f.departement_patient) && test;
   test=checkTextAjouter(f.pays_patient) && test;
    if (!test) alert('Un des champs est invalide');
    return test;
}