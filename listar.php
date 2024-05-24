<?php

include("database.php");
include("functions.php");

if (isset($_GET['tabla'])) {
    $tabla = $_GET['tabla'];
    $ordenColumna = isset($_GET['orden_columna']) ? $_GET['orden_columna'] : null;
    $ordenTipo = isset($_GET['orden_tipo']) ? $_GET['orden_tipo'] : 'ASC';
    $buscarGeneral = isset($_GET['buscar_general']) ? $_GET['buscar_general'] : '';

    $registros = obtenerRegistrosFiltradosGeneral($conn, $tabla, $buscarGeneral, $ordenColumna, $ordenTipo);

    if ($registros === false) {
        die("Error al obtener registros.");
    }

    $primaryKeyName = obtenerNombreClavePrimaria($conn, $tabla);

    if (!$primaryKeyName) {
        die("Error: No se pudo obtener el nombre de la clave primaria para la tabla $tabla.");
    }

    function toggleOrden($currentOrder)
    {
        return $currentOrder === 'ASC' ? 'DESC' : 'ASC';
    }

    
    function exportarCSV($registros)
    {
        $filename = 'export_' . date('Y-m-d') . '.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $output = fopen('php://output', 'w');
        fputcsv($output, array_keys($registros[0])); // Encabezados
        foreach ($registros as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
    }

    
    if (isset($_GET['exportar']) && $_GET['exportar'] == 1) {
        exportarCSV($registros);
        exit();
    }

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title style="color: white;">Listado de <?php echo htmlspecialchars($tabla); ?></title>

        <link href="styles.css" src="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
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
            
            .input-group {
                max-width: 600px;
                margin: 20px auto;
            }
            .form-control {
                border-radius: 0.375rem 0 0 0.375rem;
            }
            .btn-outline-primary {
                border-radius: 0 0.375rem 0.375rem 0;
            }
            .btn-outline-primary:hover {
                color: #fff;
                background-color: #0d6efd;
                border-color: #0d6efd;
            }   
            .index-background {
            background-image: url('https://upload.wikimedia.org/wikipedia/commons/0/02/Siblings_brother_and_sister.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            }
            .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: #fff;
            border-collapse: collapse;
            border-radius: 0.5rem;
            overflow: hidden;
            }
            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
                background-color: #f8f9fa;
            }

            .table tbody + tbody {
                border-top: 2px solid #dee2e6;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }

            .table-hover tbody tr:hover {
                background-color: rgba(0, 0, 0, 0.075);
            }
        </style>
    </head>

    <body class="index-background">
        <div class="container mt-3">
            <?php if (isset($_GET['mensaje'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_GET['mensaje']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
    
        <h2 style="color: white;">Listado de <?php echo htmlspecialchars($tabla); ?></h2>


        <form method="get" action="listar.php">
            <input type="hidden" name="tabla" value="<?php echo htmlspecialchars($tabla); ?>">
            <label for="buscar_general" style="color: white;">Buscar:</label>
            <div class="container">
        <div class="input-group mb-3">
                <input type="search" class="form-control" placeholder="Buscar..." aria-label="Buscar..." name="buscar_general">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </div>
        </div>
        </form>

        <?php if (count($registros) === 0) { ?>
            <p>No hay registros</p>
        <?php } else { ?>
            <table class="table table-striped">
                <tr>
                    <?php
                    foreach ($registros[0] as $column => $value) {
                        $nextOrdenTipo = toggleOrden($ordenTipo);
                        echo "<th>";
                        echo htmlspecialchars($column);
                        echo " <a href='listar.php?tabla=" . htmlspecialchars($tabla) . "&orden_columna=" . htmlspecialchars($column) . "&orden_tipo=ASC'><i class='fa-solid fa-arrow-up'></i></a>";
                        echo " <a href='listar.php?tabla=" . htmlspecialchars($tabla) . "&orden_columna=" . htmlspecialchars($column) . "&orden_tipo=DESC'><i class='fa-solid fa-arrow-down'></i></a>";
                        echo "</th>";
                    }
                    ?>
                    <?php if ($tabla !== 'Asociacion' && $tabla !== 'Colonias' && $tabla !== 'Actividades') { ?>
                        <th>Acciones</th>
                    <?php } ?>
                </tr>
                <?php
                foreach ($registros as $row) {
                    echo "<tr>";
                    foreach ($row as $column => $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    if ($tabla !== 'Asociacion' && $tabla !== 'Colonias' && $tabla !== 'Actividades') {
                        if (isset($row[$primaryKeyName])) {
                            echo "<td>
                                    <a href='formulario.php?tabla=" . htmlspecialchars($tabla) . "&id=" . htmlspecialchars($row[$primaryKeyName]) . "'>
                                        <i class='fa-regular fa-pen-to-square fa-1x' style='color: green;'></i>
                                    </a> |
                                    <a href='#' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal" . htmlspecialchars($row[$primaryKeyName]) . "'>
                                        <i class='fa-solid fa-trash fa-1x' style='color: red;'></i>
                                    </a>
                                  </td>";
                    
                            // Modal de confirmación de eliminación
                            echo "<div class='modal fade' id='confirmDeleteModal" . htmlspecialchars($row[$primaryKeyName]) . "' tabindex='-1' aria-labelledby='confirmDeleteModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='confirmDeleteModalLabel'>Confirmar Eliminación</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                ¿Estás seguro de que deseas eliminar este registro?
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                                <a href='procesar_datos.php?tabla=" . htmlspecialchars($tabla) . "&id=" . htmlspecialchars($row[$primaryKeyName]) . "&delete=1' class='btn btn-danger'>Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                  </div>";
                        }
                     else {
                            echo "<td>Error: Clave primaria no encontrada</td>";
                        }
                    }
                    echo "</tr>";
                }
                ?>
            </table>
            <?php if ($tabla !== 'Asociacion' && $tabla !== 'Colonias' && $tabla !== 'Actividades') { ?>
                <a href="formulario.php?tabla=<?php echo htmlspecialchars($tabla); ?>"><i class="fa-solid fa-plus fa-2x" style="color: white;"></i></a>
                <a href="listar.php?tabla=<?php echo htmlspecialchars($tabla); ?>&exportar=1" class="btn-export-csv"><i class="fa-solid fa-file-csv fa-2x" style="color: white;"></i></i></a>
            <?php } ?>
        <?php } ?>

        <a href="index.html" class="back-btn"><i class="fa-solid fa-circle-left fa-2x" style="color: white;"></i></i></i></a>
        <a href="index.html" class="fixed-button"><i class="fa-solid fa-circle-left"></i> Inicio</a>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </div>           
    </html>
<?php
} else {
    echo "Error: No se ha especificado una tabla.";
}
?>