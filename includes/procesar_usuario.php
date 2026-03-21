<?php 
require_once('database.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $genero = $_POST['genero'];
    $clave = $_POST['password'];
    $estado = $_POST['estado'];
    $rol = $_POST['rol'];


    

    //validaciones
    if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $mensaje = "Correo invalido";
            $tipo_mensaje = "danger";
    }else{
        $pass_hash = password_hash($clave, PASSWORD_DEFAULT);

        if(!empty($id)){
            //update
            $sql = "UPDATE usuarios
                    SET nombre= ?,
                    usuario = ?,
                    correo = ?,
                    rol = ?,
                    estado = ?,
                    genero = ?" .
                    (!empty($pass) ? ", clave = ?" : "" ) . "
                    WHERE id_usuario = ?";

            $stmt = $mysqli->prepare($sql);

            if(!empty($pass)){
                if(!$stmt->bind_param('sssssssi',$nombre,$correo,$correo,$rol,$estado,$genero,$pass_hash,$id)){
                    $mensaje= "Error al enlzar parametros del update";
                    $tipo= "danger";
                }
                
            }else{
                
                if(!$stmt->bind_param('ssssssi',$nombre,$correo,$correo,$rol,$estado,$genero,$id)){
                    $mensaje= "Error al enlzar parametros del update";
                    $tipo= "danger";
                }
            }
            if(!$stmt->execute()){
              $mensaje= "Error al ejecutar update";
              $tipo= "danger";  
            }

            if($stmt->sqlstate == '00000'){
                $mensaje = "Usuario Actualizado Correctamente";
                $tipo_mensaje = "success";

            }elseif($stmt->sqlstate > 0){
                $mensaje = "Advertencia, usuario actualizado pero con un mensaje: " . $stmt->sqlstate;
                $tipo_mensaje = "warning";
            }else{
                $mensaje = "Error, el usuario no se puedo actualizar, código de error: " . $stmt->sqlstate;
                $tipo_mensaje = "danger";
            }
        }else{
            //CREATE -> INSERT
            $sql= "INSERT INTO usuarios(nombre, usuario, clave, correo, rol, genero, estado) VALUES (?,?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            if(!$stmt->bind_param("sssssss",$nombre,$correo,$pass_hash,$correo,$rol,$genero,$estado)){
                $mensaje= "Error al enlzar parametros del insert";
                $tipo= "danger";
            }
            $stmt->execute();

            if($stmt->sqlstate == '00000'){
                $mensaje = "Usuario Creado Correctamente";
                $tipo_mensaje = "success";

            }elseif($stmt->sqlstate > 0){
                $mensaje = "Advertencia, usuario creado pero con un mensaje: " . $stmt->sqlstate;
                $tipo_mensaje = "warning";
            }else{
                $mensaje = "Error, el usuario no se puedo crear, código de error: " . $stmt->sqlstate;
                $tipo_mensaje = "danger";
            }
            
        }
        $stmt->close();
        $mysqli->close();
        $respuesta['tipo']=$tipo_mensaje;
        $respuesta['mensaje']=$mensaje;
        echo json_encode($respuesta);
        exit();
    }

}

if(isset($_GET['eliminar'])){
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->execute();

    if($stmt->sqlstate == '00000'){
        $mensaje = "Usuario eliminado Correctamente";
        $tipo_mensaje = "success";

    }elseif($stmt->sqlstate > 0){
        $mensaje = "Advertencia, usuario eliminado pero con un mensaje: " . $stmt->sqlstate;
        $tipo_mensaje = "warning";
    }else{
        $mensaje = "Error, el usuario no se puedo eliminar, código de error: " . $stmt->sqlstate;
        $tipo_mensaje = "danger";
    }

    $stmt->close();
    $mysqli->close();

    $respuesta['tipo']=$tipo_mensaje;
    $respuesta['mensaje']=$mensaje;
    echo json_encode($respuesta);
    
    exit();
}
?>