<?php
session_start();
require_once 'config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT * FROM mypage.estudiantes WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$student) {
        $_SESSION['message'] = 'Registro no encontrado.';
        header('Location: ver_datos.php');
        exit();
    }
} else {
    $_SESSION['message'] = 'ID no proporcionado.';
    header('Location: ver_datos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar alumno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Editar alumno</h2>
        <form action="actualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
            <div class="form-group">
                <label for="fullname">Nombre y apellidos:</label>
                <input type="text" class="form-control" id="fullname" name="nombre" value="<?php echo htmlspecialchars($student['nombre']); ?>" required>
            </div>

            <div class="form-group">
                <label for="age">Edad:</label>
                <input type="number" class="form-control" id="age" name="edad" value="<?php echo htmlspecialchars($student['edad']); ?>" required min="10" max="100">
            </div>

            <div class="form-group">
                <label for="email">Correo:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="course">Curso de interés:</label>
                <select class="form-control" id="course" name="curso" required>
                    <option value="Programación_Python" <?php echo $student['curso'] == 'Programación_Python' ? 'selected' : ''; ?>>Programación Python</option>
                    <option value="Marketing_Digital" <?php echo $student['curso'] == 'Marketing_Digital' ? 'selected' : ''; ?>>Marketing Digital</option>
                    <option value="Diseño_Gráfico" <?php echo $student['curso'] == 'Diseño_Gráfico' ? 'selected' : ''; ?>>Diseño Gráfico</option>
                </select>
            </div>

            <div class="form-group">
                <label>Género:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="male" name="genero" value="Masculino" <?php echo $student['genero'] == 'Masculino' ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="male">Masculino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="female" name="genero" value="Femenino" <?php echo $student['genero'] == 'Femenino' ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="female">Femenino</label>
                </div>
            </div>

            <div class="form-group">
                <label>Áreas de interés:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="intereses[]" value="Deportes" id="interest1" <?php echo in_array('Deportes', explode(',', $student['intereses'])) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="interest1">Deportes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="intereses[]" value="Negocios" id="interest2" <?php echo in_array('Arte', explode(',', $student['intereses'])) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="interest2">Negocios</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="intereses[]" value="Tecnología" id="interest3" <?php echo in_array('Tecnología', explode(',', $student['intereses'])) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="interest3">Tecnología</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block">Actualizar</button>
        </form>
        <a href="ver_datos.php" class="btn btn-secondary">Volver a Datos</a>
    </div>
</body>
</html>