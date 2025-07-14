<?php
$info = apcu_cache_info();

if ($info === false) {
    echo "No se pudo obtener información del cache.\n";
    exit(1);
}

echo "Claves guardadas en APCu:\n";

if (isset($info['cache_list']) && is_array($info['cache_list'])) {
    foreach ($info['cache_list'] as $item) {
        if (isset($item['key'])) {
            echo "- " . $item['key'] . "\n";
        } else {
            echo "- (clave sin nombre)\n";
        }
    }
} else {
    echo "No hay entradas en cache_list o no es un array.\n";
}
