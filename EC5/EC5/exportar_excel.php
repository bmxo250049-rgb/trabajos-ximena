<?php
include 'conexion.php';

// Encabezados HTTP para indicar que es un archivo Excel descargable
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte_productos.xls");
header("Pragma: no-cache");
header("Expires: 0");

$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);
?>

<meta charset="UTF-8">
<table border="1">
    <thead>
        <tr style="background-color: #217346; color: white;">
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
            <td><?php echo $fila['precio']; ?></td>
            <td><?php echo $fila['stock']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>