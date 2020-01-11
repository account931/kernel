<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\modules\models\InvoiceLoadOut;
use app\modules\models\InvoiceLoadIn;

class TransactionsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['mytransations'],
                'rules' => [
                    [
                        'actions' => ['mytransations'],
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
     * Displays personal history of all transaction.
     *
     * @return string
     */
    public function actionMytransations()
    {
		
		//$query = InvoiceLoadOut::find()->where(['user_id' => Yii::$app->user->identity->id])->joinWith(['tabless'])->all(); 
		$query1 = InvoiceLoadOut::find()->where(['user_id' => Yii::$app->user->identity->id])->all(); 
		$query2 = InvoiceLoadIn::find()->where(['user_kontagent_id' => Yii::$app->user->identity->id])->all(); 
		$queryTemp = array_merge($query1, $query2);
		
		
		
		//sort merged array by unixTime from 2 arrays (InvoiceLoadOut::date_to_load_out/InvoiceLoadIn::unix)
		$query = array();
		for($i = 0; $i < count($queryTemp); $i++){
			
			
			for($j = 0; $j < count($queryTemp)/* - $i*/; $j++){
				if(isset($queryTemp[$j]['user_id'])){
				   $key = 'date_to_load_out';
			    } else {
				    $key = 'unix';
			    }
			    if(isset($queryTemp[$j+1]['user_id'])){
				    $key2 = 'date_to_load_out';
			    } else {
				   $key2 = 'unix';
			    }
			
				if(isset($queryTemp[$j][$key])&& isset($queryTemp[$j+1][$key2])){
				    if( (int)$queryTemp[$j][$key] > (int)$queryTemp[$j+1][$key2] ){
					    $max = $queryTemp[$j];
					    $queryTemp[$j] = $queryTemp[$j+1];
					    $queryTemp[$j+1] = $max;
				     }
				}
			} 
		}
       // var_dump($queryTemp);
	   $query = $queryTemp;
		
		return $this->render('transactions-index', [
		      'query' => $query, 
	    ]);
    }

	


}
