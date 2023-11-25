<?php
// MySQL 데이터베이스 연결 정보
$servername = "localhost";  // MySQL 서버 주소
$username = "root";     // MySQL 사용자명
$password = "1234";     // MySQL 비밀번호
$dbname = "mydb"; // 사용할 데이터베이스 이름

// 로그인 정보 가져오기
$userName = isset($_POST['userName']) ? $_POST['userName'] : '';
$userPassword = isset($_POST['userPassword']) ? $_POST['userPassword'] : '';

// MySQL 데이터베이스에 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 사용자 인증을 위한 SQL 쿼리 생성
$sql = "SELECT * FROM usertbl WHERE user_id = '" . $conn->real_escape_string($userName) . "' AND user_pw = '" . $conn->real_escape_string($userPassword) . "'";

// SQL 쿼리 실행
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 로그인 성공
    session_start(); // 세션 시작
    echo "<script>alert('로그인에 성공하였습니다.');</script>";

    // 세션에 id 저장
    while ($row = $result->fetch_assoc()) { 
        $_SESSION['userId'] =  $row["user_id"];
    } 
    echo "<script>window.location.href = 'login-main.php';</script>";
} else {
    // 로그인 실패
    echo "<script>alert('로그인에 실패하였습니다.');</script>";
    echo "<script>window.location.href = 'login.html';</script>";
}


// MySQL 데이터베이스 연결 종료
$conn->close();
?>