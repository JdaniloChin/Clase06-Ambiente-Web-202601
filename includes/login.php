<?php
    require_once('database.php');

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['user'];
        $pass = $_POST['password'];

        //VALIDAR DATOS
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $mensaje  = "Correo invalido";
        }else{
            //Buscar el correo en la base de datos
            $sql = "SELECT  nombre, clave, rol FROM usuarios WHERE correo = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("s",$email);
            $stmt->execute();

            $resultado = $stmt->get_result();

            if($resultado->num_rows ===1 ){
                $usuario = $resultado->fetch_assoc();

                if(password_verify($pass, $usuario['clave'])){
                    $_SESSION['nombre_usuario'] = $usuario['nombre'];
                    $_SESSION['rol'] = $usuario['rol'];
                    $_SESSION['correo'] = $email;
                    
                    header("Location: home.php");
                    exit();
                }
            }else{
                $mensaje = "Correo no registrado";
                $_SESSION['mensaje'] = $mensaje;
            }
            $stmt->close();
            $mysqli->close();
        }
    }
    ?>