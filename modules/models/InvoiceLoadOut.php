<?php

namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "invoice_load_out".
 *
 * @property int $id
 * @property int $user_id
 * @property int $invoice_unique_id
 * @property int $product_id
 * @property int $product_wieght
 * @property int $user_date_unix
 * @property string $confirmed_by_admin
 * @property int $confirmed_date_unix
 * @property int $elevator_id
 * @property string $completed
 * @property int $completed_date_unix
 */
class InvoiceLoadOut extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_load_out';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'invoice_unique_id', 'product_id', 'product_wieght', 'user_date_unix'], 'required'], // 'confirmed_date_unix', 'elevator_id', 'completed_date_unix'
            [['user_id', 'invoice_unique_id', 'product_id', 'product_wieght', 'user_date_unix', 'confirmed_date_unix', 'elevator_id', 'completed_date_unix'], 'integer'],
            [['confirmed_by_admin', 'completed'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'invoice_unique_id' => Yii::t('app', 'Invoice Unique ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'product_wieght' => Yii::t('app', 'Product Wieght'),
            'user_date_unix' => Yii::t('app', 'User Date Unix'),
            'confirmed_by_admin' => Yii::t('app', 'Confirmed By Admin'),
            'confirmed_date_unix' => Yii::t('app', 'Confirmed Date Unix'),
            'elevator_id' => Yii::t('app', 'Elevator ID'),
            'completed' => Yii::t('app', 'Completed'),
            'completed_date_unix' => Yii::t('app', 'Completed Date Unix'),
        ];
    }
	
	
	
}
