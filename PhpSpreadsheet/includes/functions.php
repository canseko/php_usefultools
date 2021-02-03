<?php

function curPage(){
	$archivos = explode("/", $_SERVER["PHP_SELF"]);
	$curPage = $archivos[count($archivos) -1];
	
	return $curPage;
}

function getRealIP(){
    if (isset($_SERVER["HTTP_CLIENT_IP"])){
        return $_SERVER["HTTP_CLIENT_IP"];
    }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
        return $_SERVER["HTTP_X_FORWARDED"];
    }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }elseif (isset($_SERVER["HTTP_FORWARDED"])){
        return $_SERVER["HTTP_FORWARDED"];
    }else{
        return $_SERVER["REMOTE_ADDR"];

    }
}  

function getGeoPlugin($ip){
	$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

	return $ipdat;
}

function obtenerNavegadorWeb(){
	$agente = $_SERVER['HTTP_USER_AGENT'];
	$navegador = 'Unknown';
	$platforma = 'Unknown';
	$version= "";

	//Obtenemos la Plataforma
	if (preg_match('/linux/i', $agente)) {
		$platforma = 'linux';
	}
	elseif (preg_match('/macintosh|mac os x/i', $agente)) {
		$platforma = 'mac';
	}
	elseif (preg_match('/windows|win32/i', $agente)) {
		$platforma = 'windows';
	}

	//Obtener el UserAgente
	if(preg_match('/MSIE/i',$agente) && !preg_match('/Opera/i',$agente))
	{
		$navegador = 'Internet Explorer';
		$navegador_corto = "MSIE";
	}
	elseif(preg_match('/Firefox/i',$agente))
	{
		$navegador = 'Mozilla Firefox';
		$navegador_corto = "Firefox";
	}
	elseif(preg_match('/Chrome/i',$agente))
	{
		$navegador = 'Google Chrome';
		$navegador_corto = "Chrome";
	}
	elseif(preg_match('/Safari/i',$agente))
	{
		$navegador = 'Apple Safari';
		$navegador_corto = "Safari";
	}
	elseif(preg_match('/Opera/i',$agente))
	{
		$navegador = 'Opera';
		$navegador_corto = "Opera";
	}
	elseif(preg_match('/Netscape/i',$agente))
	{
		$navegador = 'Netscape';
		$navegador_corto = "Netscape";
	}

	// Obtenemos la Version
	$known = array('Version', $navegador_corto, 'other');
	$pattern = '#(?' . join('|', $known) .
	')[/ ]+(?[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $agente, $matches)) {
	//No se obtiene la version simplemente continua
	}

	$i = count($matches['browser']);
	if ($i != 1) {
	if (strripos($agente,"Version") < strripos($agente,$navegador_corto)){ $version= $matches['version'][0]; } else { $version= $matches['version'][1]; } } else { $version= $matches['version'][0]; } /*Verificamos si tenemos Version*/ if ($version==null || $version=="") {$version="?";} /*Resultado final del Navegador Web que Utilizamos*/ 

    return array(
	'agente' => $agente,
	'nombre'      => $navegador,
	'version'   => $version,
	'platforma'  => $platforma
	);

}

function OSisWindows(){
	$user_agent = getenv("HTTP_USER_AGENT");

	if(strpos($user_agent, "Win") !== FALSE)
		return true;
	else
		return false;
}

function isExplorer(){
	$user_agent = getenv("HTTP_USER_AGENT");

	if(preg_match('/msie/i', $user_agent) && !preg_match('/opera/i', $user_agent))
		return true;
	else
		return false;
}

function isFirefox(){
	$user_agent = getenv("HTTP_USER_AGENT");

	if(preg_match('/firefox/i', $user_agent))
		return true;
	else
		return false;
}

function isChrome(){
	$user_agent = getenv("HTTP_USER_AGENT");
	
	if (strpos( $user_agent, 'safari') !== false)
		return false;

	if (strpos( $user_agent, 'chrome') !== false)
		return true;
	
	return false;
}

function isSafari(){
	$user_agent = getenv("HTTP_USER_AGENT");
	
	if (strpos( $user_agent, 'Chrome') !== false)
		return false;	
	
	if (strpos( $user_agent, 'Safari') !== false)
		return true;
	
	return false;
}

if($_GET["not"] == 1){
    $mensaje = "Se agregó correctamente el registro";
    $tipo = "success";
}elseif($_GET["not"] == 2){
    $mensaje = "Se editó correctamente el registro";
    $tipo = "success";
}elseif($_GET["not"] == 3){
    $mensaje = "Se eliminó correctamente el registro";
    $tipo = "success";
}

/* Función que permite subir un archivo al servidor, es necesario especificar:
 * $nombre_campo - Nombre del campo en la base de datos y el name del input (deben de coincidir)
 * $path - La ruta a la que se subirá el archivo    
 */
function subirArchivo($nombre_campo, $path){
    if(!empty($_FILES[$nombre_campo]["name"])){
        $archivo = upload_file($nombre_campo, $path);
    
        return $archivo;
    }
}//Fin de lafunción subirArchivos

//Función que regresa el nombre de la imagen si la imagen se sube de manera correcta o vacio sino existe el archivo
function uploadFileReturnName($fieldName, $path, $current_value = NULL){
    $name_file = "";

    if(!empty($current_value)){
        $name_file = $current_value;
	}
	if($_FILES[$fieldName]["name"] != ""){
        $foto = upload_file($fieldName , $path);
        $name_file = $foto;
    }

    return $name_file;
}//Fin de la función uploadFileReturnName

//Función que obtiene el permalink para el nombre de los cocteles
function blogToPermalink($str, $replace=array(), $delimiter='-') {
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
    
    $existe = $obj->get_var("SELECT id_blog FROM blog WHERE permalink like '{$clean}' LIMIT 1");

    if(!empty($existe)){
        $clean = blogToPermalink($clean . rand(1111,9999));
    } 

	return $clean;
}//Fin de la función toPermalink