<?php
// MySQL 데이터베이스 연결 정보
$servername = "localhost";  // MySQL 서버 주소
$username = "root";     // MySQL 사용자명
$password = "1234";     // MySQL 비밀번호
$dbname = "mydb"; // 사용할 데이터베이스 이름 

// 회원가입 정보 가져오기
$id = isset($_POST['id']) ? $_POST['id'] : '';
$pw = isset($_POST['pw']) ? $_POST['pw'] : '';
$name = isset($_POST['username']) ? $_POST['username'] : '';
$age = isset($_POST['userage']) ? $_POST['userage'] : '';
$sex = isset($_POST['usersex']) ? $_POST['usersex'] : '';
$height = isset($_POST['userheight']) ? $_POST['userheight'] : '';
$weight = isset($_POST['userweight']) ? $_POST['userweight'] : '';
$bmi = isset($_POST['userbmi']) ? $_POST['userbmi'] : '';

// MySQL 데이터베이스에 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 'chooseTBL_purpose_id' 필드의 기본값을 0으로 설정
$conn->query("SET SESSION sql_mode = ''");

// 회원가입 정보를 저장할 SQL 쿼리 생성
$check_duplicate_sql = "SELECT user_id FROM usertbl WHERE user_id = '" . $conn->real_escape_string($id) . "'";
$check_duplicate_result = $conn->query($check_duplicate_sql);

if ($check_duplicate_result->num_rows > 0) {
    // 중복된 값이 이미 존재하는 경우
    echo "<script>alert('이미 사용 중인 아이디입니다. 다른 아이디를 선택해주세요.');</script>";
    echo "<script>window.location.href = 'join.html';</script>";
} else {
    // 중복된 값이 없는 경우 회원가입 정보를 저장
    $insert_sql = "INSERT INTO usertbl (user_id, user_pw, username, age, sex, height, weight, bmi)
                   VALUES ('" . $conn->real_escape_string($id) . "', '" . $conn->real_escape_string($pw) . "', '" . $conn->real_escape_string($name) . "', " . (int)$age . ", '" . $conn->real_escape_string($sex) . "', " . (int)$height . ", " . (int)$weight . ", " . (float)$bmi . ")";

    if ($conn->query($insert_sql) === TRUE) {
        // 회원가입이 완료되었을 때 알림창 띄우고 main.html로 이동
        echo "<script>alert('회원가입이 완료되었습니다.');</script>";
        echo "<script>window.location.href = 'main.php';</script>";
    } else {
        echo "오류: " . $insert_sql . "<br>" . $conn->error;
    }
}

// MySQL 데이터베이스 연결 종료 
$conn->close();
?>
