<tr>
    <td><label for="numero_cliente">Número cliente:</label></td>
    <td><input type="text" id="numero_cliente" name="numero_cliente" value="<?php echo $isEditing ? $data['Numero_cliente'] : ''; ?>" required></td>
</tr>
<tr>
    <td><label for="cliente_ci">CI:</label></td>
    <td><input type="text" id="cliente_ci" name="cliente_ci" value="<?php echo $isEditing ? $data['CI'] : ''; ?>" required></td>
</tr>
<tr>
    <td><label for="telefono">Teléfono:</label></td>
    <td><input type="tel" id="telefono" name="telefono" value="<?php echo $isEditing ? $data['Telefono'] : ''; ?>" required></td>
</tr>
<tr>
    <td><label for="edad">Edad:</label></td>
    <td><input type="tel" id="edad" name="edad" value="<?php echo $isEditing ? $data['Edad'] : ''; ?>" required></td>
</tr>
