
$(function(){
    like();
    
    
});

function like()
{
    $('img').on('click', function(){
//        showLoaderIdentity();
        var articleId = $(this).attr('data-articleId');
        $.ajax({
            url: '/index.php?route=ajax/likes', 
            data: {id : articleId},
            dataType: 'text',
            method: 'POST'
        })
        .done (function(obj){
//            hideLoaderIdentity();    
            console.log('Ответ получен');
    
    
            $('span.' + articleId).text(obj); 
            
        })
        .fail(function(){
//            hideLoaderIdentity();
            console.log('Ошибка соединения с сервером');
        });
    });
}

//$(function(){
//    $('h2').append("<p>Неверное имя пользователя или пароль</p>");
//});

