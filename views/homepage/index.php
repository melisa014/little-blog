
<h2><?php echo $homepageTitle ?></h2>
    <?php 
    foreach ($homepageArticles['results'] as $key => $value):?>

        <a href="<?= \ItForFree\SimpleMVC\Url::link("article/index&id=". $homepageArticles['results'][$key]->id)?>">
            <h4><?= $homepageArticles['results'][$key]->title; ?></h4>
        </a>

        <p><?php
            $categoryId = $homepageArticles['results'][$key]->categoryId;
            foreach ($homepageCategories['results'] as $k => $v) {
                if ($homepageCategories['results'][$k]->id == $categoryId) : ?>
                    <a href="<?= \ItForFree\SimpleMVC\Url::link("category/index&id=". $homepageCategories['results'][$k]->id)?>">
                        <?= $homepageCategories['results'][$k]->name; ?>
                    </a>
                <?php endif;
            }
        ?></p>

        <p><?= $homepageArticles['results'][$key]->summary; ?></p>
        <p class="pubDate"><?= $homepageArticles['results'][$key]->publicationDate; ?></p>
        <img src="/images/like.png" height="20px" width="20px" data-modelId="<?= $homepageArticles['results'][$key]->id?>" data-tableName='articles'>
        <span class="<?= $homepageArticles['results'][$key]->id?>">
                <?= $homepageArticles['results'][$key]->getModelLikes($homepageArticles['results'][$key]->id, 'articles') ?>
        </span>
        <img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">
        <hr><br>    
    <?php endforeach; ?>

    
    
