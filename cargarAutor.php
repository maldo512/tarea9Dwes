<?php
$salida = "";
$salida_libro = "";
if (isset($_GET["q"])){
	$nombre = $_GET["q"];
	/**
	*Conecto con el servidor, en estas lineas, el primer paso es buscar el autor, de esa busqueda *obtengo la informacion del autor y con el id del autor vuelvo a realizar una consulta SQL
	*Con la segunda colsulta obtengo todos los datos de los libros.
	*/
	$mysqli = new mysqli("localhost", "otro", "otro", "foc3");
	if (!$mysqli->connect_error){
		$mysqli->set_charset("utf8");

		$sql = "SELECT * FROM autor WHERE nombre LIKE '%$nombre%' ORDER BY nombre";

		if ($resultado = $mysqli->query($sql)){
			//Trabajar con datos del autor
			while ($fila = $resultado->fetch_assoc()){
			//Procesar result set como asociativo
				$salida = $salida . "<br>". $fila["nombre"]. " " .$fila["apellidos"] ;
				$id = $fila ["id"];
				$sql_libro = "SELECT * FROM Libro WHERE id_autor LIKE '%$id%' ORDER BY titulo";
				if ($resultado_libro = $mysqli->query($sql_libro)){
						//Trabajar con datos de los libros y los devuelvo
						while ($fila = $resultado_libro->fetch_assoc()){
						//Procesar result set como asociativo
							$salida_libro = $salida_libro . "<br>". $fila["titulo"];
							}

						$resultado_libro->free();
						
				}

				
			}
			$resultado->free();
			$mysqli->close();
			
		}

	}
}
/**Muestro los datos del autor*/
echo $salida;
echo "<h3>Libros cargados con json</h3>";
/** muestro los datos de los libros en Json*/
echo json_encode($salida_libro);
echo "<h3>Libros cargados </h3>";
/**Muestro los datos de los libros*/
echo $salida_libro;	
?>