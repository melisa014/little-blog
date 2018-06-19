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
            <a href="/index.php">На домашнюю страницу</a>
            <a href="<?= \ItForFree\SimpleMVC\Url::link("archive/index")?>">В архив</a>
            <a href="<?= \ItForFree\SimpleMVC\Url::link("login/index")?>">Войти под своим именем</a>


            <?= \ItForFree\SimpleMVC\User::get()->returnIfAllowed("article/add", 
                   "<a href=" . \ItForFree\SimpleMVC\Url::link("article/add") . ">+ Добавить статью</a>");
                \ItForFree\SimpleMVC\User::get()->returnIfAllowed("archive/allCategories", 
                   "<a href=" . \ItForFree\SimpleMVC\Url::link("archive/allCategories") . ">В архив(Категории)</a>");
                \ItForFree\SimpleMVC\User::get()->returnIfAllowed("archive/allUsers", 
                   "<a href=" . \ItForFree\SimpleMVC\Url::link("archive/allUsers") . ">В архив(Пользователи)</a>");
                \ItForFree\SimpleMVC\User::get()->returnIfAllowed("category/add", 
                   "<a href=" . \ItForFree\SimpleMVC\Url::link("category/add") . ">+ Добавить категорию</a>");
                \ItForFree\SimpleMVC\User::get()->returnIfAllowed("admin/adminusers/add", 
                   "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/adminusers/add") . ">+ Добавить пользователя</a>");
                \ItForFree\SimpleMVC\User::get()->returnIfAllowed("archive/allGoods", 
                   "<a href=" . \ItForFree\SimpleMVC\Url::link("archive/allGoods") . ">В архив(Товары)</a>");
                \ItForFree\SimpleMVC\User::get()->returnIfAllowed("admin/good/add", 
                   "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/good/add") . ">+ Добавить товар</a>");
                \ItForFree\SimpleMVC\User::get()->returnIfAllowed("goodSearch/index", 
                   "<a href=" . \ItForFree\SimpleMVC\Url::link("goodSearch/index") . ">Поиск по товарам</a>");

            ?>
        </p>
       
<!-- Это блок данных о пользователе и для пользователя-->
        <p>
            <?= \ItForFree\SimpleMVC\User::get()->userName . ' ' ?><br>
            <span id="sessionLikesCount">Понравилось: <?= \ItForFree\SimpleMVC\Session::get()->session['user']['userSessionLikesCount']?></span><br>

    <!-- Выводим на экран ссылку на "Мой заказ" для просмотра и подтверждения, и в скобках кол-во заказанных товаров-->
            <span>
                <?= \ItForFree\SimpleMVC\User::get()->returnIfAllowed("order/index", 
                        "<a href=" . \ItForFree\SimpleMVC\Url::link("order/index") 
                        . ">Мой заказ</a> <span  id='myOrder'>(" . (new \application\models\Correction())->getUsersAllGoodsCount() . ")</span>");?>
            </span><br>

            <a href="<?= \ItForFree\SimpleMVC\Url::link("login/logout")?>">Выйти</a>
        </p>
        
<!-- Это начало страницы сайта-->
       <div id="container">
        