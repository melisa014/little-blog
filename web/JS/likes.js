$(function(){
    $('img').css('cursor', 'pointer');
//    hideLoaderIdentity();
    actionLike();
    sessionLikesScore();
});

function actionLike()
{
    $('img').on('click', function(){
//        showLoaderIdentity();
        var modelId = $(this).attr('data-modelId');
        var table = $(this).attr('data-tableName');
        $.ajax({
            url: '/index.php?route=ajax/likes', 
            data: {id : modelId,
                   tableName : table},
            dataType: 'text',
        })
        .done (function(obj){
//            hideLoaderIdentity();    
            console.log('Ответ получен');
            $('span.' + modelId).text(obj); 
            
        })
        .fail(function(){
//            hideLoaderIdentity();
            console.log('Ошибка соединения с сервером');
        });
    });
}


function sessionLikesScore()
{
    setInterval(function(){
//        showLoaderIdentity();
        $.ajax({
            url: '/index.php?route=ajax/sessionLikesCount', 
            dataType: 'text',
        })
        .done (function(obj){
//            hideLoaderIdentity();    
            console.log('Ответ получен');
            $('#sessionLikesCount').text("Понравилось: " + obj); 
            
        })
        .fail(function(){
//            hideLoaderIdentity();
            console.log('Ошибка соединения с сервером');
        });
    }, 5000);
}
