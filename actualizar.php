<?php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $curso = $_POST['curso'];
    $genero = $_POST['genero'];
    $intereses = isset($_POST['intereses']) ? implode(',', $_POST['intereses']) : '';

    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("UPDATE mypage.estudiantes SET nombre = ?, edad = ?, email = ?, curso = ?, genero = ?, intereses = ? WHERE id = ?");
    if ($stmt->execute([$nombre, $edad, $email, $curso, $genero, $intereses, $id])) {
        $_SESSION['message'] = 'Registro actualizado exitosamente.';
    } else {
        $_SESSION['message'] = 'Error al actualizar el registro.';
    }
} else {
    $_SESSION['message'] = 'Método de solicitud no válido.';
}

header('Location: ver_datos.php');
exit();
?>