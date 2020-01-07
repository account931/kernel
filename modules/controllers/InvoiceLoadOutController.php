<?php
//displays and handles users' request to load out product
namespace app\modules\controllers;

use Yii;
use app\modules\models\InvoiceLoadIn;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\models\InvoiceLoadOut;
use yii\data\Pagination;
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
		
       $requestsLoadOutCount = InvoiceLoadOut::find()->where(['confirmed_by_admin' => self::STATUS_PENDING]) -> all();
	   
	   //LinkPager
	   $query = InvoiceLoadOut::find()->where(['confirmed_by_admin' => self::STATUS_PENDING]);
       $pages= new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
       $modelPageLinker = $query->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('load-out-index', [
            'requestsLoadOutCount' => $requestsLoadOutCount,
			'modelPageLinker' => $modelPageLinker, //pageLinker
            'pages' => $pages,      //pageLinker
        ]);
    }

    

	
	
	
	
		//function that works with ajax sent from js/booking_cph.js -> function get_6_month()
	//gets data for all 6 months
    // **************************************************************************************
    // **************************************************************************************
    // **                                                                                  **
    // ** 
    public function actionAjax_get_invoice() 
    {	
	    $invoiceLoadOut = InvoiceLoadOut::find()->where(['id' => $_POST['serveInvoiceLoadOutID']]) -> one();

			  
		//RETURN JSON DATA
		  // Specify what data to echo with JSON, ajax usese this JSOn data to form the answer and html() it, it appears in JS consol.log(res)
         \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;  
          return [
             'result_status' => "OK", // return ajx status
             'code' => 100,	 
			 'invoiceLoadOut' => $invoiceLoadOut, 
          ]; 
	}
    
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	
	

}
