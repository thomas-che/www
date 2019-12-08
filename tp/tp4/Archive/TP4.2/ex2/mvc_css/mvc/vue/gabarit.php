<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" media="screen and (max-width: 769px)" href="style768.css" />
        <title>formulaire + css</title>
    </head>
    
	<body>
		
			<header>
				

				<div class="logo">
					<img src="logo.bmp" title="logo" alt="image du logo" />
				</div>	

				<nav>
					<ul>
						<li><a href="#catalogue">catalogue des produits</a></li>
						<li><a href="#promo">promotions du moment</a></li>
						<li><a href="#service">service après vente</a></li>
						<li><a href="#contact">contact</a></li>
					</ul>			
				</nav>


				<div class="icone">

					<img src="img.bmp" alt="photo pr resaux sosiaux" usemap="#resaux">
						<map>
							<area shape="rect" coords="0,0,247,58" href="http://www.google.com">
							<area shape="rect" coords="247,0,494,58" href="http://www.google.com">
							<area shape="rect" coords="494,0,741,58" href="http://www.google.com">
							<area shape="rect" coords="741,0,988,58" href="http://www.google.com">
							<area shape="rect" coords="988,0,1235,58" href="http://www.google.com">
						</map>

				</div>
			</header>


			<section>
				<aside>
					<article class="bulle">
						<h5>Promotion Apple !</h5>
						<div class="image">
							<img src="mac.jpg">
						</div>
						<p> 
							<strong>Apple MacBook Pro 13,3'' LED 500 Go 4 Go RAM Intel Core i5 bicœur à 2,5 GHz SuperDrive MD101. A partir de 1000 Euros. 
							</strong>
						</p>
					</article>

					<article class="bulle">
						<h5>Arrivage disques durs</h5>
						<div class="image">
							<img src="dd.jpg">
						</div>
						<p> 
							<strong>Arrivage de plusieurs 2To Western Digital, Lacie, Maxtor. Garantie 2 ans et éxtensible à 5 ans. 149,90 Euros. 
							</strong>
						</p>
					</article>

					<article class="bulle">
						<h5>Destockage clé usb</h5>
						<div class="image">
							<img src="cleusb.jpg">
						</div>
						<p> 
							<strong>Promotion du moment : une clé USB offerte pour tout achat supérieur à 100 Euros. Saisir le code PXSDEZSC. 
							</strong>
						</p>
					</article>

					<article class="bulle">
						<h5>-30% sur les cartes SD</h5>
						<div class="image">
							<img src="sd.jpg">
						</div>
						<p> 
							<strong>Toutes nos cartes SD et micro SD sont affichées à -30%. Plusieurs granques marques disponibles : Kingstom, sanDisk, Samsung. 
							</strong>
						</p>
					</article>

				</aside>
			</section>

			<section>
				<div class="centrale">


					<?php echo $displayContents ; ?>


	    		</div>
			</section>

			<footer>
				<p>copyright : @thomas</p>
			</footer>
    </body>
</html>
 