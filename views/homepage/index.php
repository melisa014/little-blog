

<h2><?= $homepageTitle ?></h2>

<?php 
foreach ($homepageArticles['results'] as $key => $value):?>
    
    <a href=http://little-blog/index.php?action=article/index&id=<?php echo $homepageArticles['results'][$key]->id; ?>>
        <h4><?php echo $homepageArticles['results'][$key]->title; ?></h4>
    </a>
    <p><?php echo $homepageArticles['results'][$key]->summary; ?></p>
    <p><?php echo $homepageArticles['results'][$key]->publicationDate; ?></p>
    <hr><br>    
<?php endforeach; ?>
    
<a href="http://little-blog/index.php?action=article/add">+ Добавить статью</a>
    
<a href="http://little-blog/index.php?action=archive/index">В архив</a>



