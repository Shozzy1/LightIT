<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Projects;
use common\models\Tasks;
use frontend\controllers\ProjectController;
use yii\web\Request;


/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */

    public $cnt;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */

    
    public function actionIndex()
    {
       
        $date = date("Y-m-d");
        $tom = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+6, date("Y")));
        $not_complete = Tasks::find()->where(['status'=>0])->count();
        $red = Tasks::find()->where('DATE (end_date)<:cur_date OR status = 0', array (':cur_date'=>$date))->orderBy(['priority' => SORT_DESC])->all();
        //$stat = Tasks::find()->where(['status' => 0])->orderBy(['priority' => SORT_DESC])->all();
        $query = Projects::find()->select('id,title,color')->all();
        $main = Tasks::find()->select('id,title,priority,end_date,status,project_id')->where('DATE (end_date)=:end_date AND status != 1 AND status != 0', array (':end_date'=>$date))->orderBy(['priority' => SORT_DESC])->all();
        $count_today = Tasks::find()->where('DATE (end_date)=:end_date AND status != 1 AND status != 0', array (':end_date'=>$date))->count();
        $count_seven = Tasks::find()->where('DATE (end_date)<=:end_date AND DATE (end_date)>=:cur_date AND status != 1 AND status != 0', array (':end_date'=>$tom, ':cur_date'=>$date))->count();
       

        return $this->render('index', compact('query','main', 'count_today', 'count_seven', 'not_complete', 'red'));
    }

   public function actionSeven()
    {
       
        $date = date("Y-m-d");
        $tom = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+6, date("Y")));
        $query = Projects::find()->select('id,title,color')->all();
        $main = Tasks::find()->select('id,title,priority,end_date,status,project_id')->where('DATE (end_date)<=:end_date AND DATE (end_date)>=:cur_date AND status != 1 AND status != 0', array (':end_date'=>$tom, ':cur_date'=>$date))->orderBy(['priority' => SORT_DESC])->all();
        $count_today = Tasks::find()->where('DATE (end_date)=:end_date AND status != 1 AND status != 0', array (':end_date'=>$date))->count();
        $count_seven = Tasks::find()->where('DATE (end_date)<=:end_date AND DATE (end_date)>=:cur_date AND status != 1 AND status != 0', array (':end_date'=>$tom, ':cur_date'=>$date))->count();
       

        return $this->render('seven', compact('query','main', 'count_today', 'count_seven'));
    }

    public function actionListing($id)
    {
        //$url =Yii::$app->request->get('id');
        $date = date("Y-m-d");
        $tom = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+6, date("Y")));
        $not_complete = Tasks::find()->where(['status'=>0, 'id'=> $id])->count();
        $red = Tasks::find()->where('DATE (end_date)<:cur_date AND id = :ids', array (':cur_date'=>$date, ':ids'=>$id))->orderBy(['priority' => SORT_DESC])->all();
        $stat = Tasks::find()->where(['status' => 0, 'id'=>$id])->orderBy(['priority' => SORT_DESC])->all();
        $query = Projects::find()->select('id,title,color')->all();
        $main = Tasks::find()->select('id,title,priority,end_date,status,project_id')->where('DATE (end_date)=:end_date AND status != 1 AND status != 0 AND id =:id', array (':end_date'=>$date, ':id'=>$id))->orderBy(['priority' => SORT_DESC])->all();
        $count_today = Tasks::find()->where('DATE (end_date)=:end_date AND status != 1 AND status != 0 AND id =:id', array (':end_date'=>$date, ':id'=>$id))->count();
        $count_seven = Tasks::find()->where('DATE (end_date)<=:end_date AND DATE (end_date)>=:cur_date AND status != 1 AND status != 0 AND id =:id', array (':end_date'=>$tom, ':cur_date'=>$date, ':id'=>$id))->count();
       

        return $this->render('listing', compact('query','main', 'count_today', 'count_seven', 'not_complete', 'red', 'stat'),['id' => $id]);
    }
     public function actionArhive()
    {
       
        $date = date("Y-m-d");
        $tom = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+6, date("Y")));
       
       
        $query = Projects::find()->select('id,title,color')->all();
        $main = Tasks::find()->where(['status'=> 1])->orderBy(['priority' => SORT_DESC])->all();
        $count_today = Tasks::find()->where('DATE (end_date)=:end_date AND status != 1 AND status != 0', array (':end_date'=>$date))->count();
         $count_seven = Tasks::find()->where('DATE (end_date)<=:end_date AND DATE (end_date)>=:cur_date AND status != 1 AND status != 0', array (':end_date'=>$tom, ':cur_date'=>$date))->count();
       

        return $this->render('arhive', compact('query','main', 'count_today', 'count_seven'));
    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    
}
