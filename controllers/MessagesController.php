<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\modules\models\Messages;
use yii\data\Pagination;

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
		$messagesCount = Messages::find() ->orderBy ('m_id DESC')->where(['m_receiver_id' => Yii::$app->user->identity->id])->all();
		
		//LinkPager
		$messages = Messages::find() ->orderBy ('m_id DESC')->where(['m_receiver_id' => Yii::$app->user->identity->id]);//->all();
		$pages= new Pagination(['totalCount' => $messages->count(), 'pageSize' => 9]);
        $modelPageLinker = $messages->offset($pages->offset)->limit($pages->limit)->all();
		
		$messModel = new Messages();

		return $this->render('messages-index', [
		      'messagesCount' => $messagesCount , 
			  'modelPageLinker' => $modelPageLinker, //pageLinker
              'pages' => $pages,      //pageLinker
			  'messModel'  => $messModel
			  
	    ]);
    }

	


}
