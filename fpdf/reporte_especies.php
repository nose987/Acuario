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
      $this->Cell(175, 10, utf8_decode("REPORTE DEL REGISTRO DE ESPECIES "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* Campos de la tabla */
      $this->SetFillColor(0, 128, 200);
      $this->SetTextColor(255, 255, 255);
      $this->SetDrawColor(163, 163, 163);
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(30, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(53, 10, utf8_decode('Descripción'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('Habitat'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Temperatura'), 1, 0, 'C', 1);
      $this->Cell(65, 10, utf8_decode('Cuidados'), 1, 0, 'C', 1);
      $this->Cell(35, 10, utf8_decode('Tipo de especie'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Alimento'), 1, 1, 'C', 1);
        
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

// Consulta para obtener los datos de la especie y su relación con el tipo de especie
$sql = "SELECT 
            e.nombre, 
            e.descripcion, 
            e.habitad, 
            e.temperatura, 
            e.cuidados, 
            te.tipo AS nombre_tipo_especie, 
            e.fk_alimento 
        FROM especie e 
        INNER JOIN tipo_especie te 
        ON e.fk_tipo_especie = te.pk_tipo_especie";

// Ejecutar la consulta
$result = $db->query($sql);

// Verificar si la consulta se ejecutó correctamente
if ($result) {
    // Comprobar si hay resultados y mostrarlos en el PDF
    if ($result->num_rows > 0) {
        // Iterar sobre los resultados y agregarlos al PDF
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(30, 10, utf8_decode($row['nombre']), 1, 0, 'C');
            $pdf->Cell(53, 10, utf8_decode($row['descripcion']), 1, 0, 'C');
            $pdf->Cell(35, 10, utf8_decode($row['habitad']), 1, 0, 'C');
            $pdf->Cell(30, 10, utf8_decode($row['temperatura']), 1, 0, 'C');
            $pdf->Cell(65, 10, utf8_decode($row['cuidados']), 1, 0, 'C');
            $pdf->Cell(35, 10, utf8_decode($row['nombre_tipo_especie']), 1, 0, 'C');
            $pdf->Cell(30, 10, utf8_decode($row['fk_alimento']), 1, 1, 'C'); // Última celda en la fila
        }
    } else {
        // Si no hay resultados, agregar un mensaje al PDF
        $pdf->Cell(0, 10, utf8_decode("No se encontraron datos."), 1, 1, 'C');
    }
} else {
    // Mostrar un mensaje en caso de error en la consulta
    $pdf->Cell(0, 10, utf8_decode("Error al ejecutar la consulta."), 1, 1, 'C');
}

$pdf->Output('Prueba.pdf', 'I');
?>
