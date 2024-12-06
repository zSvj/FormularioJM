<?php
session_start();
require_once 'config/db.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Asegúrate de que los nombres de los campos coincidan con los del formulario
    $fullname = $_POST['nombre'] ?? null; // Usar null coalescing para evitar errores
    $age = $_POST['edad'] ?? null;
    $email = $_POST['email'] ?? null;
    $course = $_POST['curso'] ?? null;
    $gender = $_POST['genero'] ?? null;
    $interests = isset($_POST['intereses']) ? implode(", ", $_POST['intereses']) : '';

    // Verifica que las variables no sean nulas antes de proceder
    if ($fullname && $age && $email && $course && $gender) {
        try {
            $db = new Database();
            $conn = $db->getConnection();

            // Prepara la consulta SQL
            $stmt = $conn->prepare("INSERT INTO estudiantes (nombre, edad, email, curso, genero, intereses) VALUES (?, ?, ?, ?, ?, ?)");
            // Ejecuta la consulta
            if ($stmt->execute([$fullname, $age, $email, $course, $gender, $interests])) {
                $_SESSION['message'] = 'Registro exitoso';
            } else {
                $_SESSION['message'] = 'Error al registrar';
            }
        } catch (PDOException $e) {
            // Manejo de errores de conexión o consulta
            $_SESSION['message'] = 'Error en la base de datos: ' . $e->getMessage();
        }
    } else {
        $_SESSION['message'] = 'Por favor, complete todos los campos requeridos.';
    }
    header('Location: index.php');
    exit();
}
?>