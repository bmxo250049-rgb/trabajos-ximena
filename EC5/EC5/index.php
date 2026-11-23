<?php
include 'conexion.php';
$sql = "SELECT * FROM productos ORDER BY id ASC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>EC5 - Reportes Dinámicos</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 40px; 
            background-color: #ffe6f0; /* Fondo rosita pastel */
            color: #4a152b;
        }
        h2 { color: #b30059; }
        table { 
            width: 85%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            background-color: #ffffff; /* Tabla blanca para que resalte */
            box-shadow: 0 4px 8px rgba(179, 0, 89, 0.1);
        }
        th, td { border: 1px solid #ffb3d9; padding: 10px; text-align: left; }
        th { background-color: #ff66b2; color: white; }
        tr:nth-child(even) { background-color: #fff5f9; }
        .btn { 
            padding: 10px 15px; 
            text-decoration: none; 
            color: white; 
            border-radius: 5px; 
            margin-right: 10px; 
            font-weight: bold;
            display: inline-block;
        }
        .btn-excel { background-color: #217346; }
        .btn-pdf { background-color: #d63384; }
    </style>
</head>
<body>
    <h2>Inventario de Productos</h2>
    
    <a href="exportar_excel.php" class="btn btn-excel">Exportar a Excel</a>
    <a href="exportar_pdf.php" class="btn btn-pdf">Exportar a PDF</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?php echo $fila['id']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['categoria']; ?></td>
                <td>$<?php echo number_format($fila['precio'], 2); ?></td>
                <td><?php echo $fila['stock']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php $conn->close(); ?>