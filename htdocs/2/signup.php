<?php
// MySQL 데이터베이스 연결 정보
$servername = "localhost";  // MySQL 서버 주소
$db_username = "root";     // MySQL 사용자명
$password = "1234";     // MySQL 비밀번호
$dbname = "mydb"; // 사용할 데이터베이스 이름

// 회원가입 폼에서 전송된 데이터 가져오기
$id = isset($_POST['id']) ? $_POST['id'] : '';
$pw = isset($_POST['pw']) ? $_POST['pw'] : '';
$pw_ch = isset($_POST['pw_ch']) ? $_POST['pw_ch'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$userage = isset($_POST['userage']) ? $_POST['userage'] : '';
$usersex = isset($_POST['usersex']) ? $_POST['usersex'] : '';
$userheight = isset($_POST['userheight']) ? $_POST['userheight'] : '';
$userweight = isset($_POST['userweight']) ? $_POST['userweight'] : '';
$userbmi = isset($_POST['userbmi']) ? $_POST['userbmi'] : '';

// MySQL 데이터베이스에 연결
$conn = new mysqli($servername, $db_username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("MySQL 연결 실패: " . $conn->connect_error);
}

// 입력된 아이디가 이미 존재하는지 확인
$sql = "SELECT * FROM usertbl WHERE user_id = '" . $conn->real_escape_string($id) . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 이미 존재하는 아이디인 경우
    echo "<script>alert('이미 존재하는 아이디입니다.');</script>";
    echo "<script>window.location.href = 'join.html';</script>";
} else {
    // 존재하지 않는 아이디인 경우, 회원가입 처리
    // 비밀번호 확인 검사
    if ($pw != $pw_ch) {
        echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
        echo "<script>window.location.href = 'join.html';</script>";
    } else {
        // 회원가입 데이터 삽입
        $sql = "INSERT INTO usertbl (user_id, user_pw, userName, age, sex, height, weight, bmi, chooseTBL_purpose_id)
                VALUES ('$id', '$pw', '$username', '$userage', '$usersex', '$userheight', '$userweight', '$userbmi', 0)";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('회원가입이 완료되었습니다.');</script>";
            echo "<script>window.location.href = 'main.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// MySQL 연결 종료
$conn->close();
?>
