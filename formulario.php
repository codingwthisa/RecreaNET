<?php
include("database.php");
include("functions.php");

if (isset($_GET['tabla'])) {
    $tabla = $_GET['tabla'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $isEditing = $id ? true : false;
    $data = [];

    $primaryKeyName = obtenerNombreClavePrimaria($conn, $tabla);

    if ($isEditing) {
        $data = obtenerDatos($conn, $tabla, $id, $primaryKeyName);
        if (!$data) {
            die("Error: No se encontró el registro con ID $id.");
        }
    }

    $error = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isEditing ? 'Editar' : 'Agregar'; ?> <?php echo htmlspecialchars($tabla); ?></title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0; 
        }

        .container {
            width: 100%;
            max-width: 600px; 
            padding: 20px;
            background-color: #fff; 
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); 
        }

        .fixed-button {
            cursor: pointer;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background-color: orange;
            padding: 3px 5px;
            font-size: 25px;
            color: white;
            border-radius: 10px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo $isEditing ? 'Editar' : 'Agregar'; ?> Datos en <?php echo htmlspecialchars($tabla); ?></h2>

        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="procesar_datos.php?tabla=<?php echo htmlspecialchars($tabla); ?>&id=<?php echo htmlspecialchars($id); ?>" method="post">
            <table class="table table-borderless">
                <?php echo generarFormulario($tabla, $data, $isEditing); ?>
            </table>
            <button type="submit" class="btn btn-success"><?php echo $isEditing ? 'Actualizar' : 'Enviar'; ?></button>
        </form>
        <a href="listar.php?tabla=<?php echo htmlspecialchars($tabla); ?>" class="btn btn-secondary">Volver al listado</a>
        <a href="index.html" class="fixed-button">Inicio</a>
    </div>
</body>
</html>

<?php
} else {
    echo "Error: No se ha especificado una tabla.";
}
?>
