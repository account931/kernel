<?php

namespace app\models;
use app\models\Balance;
use Yii;

/**
 * This is the model class for table "transfer_rights".
 *
 * @property int $id
 * @property int $product_id
 * @property string $invoice_id
 * @property int $from_user_id
 * @property int $to_user_id
 * @property int $unix_time
 * @property string $date
 * @property int product_weight
 */
class TransferRights extends \yii\db\ActiveRecord
{
	
	public $user2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transfer_rights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'user2',  'product_id', 'invoice_id', 'from_user_id', 'to_user_id', 'unix_time', 'product_weight'], 'required'],
            [['product_id', 'from_user_id', 'to_user_id', 'unix_time'], 'integer'],
            [['date'], 'safe'],
            [['invoice_id'], 'string', 'max' => 77],
			['product_weight','validateWeight'], //my validation function validateWeight
			['to_user_id','validateNotSelfId'], //my validation function if user selects not himself
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Прoдукт'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'from_user_id' => Yii::t('app', 'From User ID'),
            'to_user_id' => Yii::t('app', 'To User ID'),
            'unix_time' => Yii::t('app', 'Unix Time'),
            'date' => Yii::t('app', 'Date'),
			'user2' => Yii::t('app', 'Переоформити на '),
        ];
    }
	
	
	  //hasOne relation
	  public function getProducts(){
          return $this->hasOne(ProductName::className(), ['pr_name_id' => 'product_id']); 
      }
	  
	  
	  //hasOne relation
	  public function getUsers(){
          return $this->hasOne(User::className(), ['id' => 'to_user_id']); 
      }
	
	//my validation, checks if user is not taking more than he has
	 public function validateWeight(){
		  $b = Balance::find()->where(['balance_user_id' => Yii::$app->user->identity->id])->andWhere(['balance_productName_id' => $this->product_id]) -> one();
		  if ($b->balance_amount_kg < $this->product_weight){
			  $this->addError('product_weight','Недостатньо на Вашому балансi. Доступно лише ' . $b->balance_amount_kg . ' кг.');
		  }
     }
	 
	 //my validation, checks if user selects not himself to transfer product rights
	 public function  validateNotSelfId(){
		  if ($this->to_user_id == Yii::$app->user->identity->id){
			  $this->addError('user2','Ви не можете обрати сам себе');
		  }
     }
	 
	
	 
}
