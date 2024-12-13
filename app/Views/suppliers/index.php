<?php ob_start(); ?>

<div class="jumbotron">
    <h1 class="display-4">Proveedores</h1>
    <hr class="my-4">
    <!--//* Sin ningun resultado mostraremos el boton para crear-->
    <div class="row justify-content-center w-100">
        <div class="col-md-auto align-self-center w-100">
            <?php if (empty($suppliers)): ?>
                <div class="text-center">
                    <h4>¿Sin proveedores?</h4>
                    <p>Crea uno ahora</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplierModal">
                        <i class='bx bx-plus bx-sm'></i>
                    </button>
                </div>
            <?php else: ?>
                <div class="row justify-content-center">
                    <div class="col-md-12 m-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplierModal">
                            <i class='bx bx-plus bx-sm'></i>
                        </button>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col"> - </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($suppliers as $supplier): ?>
                                    <tr>
                                        <th scope="row"><?= $supplier->id ?></th>
                                        <td><?= $supplier->name ?></td>
                                        <td><?= $supplier->phone ?></td>
                                        <td><?= $supplier->address ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-link text-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class='bx bx-dots-vertical bx-sm'></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <li>
                                                        <button class="dropdown-item edit-btn" data-toggle="modal" data-target="#supplierModal" type="button" data-id="<?= $supplier->id ?>">
                                                            <i class='bx bx-edit bx-sm'></i>
                                                            Editar
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" type="button" onclick="deleteSupplier(<?= $supplier->id ?>)">
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
<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supplierModalLabel">Crear Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container-fluid">
                <form id="supplierForm" method="POST">
                    <input type="hidden" name="id" id="supplierId" value="">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" required>
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

<!-- Tu código JavaScript/jQuery aquí -->
<script>
    // Script para cargar datos en el modal de edición
    $('#supplierModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que abre el modal
        var id = button.data('id'); // Extraer el ID del proveedor desde el botón
        if (id >= 1) {
            $.ajax({
                url: `/suppliers/view-unique/${id}`,
                type: 'GET', // Usamos GET para obtener los datos
                success: function(resp) {
                    const response = JSON.parse(resp)
                    if (response.status === 'success') {
                        var data = response.supplier;
                        // Llenar los campos del formulario en el modal con los datos del proveedor
                        var modal = $('#supplierModal');
                        modal.find('.modal-title').text('Editar Proveedor');
                        modal.find('#supplierId').val(data.id); // ID del proveedor
                        modal.find('#name').val(data.name); // Nombre del proveedor
                        modal.find('#phone').val(data.phone); // Teléfono del proveedor
                        modal.find('#address').val(data.address); // Dirección del proveedor
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
        var phone = button.data('phone');
        var address = button.data('address');

        // Llenar los campos del formulario en el modal
        var modal = $(this);
        modal.find('.modal-title').text(id ? 'Editar Proveedor' : 'Crear Proveedor');
        modal.find('#supplierId').val(id || ''); // Si es nuevo, dejar el ID vacío
        modal.find('#name').val(name || '');
        modal.find('#phone').val(phone || '');
        modal.find('#address').val(address || '');
    });

    // Cuando el documento esté listo
    $(document).ready(function() {
        // Cuando se envía el formulario
        $('#supplierForm').submit(function(e) {
            e.preventDefault(); // Evitar el comportamiento por defecto (recarga de la página)

            // Crear un objeto con los datos del formulario
            var formData = {
                id: $('#supplierId').val(),
                name: $('#name').val(),
                phone: $('#phone').val(),
                address: $('#address').val()
            };

            var url = formData.id ? `/suppliers/update/${formData.id}` : '/suppliers/store';
            // Enviar la solicitud AJAX
            $.ajax({
                url: url, // Ruta donde se procesará el formulario
                type: formData.id ? 'PUT' : 'POST',
                contentType: 'application/json', // Asegurarse de que el tipo de contenido sea JSON
                data: JSON.stringify(formData), // Convertir los datos a formato JSON
                success: function(response) {
                    // Aquí puedes manejar la respuesta, por ejemplo, mostrar un mensaje de éxito
                    alert('Proveedor guardado correctamente');
                    $('#supplierModal').modal('hide'); // Cerrar el modal después de guardar
                    location.reload(); // Recargar la página (opcional)
                },
                error: function(xhr, status, error) {
                    // Aquí puedes manejar el error, por ejemplo, mostrar un mensaje de error
                    alert('Hubo un error al guardar el proveedor');
                }
            });
        });
    });
    
    function deleteSupplier(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este proveedor?')) {
        fetch(`/suppliers/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
                alert('Proveedor eliminado correctamente');
            } else {
                alert('Hubo un error al eliminar el proveedor');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

</script>