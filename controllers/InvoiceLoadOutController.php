<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\modules\models\InvoiceLoadOut;
use app\models\Balance;


class InvoiceLoadOutController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['load-out'],
                'rules' => [
                    [
                        'actions' => ['load-out'],
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
     * Displays Load out request form
     *
     * @return string
     */
    public function actionLoadOut()
    {
        $model = new InvoiceLoadOut();
		
		//form fields
		$model->invoice_unique_id = Yii::$app->security->generateRandomString(18); //invoiceID to form 
		$model->user_date_unix = time();
		
		//products for dropdown form
		$products = Balance::find()->where(['balance_user_id' => Yii::$app->user->identity->id])-> all();
		$b = new Balance();
		
        return $this->render('load-out-index', [
		      'model' => $model, 
			  'products' => $products,
			  'b' => $b
	     ]);
    }

    

}
