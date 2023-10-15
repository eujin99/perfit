<?php
// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "mydb";

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>감량-EASY</title>
    <link rel="stylesheet" type="text/css" href="./header.css">
    <link rel="stylesheet" type="text/css" href="./healthcss.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php
    session_start(); // 세션 시작
    ?>
</head>

<body>
    <div xmlns:th="http://www.thymeleaf.org" xmlns:sec="http://www.thymeleaf.org/extras/spring-security"></div>
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
    <!--본문---------------------------------------------------------------------------------------------->
    <div class="container-inner">
            <div class="but1"><a href="./health1.php"><button>가슴</button></a></div>
            <div class="but1"><a href="./health2.php"><button>등</button></a></div>
            <div class="but1"><a href="./health3.php"><button>하체</button></a></div>
            <div class="but1"><a href="./health4.php"><button>어깨</button></a></div>
            <div class="but1"><a href="./health5.php"><button>유산소</button></a></div>
            <div class="but1"><a href="./health6.php"><button>코어</button></a></div>
            <div class="but1"><a href="./health7.php"><button>팔</button></a></div>
        </div>

        <h2>등 운동에 대해 알려드릴게요!</h2>
    <div class="tab-container">
    <div class="tabs">
        <ul>
            <?php
            for ($i = 8; $i <= 14; $i++) {
                $query = "SELECT * FROM recommendtbl WHERE number = $i";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                $exerciseName = $row['exercise_name'];
                ?>
                <li onclick="showContent1(<?=$i-1?>)"><?=$exerciseName?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="content">
        <?php
        for ($i = 8; $i <= 14; $i++) {
            $query = "SELECT * FROM recommendtbl WHERE number = $i";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($result);
            ?>
            <div id="<?=$i-1?>" class="tab-content">
                <h1><?=$row['exercise_name'] ?></h1>
                <h3>코치의 코멘트</h3>
                <p><?=$row['comment'] ?></p>
                <h3>시작 자세</h3>
                <p><?=$row['posture'] ?></p>
                <h3>운동 동작</h3>
                <p><?=$row['movement'] ?></p>
                <h3>호흡법</h3>
                <p><?=$row['breathing_methode'] ?></p>
                <h3>주의사항</h3>
                <p><?=$row['caution'] ?></p>
            </div>
        <?php } ?>
    </div>
    </div>
    <!--푸터------------------------------------------------------------------------------------------------------------->
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
                
                    <li><a href="./health.php">Health</a></li>
                    <li><a href="./diet.php">Diet</a></li>
                    <li><a href="./calculator.php">calculator</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
<script>

function showContent1(index) {
    var contentDivs = document.getElementsByClassName("tab-content");
    var tabs = document.getElementsByTagName("li");

    for (var i = 0; i < contentDivs.length; i++) {
        contentDivs[i].classList.add("hidden");
        contentDivs[i].classList.remove("active");
    }

    $("#"+index).addClass('active');
    $("#"+index).removeClass('hidden');
}

</script>
</html>