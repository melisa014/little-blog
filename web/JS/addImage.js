$(function(){
//    showFormToAddImage();
    loadFormToAddImage();
//    addImage();
});

//function showFormToAddImage()
//{
//    $('#addImageSubmit').onе('click', function(){
//        $('#addImage').fadeIn(500);
//        
//        
//        return false;
//    });
//}

function loadFormToAddImage()
{
    $('#addImageSubmit').on('click', function(){
//        console.log('on-click сработал');
       $.ajax({
            url: '/index.php?route=ajax/showFormToAddImage',
//            data: ,
            dataType: "html",
        })
        .done(function(res){
            console.log('ответ: ' + res);
            $('#addImage').html(res);
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
