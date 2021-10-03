<?php
// необходимые HTTP-заголовки 
//header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключим файл для соединения с базой и объектом trackerdata 
include_once '../config/database.php';
include_once '../objects/trackerdata.php';

// получаем соединение с БД 
$database = new Database();
$db = $database->getConnection();

// подготовка объекта 
$trackerdata = new TrackerData($db);

// очистка таблицы
if ($trackerdata->delete()) {

    // код ответа - 200 ok 
    http_response_code(200);

    // сообщение пользователю 
    echo json_encode(array("message" => "Таблица очищена."), JSON_UNESCAPED_UNICODE);
}

// если не удается очистить таблицу
else {

    // код ответа - 503 Сервис не доступен 
    http_response_code(503);

    // сообщим об этом пользователю 
    echo json_encode(array("message" => "Не удалось очистить таблицу."));
}
?>