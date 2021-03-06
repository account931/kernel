<?php
//User's page to make a request to load out some amount of product (in kg)
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
		//$model->invoice_unique_id = Yii::$app->security->generateRandomString(5). "-" . time(); //invoiceID to form 
		$model->user_date_unix = time();
		
		//products for dropdown form
		$products = Balance::find()->where(['balance_user_id' => Yii::$app->user->identity->id])-> all();
		$b = new Balance();
		
		
		
	    if ($model->load(Yii::$app->request->post())) {
			if ( $model->save()){
			    /*$res = $model->checkBalance();
			
			    if($res){
			    //adds and updates with new weigth		
			     $model->balanceAdd($res);
		       } else {
			      //saves new row with product and weigth	
			      $model->addNewProduct();
		       }
			
		       $model->sendMessage(); //notify the user
			   */
			
               //return $this->redirect(['view', 'id' => $model->id]);
			
			    $model->deductProduct();
			    $model->sendMessage();
				$model->attributes = '';
			    Yii::$app->getSession()->setFlash('statusOK', "Ваш запит на вiдвантаження вiдправлено адмiстратору. Очiкуйте на пiдтвердження у повiдомленнях"); 
			    return $this->refresh();
           } else {
			    //var_dump($model->getErrors());
			    Yii::$app->getSession()->setFlash('statusOK', "Error"); 
		   }
		}
		
		
		
		
        return $this->render('load-out-index', [
		      'model' => $model, 
			  'products' => $products,
			  'b' => $b
	     ]);
    }

    

}
