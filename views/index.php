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

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <title>Library Management</title>
    <link href="../css/contacto.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f7f3e9, #e4d4c8);
        }
    </style>
</head>

<body>
    <!-- contenedor principal -->
    <div class="container-fluid">
        <!-- fila 1 -->
        <div class="row">
            <!-- columna 1 fila 1 -->
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
                                <a class="nav-link active text-white" href="#">Home</a>
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
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="contact.php">Contact</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form id="formBuscar" class="d-flex me-2">
                            <input id="inputBuscar" class="form-control me-2" type="search" placeholder="Buscar libro" aria-label="Buscar" name="query">
                            <button class="btn btn-outline-light" type="submit">Buscar</button>
                        </form>

                        <<form class="d-flex">
                            <a href="../backend/logout.php" class="btn btn-outline-warning">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                            </form>

                    </div>
                </div>
            </nav>


        </div>
        <!-- FIN  columna 1 fila 1 -->

        <!-- fila 2 -->
        <div class="row ">
            <!-- columna 1 fila 2 -->
            <div class="container-fluid col-xs-12  col-sm-12 col-lg-6 col-12 col-md-6 text-center text-md-start bg- p-4">
                <p class="fs-5 fs-md-4 fs-lg-3">
                    On this page you can find a variety of books so you can read online,
                    which we will have updated books, old ones, with several sections which
                    you can satisfy more reading. We will have <strong>romance</strong>, <strong>action</strong>,
                    <strong>suspense</strong>, <strong>horror</strong>, <strong>daily life</strong>,
                    <strong>religious</strong>, <strong>learning</strong> and more.<br><br>
                    We recommend this page since we work to satisfy each user with their
                    preferred taste in reading, and if you already chose us, I greatly appreciate your collaboration.
                </p>
            </div>
            <!-- FIN columna 1 fila 2 -->

            <!-- columna 2 fila 2 -->
            <div class="bg- col-xs-12  col-sm-12  col-md-6 col-lg-6 text-end">
                <img src="../assets/persona.jpg" alt="..." class="img-fluid" style="max-height: 500px;">
            </div>
        </div>
        <!-- FIN columna 2 fila 2 -->


        <!-- FIN fila 2 -->

        <!-- fila 3 -->
        <div class="row">
            <!-- columna 1 fila 3 -->
            <div class="col-xs-12  col-sm-12  col-md-3 col-lg-3 bg-">
                <div class="card" style="width: 18rem;">
                    <img
                        src="../assets/elprincipito.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">The Little Prince</h5>
                        <p class="card-text">The Little Prince is a text written in 1943 by French writer Antoine de Saint-Exupéry.
                            It tells the fictional story of an aviator and a boy from another planet. We can see that this child represents a
                            childlike reality, with incredible creativity and optimism in the face of the reality he faces.</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <!-- FIN  columna 1 fila 3 -->

            <!-- columna 2 fila 3 -->
            <div class="col-xs-12  col-sm-12  col-md-3 col-lg-3 bg-">
                <div class="card" style="width: 18rem;">
                    <img
                        src="../assets/loqueelvientosellevo.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Gone With The Wind</h5>
                        <p class="card-text">Scarlett O'Hara, a young woman from a wealthy family in Atlanta, in the southern United States,
                            lives a peaceful and comfortable life, driven by her determined and daring character. When the Civil War broke out in 1861,
                            her life as she knew it collapsed, and she was faced with great responsibilities.</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <!-- FIN columna 2 fila 3 -->

            <!-- columna 3 fila 3 -->
            <div class="col-xs-12  col-sm-12  col-md-3 col-lg-3  bg-">
                <div class="card" style="width: 18rem;">
                    <img
                        src="../assets/los-secretos-de-la-mente-millonaria.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">The secrets of the millionaire mind</h5>
                        <p class="card-text">Action is essential to achieving wealth, not just positive thinking. The wealthy invest in assets
                            that produce income, while those who are not able to achieve it invest in assets that consume income. Financial education
                            is essential to achieving wealth.</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <!-- FIN columna 3 fila 3 -->

            <!-- columna 4 fila 3 -->
            <div class="col-xs-12  col-sm-12  col-md-3 col-lg-3 bg-">
                <div class="card" style="width: 18rem;">
                    <img
                        src="../assets/el-camino-del-hombre-superior.jpg"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">The path of the superior man</h5>
                        <p class="card-text">The path of the higher man presents the ultimate challenge and reward for contemporary man: to discover
                            the unity of heart and determination through the full expression of consciousness and love in the intimate openness of the
                            present moment.</p>
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <!--FIN  columna 4 fila 3 -->

        </div>
        <!-- FIN fila 3 -->

    </div>
    <!-- FIN fila 1 -->




    <!--FIN  contenedor principal -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>