<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/PHPMailer-master/src/Exception.php';
require 'php/PHPMailer-master/src/PHPMailer.php';
require 'php/PHPMailer-master/src/SMTP.php';
 
if(!$_POST) exit;
 
// Verificación del Correo (No tocar)
function isEmail($email) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}
 
if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");
 
$nombre    = $_POST['nombre'];
$telemail    = $_POST['telefonoycorreo'];

$servicio    = $_POST['servicio'];
 
 
if(trim($nombre) == '') {
  $a = 0;
  $b = '<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Por favor, ingresa tus Nombres y Apellidos.</div>';
 
  $dab = array(
    "a" => $a, 
    "b" => $b
  );
 
  echo (json_encode($dab));
	exit();
 
} else if(trim($telemail) == '') {
  $a = 0;
  $b = '<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Por favor, ingresa tu Email.</div>';
 
  $dab = array(
    "a" => $a, 
    "b" => $b
  );
 
  echo (json_encode($dab));
	exit();
 
} else if(trim($servicio) == '') {
  $a = 0;
  $b = '<div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Por favor, ingresa tu Mensaje.</div>';
 
  $dab = array(
    "a" => $a, 
    "b" => $b
  );
 
  echo (json_encode($dab));
  exit();
 
}

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'lauramorales1301@gmail.com';                     //SMTP username
    $mail->Password   = '20122017';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('lauramorales1301@gmail.com', 'Contacto Sitio');
    $mail->addAddress('gabriel@hotmail.com', 'gabriel User');     //Add a recipient
    $mail->addAddress('laura@disenios.com');               //Name is optional
    $mail->addReplyTo('gabrielgoja630@gmail.com', 'Information');
 

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Ha habido un nuevo Contacto de un cliente';
    $mail->Body    = '<h1>CONTACTO NUEVO CLIENTE</h1>
    	<h3><b>NOMBRE:</b> $nombre </h3>
    	<h3><b>Interesado en: </b>$servicio</h3>
    	<h3><b>contacto preferido:</b> $telemail</h3>

    This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
   $a = 1;
  $b = "<div class='alert alert-success'>Tu Mensaje ha sido enviado Correctamente !</div>";
 
  $dab = array(
    "a" => $a, 
    "b" => $b
  );
 
  echo (json_encode($dab));
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}