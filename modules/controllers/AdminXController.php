<?php

namespace app\modules\controllers;

use yii\web\Controller;
use Yii;
use app\models\LoginForm;
use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\models\RegisterRequest_InputModel;
/**
 * Default controller for the `admin` module
 */
class AdminXController extends Controller
{
	
	
	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['admin-panel'],
                'rules' => [
                    [
                        'actions' => ['admin-panel'],
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
     * {@inheritdoc}
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
     * any action in this controller is available with users with adminX RBAC
     */
	public function beforeAction($action){
	    if(Yii::$app->user->isGuest){
		    throw new \yii\web\NotFoundHttpException("You have no admin rights. Triggered in beforeAction()");
	    }
        return parent::beforeAction($action); 
	  }
	  
	
	
	
	
	 //===================================
	 /**
     * Renders the admin personal account/main page
     * @return string
     */
    public function actionAdminPanel()
    {

		 /*if(Yii::$app->user->isGuest){
		   return $this->redirect(['/admin/default/index']);
		 }*/
		
		
        return $this->render('admin-panel');
    }
	
	
	
	
	
	 //===================================
	 /**
     * Ajax Check and count (via ajax request) if there are any users' registration requests (with status = 10) 
     * @return json
     */
    public function actionCountRegisterRequests()
    {
        $found = User::find()->where(['status' => 9]);
		$count = $found->count();
		
		//RETURN JSON DATA
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => "OK",
			 'count' => $count ,  
          ]; 
        
    }
	
	
	
	 //===================================
	 /**
     * Renders the page to view (approve/reject) users registration requests
     * @return string
     */
    public function actionUsersRegistrationRequests()
    {
		
		
		$model = new RegisterRequest_InputModel();
		
		if ($model->load(\Yii::$app->request->post()) ) {
			$customer = User::find()->where(['id' => $model->yourInput])->one();
			$customer->status = 10;
			if($customer->save()){
				Yii::$app->getSession()->setFlash('approveOK', "You successfully approved new user" . $model->yourInputEmail);
				$model->yourInput ='';
				return $this->refresh();
			}
		}
		
		$requests = User::find()->where(['status' => 9])->all();
		
        return $this->render('users-registration-requests', [
		      'requests' => $requests, 
			  'model' => $model, 
	    ]);
    }
	
	
	
	
	
	
}
