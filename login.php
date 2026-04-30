<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTQS - 網站管理登入</title>
    <!-- 引入你專案中的 Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- 引入你專案中的自訂 CSS (如果有的話) -->
    <link rel="stylesheet" href="css/index.css">
    <!-- 引入 Vue 3 (假設你專案 js 資料夾內有 vue.3.5.13.js) -->
    <script src="js/vue.3.5.13.js"></script>
    <style>
        /* 防止 Vue 載入前閃爍 */
        [v-cloak] { display: none; }
        
        /* 依照題目圖示設計驗證碼顯示區塊 */
        .captcha-display {
            background-color: #ffc107; /* Bootstrap 的 warning 顏色，符合題目黃底 */
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            height: 38px; /* 對齊按鈕高度 */
            line-height: 38px;
            letter-spacing: 5px;
            min-width: 100px;
        }
        
        /* 表單標籤對齊微調 */
        .col-form-label {
            font-weight: normal;
        }
    </style>
</head>
<body>

    <!-- 頂部導覽列：直接載入你修改好的 header.php -->
    <?php include('include/header.php'); ?>

    <div id="login-app" class="container mt-5" v-cloak>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5"> <!-- 控制表單寬度 -->
                <h2 class="text-center mb-5 fw-normal">網站管理 - 登入</h2>
                
                <form @submit.prevent="handleLogin">
                    
                    <!-- 帳號欄位 -->
                    <div class="row mb-4 align-items-center">
                        <label for="account" class="col-sm-3 col-form-label text-md-end">帳號</label>
                        <div class="col-sm-9">
                            <input type="text" id="account" class="form-control" v-model="form.account" required>
                        </div>
                    </div>

                    <!-- 密碼欄位 -->
                    <div class="row mb-4 align-items-center">
                        <label for="password" class="col-sm-3 col-form-label text-md-end">密碼</label>
                        <div class="col-sm-9">
                            <input type="password" id="password" class="form-control" v-model="form.password" required>
                        </div>
                    </div>

                    <!-- 驗證碼輸入欄位 -->
                    <div class="row mb-3 align-items-center">
                        <label for="captcha" class="col-sm-3 col-form-label text-md-end">驗證碼</label>
                        <div class="col-sm-9">
                            <input type="text" id="captcha" class="form-control" v-model="form.captcha" required>
                        </div>
                    </div>

                    <!-- 驗證碼顯示與重新產生按鈕區塊 -->
                    <div class="row mb-4">
                        <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                            <div class="captcha-display px-3 rounded-1">{{ currentCaptcha }}</div>
                            <button type="button" class="btn btn-secondary text-white border-0" style="background-color: #6c757d;" @click="generateCaptcha">重新產生驗證碼</button>
                        </div>
                    </div>

                    <!-- 登入按鈕 -->
                    <div class="row">
                        <div class="col-12">
                            <!-- 使用 btn-success 產生題目要求的綠色按鈕 -->
                            <button type="submit" class="btn btn-success w-100 py-2 fs-5 border-0" style="background-color: #28a745;">登入</button>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- 登入邏輯 (與前一個版本相同，稍微簡化) -->
    <script>
{  // <--- 加上這個左大括號，建立獨立作用域
    const { createApp, ref, reactive, onMounted } = Vue;

    createApp({
        setup() {
            const form = reactive({
                account: '',
                password: '',
                captcha: ''
            });

            const currentCaptcha = ref('');

            const generateCaptcha = () => {
                const code = Math.floor(1000 + Math.random() * 9000).toString();
                currentCaptcha.value = code;
                
                fetch('./api/set_test_captcha.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ captcha: code })
                });
            };

            const handleLogin = async () => {
                try {
                    const response = await fetch('./api/login.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(form)
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        alert(result.message);
                        window.location.href = 'admin_route.php'; 
                    } else {
                        alert(result.message);
                        generateCaptcha(); 
                        form.captcha = ''; 
                    }
                } catch (error) {
                    console.error('Login error:', error);
                    alert('連線異常，請檢查伺服器狀態');
                }
            };

            onMounted(() => {
                generateCaptcha();
            });

            return {
                form,
                currentCaptcha,
                generateCaptcha,
                handleLogin
            };
        }
    }).mount('#login-app');
} // <--- 加上這個右大括號
</script>
</body>
</html>