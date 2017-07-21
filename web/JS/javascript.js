
$(function(){
    like();
    
    
});

function like()
{
    $('img').on('click', function(){
        var articleId = $(this).attr('data-articleId');
        var likes = $('span.' + articleId).text();
        $.ajax({
            url:'/web/ajaxHandler.php', 
            data: {likeCount : likes},
            dataType: 'text',
//            method: 'POST'
        })
        .done (function(obj){
            console.log('Ответ получен');
    
    
            $('span.' + articleId).text(obj); 
//            $('span.' + articleId).append('<hr/>');
//            $_SESSION['like']++;
            
        })
        .fail(function(){
            console.log('Ошибка соединения с сервером');
        });
    });
}

//$(function(){
//    $('h2').append("<p>Неверное имя пользователя или пароль</p>");
//});

