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
		
		 //find transaction for all period (if there is no $_GET['period'])
		 if (!Yii::$app->getRequest()->getQueryParam('period')){
		    //$query = InvoiceLoadOut::find()->where(['user_id' => Yii::$app->user->identity->id])->joinWith(['tabless'])->all(); 
		    $query1 = InvoiceLoadOut::find()->orderBy ('id ASC')->where(['user_id' => Yii::$app->user->identity->id])->all(); 
		    $query2 = InvoiceLoadIn::find() ->orderBy ('id ASC')->where(['user_kontagent_id' => Yii::$app->user->identity->id])->all(); 
		    
		 }
		
		
		 //find transaction for current month only (if there is $_GET['currentMonth'])
         if (Yii::$app->getRequest()->getQueryParam('period') == "currentMonth"){
			$query1 = InvoiceLoadOut::find()->orderBy ('id ASC')->where(['user_id' => Yii::$app->user->identity->id])
			         ->andWhere(['between', 'user_date_unix', strtotime(date('Y-m-01 00:00:00')), time() ])  //time()->current Unix, strtotime(date('Y-m-01 00:00:00')) -> unix of first day of current month
			         ->all(); 
				 
		    $query2 = InvoiceLoadIn::find() ->orderBy ('id ASC')->where(['user_kontagent_id' => Yii::$app->user->identity->id])
			        ->andWhere(['between', 'unix', strtotime(date('Y-m-01 00:00:00')), time() ])  
			        ->all(); 
		 }
		 
		 //find transaction for previous month only (if there is $_GET['lastMonth'])
         if (Yii::$app->getRequest()->getQueryParam('period') == "lastMonth"){
			$startLastMonth = mktime(0, 0, 0, date("m") - 1, 1, date("Y")); //Unix of 1st day of last month
            $endLastMonth = mktime(0, 0, 0, date("m"), 0, date("Y"));       //Unix of 1ast day of last month

			$query1 = InvoiceLoadOut::find()->orderBy ('id ASC')->where(['user_id' => Yii::$app->user->identity->id])
			         ->andWhere(['between', 'user_date_unix', $startLastMonth, $endLastMonth  ])  
			         ->all(); 
				 
		    $query2 = InvoiceLoadIn::find() ->orderBy ('id ASC')->where(['user_kontagent_id' => Yii::$app->user->identity->id])
			        ->andWhere(['between', 'unix', $startLastMonth, $endLastMonth  ])  
			        ->all(); 
		 }
		 
		 
		 //find transaction for last 6 month (if there is $_GET['last_6_Month'])
         if (Yii::$app->getRequest()->getQueryParam('period') == "last_6_Month"){
			$startLastMonth = mktime(0, 0, 0, date("m") - 6, 1, date("Y")); //Unix of 1st day of the  month -6

			$query1 = InvoiceLoadOut::find()->orderBy ('id ASC')->where(['user_id' => Yii::$app->user->identity->id])
			         ->andWhere(['between', 'user_date_unix', $startLastMonth, time() ])  
			         ->all(); 
				 
		    $query2 = InvoiceLoadIn::find() ->orderBy ('id ASC')->where(['user_kontagent_id' => Yii::$app->user->identity->id])
			        ->andWhere(['between', 'unix', $startLastMonth, time() ])  
			        ->all(); 
		 }
		 
		 
		 
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
	   
	   $query = array_reverse($queryTemp); //new comes first
	   		
		return $this->render('transactions-index', [
		      'query' => $query, 
	    ]);
    }

	


}
