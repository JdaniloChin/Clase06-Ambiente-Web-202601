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
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

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
            if(!empty($pass)){
                $stmt->bind_param('sssssssi',$nombre,$correo,$correo,$rol,$estado,$genero,$pass_hash,$id);
            }else{
                $stmt->bind_param('ssssssi',$nombre,$correo,$correo,$rol,$estado,$genero,$id);
            }
            $stmt->execute();

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
            $stmt->bind_param("sssss",$nombre,$correo,$clave_hash,$correo,$rol,$genero,$estado);
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
?>