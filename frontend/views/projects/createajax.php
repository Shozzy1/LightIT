<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model common\models\Projects */




?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="projects-create">

    

    <?= $this->render('_formajax', [
        'model' => $model,
    ]) ?>

</div>
