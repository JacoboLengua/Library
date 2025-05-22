<?php
class Contact {
    private $conn;
    private $table = "mensajes";

    public $nombre;
    public $email;
    public $mensaje;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function guardarMensaje() {
        $sql = "INSERT INTO $this->table (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":mensaje", $this->mensaje);
        return $stmt->execute();
    }

    public function listarMensajes() {
        $sql = "SELECT id, nombre, email, mensaje, fecha FROM $this->table ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
