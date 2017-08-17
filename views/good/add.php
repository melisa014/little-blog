
<h2><?= $addGoodTitle ?></h2>

<form  method="post" action="<?= \core\mvc\view\Url::link("admin/good/add")?>" enctype="multipart/form-data"> 
    <h5>Введите наименование товара</h5>
    <input type="text" name="name" value="наименование товара"><br>
    <h5>Введите описание товара</h5>
    <input type="text" name="description" value="описание товара"><br>
    <h5>В наличии на складе</h5>
    <input type="text" name="available"><br>
    <h5>Цена товара</h5>
    <input type="text" name="price"><br>
    
    <div id='addImage'>
        <div data-index='0'></div>
    </div>
    <input id='addImageSubmit' type="submit" name="addImage" value="+ Изображение"><br><br>
    
    <input type="submit" name="saveNewGood" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>

