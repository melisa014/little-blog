$(function(){
    addGoodToOrder();
});

function addGoodToOrder() {
    $('input.order').on('click', function(){
//        var data = $_GET;
//        var id_goods = $('#id_goods').attr(data-id-goods);
//        var id_users = $('#id_users').attr(data-id-users);
//        var number = $('#number').attr(data-number);
        var formData = $('#order-form').serialize();
        $.ajax({
//            type: 'POST',
            url: '/index.php?route=ajax/addGoodToOrder',
            data: formData,
//            data: {id_goods : id_goods,
//                    id_users : id_users,
//                    number : number }, // данные которые передаём  серверу
            dataType: "text", //"json
        })
        .done(function(obj){
            console.log('ответ заказа: ' + obj);
            $('#myOrder').text(obj);
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
