<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("database.php");
include("functions.php");

if (isset($_GET['tabla']) && isset($_GET['id'])) {
    $tabla = $_GET['tabla'];
    $id = $_GET['id'];

    $primaryKeyName = obtenerNombreClavePrimaria($conn, $tabla);

    if (!$primaryKeyName) {
        exit();
    }

    $columnasNumericas = [
        'Lideres_de_grupo' => ['ci', 'telefono'],
        'Cliente' => ['numero_cliente', 'cliente_ci', 'telefono', 'edad'],
        'Actividades' => ['identificador', 'lider_ci', 'numero_cliente'],
        'Juegos' => ['identificador', 'cantidad_participantes', 'id_actividad', 'numero_cliente'],
        'Campamentos' => ['identificador', 'id_actividad', 'numero_cliente'],
        'Deportes' => ['identificador', 'horas_semanales', 'id_actividad', 'numero_cliente']
    ];

    $error = '';
    if (isset($columnasNumericas[$tabla])) {
        foreach ($columnasNumericas[$tabla] as $columna) {
            if (isset($_POST[$columna]) && !is_numeric($_POST[$columna])) {
                $error = "El campo $columna debe ser numérico.";
                break;
            }
        }
    }

    if ($error) {
        header("Location: formulario.php?tabla=$tabla&id=$id&error=" . urlencode($error));
        exit();
    }

    $datos = procesarDatosPorTabla($tabla, $_POST);

    if ($id) {
        if (isset($_GET['delete'])) {
            eliminarDatos($conn, $tabla, $id, $primaryKeyName);
            header("Location: listar.php?tabla=$tabla&mensaje=" . urlencode('Los datos se han eliminado correctamente.'));
        } else {
            actualizarDatos($conn, $tabla, $id, $datos, $primaryKeyName);
            header("Location: listar.php?tabla=$tabla&mensaje=" . urlencode('Los datos se han editado correctamente.'));
        }
    } else {
        insertarDatos($conn, $tabla, $datos);
        header("Location: listar.php?tabla=$tabla&mensaje=" . urlencode('Los datos se han agregado correctamente.'));
    }
    exit();
} else {
    echo "Error: No se ha especificado una tabla o no se han enviado datos.";
}

function procesarDatosPorTabla($tabla, $postData) {
    switch ($tabla) {
        case 'Asociacion':
            return [
                'Nombre' => $postData['nombre'] ?? null,
                'Direccion' => $postData['direccion'] ?? null,
                'Telefono' => $postData['telefono'] ?? null
            ];
        case 'Colonias':
            return [
                'Codigo' => $postData['codigo'] ?? null,
                'Ubicacion' => $postData['ubicacion'] ?? null,
                'Asociacion_Nombre' => $postData['asociacion_nombre'] ?? null
            ];
        case 'Lideres_de_grupo':
            return [
                'CI' => $postData['ci'] ?? null,
                'Nombre' => $postData['nombre'] ?? null,
                'Telefono' => $postData['telefono'] ?? null,
                'Certificacion_Codigo' => $postData['codigo_certificacion'] ?? null
            ];
        case 'Cliente':
            return [
                'Numero_cliente' => $postData['numero_cliente'] ?? null,
                'CI' => $postData['cliente_ci'] ?? null,
                'Telefono' => $postData['telefono'] ?? null,
                'Edad' => $postData['edad'] ?? null
            ];
        case 'Certificacion':
            return [
                'Codigo' => $postData['codigo'] ?? null,
                'Fecha' => $postData['fecha'] ?? null,
                'Grado' => $postData['grado'] ?? null,
                'Asociacion' => $postData['asociacion_nombre'] ?? null
            ];
        case 'Actividades':
            return [
                'Identificador' => $postData['identificador'] ?? null,
                'Descripcion' => $postData['descripcion'] ?? null,
                'Lider_Certificacion_Codigo' => $postData['codigo_cert'] ?? null,
                'Lider_CI' => $postData['lider_ci'] ?? null,
                'Cliente_Numero_cliente' => $postData['numero_cliente'] ?? null
            ];
        case 'Juegos':
            return [
                'Identificador' => $postData['identificador'] ?? null,
                'Tipo_juego' => $postData['tipo_juego'] ?? null,
                'Descripcion' => $postData['descripcion'] ?? null,
                'Cantidad_participantes' => $postData['cantidad_participantes'] ?? null,
                'Actividades_idActividades' => $postData['id_actividad'] ?? null,
                'Actividades_Cliente_Numero_cliente' => $postData['numero_cliente'] ?? null
            ];
        case 'Campamentos':
            return [
                'Identificador' => $postData['identificador'] ?? null,
                'Ubicacion' => $postData['ubicacion'] ?? null,
                'Duracion' => $postData['duracion'] ?? null,
                'Actividades_idActividades' => $postData['id_actividad'] ?? null,
                'Actividades_Cliente_Numero_cliente' => $postData['numero_cliente'] ?? null
            ];
        case 'Deportes':
            return [
                'Identificador' => $postData['identificador'] ?? null,
                'Tipo' => $postData['tipo_deporte'] ?? null,
                'Accesorio' => $postData['accesorios'] ?? null,
                'Horas_semanales' => $postData['horas_semanales'] ?? null,
                'Actividades_idActividades' => $postData['id_actividad'] ?? null,
                'Actividades_Cliente_Numero_cliente' => $postData['numero_cliente'] ?? null
            ];
        default:
            exit();
    }
}
