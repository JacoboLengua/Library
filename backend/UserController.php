<?php
include 'config.php';  // Conexión a la base de datos

header('Content-Type: application/json');
$db = new DbConfig();
$conn = $db->getConnection();



// Mostrar todos los usuarios con sus roles
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT u.user_id, u.full_name, u.last_name, u.email, u.fk_role_id, 
                   r.role_name, u.status, u.statusChat
            FROM users u
            LEFT JOIN roles r ON u.fk_role_id = r.id
            ORDER BY u.user_id DESC";

    $stmt = $conn->prepare($sql);  // Usamos $conn para la conexión PDO
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($usuarios);
    exit;
}

// Acción POST para insertar o actualizar usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    // Obtener un solo usuario por ID
    if ($accion === 'obtener') {
        $id = $_POST['user_id'];
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($usuario);
        exit;
    }

    // Eliminar usuario
    if ($accion === 'eliminar') {
        $id = $_POST['user_id'];
        $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo json_encode(['message' => 'Usuario eliminado correctamente.']);
        exit;
    }

    // Insertar o actualizar usuario
    if ($accion === 'guardar') {
        $id = $_POST['user_id'] ?? '';
        $full_name = $_POST['full_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $role_id = $_POST['fk_role_id'];  // Role seleccionado por el usuario
        $company_id = $_POST['fk_company_id'];
        $departamento_id = $_POST['fk_departamento_id'];

        if ($id == '') {
            // Insertar nuevo usuario
            $sql = "INSERT INTO users (full_name, last_name, email, fk_role_id, fk_company_id, fk_departamento_id)
                    VALUES (:full_name, :last_name, :email, :role_id, :company_id, :departamento_id)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role_id', $role_id);
            $stmt->bindParam(':company_id', $company_id);
            $stmt->bindParam(':departamento_id', $departamento_id);

            if ($stmt->execute()) {
                echo json_encode(['message' => 'Usuario creado correctamente.']);
            } else {
                echo json_encode(['message' => 'Error al crear usuario.']);
            }
        } else {
            // Actualizar usuario
            $sql = "UPDATE users SET full_name = :full_name, last_name = :last_name, email = :email,
                    fk_role_id = :role_id, fk_company_id = :company_id, fk_departamento_id = :departamento_id
                    WHERE user_id = :user_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role_id', $role_id);
            $stmt->bindParam(':company_id', $company_id);
            $stmt->bindParam(':departamento_id', $departamento_id);
            $stmt->bindParam(':user_id', $id);

            if ($stmt->execute()) {
                echo json_encode(['message' => 'Usuario actualizado correctamente.']);
            } else {
                echo json_encode(['message' => 'Error al actualizar usuario.']);
            }
        }
        exit;
    }

    echo json_encode(['message' => 'Acción no válida.']);
    exit;
}
