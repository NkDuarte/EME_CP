<?php

//* |-> Mencionamos el espacio de trabajo en el que esta
namespace App\Models;

//* |-> Importaciones de modelos
use PDO;
use App\Config\Database;

//* |-> Creacion de clase modelo
class Products
{
    //* |-> Conexion DB
    private $conn;
    //* |-> Tabla DB
    private $table = 'products';
    //* |-> Tabla DB foringkey
    private $table_foring = 'suppliers';

    //* |-> Propiedades de la categoria
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $supplier_id;

    //* |-> Funcion de instancia DB
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    /****************************/
    //? -> Servicios CRUD
    /****************************/

    //? -> Obtener todas las categorias registradas
    public function all()
    {
        //* |-> Consulta
        $query = 'SELECT products.id AS product_id, products.name AS product_name, products.description, products.price, products.stock, suppliers.name AS supplier_name FROM ' . $this->table . ' INNER JOIN ' . $this->table_foring . ' ON products.supplier_id = suppliers.id;';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //? -> Obtener una categoria por su id
    public function find($id)
    {
        //* |-> Consulta
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    //? -> Crear una nueva categoria
    public function create($data)
    {
        $query = 'INSERT INTO ' . $this->table . ' (name, description, price, stock, supplier_id) VALUES (:name, :description, :price, :stock, :supplier_id)';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':supplier_id', $data['supplier_id']);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    //? |-> Actualizar una categoria por su id
    public function update($id, $data)
    {
        $query = 'UPDATE ' . $this->table . ' SET name = :name, description = :description, price = :price, stock = :stock, supplier_id = :supplier_id WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':supplier_id', $data['supplier_id']);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    //? -> Eliminar una categoria por su id
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
