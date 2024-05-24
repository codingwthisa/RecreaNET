<?php

function obtenerDatos($conn, $tabla, $id, $primaryKeyName) {
    $sql = "SELECT * FROM $tabla WHERE $primaryKeyName = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error preparando la consulta: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        die('Error: No se encontró el registro con el ID especificado.');
    }
    return $result->fetch_assoc();
}

function obtenerRegistros($conn, $tabla, $ordenColumna = null, $ordenTipo = 'ASC') {
    $sql = "SELECT * FROM $tabla";
    if ($ordenColumna) {
        $sql .= " ORDER BY $ordenColumna $ordenTipo";
    }
    $result = $conn->query($sql);

    if ($result === false) {
        die('Error al obtener registros: ' . htmlspecialchars($conn->error));
    }

    $registros = [];
    while ($row = $result->fetch_assoc()) {
        $registros[] = $row;
    }

    return $registros;
}

function obtenerRegistrosFiltradosGeneral($conn, $tabla, $buscarGeneral, $ordenColumna = null, $ordenTipo = 'ASC') {
    $sql = "SELECT * FROM " . $conn->real_escape_string($tabla);

    if (!empty($buscarGeneral)) {
        $columnas = obtenerColumnas($conn, $tabla);
        $condiciones = [];
        foreach ($columnas as $columna) {
            $condiciones[] = "$columna LIKE '%" . $conn->real_escape_string($buscarGeneral) . "%'";
        }
        $sql .= " WHERE " . implode(" OR ", $condiciones);
    }

    if ($ordenColumna) {
        $sql .= " ORDER BY " . $conn->real_escape_string($ordenColumna) . " " . $conn->real_escape_string($ordenTipo);
    }

    $result = $conn->query($sql);

    if ($result === false) {
        die('Error al obtener registros filtrados: ' . htmlspecialchars($conn->error));
    }

    $registros = [];
    while ($row = $result->fetch_assoc()) {
        $registros[] = $row;
    }

    return $registros;
}

function obtenerColumnas($conn, $tabla) {
    $sql = "SHOW COLUMNS FROM " . $conn->real_escape_string($tabla);
    $result = $conn->query($sql);

    if ($result === false) {
        die('Error al obtener columnas: ' . htmlspecialchars($conn->error));
    }

    $columnas = [];
    while ($row = $result->fetch_assoc()) {
        $columnas[] = $row['Field'];
    }

    return $columnas;
}



function generarFormulario($tabla, $data, $isEditing) {
    ob_start();
    $formularioPath = "formularios/$tabla.php";
    if (file_exists($formularioPath)) {
        include $formularioPath;
    } else {
        die("Error: No se encontró el formulario para la tabla $tabla.");
    }
    return ob_get_clean();
}

function insertarDatos($conn, $tabla, $datos) {
    $columns = implode(", ", array_keys($datos));
    $placeholders = implode(", ", array_fill(0, count($datos), '?'));
    $sql = "INSERT INTO $tabla ($columns) VALUES ($placeholders)";
    echo $sql; 
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparando la consulta: " . $conn->error);
    }
    $types = ''; 
    $params = []; 
    foreach ($datos as $value) {
        if (is_int($value)) {
            $types .= 'i'; 
        } elseif (is_float($value)) {
            $types .= 'd'; 
        } else {
            $types .= 's'; 
        }
        $params[] = $value;
    }
    $stmt->bind_param($types, ...$params);
    if (!$stmt->execute()) {
        die("Error ejecutando la consulta: " . $stmt->error);
    }
    $stmt->close();
}


function actualizarDatos($conn, $tabla, $id, $datos, $primaryKeyName) {
    $sets = [];
    $params = [];
    $types = '';

    

    foreach ($datos as $column => $value) {
        $sets[] = "$column = ?";
        $params[] = $value;

        if (is_int($value)) {
            $types .= 'i'; 
        } elseif (is_float($value)) {
            $types .= 'd'; 
        } else {
            $types .= 's'; 
        }
    }

    $params[] = $id; 
    $types .= 's'; 

    $setString = implode(", ", $sets);
    $sql = "UPDATE $tabla SET $setString WHERE $primaryKeyName = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparando la consulta: " . $conn->error);
    }

    $stmt->bind_param($types, ...$params);

    if (!$stmt->execute()) {
        die("Error ejecutando la consulta: " . $stmt->error);
    }

    $stmt->close();
    
}


function eliminarDatos($conn, $tabla, $id, $primaryKeyName) {
    
    if ($tabla === 'Cliente') {
        $sql = "DELETE FROM Actividades WHERE Cliente_Numero_cliente = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparando la consulta: " . $conn->error);
        }

        $stmt->bind_param('s', $id);
        if (!$stmt->execute()) {
            die("Error ejecutando la consulta: " . $stmt->error);
        }
        $stmt->close();
    }

    if ($tabla === 'Actividades') {
        $sql = "DELETE FROM Campamentos WHERE Actividades_idActividades = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparando la consulta: " . $conn->error);
        }

        $stmt->bind_param('s', $id);
        if (!$stmt->execute()) {
            die("Error ejecutando la consulta: " . $stmt->error);
        }
        $stmt->close();

        $sql = "DELETE FROM Juegos WHERE Actividades_idActividades = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparando la consulta: " . $conn->error);
        }

        $stmt->bind_param('s', $id);
        if (!$stmt->execute()) {
            die("Error ejecutando la consulta: " . $stmt->error);
        }
        $stmt->close();
    }


    $sql = "DELETE FROM $tabla WHERE $primaryKeyName = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparando la consulta: " . $conn->error);
    }

    $stmt->bind_param('s', $id); 

    if (!$stmt->execute()) {
        die("Error ejecutando la consulta: " . $stmt->error);
    }

    $stmt->close();
}



function obtenerNombreClavePrimaria($conn, $tabla) {
    $sql = "SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Column_name'];
    } else {
        return null;
    }
}

?>

