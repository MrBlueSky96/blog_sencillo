<?php

include_once ("Objeto_Blog.php");

class Manejo_Objetos{

    private $conexion;


    public function __construct($conexion){
        
        $this->setConexion($conexion);
        
    }


    public function setConexion(PDO $conexion){

        $this->conexion=$conexion;

    }

    public function getContenidoPorFecha() {

        $matriz=array();

        $contador=0;

        $resultado=$this->conexion->query("select * from contenido order by fecha");

        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){

            $blog=new Objeto_Blog();

            $blog->setId($registro["id"]);

            $blog->setTitulo($registro["titulo"]);

            $blog->setFecha($registro["fecha"]);

            $blog->setComentario($registro["comentario"]);

            $blog->setImagen($registro["imagen"]);


            $matriz[$contador]=$blog;

            $contador++;

        }

        return $matriz;

    }


    public function insertaContenido(Objeto_Blog $blog){

        $sql="insert into contenido(titulo,fecha,comentario,imagen) values('"
            .$blog->getTitulo() . "','"
            .$blog->getFecha() . "','"
            .$blog->getComentario() . "','"
            .$blog->getImagen() . "')";

            $this->conexion->exec($sql);

    }

}
