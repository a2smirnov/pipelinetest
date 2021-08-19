jQuery(function($){

    // HTML приложения 
    // получаем вчерашнюю дату (на текущую дату в трекере данных точно нет) в формате YYYY/MM/DD
    // используем ее как стартовую
  var now = new Date();
  now.setDate(now.getDate() - 1);
  var formated_date = now.getFullYear()+"-"+('0' + (now.getMonth() + 1)).slice(-2)+"-"+('0' + now.getDate()).slice(-2);
    var app_html=`
        <div class='container'>

            <div class='page-header'>
                <h1 id='page-title'>Данные трекера covidtracker.bsg.ox.ac.uk</h1>
            </div>

            <!-- здесь будет календарь для выбора дат -->
            <div></br>
            <h3>Выберите дату</h3>
            <input type="text" id="datepicker" value="`+formated_date+`" onchange=showTrackerData();>
            </br></div>

            <!-- здесь будет показано содержимое -->
            <div id='page-content'></div>

        </div>`;

    // вставка кода на страницу 
    $("#app").html(app_html);

});
 
// изменение заголовка страницы 
function changePageTitle(page_title){

    // измение заголовка страницы 
    $('#page-title').text(page_title);

    // измение заголовка вкладки браузера 
    document.title=page_title;
}
 
// функция для создания значений формы в формате json 
$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};