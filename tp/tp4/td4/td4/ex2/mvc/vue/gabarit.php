<!DOCTYPE html>
<html lang="fr">
    <head>
      <title>Ma page</title>
      <meta charset="utf-8">
	  <link rel="stylesheet"  href="vue/style/style.css" />
	  
    </head>
    
	<body>	
	    <header>
	        <div class="logo">		<img src="vue/image/logo.png"/>   </div>
	    	<nav>
				<ul>
					 <li> Catalogues des produits </li>
					 <li> Promotions du moments</li>
					 <li> Service après vente </li> 
					<li>  Contact</li>	 

				</ul>
		    </nav>
		    <div class="icone">   
			   <img src="vue/image/img.jpg" usemap="#icone"/>		
			       <map name="icone">
			  		 <area shape="rect" coords="0,0,30,60" href="http://www.google.fr"  />
					 <area shape="rect" coords="51,0,80,60" href="https://mail.google.com" />
					 <area shape="rect" coords="91,0,110,60" href="https://twitter.com/" />
					 <area shape="rect" coords="141,0,150,60" href="http://www.facebook.fr" />
					 <area shape="rect" coords="171,0,190,60" href="https://plus.google.com" />
					 <area shape="rect" coords="211,0,240,60" href=" " />
				   </map>
		    </div>	
	    </header>
	
	    <aside>
			
	 		<div class="bulle">
				<article>   
					<h5> Promotion Apple ! </h5>
			        <div class="image">	 <img src="vue/image/mac.jpg"/> </div> 
			   		<p>
					<strong> Apple MacBook Pro 13,3'' LED 500 Go 4 Go RAM Intel Core i5 bicœur à 2,5 GHz SuperDrive MD101. A partir de 1000 Euros.  </strong>
				    </p> 
				 
			    </article>
		 	</div>	
		
				
		    <div class="bulle">
			    <article>   
			         <h5> Arrivage disques durs </h5>
			         <div class="image">  <img src="vue/image/dd.jpg"/>	</div> 
			    	<p><strong> Arrivage de plusieurs 2To Western Digital, Lacie, Maxtor. Garantie 2 ans et éxtensible à 5 ans. 149,90 Euros.   </strong></p> 
				</article>
			</div>
		
		    <div class="bulle">
			   	 <article>   
			           <h5> Destockage clé usb </h5>
			           <div class="image"> <img src="vue/image/cleusb.jpg"/>	</div> 
			     	   <p><strong> Promotion du moment : une clé USB offerte pour tout achat supérieur à 100 Euros. Saisir le code PXSDEZSC.  </strong></p> 
				 </article>
			</div>
		
		<div class="bulle">
				<article>   
			          <h5> -30% sur les cartes SD </h5>
			          <div class="image"> <img src="vue/image/sd.jpg"/> </div> 
			      	  <p><strong> Toutes nos cartes SD et micro SD sont affichées à -30%. Plusieurs granques marques disponibles : Kingstom, sanDisk, Samsung. </strong></p> 
				</article>
	     </div>
	  </aside>
	
	<div class="centrale">


 <form name="ajouter" id="monForm"  action="site.php" method="post">
 <fieldset>
        <legend> Ajouter un client </legend>
  <p><label>  Nom : </label> <INPUT type="input" name="n" /></p> 
  <p> <label>  Prenom : </label> <INPUT type="input" name="p" /></p>
  <p> <label>  Date de naissance : </label> <INPUT type="input" name="d" /></p>
  <p> <label>  Tel : </label> <INPUT type="input" name="t" /></p>
  <p> <label class="pas_de_style"> &nbsp; </label>
    <INPUT type="submit" value="Ajouter client" name="boutonAjouter" />
	 <INPUT type="reset" value="Tout effacer" name="f1" /></p>
</fieldset>  
</form>


<!-- un formulaire pour chercher les clients -->
 <form name="chercher" id="monForm"  action="site.php" method="post">
 <fieldset>
   <legend> Recherche d un client </legend>
  <p><label>  Nom du client :  </label>  <INPUT type="input" name="nomCl" /></p>
 <p> <label class="pas_de_style"> &nbsp; </label> 
     <INPUT type="submit" value="Chercher" name="boutonRechercher" /> 
     <INPUT type="reset" value="Tout effacer" name="f1" /></p>
	 </fieldset>
</form>


<!-- un formulaire pour afficher les clients -->
<form name="afficher" id="monForm"  action="site.php" method="post">
<fieldset>
   <legend> Afficher tous les clients </legend>
  <p> <label class="pas_de_style"> &nbsp; </label>  
   <INPUT type="submit" value="Afficher " name="boutonAfficher" /> 
 </p>
</fieldset> 
 </form>

<?php echo $contenuAffichage; ?>
  
    </div>

    <footer>
	
    </footer>	

  </body>

 </html>
 