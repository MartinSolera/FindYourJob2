<?php
namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Models\Student as Student;


require './Vendor/PHPMailer/Exception.php';
require './Vendor/PHPMailer/PHPMailer.php';
require './Vendor/PHPMailer/SMTP.php';

class Mail
{
    
    public function sendMail($email,$student)
    {

        $mail = new PHPMailer(true);

        try {
                //Server settings
            // $mail->SMTPDebug =0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                            // Enable SMTP authentication
                $mail->Username   = EMAIL;                     // SMTP username
                $mail->Password   = EMAILPASS ;                               // SMTP password
                $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = "587";                                    // TCP port to connect to
                $mail->CharSet = "UTF-8";
            
                //Recipients
                $mail->setFrom(EMAIL,'FindYourJob');
                $mail->addAddress($email);                                     // Name is optional

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $i=1;
                $body = "Welcome to Find Your Job " . $student->getFirstName() . " " . $student->getLastName() . " your email is the web side is: " . $student->getEmail();
          
                $mail->Body  = $body;
                $mail->Subject = "REGISTER FIND YOUR JOB";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();

            } catch (Exception $ex) {

                echo  $ex->getMessage();
            }

    }

    public function sendMailEndedJobOffer($student, $jobPosition){

        $mail = new PHPMailer(true);

        try {
                //Server settings
            // $mail->SMTPDebug =0;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                            // Enable SMTP authentication
                $mail->Username   = EMAIL;                     // SMTP username
                $mail->Password   = EMAILPASS ;                               // SMTP password
                $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = "587";                                    // TCP port to connect to
                $mail->CharSet = "UTF-8";
            
                //Recipients
                $mail->setFrom(EMAIL,'FindYourJob');
                $mail->addAddress($student->getEmail());                                     // Name is optional

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $i=1;
                $body = "Dear " . $student->getEmail() .", the job offer you applied to with the position of: ". $jobPosition->getDescription() ." has come to an end. <br> Please wait for the company administration to contact you back.";
          
                $mail->Body  = $body;
                $mail->Subject = "Job Offer - ". $jobPosition->getDescription();
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();

            } catch (Exception $ex) {

                echo  $ex->getMessage();
            }

    }

}

?>