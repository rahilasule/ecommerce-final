<?php
include_once 'errorhandler.php';
/**
 * Created by PhpStorm.
 * User: rahilasule
 * Date: 4/20/16
 * Time: 2:10 AM
 */
	class Mail{

        public function sendMail($fname, $lname, $email){

            $mail = new PHPMailer;
            //$fname= $_SESSION['firstname'];
            $mail->isSMTP();
            $mail->Host='smtp.office365.com';
            $mail->SMTPAuth=true;
            $mail->Username='rahila.sule@ashesi.edu.gh';
            $mail->Password='mintstone';
            $mail->SMTPSecure='tls';
            $mail->Port=587;
            $mail->setFrom('rahila.sule@ashesi.edu.gh','Biruang Shoe Store');
            $mail->addAddress($email,$fname,$lname);

            $mail->isHTML(true);

            $mail->Subject='Order has been received!';
            $mail->Body='<p>Hello '.$fname.',</p><p>Your order has been received and will be processed shortly.<br> Thanks for your patronage! :)</p>
						<p style=text-align:"left">The Biruang Store Team.</p>';
            $mail->SMTPOptions=array(
                'ssl'=>array(
                    'verify_peer'=>false,
                    'verify_peer_name'=>false,
                    'allow_self_signed'=>true
                )
            );
            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;
            } else{
                echo 'Message has been sent';
            }

        }
    }