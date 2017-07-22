<h2><?= $archivePageTitle ?></h2>

<?php 
foreach ($archiveArticles['results'] as $key => $value):?>
    
    <a href="<?php Url::link("article/index&id= \$archiveArticles['results'][\$key]->id" )?>"
        <h4><?php echo $archiveArticles['results'][$key]->title; ?></h4>
    </a>
    <p><?php echo $archiveArticles['results'][$key]->summary; ?></p>
    <p><?php echo $archiveArticles['results'][$key]->publicationDate; ?></p>
    <hr><br>    
<?php endforeach; ?>

