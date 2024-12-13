<?php ob_start(); ?>

<div class="jumbotron">
    <h1 class="display-4">Bienvenido al Centro de Ventas</h1>
    <hr class="my-4">
    <h3>Accesos rapidos.</h3>
    <div class="row justify-content-center">
        <div class="col-md-auto align-self-center text-center">
            <a class="btn btn-primary btn-lg" href="/suppliers" role="button">Proveedor</a>
            <a class="btn btn-primary btn-lg" href="/products" role="button">Producto</a>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include_once __DIR__ . '/../layouts/main.php'; ?>
