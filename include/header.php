<!-- header.php -->
<header id="header-app" class="shadow-sm p-3 d-flex w-100 align-items-center">
    <a href="index.php" class="mb-0 d-flex align-items-center">
        <img src="assets/logo.png" alt="PTQS LOGO" style="height: 30px; margin-right: 10px;">
        Public Transit Query System 大眾運輸查詢系統
    </a>
    
    <div class="ml-auto" v-cloak> 
        <a href="login.php" class="ml-3">系統管理</a>
        
        <a href="#" class="ml-3" v-if="isLoggedIn" @click.prevent="logout">登出</a>
    </div>
</header>