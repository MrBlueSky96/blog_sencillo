<?php

include_once "../modelo/Objeto_Blog.php";

include_once "../modelo/Manejo_Objetos.php";

try {
    $miConexion = new PDO('mysql:host=localhost; dbname=bbddblog', 'root', '');
    $miConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_FILES['imagen']['error']) {

        switch ($_FILES['imagen']['error']) {

            case 1:

                echo "El tamaño del archivo supera el límite permitido por el servidor (upload_maz_size de php.ini)";

                break;

            case 2:

                echo "El tamaño del archivo supera lo permitido por el form (post_max_size de php.ini)";

                break;

            case 3:

                echo "El envío del archivo se ha interrumpido durante la trasmisión";

                break;

            case 4:

                echo "El tamaño del archivo es nulo o no se ha enviado el archivo";

                break;

        }

    } else {

        echo "No hay error en la transferencia del archivo. <br/>";

        if((isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK))){

            $destino_de_ruta='../imagenes/';

            move_uploaded_file($_FILES['imagen']['tmp_name'], $destino_de_ruta . $_FILES['imagen']['name']);

            echo "El archivo " . $_FILES['imagen']['name'] . " se ha copiado en el directorio de imágenes.";

        }else {

            echo "El archivo no se ha copiado en el directorio de imágenes";
    
        }

    }


    $manejo_objetos=new Manejo_Objetos($miConexion);

    $blog=new Objeto_Blog();

    $blog->setTitulo(htmlentities(addslashes($_POST["campo_titulo"]), ENT_QUOTES));

    $blog->setFecha(Date("Y-m-d H:i:s"));

    $blog->setComentario(htmlentities(addslashes($_POST["area_comentarios"]), ENT_QUOTES));

    $blog->setImagen($_FILES["imagen"]["name"]);



    $manejo_objetos->insertaContenido($blog);

    echo "<br/> Entrada de blog agregada con éxito <br/>";



} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
