<h2><?= $viewArticle->title ?>
    <span>
        <?= \core\User::get()->returnIfAllowed("article/edit", 
            "<a href=" . \Url::link("article/edit&id=". $viewArticle->id) 
            . ">[Редактировать]</a>");?>
    </span>
</h2> 

<p><?= $viewArticle->content ?></p>
<p class="pubDate">Эта статья была написана <?= $viewArticle->publicationDate ?></p>
<img src="/images/like1.png" height="20px" width="20px" data-modelId="<?= $viewArticle->id ?>">
<span class="<?= $viewArticle->id?>">
    <?= $viewArticle->getModellikes($viewArticle->id) ?>
</span>
<img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">