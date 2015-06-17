<?php
require_once dirname(__FILE__) . '/lib/swift_required.php';

$smtp = "mail.mg.com.ve";
$port = 587;
$usr = "control-horas@mg.com.ve";
$pass = "12fedcba";

$cuerpo = "prueba larismendi";

$conn = Swift_SmtpTransport::newInstance($smtp, $port);
$conn->setUsername($usr);
$conn->setPassword($pass);

$mailer = Swift_Mailer::newInstance($conn);

$message = Swift_Message::newInstance("Recordatorio de reportes pendientes.");
$type = $message->getHeaders()->get('Content-Type');
$type->setValue('text/html');
$type->setParameter('charset', 'utf-8');
$message->setBody($cuerpo);
$message->setFrom(array('info@marambio.com' => 'Prueba larismendi'));
$message->setTo(array('luisfelipe.arismendi@gmail.com'));

$mailer->send($message);

?>