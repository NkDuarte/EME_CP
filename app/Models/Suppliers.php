<?php

namespace App\Models;

use PDO;
use PDOException;
use App\Config\Database;

class Suppliers
{
    private $conn;
    private $table = 'suppliers';

    // Propiedades del proveedor
    public $id;
    public $name;
    public $phone;
    public $address;

    public function __construct()
    {
        // Instanciamos la conexión a la base de datos
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Obtener todos los proveedores
    public function all()
    {
        $query = 'SELECT * FROM ' . $this->table;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Obtener un proveedor por su ID
    public function find($id)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Crear un nuevo proveedor
    public function create($data)
    {
        $query = 'INSERT INTO ' . $this->table . ' (name, phone, address) VALUES (:name, :phone, :address)';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Actualizar un proveedor
    public function update($id, $data)
    {
        $query = 'UPDATE ' . $this->table . ' SET name = :name, phone = :phone, address = :address WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':address', $data['address']);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Eliminar un proveedor
    public function delete($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
