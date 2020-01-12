
/*#############################*/
/*                             */
/*                             */
/*     CREE/MODIF LOGIN/MDP    */ // thomas
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

// ----> ne fonctione pas <----
// function checkPasswordEqual(path){
//     var $pass1=path.creatPassword.value;
//     var $pass2=path.confirmPassword.value;
//     if (checkNotEmpty(form.creatPassword) && checkNotEmpty(form.confirmPassword) && $pass1==$pass2) {
//         return highlights(path,true);
//     }
//     else{
//         alert('Mot de pass non identique');
//         return false ;
//     }
// }

function checkForm(form){
    if( checkNotEmpty(form.creatLogin) && checkNotEmpty(form.creatPassword) && checkNotEmpty(form.confirmPassword) && checkNotEmpty(form.specialize) && checkPasswordEqual(form) ){
        alert('login et mdp ajouter');
        return true ;
    }else{
        alert('Toutes les conditions ne sont pas remplies');
        return false ;
    }
}


function checkFormUpdate(form){
    if( checkNotEmpty(form.nom_employe) && checkNotEmpty(form.prenom_employe) && checkNotEmpty(form.login) ){
        alert('login et mdp ajouter');
        return true ;
    }else{
        alert('Toutes les conditions ne sont pas remplies');
        return false ;
    }
}


/*#############################*/
/*                             */
/*                             */
/*       CREE/SUP EMPLOYE      */ // clemence
/*                             */
/*                             */
/*#############################*/

function surligne(champ,erreur){
    if(erreur){
            champ.style.backgroundColor = "" ;
            return true ;
        }else{
            champ.style.backgroundColor = "#fba" ;
            return false;
        }
    }
function verif(champ){
    if(champ.value.length > 0){
             return surligne(champ,true);
        }else{
            return surligne(champ,false);
        }
    }