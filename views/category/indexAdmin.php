<h2><?= $viewCategory->name ?>
    <span>
        <a href="/index.php?action=category/edit&id=<?php echo $viewCategory->id; ?>">
            [Редактировать]</a>
    </span>
</h2> 

<a href="/index.php">На домашнюю страницу</a>
<a href="/index.php?action=archive/index">В архив</a><br>
<a href="/index.php?action=archive/allCategories">К другим категориям</a><br>

<p><?= $viewCategory->description ?></p>