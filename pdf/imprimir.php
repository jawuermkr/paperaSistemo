<?php
    
    // DATOS DE FACTURA
    if(isset($_POST['imp_pdf'])){
        
        $codfac = $_POST['fact']; 
        
        include("../abrir_conexion.php");
        $resultados = mysqli_query($conexion,"SELECT * FROM $tablafacturas WHERE cod_f = '$codfac'");
        while($consulta = mysqli_fetch_array($resultados)) {
            $codf = $consulta['cod_f'];
            $fecha = $consulta['fecha'];
            $hora = $consulta['hora'];
            $total = $consulta['total'];
        }
        include("../cerrar_conexion.php");
    }
?>

<?php 

    require'fpdf/fpdf.php';

    $pdf = new FPDF();
    $title = 'Factura de Compra';
    $pdf->Addpage();
    $pdf->SetFont('Arial','','12');

    $pdf->Image('../img/logo.png', 8, 8, 40);
    $pdf->Ln(10);
    $pdf->Cell(200, 6, 'Papeleria y Miscelanea La Oportunidad', 0, 1, 'C');
    $pdf->Cell(200, 6, 'Nit xxxxxxxxx-x', 0, 1, 'C');
    $pdf->Cell(200, 6, 'Fecha: ' . $fecha , 0, 1, 'C');
    $pdf->Cell(200, 6, 'Hora: ' . $hora , 0, 1, 'C');
    $pdf->Ln(20);
    $pdf->Cell(40, 10, 'Factura No.  ' . $codf, 1, 1, 'L');
    
    $pdf->Ln(8);

    $pdf->SetFont('','b','12');
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(52, 73, 94);
    $pdf->Cell(62, 8, 'Codigo de Productos', 1, 0, 'C', True);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(52, 73, 94);
    $pdf->Cell(62, 8, 'Cantidad', 1, 0, 'C', True);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(52, 73, 94);
    $pdf->Cell(62, 8, 'Precio', 1, 1, 'C', True);
    
    $pdf->SetFont('Arial','','12');
    $pdf->SetTextColor(0,0,0);
    if(isset($_POST['imp_pdf'])){
        
    $codfac = $_POST['fact'];
    include("../abrir_conexion.php");
    $resultados = mysqli_query($conexion,"SELECT * FROM $tabladetafacturas WHERE cod_f = '$codfac'");
    while($consulta = mysqli_fetch_array($resultados)) {
        $pdf->Cell(62, 8, $consulta['cod_p'], 1, 0, 'C');
        $pdf->Cell(62, 8, $consulta['cantidad'], 1, 0, 'C');
        $pdf->Cell(62, 8, '$ ' . $consulta['precio'], 1, 1, 'C');
        }
    include("../cerrar_conexion.php");
    }
        
    $pdf->Cell(62);
    $pdf->Cell(62, 8, 'Total ' , 1, 0, 'C');
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(52, 73, 94);
    $pdf->Cell(62, 8, '$ ' . $total , 1, 1, 'C', True);

    $pdf->Ln(20);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(186, 8, 'Gracias por tu compra :)', 1, 1, 'C');
    $pdf->SetFont('','','8');
    $pdf->Cell(186, 8, 'Sistema desarrollado por Verda Luno | www.verdaluno.com', 0, 0, 'C');

    $pdf->Output();

?>