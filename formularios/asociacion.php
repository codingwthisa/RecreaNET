<table class="table table-striped">
<tr>
    <td><label for="nombre">Nombre:</label></td>
    <td><input type="text" id="nombre" name="nombre" value="<?php echo $isEditing ? $data['Nombre'] : ''; ?>" required></td>
</tr>
<tr>
    <td><label for="direccion">Dirección:</label></td>
    <td><input type="text" id="direccion" name="direccion" value="<?php echo $isEditing ? $data['Direccion'] : ''; ?>" required></td>
</tr>
<tr>
    <td><label for="telefono">Teléfono:</label></td>
    <td><input type="text" id="telefono" name="telefono" value="<?php echo $isEditing ? $data['Telefono'] : ''; ?>" required></td>
</tr>
<?php if ($isEditing) { ?>
<tr>
    <td colspan="2">
        <button type="submit" name="delete" value="1" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">Eliminar</button>
    </td>
</tr>
<?php } ?>