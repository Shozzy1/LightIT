<?php
namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;
use common\models\Tasks;
use common\models\User;
/**
 * This is the model class for table "projects".
 *
 * @property integer $id
 * @property string $title
 * @property integer $color
 *
 * @property Tasks[] $tasks
 */
class Projects extends ActiveRecord implements IdentityInterface {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'exist'],
            [['title', 'color'], 'required'],
            [['color'], 'string', 'max' => 11],
            [['title'], 'string', 'max' => 55],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => 'Название проекта',
            'color' => 'Цвет',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['project_id' => 'id']);
    }
    public function getListViewTasks()
    {
        return $this->tasks;
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
