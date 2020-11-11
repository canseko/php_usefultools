<?php
/**
 * @Global funciones globales por proyecto
 */

function GetAbstract($text, $maxlength = 300) {
	$suffix = '...';
	$br_tag = '<br />';
	$suffixlen = strlen($suffix);

	if($maxlength > $suffixlen) 
		$maxlength -= $suffixlen;

	if(isset($text)) {
		$text = strip_tags($text);
		if (strlen($text) > $maxlength + $suffixlen) {
			$text = wordwrap($text, $maxlength,$br_tag);
			$text = substr($text, 0, strpos($text, $br_tag)) . $suffix;
		}
	}

	return $text;
}

/*
 * Función que recibe una el formato YYYY-mm-dd y regresa dd Mes YYYY
 */
function formato_fecha($fecha){
	$meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
	$newDate = date("Y", strtotime($fecha));
	return date("j", strtotime($fecha)) . " " . $meses[date("n", strtotime($fecha)) - 1] .  " " . date("Y", strtotime($fecha));
}//Fin de la función formato_fecha

/**
 * @string $str 
 * 
 */

function toPermalink($str, $replace=array(), $delimiter='-') {
    global $obj;

	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	if(substr($clean, strlen($clean) - 1) == "-")
		$clean = substr($clean, 0, strlen($clean) - 1);
		
	if(substr($clean, 0, 1) == "-")
		$clean = substr($clean, 1);
    
    $existe = $obj->get_var("SELECT id FROM lugar WHERE permalink like '{$clean}' LIMIT 1");

    if(!empty($existe)){
        $clean = toPermalink($clean . rand(1111,9999));
    } 

	return $clean;
}

/**
 * Regresa la url de la imagen
 */

function getImageUrl($image, $path = ''){
	global $pathImage;global $pathUploads;

	if(strpos( $image, "planosimagenes") !== false){
		$find = array("/img/planosimagenes/", ".JPG", ".PNG");
		$to = array("old/", ".jpg", ".png");
		$image = str_replace($find, $to, $image);
		return $pathImage . $image;
	}else{
		$image = "/saits/". $path . $image;
		return $pathUploads . $image;
	}
}

//Se obtiene la clase que se va a aplicar a todos los productos
function getClassProductos($total_tipo_productos){
    switch ($total_tipo_productos) {
        case 1:
            $bs_class = "col-sm-12";
            break;
        case 2:
            $bs_class = "col-sm-6";
            break;
        case 3:
            $bs_class = "col-sm-4";
            break;
        default:
            $bs_class = "";
    }
    return $bs_class;
}//Fin de la función getClassProductos

//Función que determina la clase en base al numero total de elementos principales
function getClassPrincipales($actual, $totales){
    if($totales % 2 == 0){
        $bs_class = "col-sm-6";
    }else{
        if($actual == $totales){
            $bs_class = "col-sm-12";
        }else{
            $bs_class = "col-sm-6";
        }
    }
    return $bs_class;
}//Fin de la función getClassPrincipales

//Obtiene fecha
function pintaFecha($fecha){
    $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $date = new DateTime($fecha);
    $result = $date->format('d') . " de " . $meses[($date->format('m') - 1)] . " de " . $date->format('Y');
    return $result;
}
