<?php
//nhận dữ liệu từ form
$fullname = $_POST['fullnameEdit'];
$phoneNumber = $_POST['phoneNumberEdit'];
$dob = $_POST['dobEdit'];
$RegistrationDate = $_POST['RegistrationDateEdit'];
$invoiceCode = $_POST['invoiceCodeEdit'];
$totaltuition = $_POST['totaltuitionEdit'];
$paymoney = $_POST['paymoneyEdit'];
$baseregister = $_POST['baseregisterEdit'];
$customersource = $_POST['customersourceEdit'];
$registrationform = $_POST['registrationformEdit'];
$gistrationtimes = $_POST['gistrationtimesEdit'];
$idPersonnal = $_POST['idPersonnalEdit'];
$email = $_POST['emailEdit'];
$ID = $_POST['billIdEdit'];
$note = $_POST['noteEdit'];
$formatted_dob = date('Y-m-d', strtotime(str_replace('-', '/', $dob)));
$RegistrationDate = date('Y-m-d', strtotime(str_replace('-', '/', $RegistrationDate)));
if (substr($phoneNumber, 0, 1) === '0') {
    // Nếu bắt đầu bằng số 0, thay thế nó bằng mã quốc gia +84
    $phoneNumber = '+84' . substr($phoneNumber, 1);
}
$datas=$_POST['dataEdit'];
$alldata=implode(" , ",$datas);
$paymoney = str_replace('.', '', $paymoney);
$totaltuition = str_replace('.', '', $totaltuition);
//ket noi db
require_once 'conn_bill.php' ;

//viết lệnh sql để thêm dữ liệu
$themsql1 = "UPDATE bill SET
            ID_persontion='$idPersonnal',
            Registration_Date='$RegistrationDate',
            Fullname='$fullname',
            phonenumber='$phoneNumber',
            birthday='$formatted_dob',
            invoiceCode='$invoiceCode',
            pay_money='$paymoney',
            roadmap='$alldata',
            total_tuition='$totaltuition',
            base_register='$baseregister',
            customer_source='$customersource',
            registration_form='$registrationform',
            gistration_times='$gistrationtimes',
            Email='$email',
            note='$note'
            WHERE ID = '$ID';";
// Thực thi các câu lệnh INSERT INTO
$result1 = mysqli_query($conn, $themsql1);

if($result1){
    header("location: /Web_quan_ly_nhan_su/admin/bill/bill.php");
}
?>

