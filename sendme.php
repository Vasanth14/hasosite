<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Enable CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require 'vendor/autoload.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["text-569"];
    $email = $_POST["your-email"];
    $phone = $_POST["tel-303"];
    $description = $_POST["text-816"];

    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'vijaymathimayandi78@gmail.com';
        $mail->Password   = 'qfupjjjivpjftush';        
        $mail->SMTPSecure = 'tls';                
        $mail->Port       = 587;                   

        $mail->setFrom($email, $name);
        $mail->addAddress('vjmathi78@gmail.com', 'Recipient Name'); // Recipient's email and name

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Submission';
        $mail->Body = "Name: $name<br>Email: $email<br>Phone: $phone<br>Description: $description";

        // Send the email
        $mail->send();

        // Set success status and message
        $response['success'] = true;
        $response['message'] = 'Email sent successfully';
    } catch (Exception $e) {
        // Set failure status and error message
        $response['message'] = "Email could not be sent. Error: {$mail->ErrorInfo}";
    }
} else {
    // Set failure status and message for non-POST requests
    $response['message'] = 'Invalid request method';
}

// Output the JSON response
echo json_encode($response);
?>
