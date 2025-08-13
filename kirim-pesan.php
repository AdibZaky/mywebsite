<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = htmlspecialchars($_POST['nama']);
    $email  = htmlspecialchars($_POST['email']);
    $pesan  = htmlspecialchars($_POST['pesan']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ptarabiaindonesiaagrikultur@gmail.com';         
        $mail->Password   = 'fmpwveljvtnalqiy';         
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($email, $nama);
        $mail->addAddress('ptarabiaindonesiaagrikultur@gmail.com', 'Admin'); 

        $mail->isHTML(true);
        $mail->Subject = "Pesan Baru dari Website Indonesian Pepper";
        $mail->Body    = "<strong>Nama:</strong> $nama<br><strong>Email:</strong> $email<br><strong>Pesan:</strong><br>$pesan";

        $mail->send();
        echo "<script>alert('Pesan berhasil dikirim!'); window.location.href='index.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Pesan gagal dikirim. Error: {$mail->ErrorInfo}'); window.history.back();</script>";
    }
} else {
    echo "Akses ditolak!";
}
?>
