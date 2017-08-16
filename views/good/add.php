
<h2><?= $addGoodTitle ?></h2>

<form  method="post" action="<?= \core\mvc\view\Url::link("admin/good/add")?>"> 
    <h5>Введите наименование товара</h5>
    <input type="text" name="name" value="наименование товара"><br>
    <h5>Введите описание товара</h5>
    <input type="text" name="description" value="описание товара"><br>
    <h5>В наличии на складе</h5>
    <input type="text" name="available"><br>
    <h5>Цена товара</h5>
    <input data-index='0' type="text" name="price"><br>
    
    <div id='addImage'>
    </div>
    <input id='addImageSubmit' type="submit" name="addImage" value="+ Изображение"><br><br>
    
    <input class='imageSubmit' type="submit" name="saveNewGood" value="Сохранить">
    <input class='imageSubmit' type="submit" name="cancel" value="Назад"><br>
</form>

