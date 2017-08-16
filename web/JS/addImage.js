$(function(){
//    showFormToAddImage();
    loadFormToAddImage();
//    addImage();

});

function showFormToAddImage()
{
    $('#addImageSubmit').on('click', function(){
        $('#addImage').fadeIn(500);
        return false;
    });
}

function loadFormToAddImage()
{
    $('#addImageSubmit').on('click', function(){
        var imageIndex = $('#addImage').attr('data');
        imageIndex++;
        $.ajax({
            url: '/index.php?route=ajax/showFormToAddImage',
//            data: {imageIndex : imageIndex},
            dataType: "html",
        })
        .done(function(res){
            console.log('ответ: ' + res);
            $('#addImage').append(res);
            $('#addedImage').attr('data', )
            $('#addedImage').fadeIn(500);
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


//function addImage() {
//    $('').on('click', function(){
//        $.ajax({
//            url: '/index.php?route=ajax/addImage',
////            data: ,
//            dataType: "json",
//        })
//        .done(function(obj){
//            
//            console.log('ответ заказа: ' + obj);
//            
//           ;
//        })
//        .fail(function(xhr, status, error){
//             $('.holder-loader').removeClass('open');
//
//            console.log('ajaxError xhr:', xhr); // выводим значения переменных
//            console.log('ajaxError status:', status);
//            console.log('ajaxError error:', error);
//
//            // соберем самое интересное в переменную
//            var errorInfo = 'Ошибка выполнения запроса: '
//                    + '\n[' + xhr.status + ' ' + status   + ']'
//                    +  ' ' + error + ' \n '
//                    + xhr.responseText
//                    + '<br>'
//                    + xhr.responseJSON;
//
//            console.log('ajaxError:', errorInfo); // в консоль
//            alert(errorInfo); // если требуется и то на экран
//        });
//    });
//}
