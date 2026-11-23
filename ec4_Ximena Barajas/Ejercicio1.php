<?php
date_default_timezone_set("America/Mexico_City");

// ----- MODELO DE NEGOCIO -----
$precio_normal = 2673;
$error = "";

$nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
$boletos = isset($_POST["boletos"]) ? (int)$_POST["boletos"] : 0;
$membresia = isset($_POST["membresia"]) ? $_POST["membresia"] : "ninguna";

if ($nombre === "" || $boletos < 1) {
    $error = "Por favor escribe el nombre del visitante y un número de boletos mayor a 0.";
}

if ($membresia === "platino") {
    $descuento = 65;
    $nombre_membresia = "Membresía Platino";
    $badge_clase = "bg-dark text-warning";
} elseif ($membresia === "oro") {
    $descuento = 50;
    $nombre_membresia = "Membresía Oro";
    $badge_clase = "bg-warning text-dark";
} elseif ($membresia === "plata") {
    $descuento = 25;
    $nombre_membresia = "Membresía Plata";
    $badge_clase = "bg-secondary text-white";
} else {
    $descuento = 0;
    $nombre_membresia = "Sin membresía (Precio normal)";
    $badge_clase = "bg-primary text-white";
}

$subtotal = $precio_normal * $boletos;
$monto_descuento = $subtotal * ($descuento / 100);
$total = $subtotal - $monto_descuento;
$folio = "SFM-" . rand(10000, 99999);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket de cobro - Six Flags Morelos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container my-4">
    <?php if ($error !== "") { ?>
        <div class="alert alert-danger fw-bold"><?php echo htmlspecialchars($error); ?></div>
        <a href="Ejercicio1.html" class="btn btn-secondary">Regresar al formulario</a>
    <?php } else { ?>
        <!-- ----- SALIDA (Ticket de cobro) ----- -->
        <div class="ticket">
            <div class="ticket-cabecera">
                <!-- Logotipo Six Flags en SVG -->
                <svg width="210" height="58" viewBox="0 0 210 58" xmlns="http://www.w3.org/2000/svg" class="mb-1">
                    <!-- Banderas -->
                    <polygon points="32,8 48,4 45,16 30,19" fill="#e4002b"/>
                    <polygon points="52,5 68,2 65,14 50,17" fill="#ffd100"/>
                    <polygon points="72,3 88,1 85,13 70,15" fill="#00a8e8"/>
                    <polygon points="92,2 108,1 105,13 90,14" fill="#06d6a0"/>
                    <polygon points="112,3 128,4 125,16 110,15" fill="#ff9f1c"/>
                    <polygon points="132,5 148,8 145,19 130,17" fill="#ffffff"/>
                    <!-- Texto Logo -->
                    <text x="105" y="45" text-anchor="middle" font-family="Fredoka, Arial, sans-serif" font-weight="900" font-size="28" fill="#ffffff" stroke="#002060" stroke-width="1">SixFlags</text>
                </svg>
                <div class="ticket-subtitulo">HURRICANE HARBOR OAXTEPEC • MORELOS</div>
            </div>

            <div class="ticket-cuerpo">
                <div class="d-flex justify-content-between mb-2">
                    <span><b>Folio:</b> <?php echo $folio; ?></span>
                    <span><b>Fecha:</b> <?php echo date("d/m/Y H:i"); ?></span>
                </div>
                <p class="mb-1"><b>Visitante:</b> <?php echo htmlspecialchars($nombre); ?></p>
                <p class="mb-3">
                    <b>Tipo de pase:</b>
                    <span class="badge <?php echo $badge_clase; ?>"><?php echo $nombre_membresia; ?></span>
                </p>

                <table class="table table-bordered table-sm align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Concepto</th>
                            <th class="text-end">Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Boletos de acceso (<?php echo $boletos; ?> x $<?php echo number_format($precio_normal, 2); ?>)</td>
                            <td class="text-end">$<?php echo number_format($subtotal, 2); ?></td>
                        </tr>
                        <tr class="table-success">
                            <td>Descuento aplicado (<?php echo $descuento; ?>%)</td>
                            <td class="text-end">-$<?php echo number_format($monto_descuento, 2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="ticket-total">
                TOTAL A PAGAR: $<?php echo number_format($total, 2); ?> MXN
            </div>

            <div class="ticket-pie">
                <p class="mb-1 fw-bold text-dark">¡Gracias por su visita a Six Flags Morelos!</p>
                <small>Conserve este boleto para su ingreso al parque acuático.</small>
            </div>
        </div>

        <div class="text-center mt-4 d-flex justify-content-center gap-2 flex-wrap no-imprimir">
            <button type="button" class="btn btn-primary" onclick="window.print()">🖨️ Imprimir boleto</button>
            <a href="Ejercicio1.html" class="btn btn-danger">Nueva venta</a>
            <a href="index.html" class="btn btn-secondary">Menú principal</a>
        </div>
    <?php } ?>
    </div>
</body>
</html>