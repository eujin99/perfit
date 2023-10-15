<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PER-FIT</title>
    <link rel="stylesheet" href="./header.css">
    <?php
    session_start(); // 세션 시작
    ?>
</head>

<body>
    <header>
        <div class="header-background">
            <div class="header-wrap">
                <div class="header-logo">
                    <a href="./main.php">
                        <img src="./img/PERFIT_logo.png" alt="logo" class="logo">
                    </a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="./health.php">Health</a></li>
                            <li><a href="./diet.php">Diet</a></li>
                            <li><a href="./calculator.php">calculator</a></li>
                        </ul>
                        <div class="background">
                            <div class="background-bg"></div>
                        </div>
                    </div>
                    <ul class="nav">
    <?php
    if (isset($_SESSION['userId'])) {
        echo $_SESSION['userId'] . " 계정입니다.";
        if ($_SESSION['userId'] === 'admin') {
            echo "관리자 계정입니다.";
            ?>
            <li><a href="./admin.php"><button>회원 관리</button></a></li>
            <?php
        }
        ?>
        <li><a href="./mypage.php"><button>MY PAGE</button></a></li>
        <li><a href="" onclick="logout()"><button>LOGOUT</button></a></li>
        <?php
    } else {
        ?>
        <li><a href="./join.html"><button>JOIN US</button></a></li>
        <li><a href="./login.html"><button>LOG IN</button></a></li>
        <?php
    }
    ?>
</ul>
                </div>
            </div>
        </div>
        <script>
            function logout() {
                console.log("hello");
                const data = confirm("로그아웃 하시겠습니까?");
                if (data) {
                    location.href = "logoutProcess.php";
                }
            }
        </script>
    </header>
    <div class="main_img">
        <img src="./main.png">
    </div>

    <footer>
        <div class="footer-wrap">
            <div class="footer-content">
                <div class="footer-item customer-center">
                    <h3>CUSTOMER CENTER</h3>
                    <p>(+82)10-2123-5024</p>
                    <ul>
                        <li>Mon~Fri AM 10:00-PM 18:00</li>
                        <li>Lunch PM 12:00-PM 13:00</li>
                        <li>SAT SUN HOLIDAY OFF</li>
                    </ul>
                </div>
                <div class="footer-item favorite-menu">
                    <h3>QUICK MENU</h3>
                    <ul>
                    <li><a href="./join.html">JOIN US</a></li>
                    <li><a href="./login.html">LOG IN</a></li>
                    <li><a href="./mypage.php">MY PAGE</a></li>
                
                    <li><a href="./health.html">Health</a></li>
                    <li><a href="./diet.php">Diet</a></li>
                    <li><a href="./calculator.php">calculator</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
