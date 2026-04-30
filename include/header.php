<!-- header.php -->
<header id="header-app" class="shadow-sm p-3 d-flex w-100 align-items-center">
    <a href="index.php" class="mb-0 d-flex align-items-center">
        <!-- 提醒：競賽規定這裡要放你的 LOGO 圖檔 -->
        <img src="assets/logo.png" alt="PTQS LOGO" style="height: 30px; margin-right: 10px;">
        Public Transit Query System 大眾運輸查詢系統
    </a>
    
    <div class="ml-auto" v-cloak> 
        <!-- v-cloak 可以防止 Vue 還沒載入完時畫面閃爍 -->
        
        <!-- 系統管理：根據題目要求，點擊應導向登入頁或後台管理頁 -->
        <!-- 這裡統一連到後台主頁/登入頁，由該頁面自行判斷權限 -->
        <a href="login.php" class="ml-3">系統管理</a>
        
        <!-- 登出按鈕：只有在 isLoggedIn 為 true 時才顯示 -->
        <a href="#" class="ml-3" v-if="isLoggedIn" @click.prevent="logout">登出</a>
    </div>
</header>

<!-- 引入 Vue 3 (假設你使用 CDN，如果有本地檔案請改成相對路徑) -->
<script src="../js/vue.3.5.13.js"></script>

<script>
{  // <--- 加上左大括號
    const { createApp, ref, onMounted } = Vue;

    createApp({
        setup() {
            const isLoggedIn = ref(false);

            const checkLoginStatus = async () => {
                try {
                    // 請確認這邊的 API 路徑是否正確
                    const response = await fetch('./api/get_auth_status.php'); 
                    const result = await response.json();
                    isLoggedIn.value = result.isLoggedIn;
                } catch (error) {
                    console.error('無法取得登入狀態:', error);
                }
            };

            const logout = async () => {
                try {
                    await fetch('./api/logout.php');
                    isLoggedIn.value = false;
                    window.location.href = 'index.php'; 
                } catch (error) {
                    console.error('登出失敗:', error);
                }
            };

            onMounted(() => {
                checkLoginStatus();
            });

            return {
                isLoggedIn,
                logout
            };
        }
    }).mount('#header-app');
} // <--- 加上右大括號
</script>

<style>
/* 搭配 v-cloak 防止畫面閃爍 */
[v-cloak] {
    display: none;
}
</style>