
        <a href="<?= \Url::link("archive/allCategories")?>">В архив(Категории)</a>
        <a href="<?= \Url::link("article/add")?>">+ Добавить статью</a>
        <a href="<?= \Url::link("category/add")?>">+ Добавить категорию</a>
        
        <p><?= $_SESSION['username']. ' ' ?><a href="<?php \Url::link("login/logout")?>">Выйти</a></p>
        
        <p>Вам понравилось: <?= $_SESSION['like']; ?></p>
                 
        
        <!--  <?php if (\core\User::get()->isAllowed()) {
           echo \Url::link("\headerAdmin.php");
       }
 else {}?>-->
 