<?php
    session_start();
    if(!isset($_SESSION['nombre_usuario'])){
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="./CSS/styles.css" rel="stylesheet">
    <title>Inicio</title>
</head>
<body>
    <div class="container-fluid min-vh-100">
        <div class="row min-vh-100" id="main-row">
            <!-- Navbar y footer se insertan dinámicamente aquí -->
            
            <main class="col-md-9 p-4">
                <h1 class="text-center mb-3">Bienvenido <?=  $_SESSION['nombre_usuario']?> (<?=   $_SESSION['rol']?>)</h1>
                <h3 class="text-center"><?= $_SESSION['correo']?></h3>
                <p class="text-center text-muted mb-5">
                    <strong>Sistema de Punto de Venta</strong><br>
                    Ejemplo para desarrollar en el Curso Ambiente Web Cliente Servidor Universidad Fidélitas
                </p>

                <!-- Cards de acceso rápido -->
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm hover-card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="bi bi-people-fill text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="card-title">Usuarios</h5>
                                <p class="card-text">Gestiona los usuarios del sistema</p>
                                <a href="./usuarios.html" class="btn btn-primary">
                                    <i class="bi bi-arrow-right-circle"></i> Acceder
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm hover-card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="bi bi-box-seam-fill text-success" style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="card-title">Productos (Inventarios)</h5>
                                <p class="card-text">Administra el inventario de productos</p>
                                <a href="./inventarios.html" class="btn btn-success">
                                    <i class="bi bi-arrow-right-circle"></i> Acceder
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm hover-card">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="bi bi-cart-fill text-warning" style="font-size: 3rem;"></i>
                                </div>
                                <h5 class="card-title">Ventas</h5>
                                <p class="card-text">Registra y consulta las ventas realizadas</p>
                                <a href="./ventas.html" class="btn btn-warning">
                                    <i class="bi bi-arrow-right-circle"></i> Acceder
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./JS/componentes.js"></script>
    <script>
        // Inicializar layout con la página actual
        initLayout('home');
    </script>
</body>
</html>