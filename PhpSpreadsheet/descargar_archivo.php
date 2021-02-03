<?php
include 'includes/includes.php';
require 'classes/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


//Configuración del documento excel
$tipo_contacto = "1";
$fila_encabezados = "1";
$columna_inicial = "A";
$encabezados = array("FECHA Y HORA DE SOLICITUD", "NOMBRE", "CORREO ELECTRÓNICO", "CÓDIGO POSTAL", "TELÉFONO", "CIUDAD");
$tamanio_columnas_array = array(30, 25, 35, 17,20,20);

//Se obtienen los datos que se van a incluir y se colocan en el orden correcto
$contactos = $obj->get_results("SELECT contacto.nombre_completo, contacto.email, contacto.codigo_postal, contacto.telefono, ciudad.nombre as ciudad, contacto.fecha_creacion FROM `contacto` INNER JOIN ciudad ON ciudad.id_ciudad = contacto.ciudad_id WHERE tipo_contacto = $tipo_contacto ORDER BY contacto.id DESC");
$datos = array();
foreach($contactos as $row){
    $fila = array($row->fecha_creacion, $row->nombre_completo, $row->email, $row->codigo_postal, $row->telefono, $row->ciudad);
    array_push($datos, $fila);
}

//Se da un nombre al archivo
$nombre_archivo = "contacto_" . $today; //La extensión siempre será xlsx


//De aqui hacia abajo se realiza el proceso automaticamente
$spreadsheet = new Spreadsheet();

$fila_tabla = $fila_encabezados + 1;
$numero_columnas = sizeof($encabezados);
$numero_filas = sizeof($datos);

$rango_encabezado = calculaRangoEncabezado($columna_inicial, $fila_encabezados, $numero_columnas);
$rango_tabla = calculaRangoTabla($columna_inicial, $fila_tabla, $numero_columnas, $numero_filas);


// Set document properties
$spreadsheet->getProperties()->setCreator('Altozano')
    ->setLastModifiedBy('Altozano')
    ->setTitle('Office 2007 XLSX Test Document')
    ->setSubject('Office 2007 XLSX Test Document')
    ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
    ->setKeywords('office 2007 openxml php')
    ->setCategory('Test result file');

//
$sheet = $spreadsheet->getActiveSheet();
$sheet->fromArray($encabezados, NULL, $columna_inicial . $fila_encabezados);
$sheet->fromArray($datos, NULL, $columna_inicial . $fila_tabla);

formatoEncabezado($spreadsheet, $rango_encabezado);
formatoTabla($spreadsheet, $rango_tabla);
setTamanioColumnas($spreadsheet, $columna_inicial, $tamanio_columnas_array);


//Cambiar el color del texto

//Centra el texto

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombre_archivo . '.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;




//Obtiene el rango de los encabezados en el formato A1:Z99
function calculaRangoEncabezado($columna_inicial, $fila_encabezados, $numero_columnas){
    $letras = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $posicion_columna_inicial = array_search($columna_inicial, $letras);
    $posicion_columna_final = $posicion_columna_inicial + $numero_columnas - 1;
    $rango = $columna_inicial . $fila_encabezados . ":" . $letras[$posicion_columna_final] . $fila_encabezados;
    return $rango;
}//Fin de la función rango


//Obtiene el rango de la tabla en el formato A1:Z99
function calculaRangoTabla($columna_inicial, $fila_tabla, $numero_columnas, $numero_filas){
    $letras = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $posicion_columna_inicial = array_search($columna_inicial, $letras);
    $posicion_columna_final = $posicion_columna_inicial + $numero_columnas - 1;
    $rango = $columna_inicial . $fila_tabla . ":" . $letras[$posicion_columna_final] . ($fila_tabla + $numero_filas - 1);
    return $rango;
}//Fin de la función calculaRangoTabla


//Función que da formato al encabezado de la tabla
function formatoEncabezado($spreadsheet, $rango_encabezado){
    $spreadsheet->getActiveSheet()->getStyle($rango_encabezado)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $spreadsheet->getActiveSheet()->getStyle($rango_encabezado)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $spreadsheet->getActiveSheet()->getStyle($rango_encabezado)->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle($rango_encabezado)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
}//Fin de la función formatoEncabezado


//Función que da formato a la tabla
function formatoTabla($spreadsheet, $rango_tabla){
    $spreadsheet->getActiveSheet()->getStyle($rango_tabla)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
}//Fin de la función formatoTabla

//Funcion que establece el tamaño de las columnas recibiendo los datos en un array
function setTamanioColumnas($spreadsheet, $columna_inicial, $tamanio_columnas_array){
    $letras = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $posicion_columna = array_search($columna_inicial, $letras);
    foreach($tamanio_columnas_array as $tamanio_columna){
        $spreadsheet->getActiveSheet()->getColumnDimension($letras[$posicion_columna])->setWidth($tamanio_columna);
        $posicion_columna++;
    }
}