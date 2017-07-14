<?php

namespace frontend\controllers;

use Yii;
use common\models\Projects;
use common\models\Tasks;
use common\models\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
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
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projects model.
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
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionCat()
    {
       $model = new Projects();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/']);
        } else {
       return $this->renderAjax('createajax',['model' => new Projects()]);
   }
    }
     public function actionListing($id)
    {
        //$url =Yii::$app->request->get('id');
        $date = date("Y-m-d");
        $tom = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+6, date("Y")));
        $red = Tasks::find()->where('DATE (end_date)<:cur_date AND project_id = :id', array (':cur_date'=>$date, ':id'=>$id))->orderBy(['priority' => SORT_DESC])->all();
        $main = Tasks::find()->where('DATE (end_date)=:end_date AND status != 1 AND status != 0 AND project_id =:id', array (':end_date'=>$date, ':id'=>$id))->orderBy(['priority' => SORT_DESC])->all();
        return $this->renderAjax('listing', compact('main','red'));
    }

    

    

    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $date = date("Y-m-d");
        $lde = Tasks::find()->where('DATE (end_date)>=:cur_date AND project_id =:id ', array (':cur_date'=>$date, ':id'=>$id))->all();
        $del = Tasks::find()->where(['project_id'=>$id, 'status' =>2])->all();
        $oo = count($del);
        $cc = count($lde);
        if($oo > 0 or $cc>0){

            return $this->redirect(['/']); 
            
        } else {
          
           $this->findModel($id)->delete();
           return $this->redirect(['/']); 
        }
        

        
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
