<?php
session_start();

if (isset($_SESSION['logged_in']) &&  $_SESSION['logged_in'] === true) {
    // El usuario está autenticado
    $userId = $_SESSION['user_id'];
    $roleId = $_SESSION['role_id'];
    $nombre = $_SESSION['nombre'];
} else {
    header("Location: ../index.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contacts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/contacto.css" rel="stylesheet">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3e2723;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../assets/libros.jpg" alt="Library Logo" width="40" height="40" class="me-2 rounded-circle">
            <span class="fs-5">Library</span>
            <span class="ms-3 text-warning"><?php echo $nombre ?></span>
        </a>
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="tableuser.php">User</a>
                </li>
                   <li class="nav-item">
                    <a class="nav-link text-white" href="libros.php">Books</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Sections
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="listalibros.php">Books List</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="contact.php">Contact</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex me-2">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
            <form class="d-flex">
                <a href="../backend/logout.php" class="btn btn-outline-warning">Logout</a>
            </form>
        </div>
    </div>
</nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="row g-0">
                        <!-- LADO IZQUIERDO: Información de contacto -->
                        <div class="col-md-5 bg-dark text-white p-4 rounded-start">
                            <h4 class="mb-4">Contáctanos</h4>
                            <p><strong>Dirección:</strong> Cra 16B#51C40 La Asuncion, Manizales</p>
                            <p><strong>Teléfono:</strong> +57 313 605 0664</p>
                            <p><strong>Email:</strong> jacobo.len@biblioteca.com</p>
                            <p><strong>Horario:</strong> Lunes a Viernes, 9am - 6pm</p>
                        </div>

                        <!-- LADO DERECHO: Formulario -->
                        <div class="col-md-7 p-4 bg-light rounded-end">
                            <p class="text-muted mb-4">
                                Si tienes una <strong>sugerencia</strong> o <strong>reclamo</strong>, también puedes comunicarte por acá. Estaremos encantados de ayudarte.
                            </p>

                            <form id="form-contacto">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="mensaje" class="form-label">Mensaje:</label>
                                    <textarea name="mensaje" id="mensaje" rows="4" class="form-control" required></textarea>
                                </div>


                                <form id="form-contacto">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </form>
                                <p id="respuesta" class="text-center mt-3"></p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
     <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/contacto.js"></script>
</body>

</html>