<h2><?= $archivePageTitle ?></h2>

<?php 
foreach ($archiveArticles['results'] as $key => $value):?>
    
    <a href="<?= \core\mvc\view\Url::link("article/index&id=". $archiveArticles['results'][$key]->id)?>">
        <h4><?= $archiveArticles['results'][$key]->title; ?></h4>
    </a>
    <p><?= $archiveArticles['results'][$key]->summary; ?></p>
    <p><?= $archiveArticles['results'][$key]->publicationDate; ?></p>
    <hr><br>    
<?php endforeach; ?>

