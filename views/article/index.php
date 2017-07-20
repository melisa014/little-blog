<h2><?= $viewArticle->title ?></h2> 

<a href="/index.php">На домашнюю страницу</a>
<a href="/index.php?action=archive/index">В архив</a><br>

<p><?= $viewArticle->content ?></p>
<p class="pubDate">Эта статья была написана <?= $viewArticle->publicationDate ?></p>
