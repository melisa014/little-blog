<h2><?= $archivePageTitle ?></h2>

<?php 
foreach ($archiveCategories['results'] as $k => $v):?>
    
    <a href="<?= \Url::link("category/index&id=". $archiveCategories['results'][$k]->id)?>">
        <h4><?= $archiveCategories['results'][$k]->name; ?></h4>
    </a>
    <p><?= $archiveCategories['results'][$k]->description; ?></p>
    <hr><br>    
<?php endforeach; ?>

