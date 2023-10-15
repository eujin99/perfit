<?php
session_start();

// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "mydb";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// 사용자 정보 가져오기
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];

    // 사용자 정보 조회
    $sql = "SELECT user_id, user_pw, sex, age, userName, height, weight, bmi FROM usertbl WHERE user_id = '$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 사용자 정보 출력
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $user_pw = $row['user_pw'];
        $sex = $row['sex'];
        $age = $row['age'];
        $userName = $row['userName'];
        $height = $row['height'];
        $weight = $row['weight'];
        $bmi = $row['bmi'];

        // 개인정보 수정 처리
        if (isset($_POST['submit'])) {
            // 수정할 정보 가져오기
            $user_pw = $_POST['user_pw'];
            $sex = $_POST['sex'];
            $age = $_POST['age'];
            $userName = $_POST['userName'];
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            $bmi = $_POST['bmi'];

            // 개인정보 업데이트
            $updateSql = "UPDATE usertbl SET user_pw = '$user_pw' , sex = '$sex', age = $age, userName = '$userName', height = $height, weight = $weight, bmi = $bmi WHERE user_id = '$userId'";
            if ($conn->query($updateSql) === TRUE) {
                echo "<script>alert('개인정보가 업데이트되었습니다.');</script>";
            } else {
                echo "개인정보 업데이트 실패: " . $conn->error;
            }
        }
    } else {
        echo "사용자 정보를 가져올 수 없습니다.";
    }
} else {
    header("Location: login.html"); // 로그인 페이지로 이동
    exit();
}

// 데이터베이스 연결 종료
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mypage</title>
    <link rel="stylesheet" type="text/css" href="mypage.css">
    <link rel="stylesheet" type="text/css" href="header.css">
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
        <li><a href="./mypage.php"><button>MY PAGE</button></a></li>
        <li><a href="" onclick="logout()"><button>LOGOUT</button></a></li>
        <?php
    }
} else echo "관리자 계정입니다.";{
    ?>
        <li><a href="./mypage.php"><button>MY PAGE</button></a></li>
        <li><a href="" onclick="logout()"><button>LOGOUT</button></a></li>
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
    <h1 class="mypage">Mypage</h1>
    <p class="tag">개인정보 열람 및 수정이 가능합니다.</p>
    <div class="container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="user_id">ID</label>
            <input type="text" id="user_id" name="user_id" value="<?php echo $user_id; ?>" disabled><br>

            <label for="user_pw">비밀번호</label>
            <input type="text" id="user_pw" name="user_pw" value="<?php echo $user_pw; ?>"><br>

            <label for="sex">성별</label>
            <input type="text" id="sex" name="sex" value="<?php echo $sex; ?>"><br>

            <label for="age">나이</label>
            <input type="text" id="age" name="age" value="<?php echo $age; ?>"><br>

            <label for="userName">이름</label>
            <input type="text" id="userName" name="userName" value="<?php echo $userName; ?>"><br>

            <label for="height">신장</label>
            <input type="text" id="height" name="height" value="<?php echo $height; ?>"><br>

            <label for="weight">체중</label>
            <input type="text" id="weight" name="weight" value="<?php echo $weight; ?>"><br>

            <label for="bmi">BMI</label>
            <input type="text" id="bmi" name="bmi" value="<?php echo $bmi; ?>"><br>

            <input type="submit" name="submit" value="개인정보 수정">
        </form>
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
                        <li><a href="./health.php">Health</a></li>
                        <li><a href="./diet.php">Diet</a></li>
                        <li><a href="./calculator.php">calculator</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>