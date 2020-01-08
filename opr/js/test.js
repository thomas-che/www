var newLink = document.createElement('a');
var newLinkText = document.createTextNode("Le Site du Zéro");

newLink.id = 'sdz_link';
newLink.href = 'http://www.siteduzero.com';
newLink.title = 'Découvrez le Site du Zéro !';
newLink.setAttribute('tabindex', '10');

newLink.appendChild(newLinkText);
document.getElementById('myP').appendChild(newLink);

// On va cloner un élément créé :
var hr1 = document.createElement('hr');
var hr2 = document.createElement('hr').cloneNode(false); // Il n'a pas d'enfants…

// Ici, on clone un élément existant :
var paragraph1 = ;
var paragraph2 = document.getElementById('myP').cloneNode(true);

// Et attention, l'élément est cloné, mais pas « inséré » tant que l'on n'a pas appelé appendChild() :
paragraph1.parentNode.appendChild(paragraph2);

var link = document.querySelector('a');
var newLabel = document.createTextNode('et un hyperlien');
link.replaceChild(newLabel, link.firstChild);

var paragraph = document.querySelector('p');
alert(paragraph.hasChildNodes()); // Affiche true