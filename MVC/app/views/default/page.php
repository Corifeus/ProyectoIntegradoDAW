<!DOCTYPE html>
<html>
	
	<head>
		 
		<meta charset="utf-8">
    	<title>#TITULO#</title>
		
		#CSS#
		
		<script src='https://www.google.com/recaptcha/api.js'></script>
		
	</head>

	<body>

		<header>

			#LOGO#

			<div id="buscador">
			
				<form action="index.php?action=busqueda" method="post" class="search-wrapper cf">
        		
        			<input type="text" name="nombre" placeholder="Busca tu juego" required="">
        			
        			<button type="submit"> BUSCAR </button>

    			</form>

    		</div>

    		<nav>
    		
    			<div class="menuElement"> 

					<a href="index.php?action=inicio"> INICIO </a>

				</div>
			
				<div class="menuElement">
				
					<a href="index.php?action=genero"> GENERO </a>

				</div>
			
				<div class="menuElement"> 

					<a href="index.php?action=avanzada"> BUSQUEDA AVANZADA </a>

				</div>

				<div class="menuElement"> 

					#SESION#
			
				</div>
			
    		</nav>

		</header>

		#CONTENIDO#
		<footer>
			

			<div class="apartado">
			
			<p> REDES SOCIALES</p>

			

			<div id="redes">
			
			<img src="app/views/default/images/twitter.png" alt="twitter" class="imgFooter">

			<img src="app/views/default/images/facebook.png" alt="facebook" class="imgFooter">
			
			</div>

			</div>


			<div class="apartado">
			
			<p> COLABORACIONES </p>

			

			<div id="redes">
			
				<a href="http://store.steampowered.com/">
					<img src="app/views/default/images/tienda1.png" alt="twitter" class="imgFooter">
				</a>
				<a href="http://www.gamersgate.com/">
					<img src="app/views/default/images/tienda2.png" alt="twitter" class="imgFooter">
				</a>
				<a href="http://www.funstockdigital.co.uk/">
					<img src="app/views/default/images/tienda3.png" alt="facebook" class="imgFooter">
				</a>
				<a href="https://www.gamesrocket.es/">
					<img src="app/views/default/images/tienda4.png" alt="facebook" class="imgFooter">
				</a>

			</div>

			</div>


		</footer>
	</body>

</html>