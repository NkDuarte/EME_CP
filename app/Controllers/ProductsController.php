<?php

//* |-> Nombramos el espacio de trabajo
namespace App\Controllers;

//! Importacion de modelos
use App\Models\Products;
use App\Controllers\Controller;

//* |-> Instanciamos la clase y extendemos de Controller
class ProductsController extends Controller
{
    //* |-> Funcion que traera los resultados y cargara la vista inicial
    public function index()
    {
        $products = new Products();
        $result_products = $products->all();

        $this->view('products/index', [
            'title' => 'Productos',
            'products' => $result_products
        ]);
    }

    //* |-> Funcion que traera un producto por id
    public function unique_view_id($id)
    {
        //* |-> Iniciamos la instancia
        $product = new Products();
        //* |-> Ejecutamos el metodo de busqueda por id
        $result_product_id = $product->find($id);

        //* |-> Validamos que retorne datos
        if ($result_product_id) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Busqueda exitosa!',
                'product' => $result_product_id
            ]);
        }else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Producto no encontrado!',
            ]);
        }
    }

    //* |-> Funcion que creara un producto
    public function store()
    {
        //* |-> Capturamos la data del body de la peticion
        $data = json_decode(file_get_contents('php://input'), true);
        //* |-> Validamos que los campos necesarios esten
        if (isset($data['name']) && isset($data['description']) && isset($data['price']) && isset($data['stock']) && isset($data['supplier_id'])) {
            $product = new Products();
            if ($product->create($data)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Producto creado exitosamente',
                    'supplier' => $data
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Hubo un error al crear el producto'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Faltan datos requeridos'
            ]);
        }
    }

    //* |-> Funcion que actualizara un producto por su id
    public function update($id)
    {
        //* |-> Capturamos la data del body de la peticion
        $data = json_decode(file_get_contents('php://input'), true);
        //* |-> Validamos que los campos necesarios esten
        if (isset($data['name']) && isset($data['description']) && isset($data['price']) && isset($data['stock']) && isset($data['supplier_id'])) {
            $product = new Products();
            if ($product->update($id, $data)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Producto actualizado exitosamente',
                    'supplier' => $data
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Hubo un error al actualizar el producto'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Faltan datos requeridos'
            ]);
        }
    }

    //* |-> Funcion que eliminara un producto por su id
    public function delete($id)
    {
        $supplier = new Products();
        $delete_supplier = $supplier->delete($id);

        if ($delete_supplier) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Eliminacion exitosa!'
            ]);
        }
    }
}

?>