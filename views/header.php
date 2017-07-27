<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>Little-blog</title>
        <link rel="stylesheet" type="text/css" href="/web/style.css">
        <script src="/web/JS/jquery-3.2.1.js"></script>
        <script src="web/loaderIdentity.js"></script>
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
            \core\User::get()->returnIfAllowed("category/add", 
               "<a href=" . \Url::link("category/add") . ">+ Добавить категорию</a>");
        ?>
       
       <p><?= \core\User::get()->userName . ' ' ?><a href="<?= \Url::link("login/logout")?>">Выйти</a></p>
                     
       <div id="container">
        