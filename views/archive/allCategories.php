<h2><?= $archivePageTitle ?></h2>

<a href="<?php \Url::link("category/add")?>">+ Добавить категорию</a>

<?php 
foreach ($archiveCategories['results'] as $k => $v):?>
    
    <a href="<?php \Url::link("category/index&id=". $archiveCategories['results'][$k]->id)?>">
        <h4><?php echo $archiveCategories['results'][$k]->name; ?></h4>
    </a>
    <p><?php echo $archiveCategories['results'][$k]->description; ?></p>
    <hr><br>    
<?php endforeach; ?>

