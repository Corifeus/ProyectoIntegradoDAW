<?php
	
	session_start();

	$nombreUsuario=$_SESSION["nombreusuario"];

		include("mysqli.inc.php");

		if($c = mysqli_connect($cfg_servidor,$cfg_usuario,$cfg_password,$cfg_basephp1))
		{






			#SACAR LOS FAVORITOS
			$tabla="favoritos";

			$sentencia='select j.Nombre from favoritos f,usuario u,juego j where f.Id_Usuario=u.Id_Usuario and j.Id_Juego=f.Id_Juego 
			and u.Nombre="' . $nombreUsuario. '"';

			if(mysqli_query($c,$sentencia))
			{

			$resultado=mysqli_query($c,$sentencia);

				while($objeto=mysqli_fetch_object($resultado))
				{

						$arrayFavorito[]=$objeto;
				}
			}

			echo "<h1>Lista de juegos favoritos de " . $nombreUsuario . "</h1>";
			foreach ($arrayFavorito as $key => $value) {
				echo "<br>$value->Nombre<br>";
			}



			#SACAR LA BIBLIOTECA
			$tabla="biblioteca";

			$sentencia='select j.Nombre from biblioteca b,usuario u,juego j where b.Id_Usuario=u.Id_Usuario and j.Id_Juego=b.Id_Juego and 
			u.Nombre="' . $nombreUsuario . '"';

			if (mysqli_query($c,$sentencia)) 
			{
				$resultado=mysqli_query($c,$sentencia);

				while($objeto=mysqli_fetch_object($resultado))
				{

						$arrayFavorito[]=$objeto;
				}

			}

			echo "<h1>Juegos Adquiridos por ". $nombreUsuario . "</h1>";
			foreach ($arrayFavorito as $key => $value) {
				echo "<br>$value->Nombre<br>";
			}





		}
?>