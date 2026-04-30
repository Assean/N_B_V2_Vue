<?php
// api/set_test_captcha.php
session_start();
$data = json_decode(file_get_contents("php://input"), true);
if (isset($data['captcha'])) {
    $_SESSION['captcha'] = $data['captcha'];
}
?>