<?php
// 세션 시작
session_start();

// 로그인이 성공한 경우
// $userId = $_SESSION['user_id'];  // $userId 변수에 사용자 ID가 들어있는지 확인해주세요

// 임시로 데이터 삽입 나중에 삭제하면됨
$_SESSION['user_id'] = 'wwww';

// MySQL 접속 정보 설정
$servername = "localhost";
$username = "root";
$password = "dobi0102!";
$dbname = "perfit";
$port = 3306;

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 접속 실패: " . $conn->connect_error);
} else {
    echo "MySQL 접속 성공!!!!!!!!!__________";
}

// POST 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // // 개인정보 입력 값 가져오기

    $userName = isset($_POST['userName']) ? $_POST['userName'] : '';
    $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $height = isset($_POST['height']) ? $_POST['height'] : '';
    $weight = isset($_POST['weight']) ? $_POST['weight'] : '';
    $userId = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $userPw = isset($_POST['user_pw']) ? $_POST['user_pw'] : '';
    $bmi = isset($_POST['bmi']) ? $_POST['bmi'] : '';

    // $userName = !$_POST['userName'];
    // $sex = $_POST['sex'];
    // $age = !$_POST['age'];
    // $height = !$_POST['height'];
    // $weight = !$_POST['weight'];
    // $userId = !$_POST['user_id']; // 세션 변수에서 사용자 ID 가져오기
    // $userPw = !$_POST['user_pw'];
    // $bmi = !$POST['bmi'];

    // 개인정보 업데이트 쿼리 작성
    $query = "UPDATE usertbl SET userName='$userName', sex='$sex', age=$age, height=$height, weight=$weight, user_id='$userId', user_pw='$userPw', bmi=$bmi";
    
// 쿼리 실행
if ($conn->query($query) === TRUE) {
    $response = array('message' => '개인정보가 성공적으로 업데이트되었습니다.');
    echo json_encode($response);
} else {
    $response = array('message' => '개인정보 업데이트에 실패했습니다.');
    echo json_encode($response);
}
}
// 세션 변수에서 사용자 ID 가져오기
$userId = $_SESSION['user_id'];
echo $_SESSION['user_id'];

// 개인정보 조회 쿼리 작성
$query = "SELECT * FROM usertbl WHERE user_id='$userId'";

// 쿼리 실행
//$result = $conn->query($query);
$result= mysqli_query($conn, $query);

// 오류 처리
if (!$result) {
    die("쿼리 실행 오류: " . $conn->error);
}else {
     echo "db 연결!!!!!!!!!!!!!!!!!!!!!1_____________________";
}


    /// 개인정보 가져오기
// if ($result->num_rows > 0) {
    if (mysqli_num_rows($result) > 0) {
    // while ($row = $result->fetch_assoc()) {
        while ($row = mysqli_fetch_assoc($result)) {
        
   
            // 가져온 데이터 활용
            $userName = $row['userName'];
        $userId = $row['user_id'];
        $userPw = $row['user_pw'];
        $age = $row['age'];
        $sex = $row['sex'];
        $height = $row['height'];
        $weight = $row['weight'];
        $bmi = $row['bmi'];}

            // // 개인정보 출력
            // echo "사용자 이름: " . $userName . "<br>";
            // echo "사용자 ID: " . $userId . "<br>";
            // echo "성별: " . $sex . "<br>";
            // echo "나이: " . $age . "<br>";
            // echo "키: " . $height . "<br>";
            // echo "몸무게: " . $weight . "<br>";
            // echo "비밀번호: " . $userPw . "<br>";
            // echo "BMI: " . $bmi . "<br>";

        


                        // 가져온 데이터 출력
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['userName'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['age'] . "세</td>";
                echo "<td>" . $row['sex'] . "</td>";
                echo "<td>" . $row['height'] . "cm</td>";
                echo "<td>" . $row['weight'] . "kg</td>";
                echo "<td>" . $row['bmi'] . "</td>";
                echo "</tr>";
            }
        }else {
            $userName = '';
            $sex = '';
            $age = '';
            $height = '';
            $weight = '';
        }
// 데이터베이스 연결 종료
$conn->close();
?> 

<!DOCTYPE html>
<html>
<head>
    <title>마이페이지</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="mypage.css">
