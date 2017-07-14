<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tasks */




?>
<div class="tasks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formajax', [
        'model' => $model,
    ]) ?>

</div>
