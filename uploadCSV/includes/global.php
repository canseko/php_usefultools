<?php date_default_timezone_set("America/Mexico_City");
@session_start();

$page = curPage();

/**
 * si el dispositivo mobile, la var $isMobile contiene true.
 * @var booean
 */
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

/**
 * inicializa la database
 */
$obj = new db();

$today = date("Y-m-d H:i:s");
