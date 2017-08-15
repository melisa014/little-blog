$(function(){
    addGoodToOrder();
});

function addGoodToOrder() {
    $('input.order').on('click', function(){
        var formData = $('#order-form').serialize();
        $.ajax({
//            type: 'POST',
            url: '/index.php?route=ajax/addGoodToOrder',
            data: formData,
            dataType: "json",
        })
        .done(function(obj){

            
            console.log('ответ заказа: ' + obj);
            console.log('ответ заказа: ' + obj.goodsAvailable);
            if ('goodsAvaliable' in obj){
                console.log('св-во существует');
//                alert(obj.goodsAvailable);
            }
            $('#myOrder').text('(' + obj.goodsCount + ')');
            $('span.available').text(obj.goodsAvailable);
        })
        .fail(function(xhr, status, error){
             $('.holder-loader').removeClass('open');

            console.log('ajaxError xhr:', xhr); // выводим значения переменных
            console.log('ajaxError status:', status);
            console.log('ajaxError error:', error);

            // соберем самое интересное в переменную
            var errorInfo = 'Ошибка выполнения запроса: '
                    + '\n[' + xhr.status + ' ' + status   + ']'
                    +  ' ' + error + ' \n '
                    + xhr.responseText
                    + '<br>'
                    + xhr.responseJSON;

            console.log('ajaxError:', errorInfo); // в консоль
            alert(errorInfo); // если требуется и то на экран
        });
        return false;
    });
        
}
