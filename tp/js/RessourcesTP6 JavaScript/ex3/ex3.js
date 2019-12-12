function toUpperFnc(){
	var lowerCase = document.forms['case'].elements['lowerCase'].value ;
	document.forms['case'].elements['upperCase'].value =  lowerCase.toUpperCase();
}

function prixTTCFnc(){
	var prixHT = document.forms['prix'].elements['prisHT'].value ;
	var prixTTC = eval(prixHT*eval(1+19.6/100) ) ;
	document.forms['prix'].elements['prixTTC'].value = prixTTC;
}

function moyenneFnc(){
	var ds1 = document.forms['moyenne'].elements['noteDS1'].value;
	var ds2 = document.forms['moyenne'].elements['noteDS2'].value;
	var ds3 = document.forms['moyenne'].elements['noteDS3'].value;
	var moy = eval((ds1/20+ds2/20+ds3/20)/3 * 20);
	document.forms['moyenne'].elements['moyenne'].value = moy ;
}