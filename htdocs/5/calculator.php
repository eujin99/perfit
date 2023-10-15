<?php

$tableData = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    for ($i = 1; ; $i++) {
        $foodNameKey = 'foodName' . $i;
        
        if (isset($_POST[$foodNameKey])) {
            $foodName = $_POST[$foodNameKey];
            $tableData[$foodNameKey] = foodApi($foodName);
        } else {
            break; // foodName1, foodName2, ... 요소가 연속해서 없는 경우 반복문 종료
        }
    }
}

function foodApi($searchText) {
    $url = 'http://openapi.foodsafetykorea.go.kr/api/c884639510284a029639/I2790/json/1/1000/DESC_KOR=' . $searchText;
    $data = array('Key1' => 'value1', 'key2' => 'value2');

    // header, method, body를 설정한다.
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context  = stream_context_create($options); // 데이터 가공
    $result = file_get_contents($url, false, $context); // 전송 ~ 결과값 반환
    $data = json_decode($result, true); // 반환된 결과를 json으로 변환한다.

    if (isset($data['I2790']['row'])) {
        return $data['I2790']['row'];
    } else {
        return array(); // 결과값이 없을 경우 빈 배열 반환
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>음식 칼로리 조회</title>

    <link rel="stylesheet" href="header.css">
    
<link rel="stylesheet" href="calc_test_output.css">
<link rel="stylesheet" href="calc_test.css">
<link rel="stylesheet" href="calculator.css">
<?php
    session_start(); // 세션 시작
    ?>
</head>
<body>
<div id="header-container">
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
    </header>
</div>

<div class="box">
    <div id="-container">
        <p>음식 칼로리 조회</p>
        <div id="output-container">
        <table>
            <thead>
                <tr>
                    <th>음식이름</th>
                    <th>총량 (g)</th>
                    <th>열량 (kcal)</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $lastSearchedItem = '';
            $totalCal = 0;
            if (!empty($tableData)) {
                foreach ($tableData as $foodNameKey => $foodData) {
                    for ($i = 0; $i < count($foodData); $i++) {
                        if ($lastSearchedItem === $_POST[$foodNameKey]) break;
                        if ($foodData[$i]["DESC_KOR"] === $_POST[$foodNameKey]) {
                            echo '<tr>';
                            echo '<td>' . $foodData[$i]["DESC_KOR"] . '</td>'; // 음식이름
                            echo '<td>' . $foodData[$i]["SERVING_SIZE"] . '</td>'; // 총량
                            echo '<td>' . $foodData[$i]["NUTR_CONT1"] . '</td>'; // 열량
                            echo '</tr>';
                            $lastSearchedItem = $_POST[$foodNameKey];
                            $totalCal += $foodData[$i]["NUTR_CONT1"];
                        }
                    }
                }
            } else {
                echo '<tr><td colspan="4">결과가 없습니다.</td></tr>';
            }
            //echo '조회하신 음식의 총 칼로리는 '.$totalCal.'입니다.';
            echo '<tr><td colspan="3">조회하신 음식의 총 칼로리는 ' . $totalCal . '입니다.</td></tr>';
            ?>
    </tbody>
        </table>
        </div>
        <form id="foodForm" method="POST" action="calculator.php">
            <div id="foodFieldsContainer">
                <div class="food-field">
                    <label for="foodName1">음식 이름:</label>
                    <input type="text" id="foodName1" name="foodName1">
                    <button class="remove-food">-</button>
                </div>
            </div>

            <button id="addFoodButton">+</button>
            <input type="submit" value="조회">
        </form>

        
        <script>

  // 출력 후에 스타일을 적용하는 함수
  function applyStyles() {
                var rows = document.querySelectorAll('#output-container table tbody tr');
                for (var i = 0; i < rows.length; i++) {
                    if (i % 2 === 0) {
                        rows[i].classList.add('even-row');
                    } else {
                        rows[i].classList.add('odd-row');
                    }
                    rows[i].addEventListener('mouseover', function () {
                        this.classList.add('highlight');
                    });
                    rows[i].addEventListener('mouseout', function () {
                        this.classList.remove('highlight');
                    });
                }

                var cells = document.querySelectorAll('#output-container table td');
                for (var j = 0; j < cells.length; j++) {
                    cells[j].style.padding = '5px';
                }

                var outputDiv = document.querySelector('#output-container div');
                outputDiv.style.border = '1px solid #ffebb5';
                outputDiv.style.backgroundColor = '#ffebb5';
                outputDiv.style.borderRadius = '16px';
                outputDiv.style.boxShadow = 'inset 0 0 8px #deb13a';
                outputDiv.style.width = '160px';
                outputDiv.style.height = '160px';
            }

// 페이지 로드 후에 applyStyles 함수를 호출하여 스타일을 적용
window.addEventListener('load', applyStyles);


            let foodFieldCounter = 2;

            function createFoodField() {
                const foodField = document.createElement('div');
                foodField.className = 'food-field';

                const label = document.createElement('label');
                label.htmlFor = `foodName${foodFieldCounter}`;
                label.textContent = '음식 이름:';

                const input = document.createElement('input');
                input.type = 'text';
                input.id = `foodName${foodFieldCounter}`;
                input.name = `foodName${foodFieldCounter}`;

                const removeButton = document.createElement('button');
                removeButton.className = 'remove-food';
                removeButton.textContent = '-';
                removeButton.disabled = foodFieldCounter === 1; // 최소한의 음식 필드는 삭제할 수 없도록 설정

                foodField.appendChild(label);
                foodField.appendChild(input);
                foodField.appendChild(removeButton);

                removeButton.addEventListener('click', function () {
                    foodField.remove();
                });

                foodFieldsContainer.appendChild(foodField);
                foodFieldCounter++;
            }

            const addFoodButton = document.getElementById('addFoodButton');
            const foodForm = document.getElementById('foodForm');
            const resultDiv = document.getElementById('result');
            const calculateButton = document.getElementById('calculateButton');
            const totalCaloriesDiv = document.getElementById('totalCalories');
            const foodFieldsContainer = document.getElementById('foodFieldsContainer');

            addFoodButton.addEventListener('click', function (event) {
                event.preventDefault();
                createFoodField();
            });

        </script>
    </div>
</div>

<footer>
    <!-- 푸터 내용 -->
</footer>

</body>
</html>
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


