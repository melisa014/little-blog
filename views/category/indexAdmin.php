<h2><?= $viewCategory->name ?>
    <span>
        <a href="/index.php?action=category/edit&id=<?php echo $viewCategory->id; ?>">
            [Редактировать]</a>
    </span>
</h2> 



<p><?= $viewCategory->description ?></p>