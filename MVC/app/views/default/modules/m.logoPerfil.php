<div id="imgPerfil">
			
				<img src="IMAGENES/perfil.jpg" id="fotoPerfil" alt="fotoPerfil"> 

			</div>

			<div id="nick">
			
				
					<?php
					session_start();

					if($_SESSION["nombreusuario"]==false){
					sleep(0);
     				header ("Location: index.php?action=conectarse");
     				}
					echo '<div class="nick2">' . "Nombre Usuario:  " .  $_SESSION["nombreusuario"] . '</div>';
					
					if ($_SESSION["Privacidad"]=="Si") {
					
					echo '<div class="nick2">';
					echo  "Email:  " . $_SESSION["email"];
					echo '</div>';
					
					echo '<div class="nick2">';
					echo "Id-Steam:  " . $_SESSION["idsteam"];
					echo '</div>';
					}
				?>
			


    		</div>