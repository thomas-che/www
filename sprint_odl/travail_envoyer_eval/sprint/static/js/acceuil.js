/*#############################*/
/*                             */
/*                             */
/*         CONNEXION           */ // clemence
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
function checkForm(form){
    if(checkNotEmpty(form.login)&&checkNotEmpty(form.mdp)){
        return true ;
    }else{
        alert('Toutes les conditions ne sont pas remplies');
        return false ;
    }
}

