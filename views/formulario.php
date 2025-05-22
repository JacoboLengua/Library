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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/contacto.css" rel="stylesheet">
    <title>Formulario</title>
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
                            <li>
                                <hr class="dropdown-divider">
                            </li>
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
    <div class="container my-5">
        <h2 class="text-center mb-4">📚 Book List</h2>

        <!-- Formulario -->
        <div class="card mb-4 col-lg-8 col-md-10 col-sm-12 mx-auto">
            <div class="card-header">➕ Add / ✏️ Edit Book</div>
            <div class="card-body">
                <form id="formLibro" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Author</label>
                        <input type="text" name="author" id="author" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <input type="text" name="category" id="category" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <input type="text" name="description" id="description" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Year</label>
                        <input type="number" name="year" id="year" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="cover_url" id="cover_url" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../js/jquery-3.7.1.min.js"></script>
        <script src="../js/listalibro.js"></script>

</body>

</html>