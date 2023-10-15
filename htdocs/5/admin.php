<!DOCTYPE html>
<html>
<head>
    <title>관리자 페이지</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" type="text/css" href="header.css">
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
     <li><a href="./admin.php"><button>회원 관리</button></a></li>
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
    <div class="admin_main">
    <?php
    // 로그인 여부 확인 및 관리자 계정 확인
    session_start();
    if (isset($_SESSION['userId']) && $_SESSION['userId'] === 'admin') {
        // 관리자 계정 로그인 시에만 페이지 표시
        ?>
        <h1>PER-FIT</h1>
        <div class="container">
            <h2>회원 목록</h2>
            <?php
            // 데이터베이스 연결 정보
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

            // 회원 목록 조회
            $sql = "SELECT * FROM usertbl";
            $result = $conn->query($sql);
?>

<!-- 회원 목록 출력 테이블 -->
<form method="POST" action="">
    <table>
        <tr>
            <th>체크</th>
            <th>회원 ID</th>
            <th>비밀번호</th>
            <th>성별</th>
            <th>나이</th>
            <th>이름</th>
            <th>키</th>
            <th>몸무게</th>
            <th>BMI</th>
        </tr>
        <?php
        // 회원 목록 출력
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='delete[]' value='" . $row["user_id"] . "'></td>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["user_pw"] . "</td>";
                echo "<td>" . $row["sex"] . "</td>";
                echo "<td>" . $row["age"] . "</td>";
                echo "<td>" . $row["userName"] . "</td>";
                echo "<td>" . $row["height"] . "</td>";
                echo "<td>" . $row["weight"] . "</td>";
                echo "<td>" . $row["bmi"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>회원이 없습니다.</td></tr>";
        }
        ?>
    </table>
    <input type="submit" name="delete_selected" value="선택 회원 삭제" class="button1">
</form>

<?php
// 선택한 회원들을 일괄 삭제
if (isset($_POST['delete_selected'])) {
    // 선택한 회원 ID들을 배열로 받아옴
    $deleteIDs = $_POST['delete'];

    if (!empty($deleteIDs)) {
        // 선택한 회원 삭제
        $deleteIDsString = implode("', '", $deleteIDs);
        $sql = "DELETE FROM usertbl WHERE user_id IN ('$deleteIDsString')";
        $conn->query($sql);

        echo "<script>alert('선택한 회원들이 삭제되었습니다. 새로고침하여 목록을 확인하세요.');</script>";
    } else {
        echo "<script>alert('삭제할 회원을 선택해주세요.');</script>";
    }
}
            // 데이터베이스 연결 종료
            $conn->close();
            ?>
            
            <h2>회원 추가</h2>
<form id="add-member-form" action="admin.php" method="post">
    <label for="user_id">아이디</label>
    <input type="text" id="user_id" name="user_id" required>
    <label for="user_pw">비밀번호</label>
    <input type="text" id="user_pw" name="user_pw" required>
    <label for="sex">성별</label>
    <input type="text" id="sex" name="sex" required>
    <label for="age">나이</label>
    <input type="text" id="age" name="age" required>
    <label for="userName">이름</label>
    <input type="text" id="userName" name="userName" required>
    <label for="height">키</label>
    <input type="text" id="height" name="height" required>
    <label for="weight">몸무게</label>
    <input type="text" id="weight" name="weight" required>
    <label for="bmi">BMI</label>
    <input type="text" id="bmi" name="bmi" required>
    <input type="submit" value="회원 추가" name="submit" class="button1">
</form>

<?php
// 회원 추가 처리
if (isset($_POST['submit'])) {
    // 입력 받은 회원 정보 가져오기
    $user_id = $_POST['user_id'];
    $user_pw = $_POST['user_pw'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $userName = $_POST['userName'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $bmi = $_POST['bmi'];

    // 데이터베이스 연결
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 연결 확인
    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

       // 중복 회원 확인
       $checkQuery = "SELECT * FROM usertbl WHERE user_id = '$user_id'";
       $checkResult = $conn->query($checkQuery);
   
       if ($checkResult->num_rows > 0) {
           echo "이미 존재하는 회원입니다.";
       } else {
           // 존재하지 않는 경우 회원 추가
           // 중복을 피하기 위한 고유한 user_id 생성
           $user_idid = uniqid(); // 고유한 ID 생성 함수 사용
   

    // 회원 추가 SQL 실행
    $sql = "INSERT INTO usertbl (user_id, user_pw, sex, age, userName, height, weight, bmi, chooseTBL_purpose_id) VALUES ('$user_id', '$user_pw', '$sex', $age, '$userName', $height, $weight, $bmi, 0)";
    // 중복을 피하기 위한 고유한 user_id 생성
    $user_id = uniqid(); // 고유한 ID 생성 함수 사용
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('회원이 추가되었습니다. 새로고침하여 목록을 확인하세요.');</script>";
    } else {
        echo "<script>alert('회원 추가 실패: ');</script>" . $conn->error;
    }
}

    // 데이터베이스 연결 종료
    $conn->close();
}
?>
            <h2>회원 직접 삭제</h2>
            <form id="delete-member-form" action="admin.php" method="post">
                <label for="member-id" class="delete_member">삭제할 회원 ID:</label>
                <input type="text" id="member-id" name="id" required>
                <input type="submit" value="회원 삭제" name="delete">
            </form>

            <?php
        // 회원 삭제 처리
        if (isset($_POST['delete'])) {
            // 입력 받은 회원 ID 가져오기
            $memberId = $_POST['id'];

            // 데이터베이스 연결
            $conn = new mysqli($servername, $username, $password, $dbname);

            // 연결 확인
            if ($conn->connect_error) {
                die("데이터베이스 연결 실패: " . $conn->connect_error);
            }

            // 회원 삭제 SQL 실행
            $sql = "DELETE FROM usertbl WHERE user_id='$memberId'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('선택한 회원들이 삭제되었습니다. 새로고침하여 목록을 확인하세요.');</script>";
            } else {
                echo "<script>alert('회원 삭제 실패: ');</script>" . $conn->error;
            }

            // 데이터베이스 연결 종료
            $conn->close();
        }
        ?>

        </div>
        <?php
    } else {
        echo "<p>접근 권한이 없습니다.</p>";
    }
    ?>

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