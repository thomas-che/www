// CORRECTION

function num2Letters(number) {

    if (isNaN(number) || number < 0 || 999 < number) {
        return 'Veuillez entrer un nombre entier compris entre 0 et 999.';
    }

    var units2Letters = ['', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf'],
        tens2Letters = ['', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante', 'quatre-vingt', 'quatre-vingt'];

    var units = number % 10,
        tens = (number % 100 - units) / 10,
        hundreds = (number % 1000 - number % 100) / 100;

    var unitsOut, tensOut, hundredsOut;

    if (number === 0) {
        return 'zéro';
    } else {

        // Traitement des unités
        unitsOut = (units === 1 && tens > 0 && tens !== 8 ? 'et-' : '') + units2Letters[units];

        // Traitement des dizaines
        if (tens === 1 && units > 0) {
            tensOut = units2Letters[10 + units];
            unitsOut = '';
        } else if (tens === 7 || tens === 9) {
            tensOut = tens2Letters[tens] + '-' + (tens === 7 && units === 1 ? 'et-' : '') + units2Letters[10 + units];
            unitsOut = '';
        } else {
            tensOut = tens2Letters[tens];
        }
        tensOut += (units === 0 && tens === 8 ? 's' : '');

        // Traitement des centaines
        hundredsOut = (hundreds > 1 ? units2Letters[hundreds] + '-' : '') + (hundreds > 0 ? 'cent' : '') + (hundreds > 1 && tens == 0 && units == 0 ? 's' : '');

        // Retour du total
        return hundredsOut + (hundredsOut && tensOut ? '-' : '') + tensOut + (hundredsOut && unitsOut || tensOut && unitsOut ? '-' : '') + unitsOut;
    }
}

var userEntry;
while (userEntry = prompt('Indiquez le nombre à écrire en toutes lettres (entre 0 et 999) :')) {
    alert(num2Letters(parseInt(userEntry, 10)));
}




// moi ne fonctione pas avec 78 93 ect

var text,number,longeurNb,tabNb;
text=prompt('entre nb 0-999');


function conv(text){
	number=parseInt(text);
	if (!isNaN(number)){
		longeurNb=parseInt(number.toString().length);
		tabNb={centaine:0,dixaine:0,uniter:0};
		tabNb['uniter']=number%10;
		tabNb['dixaine']=(number%100-tabNb['uniter'])/10;
		tabNb['centaine']=(number%1000-tabNb['dixaine']*10-tabNb['uniter'])/100;
		console.log(tabNb);
		var uniterStr,dixaineStr,centaineStr,uniterTab,dixaineTab;
		uniterTab=['', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf'];
		dixaineTab=['', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante', 'quatre-vingt', 'quatre-vingt'];
		if (number===0){
			return'zero';
		}
		else{
			if (tabNb['dixaine']===1 && 0<tabNb['uniter']){
				dixaineStr=uniterTab[tabNb['dixaine']*10+tabNb['uniter']];
				uniterStr=uniterTab[0];
			}
			else {
				if (tabNb['dixaine']===7 || tabNb['dixaine']===9){
					dixaineStr=dixaineTab[tabNb['dixaine']]+'-'+uniterTab[tabNb['dixaine']*10+tabNb['uniter']];
				}
				else {
					if (tabNb['centaine']!==0){
						centaineStr=uniterTab[tabNb['centaine']]+'-cents';
						if (tabNb['centaine']===1){
							centaineStr='Cent';
						}
					}
					else {
						centaineStr=uniterTab[0];
					}
					uniterStr=uniterTab[tabNb['uniter']];
					dixaineStr=dixaineTab[tabNb['dixaine']];
				}
				uniterStr=uniterTab[0];
				if (tabNb['centaine']!==0){
					centaineStr=uniterTab[tabNb['centaine']]+'-cents';
					if (tabNb['centaine']===1){
						centaineStr='Cent';
					}
				}
				else {
					centaineStr=uniterTab[0];
				}
			}
			return centaineStr+'-'+dixaineStr+'-'+uniterStr;
		}
	}
	else{
		alert('vous n avez pas renter un nb');
	}
}

alert(conv(text));