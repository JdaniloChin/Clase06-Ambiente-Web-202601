<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <link href="./CSS/styles.css" rel="stylesheet">
    <title>Usuarios</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row min-vh-100" id="main-row">
            <!-- Navbar y footer se insertan dinámicamente aquí -->
            
            <main class="col-md-9 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Usuarios del sistema</h3>
                    <button class="btn btn-success mb-3" id="btnAgregar" data-bs-toggle="modal"
                        data-bs-target="#modalUsuarios">Agregar Usuario</button>
                </div>
                <table class="table table-bordered table-striped" id="tablaUsuarios">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Género</th>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Se van agregar dinamicamente desde js -->
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- Modal de usuarios... -->
    <div class="modal fade" id="modalUsuarios" tabindex="-1" aria-labelledby="modalUsuariosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalUsuariosLabel">Registro de Usuarios</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formUsuarios" method="post">
                        <input type="hidden" id="id_usuario" name="id_usuario">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Juan Pérez" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña inicial" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico:</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="usuario@dominio.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Género:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genero" id="femenino" value="Femenino">
                                <label class="form-check-label" for="femenino"> Femenino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genero" id="masculino" value="Masculino">
                                <label class="form-check-label" for="masculino"> Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genero" id="otro" value="Otro">
                                <label class="form-check-label" for="otro"> Otro</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol:</label>
                            <select name="rol" id="rol" class="form-select">
                                <option value="-1">Seleccione un rol</option>
                                <option value="Admin">Administrador</option>
                                <option value="Cliente">Cliente</option>
                                <option value="Vendedor">Vendedor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado:</label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="-1">Seleccione un estado</option>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" id="btnGuardar">Guardar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JS/componentes.js"></script>
    <script src="./JS/usuarios.js"></script>
    <script>
        // Inicializar layout con la página actual
        initLayout('usuarios');
    </script>
</body>
</html>