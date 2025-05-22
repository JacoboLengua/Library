<?php
// Mostrar errores para depuración 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Validación básica
if (!isset($_GET['category']) || empty($_GET['category'])) {
    echo json_encode([]);
    exit;
}

$category = $_GET['category'];

require_once 'config.php';

class Libro {
    private $conn;
    private $table = 'libros';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getByCategory($category, $limit = 5) {
        $sql = "SELECT id, title, author, description, category, cover_url 
                FROM {$this->table} 
                WHERE category = :category 
                LIMIT $limit"; 

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

try {
    $libro = new Libro($pdo);
    $books = $libro->getByCategory($category);
    echo json_encode($books);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
