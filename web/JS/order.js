$(function(){
    addGoodToOrder();
});

function addGoodToOrder() {
    $(document).on('click', 'input.goods', function(){
        var goodId = $(this).attr('data-good-id');
        var formData = $('#form-' + goodId).serialize();
        $.ajax({
//            type: 'POST',
            url: '/index.php?route=ajax/addGoodToOrder',
            data: formData,
            dataType: "json",
        })
        .done(function(obj){
            
            console.log('ответ заказа: ' + obj);
            console.log('obj.goodsCount: ' + obj.goodsCount);
            console.log('obj.goodsAvaliable: ' + obj.goodsAvaliable);
            console.log('obj.notAvaliable: ' + obj.notAvaliable);
            
            if ("notAvaliable" in obj){
                if ($('#notAvaliable-' + goodId).html() == '') {
                   $('#notAvaliable-' + goodId).append(obj.notAvaliable);
                }
            }

            if ("goodsAvaliable" in obj ){ 
                $('#notAvaliable-' + goodId).empty(); 
                $('#myOrder').text("(" + obj.goodsCount + ")");
                $('#available-' + goodId).text(obj.goodsAvaliable);
            }
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
