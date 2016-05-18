<!DOCTYPE html>
<html>
	
	<head>
		 
		<meta charset="utf-8">
    	<title>#TITULO#</title>
		
		#CSS#

	</head>

	<body>

		<header>

			#LOGO#

			<div id="buscador">
			
				<form action="index.php?action=busqueda" class="search-wrapper cf">
        		
        			<input type="text" placeholder="Busca tu juego" required="">
        			
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
	
	</body>

</html>