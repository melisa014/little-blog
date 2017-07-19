<h2><?= $archivePageTitle ?></h2>
<a href="/index.php">На домашнюю страницу</a>
<a href="/index.php?action=archive/index">В архив</a>

<?php 
foreach ($archiveArticles['results'] as $key => $value):?>
    
    <a href="/index.php?action=article/index&id=<?php echo $archiveArticles['results'][$key]->id; ?>">
        <h4><?php echo $archiveArticles['results'][$key]->title; ?></h4>
    </a>
    <p><?php echo $archiveArticles['results'][$key]->summary; ?></p>
    <p><?php echo $archiveArticles['results'][$key]->publicationDate; ?></p>
    <hr><br>    
<?php endforeach; ?>

