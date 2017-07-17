<h2><?= $archivePageTitle ?></h2>

<?php 
foreach ($archiveArticles['results'] as $key => $value):?>
    
    <a href=http://little-blog/index.php?action=article/index&id=<?php echo $archiveArticles['results'][$key]->id; ?>>
        <h4><?php echo $archiveArticles['results'][$key]->title; ?></h4>
    </a>
    <p><?php echo $archiveArticles['results'][$key]->summary; ?></p>
    <p><?php echo $archiveArticles['results'][$key]->publicationDate; ?></p>
    <hr><br>    
<?php endforeach; ?>

<a href="http://little-blog/index.php">На домашнюю страницу</a><br>
<a href="http://little-blog/index.php?action=archive/index">В архив</a>