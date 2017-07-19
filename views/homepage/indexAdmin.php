<h2><?php echo $homepageTitle ?></h2>

<a href="/index.php?action=article/add">+ Добавить статью</a>
<a href="/index.php?action=category/add">+ Добавить категорию</a>
<a href="/index.php?action=archive/index">В архив</a>
<a href="/index.php?action=login/logout">Выйти</a>


<?php 
foreach ($homepageArticles['results'] as $key => $value):?>
    
    <a href="/index.php?action=article/index&id=<?php echo $homepageArticles['results'][$key]->id; ?>">
        <h4><?php echo $homepageArticles['results'][$key]->title; ?></h4>
    </a>
    <p><?php echo $homepageCategories['results'][$key]->name; ?></p>
    <p><?php echo $homepageArticles['results'][$key]->summary; ?></p>
    <p><?php echo $homepageArticles['results'][$key]->publicationDate; ?></p>
    <hr><br>    
<?php endforeach; ?>

