<?php 
use ItForFree\SimpleMVC\Config;


$User = Config::getObject('core.user.class');

?>
<!DOCTYPE html>
<html>
    <?php include('includes/main/head.php'); ?>
    <body> 
        <?php include('includes/admin-main/nav.php'); ?>
        <div class="container">
            <?= $CONTENT_DATA ?>
        </div>
        <?php include('includes/main/footer.php'); ?>
    </body>
</html>

