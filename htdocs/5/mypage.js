$(document).ready(function() {
    // 개인정보 수정 버튼 클릭 이벤트 핸들러
    $('.edit-profile-btn').click(function(event) {
        event.preventDefault(); // 기본 동작 방지

        // 개인정보 입력 값 가져오기
        var userName = $('#userName').val();
        var sex = $('#sex').val();
        var age = $('#age').val();
        var height = $('#height').val();
        var weight = $('#weight').val();

        // 개인정보 객체 생성
        var personalInfo = {
            userName: userName,
            sex: sex,
            age: age,
            height: height,
            weight: weight
        };

        // 서버로 개인정보 전송
        $.ajax({
            url: 'updateUserInfo.php',
            type: 'POST',
            data: personalInfo,
            dataType: 'json',
            success: function(response) {
                // 개인정보 업데이트 성공 시 동작
                alert(response.message);
            },
            error: function(xhr, status, error) {
                // 개인정보 업데이트 실패 시 동작
                alert("개인정보 업데이트 실패: " + error);
            }
        });
    });

    // 로그아웃 버튼 클릭 이벤트 핸들러
    $('.logout-btn').click(function() {
        // TODO: 로그아웃 로직 구현
        console.log('로그아웃 버튼이 클릭되었습니다.');
    });
});