<?php
header('Content-Type: application/json');
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Aquí podrías guardar en base de datos o enviar correo

    echo json_encode(['success' => true, 'message' => 'Tu mensaje ha sido enviado con éxito. ¡Gracias por contactarnos!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida.']);
}
