<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
	class EmailService {
		protected $message;
		function send($to, $subject, $message) {
			//Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);
			$mail->CharSet = 'UTF-8'; // fix tiếng việt
			try {
		    //Server settings
		    $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER : để debug, giá trị 0 là ko debug. Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
		    $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		    $mail->Username   = SMTP_USERNAME;                     //SMTP username
		    $mail->Password   = SMTP_SECRET;                               //SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		    //Recipients
		    $mail->setFrom(SMTP_USERNAME); // có thể có tham số thứ 2: 'Mailer'
		    $mail->addAddress($to);     //Add a recipient
		    

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = $subject;
		    $mail->Body    = $message;
		    
		    $mail->send();
		   	$this->message = 'Đã gửi mail thành công';
		   	return true;
			} catch (Exception $e) {
				$this->message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				return false;
			}
		}
		function getMessage() {
			return $this->message;
		}
	}
 ?>