<?php
require('./fpdf.php');
require('../class/clase_conexion.php'); // Asegúrate de que este sea el camino correcto al archivo de conexión

class PDF extends FPDF
{
   // Cabecera de página
   function Header()
   {
      $this->Image('logo.jpg', 0, 5, 40);
      $this->SetFont('Arial', 'B', 19);
      $this->Cell(45);
      $this->SetTextColor(0, 128, 200);
      $this->Cell(190, 15, utf8_decode('REINO ACUATICO'), 1, 1, 'C', 0);
      $this->Ln(3);
      $this->SetTextColor(103);

      /* Información adicional */
      $this->Cell(1);
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : Puerto Vallarta, Jalisco"), 0, 0, '', 0);
      $this->Ln(5);

      $this->Cell(1);
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : 322 227 0603 "), 0, 0, '', 0);
      $this->Ln(5);

      $this->Cell(1);
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : reino1acuatico@gmail.com "), 0, 0, '', 0);
      $this->Ln(5);

      $this->Cell(1);
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Sucursal : Las Glorias, 48333 Puerto Vallarta, Jal. "), 0, 0, '', 0);
      $this->Ln(10);
      /* Título del reporte */
      $this->SetTextColor(0, 128, 200);
      $this->Cell(50);
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(175, 10, utf8_decode("REPORTE DEL REGISTRO DEL TRATAMIENTO DE LAS ESPECIES "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* Campos de la tabla */
      $this->SetFillColor(0, 128, 200);
      $this->SetTextColor(255, 255, 255);
      $this->SetDrawColor(163, 163, 163);
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(25, 10, utf8_decode('Fecha Inicio.'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Fecha Fin'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Especie'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Estado'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Descripción'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Instrucciones'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('Veterinario'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('Observaciones'), 1, 1, 'C', 1);
      
        
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');

      $this->SetY(-15);
      $this->SetFont('Arial', 'I', 8);
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C');
   }
}

$pdf = new PDF();
$pdf->AddPage('L');
$pdf->AliasNbPages();
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

// Conectar a la base de datos
$conn = new Conexion();
$db = $conn->conectar(); // Asegúrate de que este método esté definido en tu clase de conexión

// Consulta para obtener los datos de la calidad del agua
$sql = "SELECT * FROM zsfSDGdhzdgfdahhjktratamiento"; // Cambia 'calidad_agua' a la tabla correcta si es necesario
$result = $db->query($sql);

// Comprobar si hay resultados y mostrarlos en el PDF.
if ($result && $result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
      $pdf->Cell(25, 10, utf8_decode($row['fecha_inicio']), 1, 0, 'C', 0);
      $pdf->Cell(25, 10, utf8_decode($row['fecha_fin']), 1, 0, 'C', 0);
      $pdf->Cell(20, 10, utf8_decode($row['especie']), 1, 0, 'C', 0);
      $pdf->Cell(20, 10, utf8_decode($row['estado']), 1, 0, 'C', 0);
      $pdf->Cell(25, 10, utf8_decode($row['descripcion']), 1, 0, 'C', 0);
      $pdf->Cell(30, 10, utf8_decode($row['instrucciones']), 1, 0, 'C', 0);
      $pdf->Cell(35, 10, utf8_decode($row['fk_persona']), 1, 0, 'C', 0);
      $pdf->Cell(35, 10, utf8_decode($row['observaciones']), 1, 1, 'C', 0);
    
      
      
   }
} else {
   $pdf->Cell(0, 10, utf8_decode("No se encontraron datos."), 1, 1, 'C', 0);
}

$pdf->Output('Prueba.pdf', 'I');
?>
