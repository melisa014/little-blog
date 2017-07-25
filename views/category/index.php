<h2><?= $viewCategory->name ?>
    <span>
        <a href="<?php \Url::link("category/edit&id=". $viewCategory->id)?>">
            [Редактировать]</a>
    </span>
</h2> 



<p><?= $viewCategory->description ?></p>