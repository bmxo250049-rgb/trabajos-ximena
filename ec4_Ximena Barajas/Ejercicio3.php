<?php
date_default_timezone_set("America/Mexico_City");

// ----- MODELO DE NEGOCIO -----
$pago_hora = 16;
$pago_extra = 20;
$error = "";

$nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
$horas = isset($_POST["horas"]) ? (float)$_POST["horas"] : -1;

if ($nombre === "" || $horas < 0 || $horas > 168) {
    $error = "Escribe el nombre completo del trabajador y un número de horas válido (entre 0 y 168).";
}

if ($horas <= 40) {
    $horas_normales = $horas;
    $horas_extra = 0;
} else {
    $horas_normales = 40;
    $horas_extra = $horas - 40;
}

$pago_normal = $horas_normales * $pago_hora;
$pago_horas_extra = $horas_extra * $pago_extra;
$salario = $pago_normal + $pago_horas_extra;
$folio = "NOM-" . rand(1000, 9999);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recibo de pago semanal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container my-4">
    <?php if ($error !== "") { ?>
        <div class="alert alert-danger fw-bold"><?php echo htmlspecialchars($error); ?></div>
        <a href="Ejercicio3.html" class="btn btn-secondary">Regresar</a>
    <?php } else { ?>
        <!-- ----- SALIDA (Recibo de pago) ----- -->
        <div class="recibo">
            <div class="recibo-header">
                <h2 class="mb-1 fw-bold">RECIBO DE PAGO SEMANAL</h2>
                <small>Comprobante de Nómina • Folio: <?php echo $folio; ?></small>
            </div>

            <div class="row mb-3">
                <div class="col-sm-8">
                    <p class="mb-1"><b>Trabajador:</b> <?php echo htmlspecialchars($nombre); ?></p>
                    <p class="mb-0"><b>Total de horas trabajadas:</b> <?php echo $horas; ?> hrs</p>
                </div>
                <div class="col-sm-4 text-sm-end">
                    <p class="mb-0"><b>Fecha:</b> <?php echo date("d/m/Y"); ?></p>
                </div>
            </div>

            <table class="table table-bordered align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Concepto</th>
                        <th class="text-center">Horas</th>
                        <th class="text-end">Tarifa</th>
                        <th class="text-end">Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Jornada ordinaria (hasta 40 hrs)</td>
                        <td class="text-center"><?php echo $horas_normales; ?></td>
                        <td class="text-end">$<?php echo number_format($pago_hora, 2); ?></td>
                        <td class="text-end">$<?php echo number_format($pago_normal, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Tiempo extra (excedente de 40 hrs)</td>
                        <td class="text-center"><?php echo $horas_extra; ?></td>
                        <td class="text-end">$<?php echo number_format($pago_extra, 2); ?></td>
                        <td class="text-end">$<?php echo number_format($pago_horas_extra, 2); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="table-dark fs-5">
                        <th colspan="3" class="text-end">SALARIO SEMANAL NETO:</th>
                        <th class="text-end">$<?php echo number_format($salario, 2); ?></th>
                    </tr>
                </tfoot>
            </table>

            <p class="mt-5 mb-0 text-center">________________________________________<br><b>Firma de conformidad del trabajador</b></p>
        </div>

        <div class="alert alert-info text-center mt-3 mx-auto no-imprimir" style="max-width: 650px;">
            💡 Para imprimir este recibo presiona las teclas <b>Ctrl + P</b> (o haz clic en el botón de imprimir).
        </div>

        <div class="text-center mt-3 d-flex justify-content-center gap-2 flex-wrap no-imprimir">
            <button type="button" class="btn btn-primary" onclick="window.print()">🖨️ Imprimir recibo (Ctrl + P)</button>
            <a href="Ejercicio3.html" class="btn btn-success">Nuevo recibo</a>
            <a href="index.html" class="btn btn-secondary">Menú principal</a>
        </div>
    <?php } ?>
    </div>
</body>
</html>