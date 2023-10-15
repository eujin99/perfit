<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['foodName1'])) {
        $foodName1 = $_POST['foodName1'];
        foodApi($foodName1); // foodApi 함수에 foodName1 값을 전달
    }
}


function foodApi($searchText) {
    $url = 'http://openapi.foodsafetykorea.go.kr/api/c884639510284a029639/I2790/json/1/1000/DESC_KOR='.$searchText;
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
    $isSearch = false;
    $searchResult = "";
    
    foreach ($data["I2790"]["row"] as $item) {
      if($item["DESC_KOR"] == $searchText){
        $isSearch = true;
        $searchResult = "검색어가 포함된 음식 이름: " . $item["DESC_KOR"]."<br>총량: " . $item["SERVING_SIZE"] . "g 칼로리: " . $item["NUTR_CONT1"] . "kcal <br><br>";
      }
    }
    
    if($isSearch){
      echo $searchResult;
    }else{
      echo "검색어와 일치하는 음식이 없습니다.";
    }
}

?>