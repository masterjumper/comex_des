<?php

//-- Averiguar esta IP de un servidor SMTP (salida de emails)
//-- con el ip 10.1.63.9 *NO* estaria funcionando...

ini_set('SMTP','mail.bbe-sa.com.ar');


//-- De que remitente queres que aparezcan enviados los mails

ini_set('sendmail_from','smuguerza@bbe-sa.com.ar');

//ini_set( 'username', 'smuguerza@bbe-sa.com.ar' );
//ini_set( 'password', 'Hug.2020*' );

//ini_set( 'smtp_port', '587' );

//ini_set( 'sendmail_path', '/usr/sbin/sendmail -t -i');
/*
 */
$headers = 'From: smuguerza@bbe-sa.com.ar' . "\r\n" .
    'MIME-Version: 1.0' . "\r\n" .
    'Content-Type: text/html; charset=utf-8';

//$result = mail("smuguerza@bbe-sa.com.ar", "Hello World", "This is email body", $headers);

//var_dump($result);
/*

*/
ini_set( 'display_errors', 1 );
//$error_reporting_value = error_reporting( E_ALL );
/*
$error_reporting_value = 22527;
$constants = array(
    "E_ERROR",
    "E_WARNING",
    "E_PARSE",
    "E_NOTICE",
    "E_CORE_ERROR",
    "E_CORE_WARNING",
    "E_COMPILE_ERROR",
    "E_COMPILE_WARNING",
    "E_USER_ERROR",
    "E_USER_WARNING",
    "E_USER_NOTICE",
    "E_STRICT",
    "E_RECOVERABLE_ERROR",
    "E_DEPRECATED",
    "E_USER_DEPRECATED",
    "E_ALL"
);
$included = array();
$excluded = array();
foreach ($constants as $constant) {
    $value = constant($constant);
    if (($error_reporting_value & $value) === $value) {
        $included[] = $constant;
    } else {
        $excluded[] = $constant;
    }
}
echo "error reporting " . $error_reporting_value . PHP_EOL . '</br>';
echo "includes " . implode(", ", $included) . PHP_EOL. '</br>';
echo "excludes " . implode(", ", $excluded) . PHP_EOL. '</br>';
*/

//$from = "smuguerza@bbe-sa.com.ar";
$to = "smuguerza@bbe-sa.com.ar";
$subject = "PHP Mail Test script";
$message = "This is a test to check the PHP Mail functionality";
//$headers = "From:" . $from;
$result = mail($to, $subject, $message, $headers);
echo $result ? "sent" : "error";
echo "Test email sent";

//ini_set( 'smtp_crypto', 'tls' );

//ini_set( 'mailtype', 'html' );

//ini_set( 'smtp_timeout', '7' );

//ini_set( 'smtp_charset', 'iso-8859-1' );

//ini_set( 'wordwrap', 'TRUE' );

//ini_set( 'newline', '\r\n' );

//ini_set( 'dsn', 'TRUE' );

//mail( "gcloquel@gmail.com", "Asunto desde MAp", "Cuerpo desde MAp" );

//mail( "gcloquell@bbe-sa.com.ar", "Asunto desde MAp", "Cuerpo desde MAp" );

?>