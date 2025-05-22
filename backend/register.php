<?php
require_once 'config.php'; // Asegúrate de que esto conecta bien con PDO

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $name = trim($_POST['name'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validaciones básicas
    if (empty($name) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Correo electrónico no válido.']);
        exit;
    }

    if ($password !== $confirm_password) {
        echo json_encode(['status' => 'error', 'message' => 'Las contraseñas no coinciden.']);
        exit;
    }

    try {
        $db = new DbConfig();
        $conn = $db->getConnection();

        // Verificar si el email ya existe
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetch()) {
            echo json_encode(['status' => 'error', 'message' => 'El correo ya está registrado.']);
            exit;
        }

        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Valores por defecto para rol, empresa y departamento
        $fk_role_id = 1;
        $fk_company_id = 1;
        $fk_departamento_id = 1;

        // Insertar usuario
        $sql = "INSERT INTO users (full_name, last_name, email, password, fk_role_id, fk_company_id, fk_departamento_id, status, statusChat)
                VALUES (:full_name, :last_name, :email, :password, :role_id, :company_id, :departamento_id, 'Activo', 'Offline')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':full_name', $name);
        $stmt->bindParam(':last_name', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role_id', $fk_role_id);
        $stmt->bindParam(':company_id', $fk_company_id);
        $stmt->bindParam(':departamento_id', $fk_departamento_id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Usuario registrado correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al registrar usuario.']);
        }

    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error de conexión: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
?>
