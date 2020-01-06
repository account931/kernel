<?php

namespace app\modules\controllers;

use Yii;
use app\modules\models\InvoiceLoadIn;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\models\InvoiceLoadOut;
//use app\models\User;
//use app\models\ProductName;
//use app\modules\models\Elevators;
//use app\models\Balance;


/**
 * InvoiceLoadOutController implements the CRUD actions for InvoiceLoadIn model.
 */
class InvoiceLoadOutController extends Controller
{
	
	 const STATUS_PENDING = '0';

	
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
     * any action in this controller is available with users with adminX RBAC
     */
	public function beforeAction($action){
	    if(Yii::$app->user->isGuest){
		    throw new \yii\web\NotFoundHttpException("You have no admin rights. Triggered in beforeAction()");
	    }
        return parent::beforeAction($action); 
	  }
	  
	  
	  
	  

    /**
     * Lists all InvoiceLoadOut requests sent by user.
     * @return mixed
     */
    public function actionIndex()
    {
		
       $requestsLoadOut = InvoiceLoadOut::find()->where(['confirmed_by_admin' => self::STATUS_PENDING]) -> all();

        return $this->render('load-out-index', [
            'requestsLoadOut' => $requestsLoadOut,
        ]);
    }

    

	
	

}