</head>
<body>
<header>
        <div class="header-background">
            <div class="header-wrap">
                <div class="header-logo">
                    <a href="./main.html">
                        <img src="./img/PERFIT_logo.png" alt="logo" class="logo">
                    </a>
                        <div class="header-menu">
                            <ul>
                                <li><a href="about_us">About_us</a></li>
                                <li><a href="health">Health</a></li>
                                <li><a href="diet">Diet</a></li>
                                <li><a href="calculator">calculator</a></li>
                            </ul>
                        
                            <div class="background">
                                <div class="background-bg"></div>
                            </div>
                        </div>
                    <ul class="nav">
                        <li><a href="./join.html"><button>JOIN US</button></a></li>
                        <li><a href="./login.html"><button>LOG IN</button></a></li>
                        <li><a href="./mypage.html"><button>MY PAGE</button></a></li>
                    </ul>.
                </div>
            </div>
        </div>
    </header>
    <div class="box">
        <div class="container">
            <h1>마이페이지</h1>

            <div class="profile">
                <img src="./img/profile.png" alt="프로필 사진">
                <div class="profile-info">
                    <div class="profile-name"><?php echo $userName; ?></div>
                </div>
            </div>
            <div class="section">
                <div class="section-title">개인 정보</div>
                <div class="section-content">
                    <div><strong>이름:</strong> <?php echo $userName; ?></div>
                    <div><strong>ID:</strong> <?php echo $userId ?></div>
                    <div><strong>나이:</strong> <?php echo $age; ?>세</div>
                    <div><strong>성별:</strong> <?php echo $sex; ?></div>
                    <div><strong>키:</strong> <?php echo $height; ?>cm</div>
                    <div><strong>몸무게:</strong> <?php echo $weight; ?>kg</div>
                    <div><strong>BMI:</strong> <?php echo $bmi; ?></div>
                </div>
            </div>

            <div class="action-buttons">
                <button class="edit-profile-btn">개인정보 수정</button>
                <button class="logout-btn">로그아웃</button>
            </div>
        </div>
    </div>

    <script>
        // 개인정보 수정 버튼 클릭 이벤트 핸들러
        document.querySelector('.edit-profile-btn').addEventListener('click', function() {
            // 동적으로 개인정보 입력 폼 생성 및 기존 정보 입력
            var formHtml = `
                <form id="update-form" action="mypage.php" method="post">
                    <label for="userName">이름:</label>
                    <input type="text" name="userName" value="<?php echo $userName; ?>"><br>
                    <label for="sex">성별:</label>
                    <input type="text" name="sex" value="<?php echo $sex; ?>"><br>
                    <label for="age">나이:</label>
                    <input type="text" name="age" value="<?php echo $age; ?>"><br>
                    <label for="height">키:</label>
                    <input type="text" name="height" value="<?php echo $height; ?>"><br>
                    <label for="weight">몸무게:</label>
                    <input type="text" name="weight" value="<?php echo $weight; ?>"><br>
                    <label for="user_pw">비밀번호:</label>
                    <input type="password" name="user_pw" value="<? echo $userPw; ?>"><br>
                    <label for="bmi">BMI:</label>
                    <input type="text" name="bmi" value="<?php echo $bmi; ?>"><br>
                    <input type="submit" value="업데이트">
                </form>
            `;
            
            // 섹션내용을 폼으로 대체
            var sectionContent = document.querySelector('.section-content');
            sectionContent.innerHTML = formHtml;

            // 폼 제출 처리 업데이트
            document.getElementById('update-form').addEventListener('submit', function(e) {
                e.preventDefault(); // 기본 폼 제출 동작 방지
                var formData = new FormData(this); // 폼 데이터 가져오기

                // 개인정보 업데이트를 위한 AJAX 요청 보내기
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'mypage.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.message) {
                            // 성공 메시지 표시
                            var messageDiv = document.createElement('div');
                            messageDiv.classList.add('success-message');
                            messageDiv.textContent = response.message;
                            sectionContent.appendChild(messageDiv);
                        }
                    } else {
                        // 오류 메시지 표시
                        var errorDiv = document.createElement('div');
                        errorDiv.classList.add('error-message');
                        errorDiv.textContent = '개인정보 업데이트에 실패했습니다.';
                        sectionContent.appendChild(errorDiv);
                    }
                };
                xhr.send(formData);
            });
        });

        // 로그아웃 버튼 클릭 이벤트 핸들러
        document.querySelector('.logout-btn').addEventListener('click', function() {
            // TODO: 로그아웃 로직 구현
            console.log('로그아웃 버튼이 클릭되었습니다.');
        });
        </script>
</div>
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
                    <li><a href="./mypage.html">MY PAGE</a></li>
                    <li><a href="./about_us.html">About_us</a></li>
                    <li><a href="./health.html">Health</a></li>
                    <li><a href="./diet.html">Diet</a></li>
                    <li><a href="./calculator.html">calculator</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>
</html>


