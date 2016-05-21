<form action="index.php?action=busqueda" method="post">
	<fieldset id="busquedaAv">	
		<p class="precio">
	
			PRECIO MAXIMO:
			<input  id="precmin" type="number" name="precioMax" min="0" step="5" value="0">  €
					
		</p>
		<p>
			BUSQUEDA POR LETRAS:
			<select name="letras">
				<option value="" selected> Todas </option>
				<option value="a"> A </option>
				<option value="b"> B </option>
				<option value="c"> C </option>
				<option value="d"> D </option>
				<option value="e"> E </option>
				<option value="f"> F </option>
				<option value="g"> G </option>
				<option value="h"> H </option>
				<option value="i"> I </option>
				<option value="j"> J </option>
				<option value="k"> K </option>
				<option value="l"> L </option>
				<option value="m"> M </option>
				<option value="n"> N </option>
				<option value="o"> O </option>
				<option value="p"> P </option>
				<option value="q"> Q </option>
				<option value="r"> R </option>
				<option value="s"> S </option>
				<option value="t"> T </option>
				<option value="u"> U </option>
				<option value="v"> V </option>
				<option value="w"> W </option>
				<option value="y"> Y </option>
				<option value="z"> Z </option>
				<option value="1-9"> 1 - 9 </option>
			</select>
		</p>
		<p>
			GENERO:
			<select name="nombreGenero">
				<option value="" selected> Todos </option>
				<option value="1"> Acción </option>
				<option value="2"> Aventura </option>
				<option value="3"> Casual </option>
				<option value="4"> Acceso Anticipado </option>
				<option value="5"> Gratuito </option>
				<option value="6"> Indie </option>
				<option value="7"> Multijugador Masivo </option>
				<option value="8"> Carreras </option>
				<option value="9"> Simulación </option>
				<option value="10"> Rol </option>
				<option value="12"> Estrategia </option>
				<option value="13"> Deportes </option>
				<option value="11"> Otro </option>
	  		</select>
	  	</p>	
	  	<p>
			DESARROLLADOR:
			<input type="text" name="desarrollador">
	  	</p>
		<P>VALORACION: </P>
		<p class="clasificacion">
   			<input id="radio1" type="radio" name="estrellas" value="5">
    		<label for="radio1">&#9733;</label>
    		<input id="radio2" type="radio" name="estrellas" value="4">
  			<label for="radio2">&#9733;</label>
   			<input id="radio3" type="radio" name="estrellas" value="3">
   			<label for="radio3">&#9733;</label>
  			<input id="radio4" type="radio" name="estrellas" value="2">
   			<label for="radio4">&#9733;</label>
  			<input id="radio5" type="radio" name="estrellas" value="1">
  			<label for="radio5">&#9733;</label>
  		</p>
		<p class="inicioBusq">
			<input type="submit" value="Buscar juego">
		</p>
	</fieldset>
</form>