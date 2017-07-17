<h2><?= $viewArticleTitle ?></h2> 
<a href="http://little-blog/index.php?action=article/edit&id=<?php echo $viewArticleId; ?>">
    [Редактировать]</a>
<p><?= $viewArticleContent ?></p>
<p>Эта статья была написана <?= $viewArticleDate ?></p>
<a href="http://little-blog/index.php">На домашнюю страницу</a><br>
<a href="http://little-blog/index.php?action=archive/index">В архив</a>