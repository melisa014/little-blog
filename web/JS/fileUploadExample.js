$(function () {
 
 
    var mainContainerSelector = '.box-add';
    var PrototypeContainerSelector = '.copy-box';
    var RowSelector = '.holder-inp';
    var deleteElementSelector = '.close-box'; // по чем кликаем, чтобы удалить строку (подразмевается, что жлемент удаления есть в каждой "строке" формы)
     
    var $researchLine = $(PrototypeContainerSelector);
    var $researchContainer = $(mainContainerSelector);
    var researchIndex = $(mainContainerSelector + " > " + RowSelector).length; // вложенные стоки должны быть непосредственными потомками
    var $researchRow  = $researchLine.clone();
    $researchLine.remove();
  
    console.log('researchIndex', researchIndex);
     
     
   function addResearchRow() {
        console.log('add row!!', 'RR=', $researchRow.html());
        $researchContainer.append($researchRow.html().replace(/%elem_number%/g, researchIndex));
         
        researchIndex++;
            
        return false;
    }
     
    $('.plus').off("click"); // вырубаем иные обработчики
    $(document).on("click", '.plus', function() { // добавляем строчку c полями (таблица)
        addResearchRow();
         
        return false;
    });
     
     
    $('body').on('focus',"input.datepicker_recurring_start", function(){ // привязываем датапикер для динамически добавляемых элементов
       console.log('bind', researchIndex);
       $(this).removeClass('datepicker_recurring_start');
        $(this).datetimepicker();
    });
     
     
    $(document).on("click", deleteElementSelector, function() { // удаляем элемент
 
        $element = $(this).parent(); // получаем родителя
 
        $element.stop().animate({ // анимация средствами JQuery
 
                height: "0px", // высоту к нулю
                width: "0px", // высоту к нулю
                opacity: 0, // прозрачность к нулю
            }, 600, function() {
                $(this).remove(); 
            }
        );
 
        researchIndex--;
         
        return false;
    });
 
}
 
)


