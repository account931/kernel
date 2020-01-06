<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\modules\models\Messages;

class MessagesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['show-messages'],
                'rules' => [
                    [
                        'actions' => ['show-messages'],
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
     * Displays user's messages.
     *
     * 
     */
    public function actionShowMessages()
    {
		$messages = Messages::find() ->orderBy ('m_id DESC')->where(['m_receiver_id' => Yii::$app->user->identity->id])->all();
		
		$messModel = new Messages();

		return $this->render('messages-index', [
		      'messages' => $messages , 
			  'messModel'  => $messModel
			  
	    ]);
    }

	


}
