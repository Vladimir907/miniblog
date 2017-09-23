<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Comment */

$this->title = 'Оставить комментарий';
?>
<div id="templatemo_main_wrapper">
<div id="templatemo_content_wrapper">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
