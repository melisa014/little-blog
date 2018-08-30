<?php 
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

$User = Config::getObject('core.user.class');


//vpre($User->explainAccess("archive/index"));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>Little-blog</title>
        <link rel="stylesheet" type="text/css" href="/style.css">
        <script src="/JS/jquery-3.2.1.js"></script>
        <script src="/JS/jquery.validate.js"></script>
        <script src="/JS/loaderIdentity.js"></script>
        <script src="/JS/scrollingPage.js"></script>
        <script src="/JS/order.js"></script>
        <script src="/JS/userAddValidation.js"></script>
        <script src="/JS/addImage.js"></script>
        <!--<script src="/JS/likes.js"></script>-->
        <!--<script src="/JS/searchGoods.js"></script>-->
    </head>
    <body>
        <h1>Самый лучший сайт</h1>
        <hr></hr>

<!-- Это блок навигации по сайту -->
        <p>
            <a href="/index.php">Главная</a>
            <?php  if ($User->isAllowed("login/login")): ?>
                <a href="<?= Url::link("login/login")?>">В архив</a>
            <?php endif; ?>
            
            <?php  if ($User->isAllowed("login/login")): ?>
                <a href="<?= Url::link("login/login")?>">[Вход]</a>
            <?php endif; ?>

            <?= $User->returnIfAllowed("article/add", 
                   "<a href=" . Url::link("article/add") . ">+ Добавить статью</a>");
                $User->returnIfAllowed("archive/allCategories", 
                   "<a href=" . Url::link("archive/allCategories") . ">В архив(Категории)</a>");
                $User->returnIfAllowed("archive/allUsers", 
                   "<a href=" . Url::link("archive/allUsers") . ">В архив(Пользователи)</a>");
                $User->returnIfAllowed("category/add", 
                   "<a href=" . Url::link("category/add") . ">+ Добавить категорию</a>");
                $User->returnIfAllowed("admin/adminusers/add", 
                   "<a href=" . Url::link("admin/adminusers/add") . ">+ Добавить пользователя</a>");
                $User->returnIfAllowed("archive/allGoods", 
                   "<a href=" . Url::link("archive/allGoods") . ">В архив(Товары)</a>");
                $User->returnIfAllowed("admin/good/add", 
                   "<a href=" . Url::link("admin/good/add") . ">+ Добавить товар</a>");
                $User->returnIfAllowed("goodSearch/index", 
                   "<a href=" . Url::link("goodSearch/index") . ">Поиск по товарам</a>");

            ?>
        </p>
       
<!-- Это блок данных о пользователе и для пользователя-->
        <p>
            <?= $User->userName . ' ' ?><br>
            <span id="sessionLikesCount">Понравилось: <?= \ItForFree\SimpleMVC\Session::get()->session['user']['userSessionLikesCount']?></span><br>

    <!-- Выводим на экран ссылку на "Мой заказ" для просмотра и подтверждения, и в скобках кол-во заказанных товаров-->
        <span>
            <?php if ($User->isAllowed("order/index")): ?> 
                    <a href="<?= Url::link("order/index") ?>">
                        Мой заказ</a> 
                    <span  id='myOrder'>
                        (<?=  (new \application\models\Correction())->getUsersAllGoodsCount() ?>)
                    </span>
            <?php endif; ?>
        </span><br>
        
        <?php  if ($User->isAllowed("login/logout")): ?>
            <a href="<?= Url::link("login/logout")?>">Выйти</a>
         <?php endif; ?>   
            
        </p>
        
<!-- Это начало страницы сайта-->
       <div id="container">
        