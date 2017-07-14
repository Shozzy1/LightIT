<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Dropdown;
use frontend\assets\LocateAsset;





/* @var $this yii\web\View */

$this->title = 'LightIT';
?>


        
           
                <h3>7 days <span style=" font-size: 14px; color:#696969; font-weight: bold;"><?php echo date("l d M")?></span></h3>
                    
                <ul class="cat-menu">
               <p>Текущие</p>
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
                        <p><a href="/tasks/updates?id=<?=$tasks->id?>"><?php echo FA::icon('thumbs-o-up');?></a></p>
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
               
                
         
 
