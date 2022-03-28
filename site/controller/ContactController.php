<?php 

class ContactController {
	function form() {
		require ABSPATH_SITE . "view/contact/form.php";
	}

	function send() {
		$emailService = new EmailService();		
		$to = SMTP_USERNAME;
		$fullname = $_POST["fullname"];
		$email = $_POST["email"];
		$mobile = $_POST["mobile"];
		$content = $_POST["content"];

		$subject = "Godashop: Khách hàng $email liên hệ";
		$message = "Tên khách hàng: $fullname, <br>
					Email: $email, <br>
					Số điện thoại: $mobile, <br>
					Nội dung: $content
		";
		$emailService->send($to, $subject, $message);
		echo $emailService->getMessage();

	}
}
 ?>
