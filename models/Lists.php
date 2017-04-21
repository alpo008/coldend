<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lists".
 *
 * @property integer $id
 * @property integer $materials_id
 * @property integer $orders_id
 * @property string $qty
 */
class Lists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['materials_id', 'orders_id'], 'required'],
            [['materials_id', 'orders_id'], 'integer'],
            [['qty'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'materials_id' => Yii::t('app', 'Materials ID'),
            'orders_id' => Yii::t('app', 'Orders ID'),
            'qty' => Yii::t('app', 'Qty'),
        ];
    }
}
