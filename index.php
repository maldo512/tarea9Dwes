<!DOCTYPE html>
<html>
<!-- Versión 1.0 -->
<head>
	<style>
	  		@import url("estilo.css"); 
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	
	<script>
		
		function validar(){
				var okText = validartext();
				if(okText )
				  return true;
				return false;
			  }
			// funcion para validar el campo texto
			function validartext(){
				var ok = true; // con ok recogemos un valor boolean
				var msgError = ""; //recogemos el mensaje un cada uno de los casos
				var texto = document.getElementById("texto").value; // recogemos el valor para la validacion
				var divUsuario = document.getElementById("divtext"); // recoge el evento que sucedera en caso negativo
				var error = document.getElementsByClassName("error")[0]; //recoge el mensaje de error
				divtext.style.border = "";
				error.innerHTML = "";
				if(texto.length == 0){  // Comprobamos que el campo no esté vacío 
				  ok = false;
				  msgError = "Este campo no puede estar vacío";
				}
				else
				 	if(/^\s+$/.test(texto)){  // Comprobamos que no esté compuesto sólo por espacios en blanco
					 ok = false;
					 msgError = "Este campo no puede contener sólo espacios en blanco";
				  	}
				  	else{
						if(/^([a-z])$/.test(texto)){   // Si está compuesto por letras minusculas
							  ok = true;
						}
						else {
							   ok = false;
							   msgError = "Este campo no puede contener MAYUSCULAS";
						}
					}
				if(!ok){
				   divtext.style.border = "2px solid red";
				   error.innerHTML = msgError;
				   return false;
				}
				return true;
			  }
		
		
		$(document).ready(function(){
			$("#texto").keyup(function(){
				$("#sugerencias").load("cargarAutor.php?q=" + $("#texto").val());
			});
		});
		
	
	</script>
</head>
<body>
	<p><b>Búsqueda de Autor y todos sus libros:</b></p>
	<form action="" onsubmit="return validar()">
		<!--
		Cada vez que tecleamos algo en este field se ejecutará mostrar_sugerencias
		-->
		<div id="divtext">
			<label>Autor:</label> 
			<input type="text" id="texto">
			<label class="error"></label>
	  	</div>
		<div>
        	<input type="submit" value="Validar" id="boton"/>
	  	</div>
	</form>
	<!-- En el span con id="sugerencias" mostraremos las coincidencias -->
	<p><strong>Sugerencias:</strong> <span id="sugerencias" style="color: #0080FF;"></span></p>
</body>
</html>

