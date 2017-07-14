<?php

namespace common\models;

use Yii;
use common\models\Projects;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;

use common\models\User;
/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property string $title
 * @property integer $priority
 * @property integer $end_date
 * @property integer $status
 * @property integer $project_id
 *
 * @property Projects $project
 */
class Tasks extends ActiveRecord implements IdentityInterface{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['title', 'priority', 'end_date', 'project_id'], 'required'],
            [['priority', 'status', 'project_id'], 'integer'],
            [['title'], 'string', 'max' => 80],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => 'Название задачи',
            'priority' => 'Приоритет',
            'end_date' => 'Дата окончания',
            'status' => 'Статус задачи',
            'project_id' => 'Проект',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }
      public function getProject0()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project']);

    }
    public function getListViewProjectName()
    {
        return $this->project0->title;
    }
    public function getListViewColorName()
    {
        return $this->project0->color;
    }

    
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    public function getId()
    {
        return $this->id;
    }
    public static function findIdentityByAccessToken($token,$type = null)
    {

    }
    public function getAuthKey()
    {

    }
    public function validateAuthKey($authKey)
    {
        
    }
}
