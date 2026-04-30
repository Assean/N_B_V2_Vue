<?php
// api/get_auth_status.php
session_start();
header('Content-Type: application/json; charset=utf-8');

// 檢查 session 是否存在
if (isset($_SESSION['user'])) {
    // 已登入，回傳 true
    echo json_encode(['isLoggedIn' => true, 'user' => $_SESSION['user']]);
} else {
    // 未登入，回傳 false
    echo json_encode(['isLoggedIn' => false]);
}
?>