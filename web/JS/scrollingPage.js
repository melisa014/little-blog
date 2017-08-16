
var projectsContainerId = '#projects-container'; // контейнер, в который добалять вновь загруженные данные
var distanceFromBottomToStartLoad = 500; // в пикселях -- за сколько пикселей до конца страницы начинать загрузку
 
/* Элемент руководящей загрузкой - в его полях содержим все опции необходимые 
  для выборки очередной порции данных или прекращения загрузки */
var loaderManagerElementId = '#loader-manager'; // элемент, руководящий загрузкой
//var loadAjax = true;

$(function(){
    initScrollingLoad(); // инициаллизируем обработчик прокрутки и фоновую загрузку
});

var loadAjax = false;

function initScrollingLoad()
{
    var $loadManager = $(loaderManagerElementId); 
    $(window).scroll(function() {
                
        // Проверяем пользователя, находится ли он в нижней части страницы

        if (($(window).scrollTop() + $(window).height() > $(document).height() - distanceFromBottomToStartLoad) && !loadAjax) {


            console.log('infinit load event!!');

            // Идет процесс
            loadAjax = true;

            // Сообщить пользователю что идет загрузка данных
            // $this.find('.loading-bar').html('Загрузка данных');  

            // Запустить функцию для выборки данных с установленной задержкой
            // Это полезно, если у вас есть контент в футере
            setTimeout(function() {

                var url =  $loadManager.data('url');
                var limit  =  $loadManager.data('limit');
                var pageNumber  =  $loadManager.data('page-number');
                var pageCount  =  $loadManager.data('page-count');

                pageNumber++;
                $loadManager.data('page-number', pageNumber);
                
                var loadOptions = {
                    'limit':   limit ,
                    'page-number': pageNumber,
                    'page-count' : pageCount,
               }
                if (pageNumber < pageCount) {
                    sendAjax(url, loadOptions); // передаём необходимые данные функции отправки запроса
                }
            }, 30);

        }  
   });
}

function sendAjax(url, data)
{
//    showLoaderIdenity(); //  показываем идентификатор загрузки
    $.ajax({ //  сам запрос
        type: 'POST',
        url: url,
        data: data, // данные которые передаём  серверу
        dataType: "html" //"json" // предполоижтельный формат ответа сервера
    }).done(function(res) { // если успешно
//        hideLoaderIdenity(); // скрываем идентификатор загрузки

        appendHtml(res) // добавляем скаченные данные в конец ленты
        $('div.page').attr('style', 'display : none');
       
//        if (res.finished) { // если получили признак завершения прокрутки
//           
//        }

        loadAjax = false; // укажем, что данный цикл загрузки завершён
        console.log('Ответ получен: ', res);

//        if (res.success) { // если все хорошо
//            console.log('ОК!)');
//
//        } else { // если не нравится результат
//            console.log('Пришли не те данные!');
//            alert(res.message);
//        }
    }).fail(function(xhr, status, error){
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
}

/**
 * Добавим подгруженные данные в ленту
 * 
 * @param {type} html
 * @returns {undefined}
 */
function appendHtml(html) {
    $(projectsContainerId).append(html);
}
 
 
function stopLoadTrying() {
  $(window).off('scroll'); // отвязываем обработку прокрутки от окна
}


