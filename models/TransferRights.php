<?php

namespace app\models;

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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'from_user_id' => Yii::t('app', 'From User ID'),
            'to_user_id' => Yii::t('app', 'To User ID'),
            'unix_time' => Yii::t('app', 'Unix Time'),
            'date' => Yii::t('app', 'Date'),
			'user2' => Yii::t('app', 'Переоформити на '),
        ];
    }
}
