<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('database.php');

function obtenerAsociaciones($conn) {
    $sql = "SELECT Codigo FROM Certificacion";
    $result = $conn->query($sql);

    if ($result === false) {
        die('Error al obtener codigos: ' . htmlspecialchars($conn->error));
    }

    $cod_certificacion = [];
    while ($row = $result->fetch_assoc()) {
        $cod_certificacion[] = $row['Codigo'];
    }

    return $cod_certificacion;
}

$cod_certificacion = obtenerAsociaciones($conn);
?>

<form action="procesar_datos.php?tabla=Lideres_de_grupo&id=<?php echo $isEditing ? $data['CI'] : ''; ?>" method="post">
<tr>
    <td><label for="ci">CI:</label></td>
    <td><input type="number" id="ci" name="ci" value="<?php echo $isEditing ? $data['CI'] : ''; ?>" required></td>
</tr>
<tr>
    <td><label for="nombre">Nombre:</label></td>
    <td><input type="text" id="nombre" name="nombre" value="<?php echo $isEditing ? $data['Nombre'] : ''; ?>" required></td>
</tr>
<tr>
    <td><label for="telefono">Teléfono:</label></td>
    <td><input type="tel" id="telefono" name="telefono" value="<?php echo $isEditing ? $data['Telefono'] : ''; ?>" required></td>
</tr>
<tr>
        <td><label for="codigo_certificacion">Código certificación:</label></td>
        <td>
            <select id="codigo_certificacion" name="codigo_certificacion" required>
                <?php foreach ($cod_certificacion as $certificacion) { ?>
                    <option value="<?php echo $certificacion; ?>" <?php echo $isEditing && $data['Certificacion_Codigo'] == $certificacion ? 'selected' : ''; ?>>
                        <?php echo $certificacion; ?>
                    </option>
                <?php } ?>
            </select>
        </td>
    </tr>
</form>