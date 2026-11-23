<?php
require_once 'conexion.php';
require_once 'fpdf.php';

class PDF extends FPDF {
    // Encabezado de página
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(179, 0, 89); // Título rosa fuerte
        $this->Cell(0, 10, mb_convert_encoding('REPORTE DINÁMICO DE INVENTARIO', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        
        $this->SetFont('Arial', 'I', 9);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(0, 6, mb_convert_encoding('Generado el: ' . date('d/m/Y H:i:s'), 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        $this->Ln(5);

        // Encabezados de la tabla en rosita
        $this->SetFillColor(255, 102, 178);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(255, 179, 217);
        $this->SetFont('Arial', 'B', 10);

        $this->Cell(20, 8, 'ID', 1, 0, 'C', true);
        $this->Cell(75, 8, 'Producto', 1, 0, 'C', true);
        $this->Cell(40, 8, mb_convert_encoding('Categoría', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
        $this->Cell(30, 8, 'Precio', 1, 0, 'C', true);
        $this->Cell(25, 8, 'Stock', 1, 1, 'C', true);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(179, 0, 89);
        $this->Cell(0, 10, mb_convert_encoding('Página ', 'ISO-8859-1', 'UTF-8') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(50, 50, 50);
$pdf->SetDrawColor(255, 179, 217);

$sql = "SELECT * FROM productos ORDER BY id ASC";
$resultado = $conn->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    $pdf->Cell(20, 7, $fila['id'], 1, 0, 'C');
    $pdf->Cell(75, 7, mb_convert_encoding($fila['nombre'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(40, 7, mb_convert_encoding($fila['categoria'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
    $pdf->Cell(30, 7, '$' . number_format($fila['precio'], 2), 1, 0, 'R');
    $pdf->Cell(25, 7, $fila['stock'], 1, 1, 'C');
}

$conn->close();
$pdf->Output('D', 'Reporte_Productos.pdf');
?>