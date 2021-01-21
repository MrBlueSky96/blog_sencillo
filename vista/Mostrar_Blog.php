<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Blog sencillo</title>

<?php

include_once "../modelo/Manejo_Objetos.php";

try {

    $miConexion = new PDO('mysql:host=localhost; dbname=bbddblog', 'root', '');
    $miConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $manejo_objetos = new Manejo_Objetos($miConexion);

    $tabla_blog = $manejo_objetos->getContenidoPorFecha();

    if (empty($tabla_blog)) {

        echo "No hay entradas de blog";

    } else {

        foreach ($tabla_blog as $valor) {

            echo "<h3>" . $valor->getTitulo() . "</h3>";

            echo "<h4>" . $valor->getFecha() . "</h4>";

            echo "<div style='width:400px'>";

            echo $valor->getComentario() . "</div>";

            if ($valor->getImagen() != "") {

                echo "<img src='../imagenes/";

                echo $valor->getImagen() . "' width='300px' height='200px'/>";
            }

            echo "<hr/>";

        }

    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

?>

<br/>

<a href="Formulario.php"> Volver a la página de inserción </a>

</body>
</html>