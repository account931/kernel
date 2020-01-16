<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\TransferRights;
use app\models\User;


class TransferRightsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['transfer-right'],
                'rules' => [
                    [
                        'actions' => ['transfer-right'],
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
            'error' => [//
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
	
	
	
	
    //====================================================
    /**
     * Application to transfer your right to other client
     *
     * 
     */
    public function actionTransferRight()
    {
		
		$model = new TransferRights();
		$allUsers = User::find()->orderBy ('id DESC')->all(); //users list for form autocomplete
		
		if ($model->load(Yii::$app->request->post())) {
			if ( $model->save()){
				//addUser2
				//deductUser1
				//send Email
			    Yii::$app->getSession()->setFlash('statusOK', "Ваш запит на переоформлення зерна виконано. Пiдтвердження у повiдомленнях."); 
			    return $this->refresh();
           } else {
			    //var_dump($model->getErrors());
			    Yii::$app->getSession()->setFlash('statusFail', "Error"); 
		   }
		}
		
		
		return $this->render('trans-right-index', [
		      'model' => $model,
			  'allUsers' => $allUsers,
	    ]);
    }

	


}
