<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Final</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <div class="container-fluid">
        <!-- Sidebar -->
        <div class="row">
            <div class="col-md-2 bg-primary text-white vh-100">
                <div class="text-center mt-3">
                    <img src="./images/usfx.png" alt="usfx" class="img-fluid rounded-circle" style="width: 80px;">
                </div>
                <nav class="nav flex-column mt-4">
                    <a class="nav-link text-white" href="#">Inicio</a>
                    <a class="nav-link text-white" href="#">Pregunta 2</a>
                    <a class="nav-link text-white" href="#">Pregunta 3</a>
                    <a class="nav-link text-white" href="#">Pregunta 4</a>
                    <a class="nav-link text-white" href="#">Pregunta 5</a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <!-- Encabezado -->
                <div class="d-flex justify-content-between align-items-center bg-light p-3">
                    <h4 class="text-primary">Inicio</h4>

                    <a class="nav-link text-white" href="#pregunta2">Pregunta 2</a>
                    <a class="nav-link text-white" href="#pregunta3">Pregunta 3</a>
                    <a class="nav-link text-white" href="#pregunta4">Pregunta 4</a>
                    <a class="nav-link text-white" href="#pregunta5">Pregunta 5</a>
                    
                    <button class="btn btn-primary">Iniciar Sesión</button>
                </div>
                
                <!-- Información Personal -->
                <div class="text-center mt-4">
                    <img src="./images/yo.jpg" alt="Perfil" class="img-fluid rounded-circle" style="width: 100px;">
                    <h4 class="mt-2">Gonzales Suyo Franz Reinaldo</h4>
                    <p>Carrera: Ingeniería de Sistemas</p>
                    <p>Repositorio: <a href="https://github.com/clpereirac/DesarrolloWebCPC" target="_blank" class="btn btn-primary">GitHub</a></p>
                </div>
                
                <!-- Título -->
                <div class="mt-4 text-center">
                    <h2>SIS 256 Programación Web</h2>
                    <p>Examen Final - 02-12-2023 7:00 am</p>
                </div>

                <!-- Tarjetas de Servicios -->
                <div class="mt-5">
                    <h3 class="text-center">Nuestros Servicios</h3>
                    <div class="row text-center mt-4">
                        <!-- Tarjeta 1 -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    Consultoría
                                </div>
                                <div class="card-body">
                                    <p>Asesoramiento personalizado para mejorar tu negocio.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 2 -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    Desarrollo Web
                                </div>
                                <div class="card-body">
                                    <p>Sitios web modernos y funcionales para tu empresa.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 3 -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    Soporte Técnico
                                </div>
                                <div class="card-body">
                                    <p>Asistencia 24/7 para garantizar el éxito de tu negocio.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie de Página -->
                <footer class="bg-dark text-white text-center py-3 mt-4">
                    Sucre – Semestre 2-2023
                </footer>
            </div>
        </div>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
