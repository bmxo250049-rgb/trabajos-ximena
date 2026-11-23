<?php
// ----- MODELO DE NEGOCIO -----
$peso_payaso = 112;   // gramos
$peso_muneca = 104;   // gramos
$error = "";

$npayasos_raw = isset($_POST["npayasos"]) ? trim($_POST["npayasos"]) : "";
$nmunecas_raw = isset($_POST["nmunecas"]) ? trim($_POST["nmunecas"]) : "";

$npayasos = filter_var($npayasos_raw, FILTER_VALIDATE_INT);
$nmunecas = filter_var($nmunecas_raw, FILTER_VALIDATE_INT);

if ($npayasos === false || $nmunecas === false || $npayasos < 0 || $nmunecas < 0) {
    $error = "Por favor escribe únicamente números enteros iguales o mayores a 0.";
} elseif ($npayasos === 0 && $nmunecas === 0) {
    $error = "El pedido debe incluir al menos 1 payaso o 1 muñeca.";
}

if ($error === "") {
    $paquetepayaso = $npayasos * $peso_payaso;
    $paquetemunecas = $nmunecas * $peso_muneca;
    $pesototal = $paquetepayaso + $paquetemunecas;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado - Peso del paquete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <div class="encabezado encabezado-naranja">
            <h1>Peso del paquete</h1>
            <p class="mb-0">Informe de envío logístico</p>
        </div>

        <div class="resultado-card">
        <?php if ($error !== "") { ?>
            <div class="alert alert-danger fw-bold"><?php echo htmlspecialchars($error); ?></div>
            <a href="Ejercicio2.html" class="btn btn-secondary">Regresar al formulario</a>
        <?php } else { ?>
            <table class="table table-bordered table-hover bg-white text-center align-middle">
                <thead class="table-warning">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Peso unitario</th>
                        <th>Peso subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-bold">🤡 Payasos</td>
                        <td><?php echo $npayasos; ?></td>
                        <td><?php echo $peso_payaso; ?> g</td>
                        <td class="fw-bold"><?php echo number_format($paquetepayaso); ?> g</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">🪆 Muñecas</td>
                        <td><?php echo $nmunecas; ?></td>
                        <td><?php echo $peso_muneca; ?> g</td>
                        <td class="fw-bold"><?php echo number_format($paquetemunecas); ?> g</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="table-dark">
                        <th colspan="3" class="text-end">Peso total del paquete:</th>
                        <th><?php echo number_format($pesototal); ?> g</th>
                    </tr>
                </tfoot>
            </table>

            <div class="alert alert-success text-center fs-5 mb-4">
                El paquete total pesa <b><?php echo number_format($pesototal); ?> gramos</b>
                (<b><?php echo number_format($pesototal / 1000, 3); ?> kg</b>).
            </div>

            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <a href="Ejercicio2.html" class="btn btn-warning">Nuevo cálculo</a>
                <a href="index.html" class="btn btn-secondary">Menú principal</a>
            </div>
        <?php } ?>
        </div>
    </div>
</body>
</html>