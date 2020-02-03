var mainDiv = document.createElement('div');
mainDiv.id = 'divTp3';

var tab = [ document.createTextNode('Langages basés sur ECMAScript :'),
			document.createTextNode('JavaScript'),
			document.createTextNode('JavaScript est un langage de programmation de scripts principalement utilisé dans les pages web interactives mais aussi coté serveur.'),
			document.createTextNode('JScript est le nom générique de plusieurs implémentations d\'ECMAScript 3 créées par Microsoft.'),
			document.createTextNode('ActionScript'),
			document.createTextNode('ActionScript est le langage de programmation utilisé au sein d\'applications clientes (Adobe Flash, Adobe Flex) et serveur (Flash media server, JRun, Macromedia Generator).'),
			document.createTextNode('EX4'),
			document.createTextNode('ECMAScript for XML (E4X) est une extension XML au langage ECMAScript.'),
			];

var p = document.createElement('p');

var	dl = document.createElement('dl');
var	dt1 = document.createElement('dt');
var	dt2 = document.createElement('dt');
var	dt3 = document.createElement('dt');
var	dt4 = document.createElement('dt');
var	dd1 = document.createElement('dd');
var	dd2 = document.createElement('dd');
var	dd3 = document.createElement('dd');
var	dd4 = document.createElement('dd');

p.appendChild(tab[0]);
dl.appendChild(p);

dt1.appendChild(tab[1]);
dl.appendChild(dt1);
dd1.appendChild(tab[2]);
dl.appendChild(dd1);

dt2.appendChild(tab[1]);
dl.appendChild(dt2);
dd2.appendChild(tab[3]);
dl.appendChild(dd2);


dt3.appendChild(tab[4]);
dl.appendChild(dt3);
dd3.appendChild(tab[5]);
dl.appendChild(dd2);


dt4.appendChild(tab[6]);
dl.appendChild(dt4);
dd4.appendChild(tab[7]);
dl.appendChild(dd4);


mainDiv.appendChild(dl);

document.body.appendChild(mainDiv);