<h2><?= $archivePageTitle ?></h2>

<a href="/index.php?action=category/add">+ Добавить категорию</a>
<a href="/index.php?action=archive/index">В архив</a>
<a href="/index.php?action=login/logout">Выйти</a>


<?php 
foreach ($archiveCategories['results'] as $k => $v):?>
    
    <a href="/index.php?action=category/index&id=<?php echo $archiveCategories['results'][$k]->id; ?>">
        <h4><?php echo $archiveCategories['results'][$k]->name; ?></h4>
    </a>
    <p><?php echo $archiveCategories['results'][$k]->description; ?></p>
    <hr><br>    
<?php endforeach; ?>

