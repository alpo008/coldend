<?php

namespace app\models;

use yii;
use app\traits\AutocompleteTrait;

/**
 * This is the model class for table "incoms".
 *
 * @property integer $id
 * @property integer $materials_id
 * @property string $qty
 * @property integer $came_from
 * @property integer $came_to
 * @property string $responsible
 * @property string $trans_date
 * @property string $ref_doc
 * @property string $comment
 */
class Incoms extends \yii\db\ActiveRecord
{
    use AutocompleteTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'incoms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qty', 'came_from', 'came_to', 'responsible', 'trans_date'], 'required'],
            [['came_from', 'came_to'], 'integer'],
            [['qty'], 'number', 'min' => 1],
            [['materials_id', 'trans_date'], 'safe'],
            [['comment'], 'string'],
            [['responsible'], 'string', 'max' => 64],
            [['ref_doc'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'materials_id' => Yii::t('app', 'Material description'),
            'qty' => Yii::t('app', 'Qty'),
            'came_from' => Yii::t('app', 'Came From'),
            'came_to' => Yii::t('app', 'Came To'),
            'responsible' => Yii::t('app', 'Responsible'),
            'trans_date' => Yii::t('app', 'Trans Date'),
            'ref_doc' => Yii::t('app', 'Ref Doc'),
            'comment' => Yii::t('app', 'Comments'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)){
            if($this->came_to == 1 && $this->came_from == 1){
                echo "<script>alert('Обратите внимание на поля ОТКУДА и КУДА!');</script>";
                return false;
            }
            $this->materials_id = (int) $this->materials_id;
            if (!array_key_exists($this->materials_id, $this->partsAutocompleteList())){
                echo "<script>alert('Такого материала не существует!');</script>";
                return false;
            }
            $result = true;

            if ($this->came_to == 1){
                if ($material = Materials::findOne(['id' => $this->materials_id])){
                    $material->at_stock += $this->qty;
                    $result = $material->save();
                }
            }
            if ($this->came_to == 0 && $this->came_from != 1){
                if ($material = Materials::findOne(['id' => $this->materials_id])){
                    $material->at_dept += $this->qty;
                    $result = $material->save();
                }
            }
            if ($this->came_from == 1){
                if ($material = Materials::findOne(['id' => $this->materials_id])){
                    if ($material->at_stock < $this->qty){
                        echo "<script>alert('На складе нет такого количества материала!');</script>";
                        return false;
                    }else{
                        if ($this->came_to == 0){
                            $material->at_dept += $this->qty;
                        }
                    $material->at_stock -= $this->qty;
                    $result = $material->save();
                    }
                }
            }
            return $result;
        }else{
            return false;
        }
    }

    public function beforeDelete()
    {
        $result = parent::beforeDelete();
        $this->materials_id = (int) $this->materials_id;
        if ($this->came_to == 1){
            if ($material = Materials::findOne(['id' => $this->materials_id])){
                $material->at_stock -= $this->qty;
                $result = $material->save();
            }
        }
        if ($this->came_to == 0){
            if ($material = Materials::findOne(['id' => $this->materials_id])){
                $material->at_dept -= $this->qty;
                $result = $material->save();
            }
        }
        if ($this->came_from == 1){
            if ($material = Materials::findOne(['id' => $this->materials_id])){
                $material->at_stock += $this->qty;
                $result = $material->save();
            }
        }
        return $result;
    }

    public function getMaterials()
    {
        return $this->hasOne(Materials::className(), ['id' => 'materials_id']);
    }

    /**
     * @return array
     */
    public  function fromDropdown (){
        return [
            0 => Yii::t('app', 'Supplier'),
            1 => Yii::t('app', 'Factory stock'),
            2 => Yii::t('app', 'Second hand'),
        ];
    }

    public  function toDropdown (){
        return [
            0 => Yii::t('app', 'Department'),
            1 => Yii::t('app', 'Factory stock'),
        ];
    }
}
