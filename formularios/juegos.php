<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('database.php');

function obteneridActividades($conn) {
    $sql = "SELECT Identificador FROM Actividades";
    $result = $conn->query($sql);

    if ($result === false) {
        die('Error al obtener ID Actividades: ' . htmlspecialchars($conn->error));
    }

    $id_actividades = [];
    while ($row = $result->fetch_assoc()) {
        $id_actividades[] = $row['Identificador'];
    }

    return $id_actividades;
}

function obtenerClientes($conn) {
    $sql = "SELECT Numero_cliente FROM Cliente";
    $result = $conn->query($sql);

    if ($result === false) {
        die('Error al obtener ID Numero Clientes: ' . htmlspecialchars($conn->error));
    }

    $numero_clien = [];
    while ($row = $result->fetch_assoc()) {
        $numero_clien[] = $row['Numero_cliente'];
    }

    return $numero_clien;
}

$numero_clien = obtenerClientes($conn);
$id_actividades = obteneridActividades($conn);
?>

<form action="procesar_datos.php?tabla=Juegos&id=<?php echo $isEditing ? $data['Identificador'] : ''; ?>" method="post">
<tr>
    <td><label for="identificador">Identificador:</label></td>
    <td><input type="text" id="identificador" name="identificador" value="<?php echo $isEditing ? $data['Identificador'] : ''; ?>" required></td>
</tr>
<tr>
    <td><label for="tipo_juego">Tipo de Juego:</label></td>
    <td><input type="text" id="tipo_juego" name="tipo_juego" value="<?php echo $isEditing ? $data['Tipo_juego'] : ''; ?>" required></td>
</tr>
<tr>
    <td><label for="descripcion">Descripción:</label></td>
    <td><textarea type="text" id="descripcion" name="descripcion" required><?php echo $isEditing ? $data['Descripcion'] : ''; ?></textarea></td>
</tr>
<tr>
    <td><label for="cantidad_participantes">Cantidad de Participantes:</label></td>
    <td><input type="number" id="cantidad_participantes" name="cantidad_participantes" value="<?php echo $isEditing ? $data['Cantidad_participantes'] : ''; ?>" required></td>
</tr>
<tr>
            <td><label for="id_actividad">ID Actividad:</label></td>
            <td>
                <select id="id_actividad" name="id_actividad" required>
                    <?php foreach ($id_actividades as $idactividad) { ?>
                        <option value="<?php echo $idactividad; ?>" <?php echo $isEditing && $data['Actividades_idActividades'] == $idactividad ? 'selected' : ''; ?>>
                            <?php echo $idactividad; ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
        </tr>
<tr>
            <td><label for="numero_cliente">Número Cliente:</label></td>
            <td>
                <select id="numero_cliente" name="numero_cliente" required>
                    <?php foreach ($numero_clien as $num_cliente) { ?>
                        <option value="<?php echo $num_cliente; ?>" <?php echo $isEditing && $data['Actividades_Cliente_Numero_cliente'] == $num_cliente ? 'selected' : ''; ?>>
                            <?php echo $num_cliente; ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
        </tr>
</form>
