# 📦 Sistema de Gestión de Proveedores y Productos

Sistema web para gestionar proveedores y productos con operaciones CRUD, empleando patrones de diseño como MVC para escalabilidad y mantenibilidad.

---

## ✨ Características Principales

- Gestión de proveedores y productos con relación directa.
- AJAX con jQuery para llamadas asíncronas.
- Consultas SQL optimizadas con `INNER JOIN`.
- Interfaz dinámica con formularios y listas desplegables.

---

## 📂 Estructura del Proyecto

```plaintext
project/
├── app/                # Lógica principal
│   ├── Controllers/    # Controladores
│   ├── Models/         # Modelos
│   ├── Views/          # Plantillas HTML
├── config/             # Configuración global
├── public/             # Archivos accesibles (index.php, assets)
├── routes/             # Definición de rutas

```

---

## 🚀 Instalación

### Requisitos
- PHP (>=7.4), MySQL, servidor local (XAMPP, Laragon).

### Pasos
1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/NkDuarte/EME_CP.git
   cd EME_CP/
   ```
2. **Instalar dependencias**:
   Si el proyecto incluye un archivo `composer.json`, ejecuta:
   ```bash
   composer install
3. **Configurar la base de datos**:
   Crear la base `eme_database` y ejecutar:
   ```sql
    CREATE TABLE `products` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `description` text DEFAULT NULL,
    `price` decimal(10, 2) NOT NULL,
    `stock` int(11) NOT NULL DEFAULT 0,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `supplier_id` int(11) DEFAULT NULL
   ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
   
   CREATE TABLE `suppliers` (
      `id` int(11) NOT NULL,
      `name` varchar(255) NOT NULL,
      `phone` varchar(20) DEFAULT NULL,
      `address` varchar(255) NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
   ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
   ```
4. **Editar configuración**:
    Modificar `config/database.php`:
    ```php
    return [
        'host' => 'localhost',
        'dbname' => 'eme_database',
        'user' => 'root',
        'password' => ''
    ];
    ```
5. **Ejecutar el proyecto**:
   Accede en el navegador a `http://localhost:port`.
   ```bash
   php -S localhost:8080 -t public

---

## 📋 Rutas Disponibles

| Método | Ruta                       | Descripción              |
|--------|----------------------------|--------------------------|
| GET    | `/suppliers/view-all`      | Listar proveedores.      |
| POST   | `/suppliers/create`        | Crear proveedor.         |
| PUT    | `/suppliers/update/{id}`   | Actualizar proveedor.    |
| DELETE | `/suppliers/delete/{id}`   | Eliminar proveedor.      |
|--------|----------------------------|--------------------------|
| GET    | `/products/view-all`       | Listar productos.        |
| POST   | `/products/create`         | Crear producto.          |
| PUT    | `/products/update/{id}`    | Actualizar producto.     |
| DELETE | `/products/delete/{id}`    | Eliminar producto.      |

---

## 🛠️ Tecnologías

- **Backend**: PHP, MySQL
- **Frontend**: HTML5, CSS3, jQuery
- **Patrón**: Modelo-Vista-Controlador (MVC)
- **Practicas**: Clean Architecture

---

---

## 🧑‍💻 Autor

**Nicolás Duarte Moreno**  
```
 ███▄    █  ██ ▄█▀
 ██ ▀█   █  ██▄█▒ 
▓██  ▀█ ██▒▓███▄░ 
▓██▒  ▐▌██▒▓██ █▄ 
▒██░   ▓██░▒██▒ █▄
░ ▒░   ▒ ▒ ▒ ▒▒ ▓▒
░ ░░   ░ ▒░░ ░▒ ▒░
   ░   ░ ░ ░ ░░ ░ 
         ░ ░  ░   
                  
```