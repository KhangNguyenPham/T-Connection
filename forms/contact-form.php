<?php
    include "PHPMailer/src/PHPMailer.php";
    include "PHPMailer/src/Exception.php";
    include "PHPMailer/src/OAuth.php";
    include "PHPMailer/src/POP3.php";
    include "PHPMailer/src/SMTP.php";
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    $mail = new PHPMailer(true);                          // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'P.khangsnsd@gmail.com';                 // SMTP username
        $mail->Password = 'jbhrdhhmdenaenbn';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $errors = '';
        $myemail = 'P.khangsnsd@gmail.com';//<-----Put Your email address here.
        if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']))
        {
            $errors .= "\n Error: all fields are required";
        }

        $name = $_POST['name']; 
        $email_address = $_POST['email']; 
        $message = $_POST['message']; 

        if (!preg_match(
        "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email_address))
        {
            $errors .= "\n Error: Invalid email address";
        }

        if (empty($errors)) {
            $mail->setFrom('P.khangsnsd@gmail.com', 'Mailer');
            $mail->addAddress("$email_address", "$name");     // Add a recipient
            $mail->addReplyTo('P.Khangsnsd@gmail.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body in bold!';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        }
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

