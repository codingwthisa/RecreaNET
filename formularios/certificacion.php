<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('database.php');

function obtenerAsociaciones($conn) {
    $sql = "SELECT Nombre FROM Asociacion";
    $result = $conn->query($sql);

    if ($result === false) {
        die('Error al obtener asociaciones: ' . htmlspecialchars($conn->error));
    }

    $asociaciones = [];
    while ($row = $result->fetch_assoc()) {
        $asociaciones[] = $row['Nombre'];
    }

    return $asociaciones;
}

$asociaciones = obtenerAsociaciones($conn);
?>

<form action="procesar_datos.php?tabla=Certificacion&id=<?php echo $isEditing ? $data['Codigo'] : ''; ?>" method="post">
        <tr>
            <td><label for="codigo">Código:</label></td>
            <td><input type="text" id="codigo" name="codigo" value="<?php echo $isEditing ? $data['Codigo'] : ''; ?>" required></td>
        </tr>
        <tr>
            <td><label for="fecha">Fecha:</label></td>
            <td><input type="date" id="fecha" name="fecha" value="<?php echo $isEditing ? $data['Fecha'] : ''; ?>" required></td>
        </tr>
        <tr>
            <td><label for="grado">Grado:</label></td>
            <td><input type="text" id="grado" name="grado" value="<?php echo $isEditing ? $data['Grado'] : ''; ?>" required></td>
        </tr>
        <tr>
            <td><label for="asociacion_nombre">Asociación:</label></td>
            <td>
                <select id="asociacion_nombre" name="asociacion_nombre" required>
                    <?php foreach ($asociaciones as $asociacion) { ?>
                        <option value="<?php echo $asociacion; ?>" <?php echo $isEditing && $data['Asociacion'] == $asociacion ? 'selected' : ''; ?>>
                            <?php echo $asociacion; ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
        </tr>
</form>
