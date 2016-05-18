<form method="post" action="http://testformularios.azurewebsites.net/form" enctype="application/x-www-form-urlencoded">

			<fieldset id="busquedaAv">	
					
					<p class="pform">
						<label>
							PRECIO MAXIMO:
							<input type="number" name="preciomaximo" value="preciomaximo" min="0" tabindex=3>
						</label>
					</p>
					
					<p class="pform">
						<label>
							PRECIO MINIMO:
							<input type="number" name="preciominimo" value="preciominimo" min="0" tabindex=4>
						</label>
					</p>

					<p class="pform">
						
						<label>
						BUSQUEDA POR LETRAS:

						<select>
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

					</label>
						<P>VALORACION: </P>
						<div class="ec-stars-wrapper">
						<a href="#" data-value="1" title="Votar con 1 estrellas">&#9733;</a>
						<a href="#" data-value="2" title="Votar con 2 estrellas">&#9733;</a>
						<a href="#" data-value="3" title="Votar con 3 estrellas">&#9733;</a>
						<a href="#" data-value="4" title="Votar con 4 estrellas">&#9733;</a>
						<a href="#" data-value="5" title="Votar con 5 estrellas">&#9733;</a>
						</div>
					</label>

					</p>

					<p class="inicioBusq">
						<input type="submit" value="Bucar juego">
					</p>
			</fieldset>
		</form>