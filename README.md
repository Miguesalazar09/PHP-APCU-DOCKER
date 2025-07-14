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