<?php

namespace app\modules\models;

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
            'id' => Yii::t('app', 'ID'),
            'user_kontagent_id' => Yii::t('app', 'Kontragent ID'),
            'product_nomenklatura_id' => Yii::t('app', 'Nomenklatura ID'),
            'date' => Yii::t('app', 'Date'),
            'unix' => Yii::t('app', 'Unix'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'elevator_id' => Yii::t('app', 'Elevator ID'),
            'carrier' => Yii::t('app', 'Carrier'),
            'driver' => Yii::t('app', 'Driver'),
            'truck' => Yii::t('app', 'Truck'),
            'truck_weight_netto' => Yii::t('app', 'Truck Weight Netto'),
            'truck_weight_bruto' => Yii::t('app', 'Truck Weight Bruto'),
            'product_wight' => Yii::t('app', 'Product Wight'),
            'trash_content' => Yii::t('app', 'Trash Content'),
            'humidity' => Yii::t('app', 'Humidity'),
        ];
    }
}
