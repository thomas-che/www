// function nbAleatoire(){
// 	var nb = Math.floor(Math.random()*9)+1;
// 	return nb;
// }

// function afficheOp(){
// 	var nb1 = nbAleatoire();
// 	var nb2 = nbAleatoire();
// 	document.write(''+nb1+' x '+nb2+' = ');
// 	return [nb1,nb2];
// }

// afficheOp=afficheOp();

// var nb1=afficheOp[0];
// var nb2=afficheOp[1];

function verifierFnc(){
	var res=document.forms['calcul'].elements['inputtxt'].value;
	if (isNaN(res)){
		alert('format incorect');
		document.forms['calcul'].elements['inputtxt'].style.backgroundColor='red';
		document.forms['calcul'].elements['inputtxt'].value='';
		document.forms['calcul'].elements['inputtxt'].focus();
	}
	else {
		var resOrdi=eval(nb1*nb2);
		if (resOrdi == res){
			alert('bravo');
			document.location.href="ex4.html";
		}
		else{
			document.forms['calcul'].elements['inputtxt'].style.backgroundColor='red';
			alert('tu es nul !!');
			document.forms['calcul'].elements['inputtxt'].value='';
			document.forms['calcul'].elements['inputtxt'].focus();
		}
	}
}