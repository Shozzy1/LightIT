<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use common\models\Projects;
use rmrevin\yii\fontawesome\FA;


/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */

?>
<style>
#show,#content{display:none;}
#show:checked~#content{display:block;}
#shows,#contents{display:none;}
#shows:checked~#contents{display:block;}
.stepaside{float: right;}

</style>
<div class="tasks-form">

    <?php $form = ActiveForm::begin([
    'enableClientValidation' => true,
    'id' => 'someform'

    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=  $form-> field($model, 'end_date')->widget(DateTimePicker::classname(), [

                    'options' => ['placeholder' => 'Дата окончания и время'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd H:i:s', 
                    ]
                ]);
        ?>
   <div class="hidden">
        <?php $items = [
        '1' => 'Выполнено',
        '0'=>'Не выполнено',
    ];
    $params = [
        'prompt' => 'Выберите статус...'
    ];
    echo $form->field($model, 'status')->dropDownList($items,$params);
    ?>
    </div>

    <div class="stepaside">
 <input type=checkbox id="show">
    <label for="show"><?php echo FA::icon('smile-o fa-2x');?></label>
    <span id="content">
    <?= $form->field($model, 'project_id')->dropDownList(
    ArrayHelper::map(Projects::find()->all(), 'id', 'title'),
    [
    'prompt'=>'Выберите категорию',

    ]); 
    ?>
    </span>
    

    <input type=checkbox id="shows">
    <label for="shows"><?php echo FA::icon('bolt fa-2x');?></label>
    <div id="contents">
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
    </div>
</div>
    
    <div class="form-group ">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['site/login'], ['class'=>'btn btn-primary']) ?>
    </div>
    
      
    <?php ActiveForm::end(); ?>


</div>
