<?php

namespace App\Controllers;

use App\Controllers\Controller;

use App\Models\Suppliers;

class SuppliersController extends Controller
{

    public function index()
    {
        $supplier = new Suppliers();
        $suppliers = $supplier->all(); // Obtener todos los proveedores

        $this->view('suppliers/index', [
            'title' => 'Proveedores',
            'suppliers' => $suppliers
        ]);
    }

    public function view_all()
    {
        $supplier = new Suppliers();
        $suppliers = $supplier->all();

        echo json_encode([
            'status' => 'success',
            'message' => 'Búsqueda exitosa!',
            'suppliers' => $suppliers
        ]);
    }

    public function unique_view_id($id)
    {
        $supplier = new Suppliers();
        $supplier_data = $supplier->find($id);
        // Verifica si se encontraron datos
        if ($supplier_data) {
            // Si el proveedor fue encontrado, lo retornamos
            echo json_encode([
                'status' => 'success',
                'message' => 'Búsqueda exitosa!',
                'supplier' => $supplier_data
            ]);
        } else {
            // Si no se encuentra el proveedor, retornamos un error
            echo json_encode([
                'status' => 'error',
                'message' => 'Proveedor no encontrado'
            ]);
        }
    }

    public function store()
    {
        //* |-> Recepcion de datos enviados por el formulario
        $data = json_decode(file_get_contents('php://input'), true);
        // Verifica si los datos están completos
        if (isset($data['name']) && isset($data['phone']) && isset($data['address'])) {
            // Crear un nuevo proveedor usando el modelo Suppliers
            $supplier = new Suppliers();
            // Guardar en la base de datos
            if ($supplier->create($data)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Proveedor creado exitosamente',
                    'supplier' => $data
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Hubo un error al crear el proveedor'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Faltan datos requeridos'
            ]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        // Verifica que los datos estén completos
        if (isset($data['name']) && isset($data['phone']) && isset($data['address'])) {
            $supplier = new Suppliers();

            // Llama al método para actualizar el proveedor
            $updated = $supplier->update($id, $data);

            if ($updated) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Proveedor actualizado exitosamente',
                    'supplier' => $data
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Hubo un error al actualizar el proveedor'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Faltan datos requeridos'
            ]);
        }
    }

    public function delete($id)
    {
        $supplier = new Suppliers();
        $delete_supplier = $supplier->delete($id);

        if ($delete_supplier) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Eliminacion exitosa!'
            ]);
        }
    }
}
