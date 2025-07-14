# Mini Proyecto PHP + APCu + Docker

Este proyecto demuestra cómo usar **APCu** para cachear resultados de una consulta simulada a base de datos usando **PHP** dentro de un contenedor Docker con Apache.

---

## 🧱 Tecnologías

- PHP 8.2 (mod_php)
- Apache 2
- APCu
- Docker + Docker Compose

---

## 🚀 Cómo usar

1. Cloná este repositorio o copiá los archivos en una carpeta:

```bash
git clone https://github.com/tu-usuario/php-apcu-mini-db.git
cd php-apcu-mini-db

2. Construí y levantá el contenedor:
    docker compose up --build


3. Abrí tu navegador y entrá a:
    http://localhost:8080
    
4. Para reiniciar el cache, podés bajar el contenedor:
    docker compose down

O borrar manualmente desde código con apcu_delete('clave').

Funciones principales de APCu / APCu Main Functions
1. Guardar datos en caché / Caching Data
	apcu_store('clave', 'valor', 60); // Guarda por 60 segundos
    • 'clave': identificador único del dato
    • 'valor': cualquier valor serializable (strings, arrays, objetos)
    • 60: tiempo de vida (TTL) en segundos

2. Leer datos del caché / Read data from the cache
	$valor = apcu_fetch('clave', $success);
	if ($success) {
	    echo "Dato encontrado: $valor";
	}

3. Verificar si una clave existe / Check if a key exists
	if (apcu_exists('clave')) {
	    echo "La clave existe en cache.";
	}

4. Eliminar una clave del caché / Delete a key from the cache
	apcu_delete('clave');

5. Limpiar toda la caché / Clear the entire cache
	apcu_clear_cache();
⚠️ Solo borra datos de usuario (no afecta OPcache).

Funciones de administración y debugging
Ver estadísticas del caché
	$info = apcu_cache_info();
	print_r($info);
Ver memoria usada
	$mem = apcu_sma_info();
	print_r($mem);

📈 Buenas prácticas
    • Usá claves descriptivas ("user_123", "post_456")
    • Cacheá solo datos que no cambien seguido (por ejemplo, configuración, resultados de consulta, etc.)
    • Usá un TTL corto si los datos son sensibles a cambios
    • No abuses del caché: verificá si los datos valen la pena cachearlos