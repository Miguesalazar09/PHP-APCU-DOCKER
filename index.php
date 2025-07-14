<?php
// Simulación de "base de datos"
function consultarBaseDatos($id) {
    echo "Consultando base de datos para ID $id...\n";
    // Simulamos que tarda 2 segundos
    sleep(2);

    $datosSimulados = [
        1 => 'Dato para ID 1',
        2 => 'Dato para ID 2',
        3 => 'Dato para ID 3',
    ];

    return $datosSimulados[$id] ?? null;
}

// Función para obtener dato con cache APCu
function obtenerDatoConCache($id) {
    $cacheKey = "dato_id_" . $id;

    // Intentar leer del cache
    $dato = apcu_fetch($cacheKey, $success);
    if ($success) {
        return ["dato" => $dato, "fuente" => "cache"];
    }

    // Si no está en cache, consultar "base de datos"
    $dato = consultarBaseDatos($id);
    if ($dato !== null) {
        // Guardar en cache por 60 segundos
        apcu_store($cacheKey, $dato, 60);
    }

    return ["dato" => $dato, "fuente" => "base de datos"];
}

// Recibir id por GET, default 1
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;

$resultado = obtenerDatoConCache($id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini proyecto APCu + DB</title>
</head>
<body>
    <h1>Consulta de dato con cache APCu</h1>
    <form method="get">
        <label for="id">ID a consultar:</label>
        <input type="number" id="id" name="id" value="<?php echo htmlspecialchars($id); ?>" min="1" max="3">
        <button type="submit">Consultar</button>
    </form>

    <h2>Resultado</h2>
    <p><strong>Dato:</strong> <?php echo htmlspecialchars($resultado['dato'] ?? 'No encontrado'); ?></p>
    <p><strong>Fuente:</strong> <?php echo $resultado['fuente']; ?></p>
    <p>(Si la fuente es "base de datos" la consulta demoró 2 segundos, si es "cache" es instantáneo.)</p>
</body>
</html>
