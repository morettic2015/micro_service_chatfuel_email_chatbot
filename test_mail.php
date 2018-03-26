<pre>
    <?php
    /*
     * @Function to send Email
     * www.experienciasdigitais.com.br
     */
    require_once 'vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function mailTotem($to, $name, $subject, $body) {

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            // $mail->SMTPDebug = 4;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp-vip-farm74.uni5.net';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'contato@totemdefotos.com.br';                 // SMTP username
            $mail->Password = '019283@help';                           // SMTP password
            //  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('contato@totemdefotos.com.br', 'Totem de Fotos');
            $mail->addAddress($to, $name);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('contato@totemdefotos.com.br', 'Totem de Fotos');
            $mail->addCC('contato@totemdefotos.com.br', 'Totem de Fotos');
            //  $mail->addBCC('bcc@example.com');
            //Attachments
            //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //   $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = 'Visite: www.totemdefotos.com.br';

            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            var_dump($e);
            die();
        }
    }

    // mailTotem("malacma@gmail.com","Luis","teste","teste");