<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin([
    'enableClientValidation' => true,
    'id' => 'someform'
    	]); ?>

    <?= $form->field($model, 'color')->widget(ColorInput::classname()) , $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
       <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        
       <?= Html::a('Cancel', ['site/login'], ['class'=>'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
