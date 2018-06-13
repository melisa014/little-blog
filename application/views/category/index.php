<h2><?= $viewCategory->name ?>
    <span>
        <?= \ItForFree\SimpleMVC\User::get()->returnIfAllowed("category/edit", 
            "<a href=" . \ItForFree\SimpleMVC\Url::link("category/edit&id=". $viewCategory->id) 
            . ">[Редактировать]</a>");?>
    </span>
</h2> 



<p><?= $viewCategory->description ?></p>