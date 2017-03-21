<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use app\traits\AutocompleteTrait;


/**
 * This is the model class for table "usages".
 *
 * @property integer $id
 * @property integer $machines_id
 * @property integer $unit_id
 * @property integer $materials_id
 * @property integer $unit_qty
 */
class Usages extends ActiveRecord
{
    use AutocompleteTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit_id', 'materials_id', 'unit_qty'], 'required'],
            [['machines_id', 'unit_id', 'unit_qty'], 'integer'],
            [['materials_id', 'machines_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'machines_id' => Yii::t('app', 'Machines ID'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'materials_id' => Yii::t('app', 'Materials ID'),
            'unit_qty' => Yii::t('app', 'Unit Qty'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)){
            $this->materials_id = (int)$this->materials_id;
            return true;
        }else{
            return false;
        }
    }

    public function getMaterials()
    {
        return $this->hasOne(Materials::className(), ['id' => 'materials_id']);
    }

    public function getMachines()
    {
        return $this->hasOne(Machines::className(), ['id' => 'machines_id']);
    }
}
