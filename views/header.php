<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>Little-blog</title>
        <link rel="stylesheet" type="text/css" href="/web/style.css">
        <script src="/web/JS/jquery-3.2.1.js"></script>
        <script src="/web/JS/jquery.validate.js"></script>
        <script src="web/JS/loaderIdentity.js"></script>
        <script src="/web/JS/scrollingPage.js"></script>
        <script src="/web/JS/order.js"></script>
        <script src="/web/JS/userAddValidation.js"></script>
        <script src="/web/JS/addImage.js"></script>
        <!--<script src="/web/JS/likes.js"></script>-->
        <!--<script src="/web/JS/searchGoods.js"></script>-->
    </head>
    <body>
        <h1>Самый лучший сайт</h1>
        <hr></hr>

<!-- Это блок навигации по сайту -->
        <p>
            <a href="/index.php">На домашнюю страницу</a>
            <a href="<?= \Url::link("archive/index")?>">В архив</a>
            <a href="<?= \Url::link("login/index")?>">Войти под своим именем</a>


            <?= \core\User::get()->returnIfAllowed("article/add", 
                   "<a href=" . \Url::link("article/add") . ">+ Добавить статью</a>");
                \core\User::get()->returnIfAllowed("archive/allCategories", 
                   "<a href=" . \Url::link("archive/allCategories") . ">В архив(Категории)</a>");
                \core\User::get()->returnIfAllowed("archive/allUsers", 
                   "<a href=" . \Url::link("archive/allUsers") . ">В архив(Пользователи)</a>");
                \core\User::get()->returnIfAllowed("category/add", 
                   "<a href=" . \Url::link("category/add") . ">+ Добавить категорию</a>");
                \core\User::get()->returnIfAllowed("admin/adminusers/add", 
                   "<a href=" . \Url::link("admin/adminusers/add") . ">+ Добавить пользователя</a>");
                \core\User::get()->returnIfAllowed("archive/allGoods", 
                   "<a href=" . \Url::link("archive/allGoods") . ">В архив(Товары)</a>");
                \core\User::get()->returnIfAllowed("admin/good/add", 
                   "<a href=" . \Url::link("admin/good/add") . ">+ Добавить товар</a>");
                \core\User::get()->returnIfAllowed("goodSearch/index", 
                   "<a href=" . \Url::link("goodSearch/index") . ">Поиск по товарам</a>");

            ?>
        </p>
       
<!-- Это блок данных о пользователе и для пользователя-->
        <p>
            <?= \core\User::get()->userName . ' ' ?><br>
            <span id="sessionLikesCount">Понравилось: <?= \core\Session::get()->session['user']['userSessionLikesCount']?></span><br>

    <!-- Выводим на экран ссылку на "Мой заказ" для просмотра и подтверждения, и в скобках кол-во заказанных товаров-->
            <span>
                <?= \core\User::get()->returnIfAllowed("order/index", 
                        "<a href=" . \Url::link("order/index") 
                        . ">Мой заказ</a> <span  id='myOrder'>(" . (new \application\models\Correction())->getUsersAllGoodsCount() . ")</span>");?>
            </span><br>

            <a href="<?= \Url::link("login/logout")?>">Выйти</a>
        </p>
        
<!-- Это начало страницы сайта-->
       <div id="container">
        