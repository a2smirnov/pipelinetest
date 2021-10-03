<?php
// необходимые HTTP-заголовки 
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключаем файл для работы с БД и объектом Product 
include_once '../config/database.php';
include_once '../objects/trackerdata.php';

// получаем соединение с базой данных 
$database = new Database();
$db = $database->getConnection();

// подготовка объекта 
$trackerdata = new TrackerData($db);

if ($dataset = $trackerdata->update()) {

    // установим код ответа - 200 ok 
    http_response_code(200);

    // сообщим пользователю 
    echo json_encode(array("message" => "База обновлена."), JSON_UNESCAPED_UNICODE);
}

// если не удается обновить базу, сообщим пользователю 
else {

    // код ответа - 503 Сервис не доступен 
    http_response_code(503);

    // сообщение пользователю 
    echo json_encode(array("message" => "Невозможно обновить базу данных."), JSON_UNESCAPED_UNICODE);
}
?>