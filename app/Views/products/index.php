<?php ob_start(); ?>

<div class="jumbotron">
    <h1 class="display-4">Productos</h1>
    <hr class="my-4">
    <!--//* Sin ningun resultado mostraremos el boton para crear-->
    <div class="row justify-content-center w-100">
        <div class="col-md-auto align-self-center w-100">
            <?php if (empty($products)): ?>
                <div class="text-center">
                    <h4>¿Sin Productos?</h4>
                    <p>Crea uno ahora</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productsModal">
                        <i class='bx bx-plus bx-sm'></i>
                    </button>
                </div>
            <?php else: ?>
                <div class="row justify-content-center">
                    <div class="col-md-12 m-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productsModal">
                            <i class='bx bx-plus bx-sm'></i>
                        </button>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col"> - </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <th scope="row"><?= $product->product_id ?></th>
                                        <td><?= $product->product_name ?></td>
                                        <td><?= $product->price ?></td>
                                        <td><?= $product->stock ?></td>
                                        <td><?= $product->supplier_name ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-link text-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class='bx bx-dots-vertical bx-sm'></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <li>
                                                        <button class="dropdown-item edit-btn" data-toggle="modal" data-target="#productsModal" type="button" data-id="<?= $product->product_id ?>">
                                                            <i class='bx bx-edit bx-sm'></i>
                                                            Editar
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" type="button" onclick="deleteSupplier(<?= $product->product_id ?>)">
                                                            <i class='bx bx-trash bx-sm'></i>
                                                            Eliminar
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal para Crear y Editar Proveedores -->
<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productsModalLabel">Crear Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container-fluid">
                <form id="productsForm" method="POST">
                    <input type="hidden" name="id" id="productsId" value="">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Precio</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Stock</label>
                        <input type="text" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="input-group my-3">
                        <label class="input-group-text" for="inputGroupProveedor">Proveedor</label>
                        <select class="form-select" id="inputGroupProveedor" name="supplier_id">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Descripcion</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once __DIR__ . '/../layouts/main.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $.ajax({
        url: '/suppliers/view-all',
        type: 'GET',
        contentType: 'application/json',
        success: function(response) {
            const {
                suppliers
            } = JSON.parse(response)

            const selectElement = $('#inputGroupProveedor');

            selectElement.find('option:not(:first)').remove();

            suppliers.forEach(function(supplier) {
                const option = `<option value="${supplier.id}">${supplier.name}</option>`;
                selectElement.append(option);
            });
        },
        error: function(xhr, status, error) {
            // Aquí puedes manejar el error, por ejemplo, mostrar un mensaje de error
            alert('Hubo un error al guardar el proveedor');
        }
    });

    $('#productsModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que abre el modal
        var id = button.data('id'); // Extraer el ID del proveedor desde el botón        
        if (id >= 1) {
            $.ajax({
                url: `/products/view-unique/${id}`,
                type: 'GET', // Usamos GET para obtener los datos
                success: function(resp) {
                    const response = JSON.parse(resp)
                    if (response.status === 'success') {
                        var data = response.product;
                        // Llenar los campos del formulario en el modal con los datos del proveedor
                        var modal = $('#productsModal');
                        modal.find('.modal-title').text('Editar Proveedor');
                        modal.find('#supplierId').val(data.id);
                        modal.find('#name').val(data.name);
                        modal.find('#price').val(data.price);
                        modal.find('#stock').val(data.stock);
                        modal.find('#description').val(data.description);
                        modal.find('#inputGroupProveedor').val(data.supplier_id);
                    } else {
                        console.log(response.message);
                    }

                },
                error: function(xhr, status, error) {
                    alert('Hubo un error al cargar los datos del proveedor');
                }
            });
        }

        var name = button.data('name');
        var price = button.data('price');
        var stock = button.data('stock');
        var description = button.data('description');
        var supplier_id = button.data('supplier_id');

        // Llenar los campos del formulario en el modal
        var modal = $(this);
        modal.find('.modal-title').text(id ? 'Editar Producto' : 'Crear Producto');
        modal.find('#productsId').val(id || ''); // Si es nuevo, dejar el ID vacío
        modal.find('#name').val(name || '');
        modal.find('#price').val(price || '');
        modal.find('#stock').val(stock || '');
        modal.find('#description').val(description || '');
        modal.find('#inputGroupProveedor').val(supplier_id || '');
    });

    // Cuando el documento esté listo
    $(document).ready(function() {
        // Cuando se envía el formulario
        $('#productsForm').submit(function(e) {
            e.preventDefault(); // Evitar el comportamiento por defecto (recarga de la página)

            // Crear un objeto con los datos del formulario
            var formData = {
                id: $('#productsId').val(),
                name: $('#name').val(),
                price: $('#price').val(),
                stock: $('#stock').val(),
                description: $('#description').val(),
                supplier_id: $('#inputGroupProveedor').val()
            };
            var url = formData.id ? `/products/update/${formData.id}` : '/products/store';
            // Enviar la solicitud AJAX
            $.ajax({
                url: url, // Ruta donde se procesará el formulario
                type: formData.id ? 'PUT' : 'POST',
                contentType: 'application/json', // Asegurarse de que el tipo de contenido sea JSON
                data: JSON.stringify(formData), // Convertir los datos a formato JSON
                success: function(response) {
                    // Aquí puedes manejar la respuesta, por ejemplo, mostrar un mensaje de éxito
                    alert('Producto guardado correctamente');
                    $('#productsModal').modal('hide'); // Cerrar el modal después de guardar
                    location.reload(); // Recargar la página (opcional)
                },
                error: function(xhr, status, error) {
                    // Aquí puedes manejar el error, por ejemplo, mostrar un mensaje de error
                    alert('Hubo un error al guardar el producto');
                }
            });
        });
    });

    function deleteSupplier(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            fetch(`/products/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    response.json()
                    location.reload();
                })
                .then(data => {
                    if (data.status === 'success') {
                        alert('Prodcto eliminado correctamente');
                    } else {
                        alert('Hubo un error al eliminar el Producto');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
</script>