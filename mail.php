<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "PHPMailer-master/src/PHPMailer.php";
require_once "PHPMailer-master/src/Exception.php";


$mail = new PHPMailer(true);
try {
    //Server settings
 /*   $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = // "user@example.com";                 // SMTP username
    $mail->Password = 'secret';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
 */
    //Recipients
    $mail->setFrom('koss@darnitsa.org', 'PolisOnLine');
    $mail->addAddress($clients_array['0']['email'], $clients_array['0']['name']." ".$clients_array['0']['sirname']);  

       // Add a recipient
  //TEST $mail->addAddress('koss@darnitsa.org');     // Add a recipient

               // Name is optional
    $mail->addReplyTo('koss@darnitsa.org', 'Information');
    $mail->addBCC('koss@darnitsa.org');

    //Attachments
//koss    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    $mail->addStringAttachment($stream, 'polis.jpeg');
  //  $mail->addStringAttachment($im, $img_name);
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Travel insurance '.$order_id;
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
   
   
////////////////////////////////// KOSS KOSSSK OOSSSSOSO


	//print_r($clients_array);
    file_put_contents("callback.txt", $date. "-  Message has been sent ".$clients_array['0']['email']." --- <- \r\n", FILE_APPEND);
    //header('Location: /');
////////////////////////////////// KOSS KOSSSK OOSSSSOSO
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
////////////////////////////////// KOSS KOSSSK OOSSSSOSO
    file_put_contents("callback.txt", $date. "-  Mailer Error:".$mail->ErrorInfo." ".$view_mail."<- \r\n", FILE_APPEND);
////////////////////////////////// KOSS KOSSSK OOSSSSOSO
}




/*require_once("dompdf_ru/dompdf_config.inc.php");
$dompdf = new DOMPDF();// Создаем обьект
$dompdf->load_html($text); // Загружаем в него наш html код
$dompdf->render(); // Создаем из HTML PDF
$dompdf->stream('mypdf.pdf'); // Выводим результат (скачивание)*/
?>

