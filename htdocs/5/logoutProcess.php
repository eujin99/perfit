<?php
session_start();
session_destroy();
?>
<script>
    // 서버에 로그아웃 요청을 보내는 AJAX 요청
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'logoutProcess.php', true);
    xhr.send();

    // 로그아웃이 완료되면 페이지를 리디렉션
    xhr.onload = function() {
        if (xhr.status === 200) {
            location.href = 'main.php';
        }
    };
</script> 