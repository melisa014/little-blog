$(function(){
    $('img').css('cursor', 'pointer');
    loadFormToAddImage();
//    showFormToAddImage();
});

function loadFormToAddImage()
{
    $('input.addImageSubmit').on('click', function(){
        $.ajax({
            url: '/index.php?route=ajax/loadFormToAddImage',
            dataType: "html",
        })
        .done(function(res){
            console.log('ответ: ' + res);
            $('div.addImage').append(res);
//            $('#addedImage').attr('data', )
            $('div.addImage :last-child').fadeIn(500);
        })
        .fail(function(xhr, status, error){

            console.log('ajaxError xhr:', xhr); // выводим значения переменных
            console.log('ajaxError status:', status);
            console.log('ajaxError error:', error);

            // соберем самое интересное в переменную
            var errorInfo = 'Ошибка выполнения запроса: '
                    + '\n[' + xhr.status + ' ' + status   + ']'
                    +  ' ' + error + ' \n '
                    + xhr.responseText
                    + '\n'
                    + xhr.responseJSON;

            console.log('ajaxError:', errorInfo); // в консоль
            alert(errorInfo); // если требуется и то на экран
        });
        return false;
    });
}

function showFormToAddImage()
{
    $('input.addImageSubmit').on('click', function(){
        var form = $('addedImage').clone();
        $('div.addImage').append(form);
        return false;
    });
}