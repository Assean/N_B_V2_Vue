<?php
// api/login.php
session_start();
header('Content-Type: application/json; charset=utf-8');

// 接收前端 Vue 傳來的 JSON 資料
$data = json_decode(file_get_contents("php://input"), true);

$account = $data['account'] ?? '';
$password = $data['password'] ?? '';
$captcha = $data['captcha'] ?? '';

// 驗證碼檢查 (與 Session 中存的驗證碼比對)
if (!isset($_SESSION['captcha']) || $captcha !== $_SESSION['captcha']) {
    echo json_encode(['success' => false, 'message' => '驗證碼錯誤']);
    exit;
}

// 簡易測試帳號密碼驗證 (未來請改為 PDO 資料庫查詢)
if ($account === 'admin' && $password === '1234') {
    // 登入成功，將資訊存入 Session
    $_SESSION['user'] = $account;
    echo json_encode(['success' => true, 'message' => '登入成功']);
} else {
    // 登入失敗
    echo json_encode(['success' => false, 'message' => '帳號或密碼錯誤']);
}
?>