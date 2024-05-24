<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('database.php');

function obtenerLiderCI($conn) {
    $sql = "SELECT CI FROM Lideres_de_grupo";
    $result = $conn->query($sql);

    if ($result === false) {
        die('Error al obtener CI Líder: ' . htmlspecialchars($conn->error));
    }

    $ci_lider = [];
    while ($row = $result->fetch_assoc()) {
        $ci_lider[] = $row['CI'];
    }

    return $ci_lider;
}

function obtenerCertificacion($conn) {
    $sql = "SELECT Codigo FROM Certificacion";
    $result = $conn->query($sql);

    if ($result === false) {
        die('Error al obtener Codigo Certificacion: ' . htmlspecialchars($conn->error));
    }

    $cod_certificacion = [];
    while ($row = $result->fetch_assoc()) {
        $cod_certificacion[] = $row['Codigo'];
    }

    return $cod_certificacion;
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
$cod_certificacion = obtenerCertificacion($conn);
$ci_lider = obtenerLiderCI($conn);
?>
<form action="procesar_datos.php?tabla=Juegos&id=<?php echo $isEditing ? $data['Identificador'] : ''; ?>" method="post">
<tr>
    <td><label for="identificador">Identificador:</label></td>
    <td><input type="text" id="identificador" name="identificador" value="<?php echo $isEditing ? $data['Identificador'] : ''; ?>" required></td>
</tr>
<tr>
    <td><label for="descripcion">Descripción:</label></td>
    <td><textarea id="descripcion" name="descripcion" required><?php echo $isEditing ? $data['Descripcion'] : ''; ?></textarea></td>
</tr>
<tr>
            <td><label for="numero_cliente">Número Cliente:</label></td>
            <td>
                <select id="numero_cliente" name="numero_cliente" required>
                    <?php foreach ($numero_clien as $num_cliente) { ?>
                        <option value="<?php echo $num_cliente; ?>" <?php echo $isEditing && $data['Cliente_Numero_cliente'] == $num_cliente ? 'selected' : ''; ?>>
                            <?php echo $num_cliente; ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
</tr>
<tr>
            <td><label for="lider_ci">Líder CI:</label></td>
            <td>
                <select id="lider_ci" name="lider_ci" required>
                    <?php foreach ($ci_lider as $ci) { ?>
                        <option value="<?php echo $ci; ?>" <?php echo $isEditing && $data['Cliente_Numero_cliente'] == $ci ? 'selected' : ''; ?>>
                            <?php echo $ci; ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
</tr>
<tr>
            <td><label for="codigo_cert">Código Certificación:</label></td>
            <td>
                <select id="codigo_cert" name="codigo_cert" required>
                    <?php foreach ($cod_certificacion as $codigo_cert) { ?>
                        <option value="<?php echo $codigo_cert; ?>" <?php echo $isEditing && $data['Cliente_Numero_cliente'] == $codigo_cert ? 'selected' : ''; ?>>
                            <?php echo $codigo_cert; ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
</tr>
</form>