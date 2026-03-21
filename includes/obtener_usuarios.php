<?php
require_once('database.php');

$resultado = $stmt =$mysqli->query("SELECT id_usuario, nombre, usuario, correo, rol, estado, genero FROM usuarios");
if($resultado && $resultado->num_rows>0){
    while($usuario = $resultado->fetch_assoc()){
        echo "<tr>
                <td>" . htmlspecialchars($usuario['nombre']) . "</td>
                <td>" . htmlspecialchars($usuario['genero']) . "</td>
                <td>" . htmlspecialchars($usuario['usuario']) . "</td>
                <td>" . htmlspecialchars($usuario['correo']) . "</td>
                <td>" . htmlspecialchars($usuario['rol']) . "</td>
                <td>" . htmlspecialchars($usuario['estado']) . "</td>
                <td>
                        <a href='#' 
                        data-id='{$usuario['id_usuario']}'
                        data-nombre='{$usuario['nombre']}'
                        data-correo='{$usuario['correo']}'
                        data-rol='{$usuario['rol']}'
                        data-estado='{$usuario['estado']}'
                        data-genero='{$usuario['genero']}'
                        class='btn btn-warning btn-sm btnEditar'>Editar</a>
                        <a href='#' data-id='{$usuario['id_usuario']}' class='btn btn-danger btn-sm btnEliminar'>Eliminar</a>
                </td>
            </tr>";
    }
}
$stmt->close();
$mysqli->close();

?>