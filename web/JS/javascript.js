
$(function(){
    $('img').css('cursor', 'pointer');
    hideLoaderIdentity();
    actionLike();
    sessionLikesScore();
    formValidationOn()
});



function actionLike()
{
    $('img').on('click', function(){
        showLoaderIdentity();
        var modelId = $(this).attr('data-modelId');
        $.ajax({
            url: '/index.php?route=ajax/likes', 
            data: {id : modelId},
            dataType: 'text',
        })
        .done (function(obj){
            hideLoaderIdentity();    
            console.log('Ответ получен');
            $('span.' + modelId).text(obj); 
            
        })
        .fail(function(){
            hideLoaderIdentity();
            console.log('Ошибка соединения с сервером');
        });
    });
}


function sessionLikesScore()
{
    setInterval(function(){
        showLoaderIdentity();
        $.ajax({
            url: '/index.php?route=ajax/sessionLikesCount', 
            dataType: 'text',
        })
        .done (function(obj){
            hideLoaderIdentity();    
            console.log('Ответ получен');
            $('#sessionLikesCount').text("Понравилось: " + obj); 
            
        })
        .fail(function(){
            hideLoaderIdentity();
            console.log('Ошибка соединения с сервером');
        });
    }, 5000);
}
    
function formValidationOn()
{
    $("#addUser").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        }
    });
    
    $("#editUser").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        }
    });
}

