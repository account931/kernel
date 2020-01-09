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

    

	
	
	
	

	//works with ajax sent from js/admin/invoice_load_out.js -> method gets data for one selected invoice
    // **************************************************************************************
    // **************************************************************************************
    // **                                                                                  **
    // ** 
    public function actionAjax_get_invoice() 
    {	
	    $invoiceLoadOut = InvoiceLoadOut::find()->where(['id' => $_POST['serveInvoiceLoadOutID']]) -> one();

			  
		//RETURN JSON DATA
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
	
	
	
	
	
	
	
	//works with ajax sent from js/admin/datepicker_action.js -> method gets Interval list for a selected date, returns all html
    // **************************************************************************************
    // **************************************************************************************
    // **                                                                                  **
    // ** 
    public function actionAjax_get_interval_list() 
    {	
	    global $text;
	    $dayPost = Yii::$app->request->post('serverSelectedDateUnix'); //$_POST['serverSelectedDateUnix'];
		
		$result = InvoiceLoadOut::find()->orderBy ('id ASC') ->where([ 'date_to_load_out' => $dayPost]) ->all(); 

		$text = Yii::$app->formatter->format($dayPost, 'date') . "</br>" . $dayPost;// . "</br>" . var_dump($result) ; 
		
		$text.= "<div class='col-sm-12 col-xs-12>j</div>";
		

		
    // **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
    function DisplayReserved($iterator,$nextIterator,$indexOf,$result,$minutesStart,$minutesEnd){ 
	    global $text;
        // 1)$iterator==$i (calculated in for(){} loop), 2)$nextIterator (hour+1)==$t==$i+1 (for those who has duplicate), if does not use NULL
        //3)$indexOf==position 4)$result==Act record array result from Controller
        //5))$minutesStart==30 OR 00  6)$minutesEnd== 30 OR 00
 
        //if $nextIterator/$t called as Null (we DON"T need $nextIterator/$t   for 1st Row calling(i.e 9.00-9.30)), we Do NEED it for the second row(9.30-10.00)
        if (is_null($nextIterator) ) {
		    $nextIterator = $iterator;
	    } else {
		    $nextIterator = $nextIterator;
	    }
	    $idX = $result[$indexOf]->id;
        $text = $text . "<div class='col-sm-2 col-xs-3 taken shadowX'> Taken ".$iterator.  "."   .$minutesStart.  "-" .$nextIterator. "."   .$minutesEnd.   " </div>";
   
   }
   // **                                                                                  **
   // **************************************************************************************
   // **************************************************************************************



    //DisplayReserved($i,null,$indexOf,$result, '00',  '30');
    //DisplayReserved($i,$t,$indexOf+1,$result, '30',  '00');
    //Function which forms free cells and <a href> with data to book it
    // **************************************************************************************
    // **************************************************************************************
    //                                                                                     **
                                                                                  
    function DisplayFree($iterator,$nextIterator,$minutesStart,$minutesEnd){ 
	    global $text;
        if (is_null($nextIterator)){
	        $nextIterator = $iterator;
        } else {
	        $nextIterator = $nextIterator;
        }
 
        $hour = $iterator; // used for <a href> link
        //$dateNorm = $GLOBALS['timeX'];// we get $timeX from Controller render; This is {9-Feb-Fri-2018}, we add this to id, to make possible to redict to the same date after insert
        //findin quarters (0||3)
        if($minutesStart == "00"){
            $quarter = 0;
        } else {
            $quarter = 3;
        }
 
        $text = $text ."<div class='col-sm-2 col-xs-3 free shadowX'> Free =>  ".$iterator.  "."   .$minutesStart . "-" . $nextIterator . "." . $minutesEnd . "</div>";
        //$text = $text ."<p style='display:none;margin-top:0.7em;background-color:;' class='nnn'>  Your agenda</br> <textarea rows='2' cols='50' placeholder='...'></textarea> </br><button type='button' class='bookFinal' id='' > OK </button>  </p>";

     }
     // **                                                                                  **
     // **************************************************************************************
     // **************************************************************************************


    $bIntervals = array();// array for intervals available 
	
	foreach($result as $ss){
        array_push($bIntervals, $ss->b_intervals);
    }
		
    //just test, EREASE IT!!!!!
    foreach ($bIntervals as $y){
	   $text.= "</br>arr=> " . $y;
    }	
		
     $text.= "</br> Count=> " . count($bIntervals);  //just test, EREASE IT!!!!!
	 
	 
	 
	 
	 for($i = 6; $i < 23; $i++){
             //if time exists in array  $bIntervals, displays taken
             if(in_array($i, $bIntervals)){ 
			     $indexOf = array_search($i, $bIntervals); // find the indexOf of $i, which exists in array to use {$rowF[$indexOf]['b_booker'].}
			     $Next_i = $indexOf + 1;  //the position of first found +1
			     $t = $i + 1; // next hour
			   
			   
			 if(isset($bIntervals[$Next_i])){
				 $bIntervals[$Next_i] = $bIntervals[$Next_i];
			 } else {
				 $bIntervals[$Next_i] = FALSE;
			 }
			 
				 
				 
			   if($i == $bIntervals[$Next_i]){  //if have duplicate = Reserved/Reserved
					DisplayReserved($i, null, $indexOf, $result, '00',  '30'); //1st Row  //DisplayReserved($iterator,$nextIterator,$indexOf,$result,$minutesStart,$minutesEnd)
				       //second row
					$Next_indexOf = $indexOf + 1; //Take next row from Active Record result
					DisplayReserved($i, $t, $indexOf+1, $result, '30',  '00');  //2nd Row //Reserved second Row
				   }
				   
				   
				   
                if( $i!= $bIntervals[$Next_i] ){  //if DOES NOT have duplicate
				                if($result[$indexOf]->b_quarters == 0){ // if it is for 9.00-9.30 = Reserved/Free
								   
								   DisplayReserved($i,null,$indexOf,$result, '00',  '30'); //Reserved 1st Row
								       
									//second Free Row
								    DisplayFree($i,$t,"30","00");
								
								}// END if($result[$indexOf]->b_quarters==0)
								
								
								if($result[$indexOf]->b_quarters == 3){ // if it is for 9.30-10.00 = Free/Reserved
								    DisplayFree($i,null,"00","30");					
								       
									   //second Reserved
								   DisplayReserved($i,$t,$indexOf,$result, '30',  '00');  //2nd Row //Reserved second Row
								       
								}// END else if($result[$indexOf]->b_quarters==3){ // if it is for 9.30-10.00 = Free/Reserved
                 }	//end if( $bIntervals[$i]!=$bIntervals[$Next_i] ){  //if DOES NOT have duplicate
				
                
			  
			} else {  // End if(in_array($i, $bIntervals))  //if i does not exist in array (i.e it is FREE/FREE)
			      $tt=$i+1;	
				//
				
				//1st FREE ROW
                 DisplayFree($i, null, "00", "30");								   			
				 //second Fee Row
				 DisplayFree($i, $tt,"30","00");
		      } //End Else
			  
			  
			  
			  
			} //End for($i=9; $i<18; $i++)
	  // End Inject

	 
	 
	 
	 
	 
	 
	 
	 
	 
	 return $text;


	}
    
	// **                                                                                  **
    // **************************************************************************************
    // **************************************************************************************
	

}
