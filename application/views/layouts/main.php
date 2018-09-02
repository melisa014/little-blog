<?php 
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

$User = Config::getObject('core.user.class');


//vpre($User->explainAccess("homepage/index"));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
        <title>SimpleMVC | Учебный проект</title>
        
        <link rel="stylesheet" type="text/css" href="/CSS/bootstrap.min.css">
        
        <script src="/JS/jquery-3.2.1.js"></script>
        <script src="/JS/popper.js"></script>
        <script src="/JS/bootstrap.js"></script>

    </head>
    <body> <!-- Оформление с использование twitter bootstrap 4 ("bootstrap 4") -->
              
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <!-- Меню оформленное с помощью  twitter bootstrap -->
         <a class="navbar-brand" href="#" title="aka Самый Лучший Сайт ;)">SimpleMVC</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="login/login">Главная</a>
                </li>
                <?php  if ($User->isAllowed("login/login")): ?>
                <li class="nav-item ">
                    <a class="nav-link" href="<?= Url::link("login/login")?>">[Вход]</a>
                </li>
                <?php endif; ?>
                <?php  if ($User->isAllowed("admin/adminusers/add")): ?>
                <li class="nav-item ">
                    <a class="nav-link" href="<?= Url::link("admin/adminusers/add")?>">+ Добавить пользователя</a>
                <?php endif; ?>
                </li>
            </ul>
           </div>
        </nav>
        <div id="container">

        <div class="row justify-content-md-center">
            
       <h1>si</h1>
  
        </div>
            <?= $CONTENT_DATA ?>
        
<!-- Это начало страницы сайта-->

                    <div id="footer">
                2017. All rights reserved. I will find you.
            </div>
        </div>
    </body>
</html>

