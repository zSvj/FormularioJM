<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campos del formulario</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Campos del formulario</h2>
        
        <form action="procesar.php" method="POST" id="registrationForm">
            <div class="form-group">
                <label for="fullname">Nombre y apellidos:</label>
                <input type="text" class="form-control" id="fullname" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="age">Edad:</label>
                <input type="number" class="form-control" id="age" name="edad" required min="10" max="100">
            </div>

            <div class="form-group">
                <label for="email">Correo:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="course">Curso de interés:</label>
                <select class="form-control" id="course" name="curso" required>
                    <option value="">Seleccione un curso</option>
                    <option value="Programación_Python">Programación Python</option>
                    <option value="Marketing_Digital">Marketing Digital</option>
                    <option value="Diseño_Gráfico">Diseño Gráfico</option>
                </select>
            </div>

            <div class="form-group">
                <label>Género:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="male" name="genero" value="Masculino" required>
                    <label class="form-check-label" for="male">Masculino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="female" name="genero" value="Femenino" required>
                    <label class="form-check-label" for="female">Femenino</label>
                </div>
            </div>

            <div class="form-group">
                <label>Áreas de interés:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="intereses[]" value="Deportes" id="interest1">
                    <label class="form-check-label" for="interest1">Deportes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="intereses[]" value="Negocios" id="interest2">
                    <label class="form-check-label" for="interest2">Negocios</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="intereses[]" value="Tecnología" id="interest3">
                    <label class="form-check-label" for="interest3">Tecnología</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
        </form>

        <!-- Botón para ver datos registrados -->
        <a href="ver_datos.php" class="btn btn-secondary btn-block mt-3">Ver Datos </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('registrationForm').onsubmit = function(event) {
            const interests = document.querySelectorAll('input[name="intereses[]"]:checked');
            if (interests.length === 0) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'Por favor, seleccione al menos un área de interés.',
                    confirmButtonText: 'Aceptar'
                });
            }
        };

        <?php
        if (isset($_SESSION['message'])) {
            echo "Swal.fire({
                title: 'Mensaje',
                text: '{$_SESSION['message']}',
                icon: '" . (strpos($_SESSION['message'], 'Error') !== false ? 'error' : 'success') . "',
                confirmButtonText: 'Aceptar'
            });";
            unset($_SESSION['message']);
        }
        ?>
    </script>
</body>
</html>