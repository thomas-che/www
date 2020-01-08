function transforme(formul,source,dest) {
 var exp1=document.forms[formul].elements[source].value;

 document.forms[formul].elements[dest].value=exp1.toUpperCase(); 
}


function calcul(formul,prixht,prixttc) {
var pht=eval(document.forms[formul].elements[prixht].value);
 var pttc=pht*(1+19.6/100);
 document.forms[formul].elements[prixttc].value=pttc;
}




function calcul_moy(formu,ds1,ds2,ds3,moy) {
 var ds1=eval(document.forms[formu].elements[ds1].value);
 var ds2=eval(document.forms[formu].elements[ds2].value);
 var ds3=eval(document.forms[formu].elements[ds3].value);
 var moyenne=(ds1+ds2+ds3)/3;
 document.forms[formu].elements[moy].value=moyenne;
}
