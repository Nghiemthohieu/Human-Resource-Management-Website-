<?php
//nhận dữ liệu từ form
$fullname = $_POST['fullname'];
$phoneNumber = $_POST['phoneNumber'];
$dob = $_POST['dob'];
$RegistrationDate = $_POST['RegistrationDate'];
$invoiceCode = $_POST['invoiceCode'];
$totaltuition = $_POST['totaltuition'];
$paymoney = $_POST['paymoney'];
$baseregister = $_POST['baseregister'];
$customersource = $_POST['customersource'];
$registrationform = $_POST['registrationform'];
$gistrationtimes = $_POST['gistrationtimes'];
$idPersonnal = $_POST['idPersonnal'];
$email = $_POST['email'];
$note = $_POST['note'];
$formatted_dob = date('Y-m-d', strtotime(str_replace('-', '/', $dob)));
$RegistrationDate = date('Y-m-d', strtotime(str_replace('-', '/', $RegistrationDate)));
if (substr($phoneNumber, 0, 1) === '0') {
    // Nếu bắt đầu bằng số 0, thay thế nó bằng mã quốc gia +84
    $phoneNumber = '+84' . substr($phoneNumber, 1);
}
$datas=$_POST['data'];
$alldata=implode(" , ",$datas);
$paymoney = str_replace('.', '', $paymoney);
$totaltuition = str_replace('.', '', $totaltuition);
//ket noi db
require_once 'conn_bill.php' ;

//viết lệnh sql để thêm dữ liệu
$themsql1 = "INSERT INTO bill (ID_persontion,Registration_Date,Fullname,phonenumber,birthday,invoiceCode,pay_money,roadmap,total_tuition,base_register,customer_source,registration_form,gistration_times,Email,note) VALUES ('$idPersonnal','$RegistrationDate','$fullname','$phoneNumber','$formatted_dob','$invoiceCode','$paymoney','$alldata','$totaltuition','$baseregister','$customersource','$registrationform','$gistrationtimes','$email','$note')";

$themsql2 = "INSERT INTO customers (ID_persontion,Registration_Date,Fullname,phonenumber,birthday,roadmap,total_tuition,base_register,customer_source,Email) VALUES ('$idPersonnal','$RegistrationDate','$fullname','$phoneNumber','$formatted_dob','$alldata','$totaltuition','$baseregister','$customersource','$email')";

// Thực thi các câu lệnh INSERT INTO
$result1 = mysqli_query($conn, $themsql1);
$result2 = mysqli_query($conn, $themsql2);
if($result1 && $result2){
    header("location: /Web_quan_ly_nhan_su/admin/bill/bill.php");
}
?>

