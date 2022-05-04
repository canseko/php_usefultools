<?php
/**
 * info about current page, example: index.php
 * @return string
 */

function curPage(){
	$archivos = explode("/", $_SERVER["PHP_SELF"]);
	$curPage = $archivos[count($archivos) -1];
	
	return $curPage;
}

/**
 * @x (int)
 * @y (int)
 * regresa un rango de números dentro de un array, usualmente para ser usados en campos tipo <select>, ejemplo rango de años
 * @return (array)
 */

function rango($x,$y){
	$arr = array();
	
	if($y > $x){
		while($x <= $y){
			$arr[] = $x;
			$x++;	
		}		
	} else {
		while($x >= $y){
			$arr[] = $x;
			$x--;	
		}		
	}
	
	return $arr;
}

/**
 * @valor (int) maximo dos digitos
 * en ocasiones ocupas regresar valores tipo "09" en lugar de "9", pero si tienes "19" debes regresar el mismo "19"
 * @return (string)
 */
function zeroLeft($valor){
	if(strlen($valor) < 2){
		return "0" . $valor;
	}
	
	return $valor;
}

/**
 * envía email html con la función mail del servidor
 */
function sendEmail($asunto, $email, $body, $from){
	$cabeceras = "From: {$from}\r\nContent-type: text/html\r\n";	
	mail($email,$asunto,$body,$cabeceras);	
}

/**
 * @text (string) texto con correos electrónicos dentro
 * retorna un array de emails obtenidos del texto recibido
 * @return (array<string>)
 */
function extract_emails($text) {
	$res = preg_match_all("/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i", $text, $matches);

	if ($res) {
		foreach(array_unique($matches[0]) as $email) {
			$emails[] = $email;
		}
	}
	else
		return null;
		
	return $emails;
}

/**
 * @file (string)
 * forza la descarga de un archivo viva en el servidor
 */
function DownloadFile($file) {
    if(file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}