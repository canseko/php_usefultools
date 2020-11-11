<?php
include_once 'phpqrcode/qrlib.php';

/** Se puede generar directamente en el navegador o también se puede guardar
  * en el servidor. 
  */
QRcode::png('code data text', 'generated_qr.png');
QRcode::png('some othertext 1234');