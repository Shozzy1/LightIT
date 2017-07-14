<?php

namespace frontend\controllers;

use Yii;
use common\models\Tasks;
use common\models\TasksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Projects;
/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
  

     public function actionCreate()
    {
         $model = new Tasks();
        
        
        if ($model->load(Yii::$app->request->post())) {
           
            $model->status = 2;
            if ($model->validate() && $model->save()) {
                return $this->redirect(['/']);
            }
        }
        else
            return $this->render('create',['model'=>$model]);
    }

  public function actionCat()
    {
         $model = new Tasks();
        
        
        if ($model->load(Yii::$app->request->post())) {
           
            $model->status = 2;
            if ($model->validate() && $model->save()) {
                return $this->redirect(['/']);
            }
        }
        else
            echo $this->renderAjax('createajax',['model'=>$model]);
    }

 public function actionSeven()
    {
        $date = date("Y-m-d");
        $tom = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+6, date("Y")));
        $main = Tasks::find()->select('id,title,priority,end_date,status,project_id')->where('DATE (end_date)<=:end_date AND DATE (end_date)>=:cur_date AND status != 1 AND status != 0', array (':end_date'=>$tom, ':cur_date'=>$date))->orderBy(['priority' => SORT_DESC])->all();
        return $this->renderAjax('seven', compact('main'));
    }

 public function actionArhive()
    {

        $main = Tasks::find()->where(['status'=> 1])->orderBy(['priority' => SORT_DESC])->all();
        return $this->renderAjax('arhive', compact('main'));
    }


    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

     public function actionUpdates($id)
    {
        $model = $this->findModel($id);
        $model->status = 1;
        if ($model->save()) {
            
            return $this->redirect(['/']);
        } else {
            return $this->render('updates', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
