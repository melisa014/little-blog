<h2><?= $viewArticle->title ?>
    <span>
        <?= \ItForFree\SimpleMVC\User::get()->returnIfAllowed("article/edit", 
            "<a href=" . \ItForFree\SimpleMVC\Url::link("article/edit&id=". $viewArticle->id) 
            . ">[Редактировать]</a>");?>
    </span>
</h2> 

<p><?= $viewArticle->content ?></p>
<p class="pubDate">Эта статья была написана <?= $viewArticle->publicationDate ?></p>
<img src="/images/like.png" height="20px" width="20px" data-modelId="<?= $viewArticle->id ?>" data-tableName='articles'>
<span class="<?= $viewArticle->id?>">
    <?= $viewArticle->getModellikes($viewArticle->id, 'articles') ?>
</span>
<img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">