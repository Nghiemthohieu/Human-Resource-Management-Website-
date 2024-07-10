<?php
function checkPrivilege($uri = false){
    $uri= $uri != false ? $uri: $_SERVER['REQUEST_URI'];
    // Mảng các mẫu biểu thức chính quy
    $privileges = $_SESSION['current_user']['privileges'];
    // echo "quyền: <br/>";
    // var_dump($privileges);exit;
    // Kết hợp các mẫu thành một biểu thức duy nhất
    $privileges = implode("|", $privileges);
    
    // Kiểm tra URL với biểu thức chính quy
    preg_match('/' . $privileges . '/', $uri, $matches);
    
    // Trả về kết quả kiểm tra
    return !empty($matches);
}
?>
