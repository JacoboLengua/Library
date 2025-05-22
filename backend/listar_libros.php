<?php
class Libro {
    private $conn;
    private $tabla = "libros";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodos() {
        $stmt = $this->conn->query("SELECT * FROM {$this->tabla} ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregar($titulo, $autor, $anio, $imagen = null) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->tabla} (titulo, autor, anio, imagen) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$titulo, $autor, $anio, $imagen]);
    }

    public function actualizar($id, $titulo, $autor, $anio, $imagen = null) {
        $stmt = $this->conn->prepare("UPDATE {$this->tabla} SET titulo = ?, autor = ?, anio = ?, imagen = COALESCE(?, imagen) WHERE id = ?");
        return $stmt->execute([$titulo, $autor, $anio, $imagen, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->tabla} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>