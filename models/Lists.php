<?php

namespace app\models;

use yii;
use app\traits\AutocompleteTrait;

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
    use AutocompleteTrait;
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
            [['orders_id'], 'integer'],
            [['qty'], 'number'],
            [['materials_id'], 'validateMaterial'],
        ];
    }

    public  function  validateMaterial()
    {
        if (!array_key_exists((int)$this->materials_id, $this->partsAutocompleteList())){
            $this->addError('materials_id', Yii::t('app', 'Such material does not exist in the list'));
        }
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)){
            $this->materials_id = (int) $this->materials_id;
            return true;
        }else{
            return false;
        }
    }
}
