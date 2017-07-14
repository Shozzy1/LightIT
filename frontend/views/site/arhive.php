<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Dropdown;
use yii\helpers\Url;





/* @var $this yii\web\View */

$this->title = 'LightIT';
?>

<div class="site-index">


    <div class="body-content">

        <div class="row">
            <div class="col-lg-2">
                <ul class="side-menu">
                    <li><a href="/">На Сегодня <span style="font-size:14px; float: right;"><?php echo $count_today;?></span></a></li>
                    <li><a href="/site/seven">На 7 Дней <span style="font-size:14px; float: right;"><?php echo $count_seven;?></span></a></li>
                </ul>
                <h4>Проекты</h4>
                
                <ul class="cat-menu">
                <?php if(!empty($query)): ?>
                <?php foreach($query as $project): ?>

                   <li>
                    <p class="circle" style="background: <?=$project->color?>;"></p>
                    <a href="/projects/delete?id=<?=$project->id?>" data-method="post" class="one">
                        <?php echo FA::icon('trash-o');?>
                    </a>
                    <a href="/site/list?id=<?=$project->id?>"><?=$project->title?></a>

                        
                        <?php echo count($project->listViewTasks); ?>
                    <a href="/projects/update?id=<?=$project->id?>" class="one">
                        <?php echo FA::icon('pencil');?>
                    </a>
                    </li>
                    <?php endforeach; ?>
                <?php endif; ?> 
                  <?php  
                if (\Yii::$app->user->isGuest) {
                echo "Вы должны быть авторизированы";
                }else{
                    Pjax::begin([
                    'enablePushState' =>false,
                ]); 
                   ?><a href="/projects/cat" class="linked">+ Добавить проект</a>
                   <?php Pjax::end();

                } ?>
                </ul> 
            </div>

        
            <div class="col-lg-8 side">
                <h3>Архив</h3>

                <ul class="cat-menu">
               
               
               <?php if(empty($main)){
                echo '<h3>Задач нет!</h3>';
               }?>
                <?php if(!empty($main)): ?>

                <?php foreach($main as $tasks): ?>
                    <li>
                    <div class="col-md-6">
                    <?php 
                    if($tasks->priority == 2){
                        ?><p class="kvadr" style="background: red;"></p><?
                    }elseif($tasks->priority == 1){
                        ?><p class="kvadr" style="background: orange;"></p><?
                    }else{
                        ?><p class="kvadr" style="background: white;"></p><?
                    }?>
                    <?=$tasks->title;?>
                    </div>
                    <div class="col-md-6">
                    <?=$tasks->listViewProjectName;?>


                
                      <?php  
                    if (\Yii::$app->user->isGuest) {
                    } else {?>
                    <div class="dropdown one">
                    <span><?php echo FA::icon('ellipsis-v fa-lg');?></span>
                    <div class="dropdown-content">
                        <p><a href="/tasks/update?id=<?=$tasks->id?>"><?php echo FA::icon('pencil');?></a></p>
                        <p><a href="/tasks/delete?id=<?=$tasks->id?>" data-method="post"><?php echo FA::icon('trash-o');?></a></p>
                    </div>
                    </div>
                    <?php
                    }?>

                    <div class="circle" style="background: <?=$tasks->listViewColorName?>;"></div>
                    </div>
                    </li>
                    <?php echo '<hr>';?>
                    <?php endforeach; ?>
                    <?php endif; ?> 
                </ul>
                 
            </div>
                
            <div class="col-lg-2"> 
            </div>
        </div>

    </div>
</div>





