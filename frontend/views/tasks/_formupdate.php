<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use common\models\Projects;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
  /* <?= $form->field($model, 'end_date')->textInput() ?>*/
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
  
     <?php $items = [
        '2'=> 'Высокий приоритет',
        '1' => 'Обычный приоритет',
        '0'=>'Низкий приоритет'
    ];
    $params = [
        'prompt' => 'Выберите приоритет...'
    ];
    echo $form->field($model, 'priority')->dropDownList($items,$params);
    ?>

 <?=  $form-> field($model, 'end_date')->widget(DateTimePicker::classname(), [

                    'options' => ['placeholder' => 'End date & time'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd H:i:s', 
                    ]
                ]);
        ?>
  
        <?php $items = [
        '1' => 'Выполнено',
        '0'=>'Не выполнено',
    ];
    $params = [
        'prompt' => 'Выберите статус...'
    ];
    echo $form->field($model, 'status')->dropDownList($items,$params);
    ?>
  
    

     <?= $form->field($model, 'project_id')->dropDownList(
ArrayHelper::map(Projects::find()->all(), 'id', 'title'),
[
'prompt'=>'Выберите категорию',

]); 
?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
