jQuery(function($){

    // вставляем календарь с ограничением диапазона дат от 01 января текущего года по текущую дату
    $("#datepicker").datepicker({
    minDate: new Date(new Date().getFullYear(), 0, 1),
    maxDate: new Date(),
    dateFormat: "yy-mm-dd"
    });
    // показать список на текущую дату при первой загрузке 
    showTrackerData();
    // далее обновление списка при выборе даты 
    $(document).on('change', '.datepicker', function(){
        showTrackerData();
    });

});

// функция для вывода данных трекера 
function showTrackerData(){

    let read_data_html=`
    <!-- кнопки 'действий' -->
    <!-- кнопка обновления данных -->
        <button class='btn btn-primary update-data-button'>
            <span class='glyphicon glyphicon-edit'></span> Обновление данных в БД
        </button>
    <!-- кнопка создания таблицы -->
        <button class='btn btn-danger create-data-button'>
            <span class='glyphicon glyphicon-edit'></span> Создание таблицы в БД
        </button>
    <!-- кнопка удаления данных из таблицы-->
        <button class='btn btn-danger m-r-10px delete-data-button'>
            <span class='glyphicon glyphicon-remove'></span> Удаление таблицы из БД
        </button>`;
    $("#page-content").html(read_data_html);

    // получить данные на дату из API 
    var reqested_date = $("#datepicker").datepicker().val();
    $.getJSON(config.api_url+"read.php?requested_date=" + reqested_date, function(data){
    // html таблица для данных 
        // перебор списка возвращаемых данных 
        var temp=`<!-- начало таблицы -->
        <table class='table table-bordered table-hover'>
        
            <!-- создание заголовков таблицы -->
            <tr>
                <th class='w-15-pct'>Дата</th>
                <th class='w-15-pct'>Код страны</th>
                <th class='w-10-pct'>Подтвержденных случаев</th>
                <th class='w-15-pct'>Смертей</th>
            </tr>`;
        $.each(data.records, function(key, val) {
        // создание новой строки таблицы для каждой записи 
        temp+=`
        <tr>

            <td>` + val.date_value + `</td>
            <td>` + val.country_code + `</td>
            <td>` + val.confirmed + `</td>
            <td>` + val.deaths + `</td>
        </tr>`;
        });

        // вставка в 'page-content' нашего приложения 
        read_data_html+=temp;
        read_data_html+=`</table><BR>`;
        //выводим тип среды
        read_data_html+=config.env_type;
        $("#page-content").html(read_data_html);
    });
}