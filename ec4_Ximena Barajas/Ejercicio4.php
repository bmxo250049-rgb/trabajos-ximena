<?php
// ----- MODELO DE NEGOCIO -----
$error = "";

$kilos = isset($_POST["kilos"]) ? (float)$_POST["kilos"] : 0;
$precio = isset($_POST["precio"]) ? (float)$_POST["precio"] : 0;

if ($kilos <= 0 || $precio <= 0) {
    $error = "Por favor escribe los kilos comprados y el precio por kilo (ambos mayores a 0).";
}

if ($kilos <= 2) {
    $descuento = 0;
} elseif ($kilos <= 5) {
    $descuento = 10;
} elseif ($kilos <= 10) {
    $descuento = 15;
} else {
    $descuento = 20;
}

$subtotal = $kilos * $precio;
$monto_descuento = $subtotal * ($descuento / 100);
$total = $subtotal - $monto_descuento;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado - Frutería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <div class="encabezado encabezado-rojo">
            <h1>🍎 Nota de venta - Frutería</h1>
            <p class="mb-0">Detalle de compra y descuento aplicado</p>
        </div>

        <div class="resultado-card">
        <?php if ($error !== "") { ?>
            <div class="alert alert-danger fw-bold"><?php echo htmlspecialchars($error); ?></div>
            <a href="Ejercicio4.html" class="btn btn-secondary">Regresar</a>
        <?php } else { ?>
            <table class="table table-bordered table-hover bg-white align-middle mb-4">
                <tbody>
                    <tr>
                        <th class="bg-light" style="width: 55%;">Kilos de manzana comprados</th>
                        <td class="text-end fw-bold"><?php echo number_format($kilos, 2); ?> kg</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Precio por kilo</th>
                        <td class="text-end">$<?php echo number_format($precio, 2); ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Subtotal</th>
                        <td class="text-end">$<?php echo number_format($subtotal, 2); ?></td>
                    </tr>
                    <tr class="table-success">
                        <th>Descuento aplicado (<?php echo $descuento; ?>%)</th>
                        <td class="text-end fw-bold">-$<?php echo number_format($monto_descuento, 2); ?></td>
                    </tr>
                    <tr class="table-danger fs-5">
                        <th>Total a pagar</th>
                        <th class="text-end">$<?php echo number_format($total, 2); ?> MXN</th>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <a href="Ejercicio4.html" class="btn btn-danger">Nueva compra</a>
                <a href="index.html" class="btn btn-secondary">Menú principal</a>
            </div>
        <?php } ?>
        </div>
    </div>
</body>
</html>