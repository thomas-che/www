


function afficher(T) {
  document.write('<table id="tab" ><TR>');
  for (var i=0; i<10; i++) document.write("<td>",T[i],"</td>");
  document.write('</tr></table>');
 }


function remplire(T){
  for (var i=0; i<10; i++) T[i]=Math.floor(Math.random()*100);
  }

function f(a,b) {
 if (eval(a)<eval(b)) return -1;
 else if (eval(a)>eval(b)) return 1;
 else return 0;
}

