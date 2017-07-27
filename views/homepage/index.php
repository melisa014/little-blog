 <!--<?php 
    \DebugPrinter::debug($_SESSION, '$_SESSION');
    \DebugPrinter::debug(\core\Session::get()->session, 'св-во session'); 
    \DebugPrinter::debug(\core\User::get()->role, 'роль Userа'); 
?>-->

<h2><?php echo $homepageTitle ?></h2>

    <?php 
    foreach ($homepageArticles['results'] as $key => $value):?>

        <a href="<?= \Url::link("article/index&id=". $homepageArticles['results'][$key]->id)?>">
            <h4><?= $homepageArticles['results'][$key]->title; ?></h4>
        </a>

        <p><?php
            $categoryId = $homepageArticles['results'][$key]->categoryId;
            foreach ($homepageCategories['results'] as $k => $v) {
                if ($homepageCategories['results'][$k]->id == $categoryId) : ?>
                    <a href="<?= \Url::link("category/index&id=". $homepageCategories['results'][$k]->id)?>">
                        <?= $homepageCategories['results'][$k]->name; ?>
                    </a>
                <?php endif;
            }
        ?></p>

        <p><?= $homepageArticles['results'][$key]->summary; ?></p>
        <p class="pubDate"><?= $homepageArticles['results'][$key]->publicationDate; ?></p>
       
        <?= \DebugPrinter::debug($homepageArticles['results'][$key]);?>
        
        <img src="/images/like1.png" height="20px" width="20px" data-articleId="<?= $homepageArticles['results'][$key]->id?>">
        <span class="<?= $homepageArticles['results'][$key]->id?>">
                <?= $homepageArticles['results'][$key]->getLikes($homepageArticles['results'][$key]->id) ?>
        </span>
        <img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">
        <hr><br>    
    <?php endforeach; ?>

    
    
