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

<form action="procesar_datos.php?tabla=Colonias&id=<?php echo $isEditing ? $data['Codigo'] : ''; ?>" method="post">
    <tr>
        <td><label for="codigo">Código:</label></td>
        <td><input type="text" id="codigo" name="codigo" value="<?php echo $isEditing ? $data['Codigo'] : ''; ?>" required></td>
    </tr>
    <tr>
        <td><label for="ubicacion">Ubicación:</label></td>
        <td><input type="text" id="ubicacion" name="ubicacion" value="<?php echo $isEditing ? $data['Ubicacion'] : ''; ?>" required></td>
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
