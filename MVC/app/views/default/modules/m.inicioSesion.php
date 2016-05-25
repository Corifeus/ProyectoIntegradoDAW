<section>				
	<div id="container_demo" >
		<a class="hiddenanchor" id="toregister"></a>
		<a class="hiddenanchor" id="tologin"></a>
		<div id="wrapper">
			<div id="login" class="animate form">
        		<form  action="index.php?action=perfil" autocomplete="on" method="post"> 
			     		<p> 
                <label for="username" class="uname" data-icon="" > Escribe tu nombre o tu usuario </label>
                <input id="username" name="nombre" required="required" type="text" placeholder="Nombre de usuario"/>
              </p>
             	<p> 
             		<label for="password" class="youpasswd" data-icon=""> Contraseña </label>
               	<input id="password" name="contrasenya" required="required" type="password" placeholder="*******" /> 
             	</p>
             	<p class="login button"> 
               	<input type="submit" value="Iniciar Sesión" /> 
    					</p>
             	<p class="change_link">
		    				Enserio, ¿no estás registrado?
						    <a href="#toregister" class="to_register">Registrate</a>
					    </p>
            </form>
      </div>
      <div id="register" class="animate form">
          <form  action="index.php?action=registrarse" autocomplete="on" method="post"> 
                   	<p> 
                     	<label for="usernamesignup" class="uname" data-icon="">Nombre de usuario</label>
                     	<input id="usernamesignup" name="nombre_usuario" required="required" type="text" placeholder="misupernombre" />
                    </p>
                    <p> 
                 		  <label for="emailsignup" class="youmail" data-icon="" > Correo electrónico</label>
                   	  <input id="emailsignup" name="email" required="required" type="email" placeholder="micorreo@mail.com"/> 
                    </p>
                    <p> 
                     	<label for="passwordsignup" class="youpasswd" data-icon="">Contraseña </label>
                     	<input id="passwordsignup" name="contrasenya" required="required" type="password" placeholder="*******"/>
                 	  </p>
          		      <p> 
                    	<label for="idsteam" class="idsteam" data-icon="">Id-Steam </label>
                   	  <input id="steam" name="idsteam" type="text" placeholder="(opcional)"/>
                    </p>
              <div class="control-group ">
          	      <input type="checkbox" name="privacidad" value="permisos"> Acepto que mi perfil sea publico
                 	
                  <p class="signin button"> 
                    
        	       		<input type="submit" value="Registrarse"/> 
        			   	</p>
                  
                  <p class="change_link">  
        				     ¿Ya eres usuario?
        				     <a href="#tologin" class="to_register"> Empezar </a>
        				  </p>
                  <p>
                    <div class="g-recaptcha" data-sitekey="6Ldk3SATAAAAAPqH8zvPrJK-f8FZmdNzAVmDl4H1"></div>
                  </p>
      	</form>
               	</div>		
            </div>
        </div>  
    </div>
</section>