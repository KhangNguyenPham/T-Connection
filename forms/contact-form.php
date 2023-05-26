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
        $mail->Password = 'ubapdridnsqkaohf';                           // SMTP password
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
        $phone = $_POST['phone'];

        if (!preg_match(
        "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email_address))
        {
            $errors .= "\n Error: Invalid email address";
        }
        
        if (empty($errors)) {
            $mail->setFrom('P.khangsnsd@gmail.com', 'T-Connection');
            $mail->addAddress("phamanhlai96@gmail.com", "$name");     // Add a recipient
            $mail->addReplyTo('P.Khangsnsd@gmail.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = emailTemplate($name, $email_address, $phone, $message);
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        }
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
    
    function emailTemplate($name, $email, $phone, $message){
        return
        "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8' />
        </head>
        
        <body>
        <center>
            <div
                    style='
                  background: #e5e5e5;
                  width: 100%;
                  font-family: Tahoma, Sans-Serif;
                  color: #2e2e2e;
                '
            >
                <div
                        style='
                    background: #fff;
                    width: 100%;
                    max-width: 1280px;
                    margin: 0 auto;
                  '
                >
                    
                    <div
                            style='
                      width: 640px;
                      margin: 100px auto;
                      text-align: left;
                      font-size: 16px;
                    '
                    >
                        <p style='margin: 0 0 16px; font-size: 16px; text-align:center'>
                            Lead's Information
                        </p>
                        <p style='margin: 0 0 16px; font-size: 16px'>
                            Dear Mr Alex Dinh and Ms Jasmine Pham
                        </p>
                        <p style='margin: 0 0 20px; font-size: 16px; width: 640px'>
                            This may be useful information for you! 
                        </p>
                        <div
                                style='
                        border-top: 1px solid #c8cacd;
                        border-bottom: 1px solid #c8cacd;
                        padding: 1px 0;
                      '
                        >
                            <table
                                    width='100%'
                                    border='0'
                                    cellpadding='0'
                                    style='border-collapse: collapse; font-size: 16px'
                                    bgcolor='#FFFFFF'
                            >
                                <tbody>
                                <tr>
                                    <td
                                            style='width: 50%; padding: 8px 16px; background: #f5f5f5'
                                    >
                                        <strong>Parent name: </strong>
                                    </td>
                                    <td style='width: 50%; padding: 8px 16px'>
                                        $name
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2' style='padding: 1px 0'>
                                      <div
                                        style='
                                          border-bottom: 1px solid transparent;
                                          height: 1px;
                                          background: url('https://d1ubwt7z1ubyyw.cloudfront.net/uploads/border-dash-1653130024.png')
                                            no-repeat center;
                                          width: 100%;
                                        '
                                      ></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                            style='width: 50%; padding: 8px 16px; background: #f5f5f5'
                                    >
                                        <strong>Email: </strong>
                                    </td>
                                    <td style='width: 50%; padding: 8px 16px'>
                                        $email
                                    </td>
                                </tr>
                                <tr>
                            <td colspan='2' style='padding: 1px 0'>
                              <div
                                style='
                                  border-bottom: 1px solid transparent;
                                  height: 1px;
                                  background: url('https://d1ubwt7z1ubyyw.cloudfront.net/uploads/border-dash-1653130024.png')
                                    no-repeat center;
                                  width: 100%;
                                '
                              ></div>
                            </td>
                            </tr>
                            <tr>
                                <td
                                        style='width: 50%; padding: 8px 16px; background: #f5f5f5'
                                >
                                    <strong>Phone number: </strong>
                                </td>
                                <td style='width: 50%; padding: 8px 16px'>
                                    $phone
                                </td>
                            </tr>
                            <tr>
                            <td colspan='2' style='padding: 1px 0'>
                              <div
                                style='
                                  border-bottom: 1px solid transparent;
                                  height: 1px;
                                  background: url('https://d1ubwt7z1ubyyw.cloudfront.net/uploads/border-dash-1653130024.png')
                                    no-repeat center;
                                  width: 100%;
                                '
                              ></div>
                            </td>
                            </tr>
                            <tr>
                                <td
                                        style='width: 50%; padding: 8px 16px; background: #f5f5f5'
                                >
                                    <strong>Message: </strong>
                                </td>
                                <td style='width: 50%; padding: 8px 16px'>
                                    $message
                                </td>
                            </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </center>
        </body>
        </html>";
    } 

