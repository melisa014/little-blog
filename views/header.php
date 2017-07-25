<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>Little-blog</title>
        <link rel="stylesheet" type="text/css" href="/web/style.css">
        <script src="/web/JS/jquery-3.2.1.js"></script>
        <!--<script src="web/loaderIdentity.js"></script>-->
        <script src="/web/JS/javascript.js"></script>
    </head>
    <body>
       <h1>Самый лучший сайт</h1>
       <hr></hr>
       
       <a href="/index.php">На домашнюю страницу</a>
       <a href="<?= \Url::link("archive/index")?>">В архив</a>
       <a href="<?= \Url::link("login/index")?>">Войти под своим именем</a>
       
       <?php \core\User::get()->isAllowed($_GET['route'])?>
       
       <p><?= \core\User::get()->userName . ' ' ?><a href="<?php echo \Url::link("login/logout")?>">Выйти</a></p>
                     
       <div id="container">
           