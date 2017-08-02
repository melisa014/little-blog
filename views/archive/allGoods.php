
<h2><?= $archivePageTitle ?></h2>

<?php 
foreach ($archiveGood['results'] as $k => $v):?>
    <h4>
        <a href="<?= \Url::link("admin/good/index&id=". $archiveGood['results'][$k]->id)?>">
            <?= $archiveGood['results'][$k]->name; ?>
        </a>
    </h4>
    <p><?= $archiveGood['results'][$k]->price; ?>
    <?= $archiveGood['results'][$k]->available; ?></p>
    <img src="/images/like1.png" height="20px" width="20px" data-modelId="<?= $archiveGoods['results'][$k]->id?>">
        <span class="<?= $$archiveGoods['results'][$k]->id?>">
                <?= $$archiveGoods['results'][$k]->getArticleLikes($$archiveGoods['results'][$k]->id) ?>
        </span>
        <img id="loader-identity" src="/images/ajax-loader.gif" alt="gif">
    <hr><br>    
<?php endforeach; ?>

