<h2><?php echo $homepageTitle ?></h2>

<a href="/index.php?action=archive/index">В архив</a>
<a href="/index.php?action=login/index">Войти под своим именем</a>


<?php 
foreach ($homepageArticles['results'] as $key => $value):?>
    
    <a href="/index.php?action=article/index&id=<?php echo $homepageArticles['results'][$key]->id; ?>">
        <h4><?php echo $homepageArticles['results'][$key]->title; ?></h4>
    </a>

    <p><?php
        $categoryId = $homepageArticles['results'][$key]->categoryId;
        foreach ($homepageCategories['results'] as $k => $v) {
            if ($homepageCategories['results'][$k]->id == $categoryId) : ?>
                <a href="/index.php?action=category/index&id=<?php echo $homepageCategories['results'][$k]->id; ?>">
                    <?php echo $homepageCategories['results'][$k]->name; ?>
                </a>
            <?php endif;
        }
    ?></p>
    
    <p><?php echo $homepageArticles['results'][$key]->summary; ?></p>
    <p class="pubDate"><?php echo $homepageArticles['results'][$key]->publicationDate; ?></p>
    <hr><br>    
<?php endforeach; ?>
    




