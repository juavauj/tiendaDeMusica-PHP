<?php
require(__DIR__ . '/../config/class.Conexion.php');

class Canciones{

    public function __construct(){

    }

    public function mostrarCancion($id){

        $db= new Conexion();
        $sql="SELECT * FROM  canciones WHERE idCancion='$id'";

        $result=$db->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            //print_r($row);
            return $row;

        }else{

            return "error";
        }


    }

    public function editarCancion($id,$nombre,$idArtista,$idAlbum,$estado){
        session_start();
        $url='';
        $db= new Conexion();
        $sql="UPDATE canciones SET nombre='$nombre', idArtista='$idArtista', idAlbum='$idAlbum',idEstado='$estado' WHERE idCancion='$id'";
        $db->query($sql);
        if($_SESSION['rol'] == 'superadmin'){     
            $url='location: ../files/subpages/admins/superAdmin.php';
        } else {           
            $url='location: ../files/subpages/admins/admin.php';
        }; 

        echo $db->query($sql)?   header($url) :  'error';

    }

    // Todas las canciones
    public function getCanciones() {
        $db= new Conexion();
        $sql="SELECT nombre AS nombreCancion, idAlbum AS albumCancion FROM canciones";
        return $db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }
}

?>