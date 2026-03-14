<?php
    session_start();
    require_once("database.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nombre = $_POST['name'];
        $correo = $_POST['email'];
        $clave = $_POST['register-password'];
        $confirmacion = $_POST['register-password-confirm'];
        $rol = "Cliente";

        //validaciones
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $mensaje = "Correo invalido";
            $tipo_mensaje = "danger";
        }elseif($clave !== $confirmacion){
            $mensaje = "Contraseñas no coinciden";
            $tipo_mensaje = "danger";
        }else {
            $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

            //CREATE -> INSERT
            $sql= "INSERT INTO usuarios(nombre, usuario, clave, correo, rol) VALUES (?,?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sssss",$nombre,$correo,$clave_hash,$correo,$rol);
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
            $stmt->close();
            $mysqli->close();
        }
        
        $respuesta['mensaje'] = $mensaje;
        $respuesta['tipo'] = $tipo_mensaje;
        echo json_encode($respuesta);
        exit();
    }
?>