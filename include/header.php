<header class="shadow-sm p-3 d-flex w-100 align-items-center">
    <!-- <h3 class="mb-0"></h3> -->
    <a href="index.php" class="mb-0">Public Transit Query System 大眾運輸查詢系統</a>
    <div class="ml-auto">    
        <?php if(!isset($_SESSION['user'])){ ?>
            <a href="./api/chack_login.php" class="ml-3">系統管理</a>
        <?php }else{ ?>
            <a href="./pages/admin_index.php" class="ml-3">系統管理</a>
            <a href="./api/logout.php" class="ml-3">登出</a>
        <?php } ?>
    </div>
</header>