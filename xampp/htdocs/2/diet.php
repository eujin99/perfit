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


$sql = "SELECT * FROM dietTBL limit 7";
echo $sql;
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM dietTBL limit 7 , 14";
echo $sql2;
$result2 = mysqli_query($conn, $sql2);

$yoyil = ['월', '화', '수', '목', '금', '토', '일'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIET</title>
    <link rel="stylesheet" type="text/css" href="./dietcss.css">
    <link rel="stylesheet" type="text/css" href="./header.css">
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
                        <li><a href="./health.html">Health</a></li>
                                <li><a href="./diet.php">Diet</a></li>
                                <li><a href="./calculator.php">calculator</a></li>
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
<!-- 본문 --------------------------------------------------------------------------------------------->
<?= $row?>
<div class="health_title">
        <h1>식단 추천</h1>
    <p>원하는 다이어트 목적를 선택해보세요!</p>
    <p>요일별 식단을 칼로리와 함께 알려드릴게요.</p>
    </div>    
<div class="container" style="flex-direction:column">
    
        <div class = "button-wrapper">
            <div class="button" id="increment" onclick="showContent('increment')">증량</div>
            <div class="button" id="decrement" onclick="showContent('decrement')">감량</div>
        </div>
        <div id="incrementTable" style="display: none">
            <table>
                <tr>
                    <th>일자</th>
                    <th>아침</th>
                    <th>점심</th>
                    <th>저녁</th>
                </tr>
                <?php 
                        $i = 0;
                       while ($row = mysqli_fetch_array($result)) { // 집합에서 하나씩 레코드를 꺼내 연관배열로 저장
                ?>
                <tr>
                    <td><?=$yoyil[$i]?>요일</td>
                    <td><?=$row['breakfast'] ?></td>
                    <td><?=$row['lunch'] ?></td>
                    <td><?=$row['dinner'] ?></td>
                </tr>
                <?php  ++$i; 
                } ?>
            </table>
        </div>
        <div id="decrementTable" style="display: none">
            <table>
                <tr>
                    <th>일자</th>
                    <th>아침</th>
                    <th>점심</th>
                    <th>저녁</th>
                </tr>
                <?php 
                        $i = 0;
                       while ($row = mysqli_fetch_array($result2)) { // 집합에서 하나씩 레코드를 꺼내 연관배열로 저장
                ?>
                <tr>
                    <td><?=$yoyil[$i]?>요일</td>
                    <td><?=$row['breakfast'] ?></td>
                    <td><?=$row['lunch'] ?></td>
                    <td><?=$row['dinner'] ?></td>
                </tr>
                <?php  ++$i; 
                } ?>
            </table>
        </div>
    </div>
    <div id="content" class="content"></div>
    <script src="diet.js"></script>
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