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
        <a href="<?= \Url::link("archive/allCategories")?>">В архив(Категории)</a>
        <a href="<?= \Url::link("article/add")?>">+ Добавить статью</a>
        <a href="<?= \Url::link("category/add")?>">+ Добавить категорию</a>
        
        <p><?= $_SESSION['username']. ' ' ?><a href="<?php \Url::link("login/logout")?>">Выйти</a></p>
        


        <p>Вам понравилось: <?= $_SESSION['like']; ?></p>
              
       <div id="container">
           
           
           
           