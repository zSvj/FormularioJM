<?php
session_start();
require_once 'config/db.php';

$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT * FROM mypage.estudiantes"; // Asegúrate de que 'estudiantes' es el nombre correcto de tu tabla
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Registrados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Datos Registrados</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre y apellidos</th>
                    <th>Edad</th>
                    <th>Correo</th>
                    <th>Curso</th>
                    <th>Género</th>
                    <th>Áreas de Interés</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($results) > 0): ?>
                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['edad']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['curso']); ?></td>
                            <td><?php echo htmlspecialchars($row['genero']); ?></td>
                            <td><?php echo htmlspecialchars($row['intereses']); ?></td>
                            <td>
                                <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No hay datos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary">Volver al Registro</a>
    </div>
</body>
</html>