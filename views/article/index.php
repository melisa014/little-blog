<h2><?= $viewArticle->title ?>
    <span>
        <a href="/index.php?action=article/edit&id=<?php echo $viewArticle->id; ?>">
            [Редактировать]</a>
    </span>
</h2> 

<a href="/index.php">На домашнюю страницу</a>
<a href="/index.php?action=archive/index">В архив</a><br>

<p><?= $viewArticle->content ?></p>
<p>Эта статья была написана <?= $viewArticle->publicationDate ?></p>
