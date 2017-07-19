<h2>Список категорий</h2>

<a href="/index.php?action=category/add">+ Добавить категорию</a>
<a href="/index.php?action=archive/index">В архив</a>
<a href="/index.php?action=login/logout">Выйти</a>


<?php 
foreach ($homepageCategories['results'] as $key => $value):?>
    
    <a href="/index.php?action=category/index&id=<?php echo $homepageCategories['results'][$key]->id; ?>">
        <h4><?php echo $homepageCategories['results'][$key]->name; ?></h4>
    </a>
    <p><?php echo $homepageCategories['results'][$key]->description; ?></p>
    <hr><br>    
<?php endforeach; ?>

