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
    CREATE TABLE suppliers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        contact_name VARCHAR(255),
        ontact_email VARCHAR(255),
        phone VARCHAR(20),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    CREATE TABLE products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10, 2) NOT NULL,
        stock INT NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        supplier_id INT,  -- Relación con proveedor
        FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE SET NULL
    );
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
   Accede en el navegador a `http://localhost/EME_CP/public`.

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