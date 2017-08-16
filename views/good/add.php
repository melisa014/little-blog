
<h2><?= $addGoodTitle ?></h2>

<form class='addImage' method="post" action="<?= \Url::link("admin/good/add")?>"> 
    <h5>Введите наименование товара</h5>
    <input type="text" name="name" value="наименование товара"><br>
    <h5>Введите описание товара</h5>
    <input type="text" name="description" value="описание товара"><br>
    <h5>В наличии на складе</h5>
    <input type="text" name="available"><br>
    <h5>Цена товара</h5>
    <input type="text" name="price"><br>
    <input id='addImageSubmit' type="submit" name="addImage" value="+ Изображение"><br><br>
    <div>
    </div>
    <input type="submit" name="saveNewGood" value="Сохранить">
    <input type="submit" name="cancel" value="Назад"><br>
</form>

