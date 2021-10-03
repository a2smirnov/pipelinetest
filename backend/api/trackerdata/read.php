<?php
// необходимые HTTP-заголовки 
//header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");

// подключение базы данных и файл, содержащий объекты 
include_once '../config/database.php';
include_once '../objects/trackerdata.php';

// получаем соединение с базой данных 
$database = new Database();
$db = $database->getConnection();

// инициализируем объект 
$trackerdata = new TrackerData($db);
 
// установим дату для запроса 
$trackerdata->date_value = isset($_GET['requested_date']) ? $_GET['requested_date'] : date('Y-m-d');

// запрашиваем статистику 
$stmt = $trackerdata->read();
$num = $stmt->rowCount();

// проверка, найдено ли больше 0 записей 
if ($num>0) {

    // массив данных на дату
    $trackerdatas_arr=array();
    $trackerdatas_arr["records"]=array();

    // получаем содержимое нашей таблицы 
    // fetch() быстрее, чем fetchAll() 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        // извлекаем строку 
        extract($row);

        $trackerdata_item=array(
            "date_value" => $date_value,
            "country_code" => $country_code,
            "confirmed" => $confirmed,
            "deaths" => $deaths,
            "stringency_actual" => $stringency_actual,
            "stringency" => $stringency
        );

        array_push($trackerdatas_arr["records"], $trackerdata_item);
    }

    // устанавливаем код ответа - 200 OK 
    http_response_code(200);

    // выводим данные в формате JSON 
    echo json_encode($trackerdatas_arr);
}

else {

    // установим код ответа - 404 Не найдено 
    http_response_code(404);

    // сообщаем пользователю, что данные не найдены 
    echo json_encode(array("message" => "Данные не найдены."), JSON_UNESCAPED_UNICODE);
}
?>