<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>Little-blog</title>
        <link rel="stylesheet" type="text/css" href="/web/style.css">
        <script src="/web/JS/jquery-3.2.1.js"></script>
        <script src="/web/JS/jquery.validate.js"></script>
        <script src="web/JS/loaderIdentity.js"></script>
        <script src="/web/JS/javascript.js"></script>
    </head>
    <body>
        <h1>Самый лучший сайт</h1>
        <hr></hr>

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
       
        <p>
            <?= \core\User::get()->userName . ' ' ?><br>
            <span id="sessionLikesCount">Понравилось: <?= \core\Session::get()->session['user']['userSessionLikesCount']?></span><br>
            <span>
                <?= \core\User::get()->returnIfAllowed("order/index", "<a href=" . \Url::link("order/index") . ">Мой заказ</a>");?>
                    
                
                (<?= \core\Session::get()->session['user']['order']?> шт.)
            </span><br>
            
            <a href="<?= \Url::link("login/logout")?>">Выйти</a>
        </p>
                     
       <div id="container">
        