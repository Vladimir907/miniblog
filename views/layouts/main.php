<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="lay_footer_wrap">
<div id="templatemo_header_wrapper">
    <div id="templatemo_header">
        
       <div id="site_title">
            <h1><a href="/">
                <img src="/web/images/templatemo_logo.png" alt="tripod blog" /></a>
                <span>Мини блог</span>
            </h1>
        </div>
        
        <div id="templatemo_rss">
        <?php if(Yii::$app->user->isGuest):?>
            <a href="<?php echo Url::toRoute(['auth/login']); ?>" target="_parent">Вход</a>
            <a href="<?php echo Url::toRoute(['auth/signup']); ?>" target="_parent">Регистрация</a>
            <?php else: ?>
                <?= Html::beginForm(['/auth/logout'], 'post')
                . Html::submitButton(
                    Yii::$app->user->identity->name .' ( Выйти )',
                    ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px;"]
                )
                . Html::endForm() ?>
            <?php endif;?>
        </div>
    
    </div> <!-- end of header -->
    
    <div id="templatemo_menu">
    
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="<?php echo Url::toRoute(['site/myblog']); ?>">Мой блог</a></li>
        </ul>       
    
    </div> <!-- end of templatemo_menu -->
    
</div> <!-- end of header wrapper -->


<?= $content ?>

<div class="reserved"></div>

</div>

<div id="templatemo_footer_wrapper">
    <div id="templatemo_footer">
    
        Copyright © 2017 <a href="#">Ревчук Владимир</a>
        
    </div> <!-- end of templatemo_copyright -->
</div> <!-- end of copyright wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
