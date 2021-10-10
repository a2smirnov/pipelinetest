jQuery(function($){

    // будет работать, если была нажата кнопка обновления 
    $(document).on('click', '.delete-data-button', function(){

    // bootbox для подтверждения во всплывающем окне 
    bootbox.confirm({

    message: "<h4>Вы уверены?</h4>",
    buttons: {
        confirm: {
            label: '<span class="glyphicon glyphicon-ok"></span> Да',
            className: 'btn-danger'
        },
        cancel: {
            label: '<span class="glyphicon glyphicon-remove"></span> Нет',
            className: 'btn-primary'
        }
    },
    callback: function (result) {
        if (result) {

            // отправим запрос на обновление в API / удаленный сервер 
            $.ajax({
                url: config.api_url+"delete.php",
                type : "POST",
                success : function() {
        
                    // отображаем данные 
                    showTrackerData();
                },
                error: function(xhr, resp, text) {
                    console.log(xhr, resp, text);
                }
            });
        
        }    
    }
});
});
});