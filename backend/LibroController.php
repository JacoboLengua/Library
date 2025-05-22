<?php
require_once 'config.php';
header('Content-Type: application/json');

$db = new DbConfig();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $id = $_POST['id'] ?? null;

    if ($accion === 'obtener') {
        $stmt = $conn->prepare("SELECT * FROM libros WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
        exit;
    }

    if ($accion === 'eliminar') {
        $stmt = $conn->prepare("DELETE FROM libros WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(["message" => "Libro eliminado correctamente"]);
        exit;
    }

    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $category = $_POST['category'] ?? '';
    $description = $_POST['description'] ?? '';
    $year = $_POST['year'] ?? '';
    $imageName = '';

   
    if (!empty($_FILES['cover_url']['name'])) {
        $imageName = time() . '_' . basename($_FILES['cover_url']['name']);
        move_uploaded_file($_FILES['cover_url']['tmp_name'], "../assets/" . $imageName);
    }

    if ($id) {
        // Actualización
        $query = "UPDATE libros SET title=?, author=?, category=?, description=?, year=?";
        $params = [$title, $author,$category,$description, $year];

        if ($imageName) {
            $query .= ", cover_url=?";
            $params[] = $imageName;
        }

        $query .= " WHERE id=?";
        $params[] = $id;

        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        echo json_encode(["message" => "Libro actualizado correctamente"]);
    } else {
        // Inserción
        $stmt = $conn->prepare("INSERT INTO libros (title, author, category, description, year, cover_url) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $author, $category,$description, $year, $imageName]);
        echo json_encode(["message" => "Libro agregado correctamente"]);
    }
} else {
    // Mostrar todos los libros
    $stmt = $conn->query("SELECT * FROM libros ORDER BY id DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}
$query = '';
if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $query = trim($_GET['query']);
    $sql = "SELECT * FROM libros WHERE title LIKE :q OR author LIKE :q OR category LIKE :q";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':q' => "%$query%"]);
} else {
    $sql = "SELECT * FROM libros";
    $stmt = $pdo->query($sql);
}
?>
