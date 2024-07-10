<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

// hiển thị 6 số ngẫu nhiên của mật khẩu
function generateRandomPassword($length = 6) {
    // Các ký tự mà bạn muốn sử dụng để tạo mật khẩu ngẫu nhiên
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';

    // Tạo mật khẩu ngẫu nhiên bằng cách chọn ngẫu nhiên các ký tự từ chuỗi $characters
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
}

//nhận dữ liệu từ form
$fullname = $_POST['fullname'];
$code = $_POST['code'];
$office = $_POST['office'];
$startDate = $_POST['startDate'];
$position = $_POST['position'];
$hometown = $_POST['hometown'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
// $avatar = $_POST['avatar'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$key= $_POST['Key'];
$password = generateRandomPassword();
$formatted_startDate = date('Y-m-d', strtotime(str_replace('-', '/', $startDate)));
$formatted_dob = date('Y-m-d', strtotime(str_replace('-', '/', $dob)));
$status=1;
if (substr($phoneNumber, 0, 1) === '0') {
    // Nếu bắt đầu bằng số 0, thay thế nó bằng mã quốc gia +84
    $phoneNumber = '+84' . substr($phoneNumber, 1);
}

//ket noi db
require_once 'conn.php' ;

//viết lệnh sql để thêm dữ liệu
$themsql= "INSERT INTO personnal (ID_personnal,Name, ID_position, office, startword, hometown, phonenumber, birthday, gender, mail, password,ID_status) VALUES ('$key','$fullname','$position','$office','$formatted_startDate','$hometown','$phoneNumber','$formatted_dob','$gender','$email','$password','$status')";
//thực thi câu lệnh thêm
$result = mysqli_query($conn, $themsql);

// $last_id = mysqli_insert_id($conn);

$themsql1= "INSERT INTO teams (ID_teams,ID_personnal) VALUES ('$code','$key')";
//thực thi câu lệnh thêm
$result1 = mysqli_query($conn, $themsql1);

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'unienglishcg@gmail.com';                     //SMTP username
    $mail->Password   = 'p j e v e o m k u q n w s z u c';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('unienglishcg@gmail.com', 'UNI ENGLISH CENTER');
    $mail->addAddress($email, $fullname);     //Add a recipient
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'ACCOUNT';
    $mail->Body    = '<h2>Chúc mừng bạn đã trở thành một thành viên của UNI ENGLISH CENTER</h2>
    <span>Mã Key:</span><span style="font-size: 20px;">' . $last_id . '</span><br>
    <span>Mật khẩu đăng nhập:</span><span style="font-size: 20px;">' . $password . '</span>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
if($result){
    header("location: /Web_quan_ly_nhan_su/admin/personnal/personnal.php");
}
?>

