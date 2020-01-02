<?php
//User ++ operations
namespace app\modules\models;
use app\models\Balance;
use app\models\ProductName;
use app\models\User;
use app\modules\models\Messages;
use Yii;

/**
 * This is the model class for table "invoice_load_in".
 *
 * @property int $id
 * @property int $user_kontagent_id
 * @property int $product_nomenklatura_id
 * @property string $date
 * @property int $unix
 * @property string $invoice_id
 * @property int $elevator_id
 * @property string $carrier
 * @property string $driver
 * @property string $truck
 * @property int $truck_weight_netto
 * @property int $truck_weight_bruto
 * @property int $product_wight
 * @property int $trash_content
 * @property int $humidity
 */
class InvoiceLoadIn extends \yii\db\ActiveRecord
{
	public $user_name; //not involved in form saving, just to get value (Id of user) from autocmplete and set it to {user_kontagent_id}
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_load_in';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_kontagent_id', 'product_nomenklatura_id', 'unix', 'invoice_id', 'elevator_id', 'carrier', 'driver', 'truck', 'truck_weight_netto', 'truck_weight_bruto', 'product_wight', 'trash_content', 'humidity'], 'required'],
            [['user_kontagent_id', 'product_nomenklatura_id', 'unix', 'elevator_id', 'truck_weight_netto', 'truck_weight_bruto', 'product_wight', 'trash_content', 'humidity'], 'integer'],
            [['date'], 'safe'],
            [['invoice_id', 'carrier', 'driver', 'truck'], 'string', 'max' => 77],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
		    'user_name' => Yii::t('app', 'Контрагент'), //not involved in form saving, just to get value (Id of user) from autocmplete and set it to {user_kontagent_id}
            'id' => Yii::t('app', 'ID'),
            'user_kontagent_id' => Yii::t('app', 'Contragent User ID (hidden input)'),
            'product_nomenklatura_id' => Yii::t('app', 'Номенклатура'),
            'date' => Yii::t('app', 'Date'),
            'unix' => Yii::t('app', 'Unix time_'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'elevator_id' => Yii::t('app', 'Elevator ID'),
            'carrier' => Yii::t('app', 'Carrier___'),
            'driver' => Yii::t('app', 'Driver'),
            'truck' => Yii::t('app', 'Truck'),
            'truck_weight_netto' => Yii::t('app', 'TruckNetto'),
            'truck_weight_bruto' => Yii::t('app', 'TruckBruto'),
            'product_wight' => Yii::t('app', 'Product Wight'),
            'trash_content' => Yii::t('app', 'Trash %__'),
            'humidity' => Yii::t('app', 'Humidity'),
        ];
    }
	
	  //hasOne relation
	  public function getUsers(){
          return $this->hasOne(User::className(), ['id' => 'user_kontagent_id']); 
      }
	  
	   //hasOne relation
	  public function getProducts(){
          return $this->hasOne(ProductName::className(), ['pr_name_id' => 'product_nomenklatura_id']); 
      }
	  
	  
	  //Check User balance (if user has relvant product balance in DB Balance, i.e product !=0)
	  public function checkBalance(){
		  $userBalance = Balance::find()->where(['balance_user_id' => $this->user_kontagent_id])->andWhere(['balance_productName_id' => $this->product_nomenklatura_id])->one();
		  return $userBalance;
			  
	  }
	 
    //adds and updates with new weigth	 
	public function balanceAdd($res){
		$prev = $res->balance_amount_kg;
		$new = $prev + $this->product_wight;
		$res->balance_amount_kg = $new;
		$res->balance_last_edit = date('Y-m-d H:i:s'); //update time
		$res->save();
		
	}		

	//saves new row with product and weigth	  
	public function addNewProduct(){
		$m = new Balance();
		$m->balance_productName_id = $this->product_nomenklatura_id; //user id
		$m->balance_user_id = $this->user_kontagent_id; //product id
		$m->balance_amount_kg = $this->product_wight; //product weight
		$m->save();
	}
	
	//notify the user-> send the message
	public function  sendMessage(){
		$model = new Messages();
		$model->m_sender_id = Yii::$app->user->identity->id;
		$model->m_receiver_id = $this->user_kontagent_id;
		$model->m_text = "<p>Dear user <b>". $this->users->first_name . "</b></p>" .//hasOne relation (gets username by ID)
		                "<p>You received new amount of " . $this->products->pr_name_name . //hasOne relation(gets product name by ID)
						" " .$this->product_wight . "кг.</p>" .   //weight
						"<p> Invoice number is " . $this->invoice_id . ".</p>" .
						"<p>Best regards, Admin team. </p>";  
		$model->m_unix = time();
		$model->save();
	}
	  
}
