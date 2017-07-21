<h2><?= $viewArticle->title ?>
    <span>
        <a href="/index.php?action=article/edit&id=<?php echo $viewArticle->id; ?>">
            [Редактировать]</a>
    </span>
</h2> 

<p><?= $viewArticle->content ?></p>
<p class="pubDate">Эта статья была написана <?= $viewArticle->publicationDate ?></p>
<img src="/images/like1.png" height="20px" width="20px">