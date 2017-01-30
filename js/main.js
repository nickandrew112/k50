$('#generate_form').on( 'submit', function () {
    var errorBlock = $('#error_block');
    var downLink =  $('#down_link');
    errorBlock.html('');
    downLink.html('')
    fields_count = $(this).find('.fields_count').val();
    chip_count = $(this).find('.chip_count').val();


    dataStr = 'fields_count=' + fields_count +
        '&chip_count=' + chip_count;


    $.ajax('/bootstrap.php' , {
        type: "POST",
        data : dataStr,
        success :function (dataGetting) {
            downLink.html('Ссылка на скачивание: ' + dataGetting);
        },
        error: function (xhr, errorType, exception) {
            if( xhr.status == 400)
            {
                errorBlock.html("Некорректные аргументы!");
            }
            else if( xhr.status == 500)
            {
                errorBlock.html("Ошибка сервера!");
            }
        }
    });

    return false;

});