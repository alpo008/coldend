<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use app\traits\AutocompleteTrait;
use app\traits\DateTrait;

/**
 * This is the model class for table "outcomes".
 *
 * @property integer $id
 * @property integer $materials_id
 * @property string $qty
 * @property integer $came_from
 * @property integer $came_to
 * @property integer $unit_id
 * @property string $responsible
 * @property string $trans_date
 * @property integer $purpose
 * @property string $comment
 */
class Outcomes extends ActiveRecord
{

    use AutocompleteTrait;
    use DateTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outcomes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qty', 'came_from', 'responsible', 'trans_date'], 'required'],
            [['came_from', 'purpose'], 'integer'],
            [['qty'], 'number', 'min' => 1],
            [['trans_date'], 'validateDate'],
            [['comment'], 'string'],
            [['responsible'], 'string', 'max' => 64],
            ['materials_id', 'validateMaterial'],
            ['came_to', 'validateCameTo'],
            ['qty', 'validateQty'],
        ];
    }

    public  function  validateMaterial()
    {
        if (!array_key_exists((int)$this->materials_id, $this->partsAutocompleteList())){
            $this->addError('materials_id', Yii::t('app', 'Such material does not exist in the list'));
        }

    }    
    
    public  function  validateCameTo()
    {
        if (!array_key_exists((int)$this->came_to, $this->machinesAutocompleteList())){
            $this->addError('came_to', Yii::t('app', 'Such machine does not exist in the list'));
        }

    }

    public  function  validateQty()
    {
        if ($this->isNewRecord){
            if ($this->materials){
                if ($this->came_from == 1 && $this->materials->at_stock < $this->qty){
                     $this->addError('qty', Yii::t('app', 'The stock rest is only') . ' ' . $this->materials->at_stock. ' ' . Yii::t('app', 'un.'));
                }elseif ($this->came_from == 0 && $this->materials->at_dept < $this->qty){
                    $this->addError('qty', Yii::t('app', 'The dept rest is only') . ' ' . $this->materials->at_dept. ' ' . Yii::t('app', 'un.'));
                }
            }else{
                $this->addError('materials_id', Yii::t('app', 'The material is not defined'));
            }
        }
    }

    public  function  validateDate()
    {
        $pattern1 = '/(19|20)\d\d-((0[1-9]|1[012])-(0[1-9]|[12]\d)|(0[13-9]|1[012])-30|(0[13578]|1[02])-31)/';
        $pattern2 = '/(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d/';
        if (!preg_match($pattern1, $this->trans_date) && !preg_match($pattern2, $this->trans_date)){
            $this->addError('trans_date', Yii::t('app', 'Date format is not acceptable'));
        }


    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'materials_id' => Yii::t('app', 'Material'),
            'qty' => Yii::t('app', 'Qty'),
            'came_from' => Yii::t('app', 'Taken From'),
            'came_to' => Yii::t('app', 'Used in machine'),
            'responsible' => Yii::t('app', 'Responsible'),
            'trans_date' => Yii::t('app', 'Trans Date'),
            'purpose' => Yii::t('app', 'Purpose'),
            'comment' => Yii::t('app', 'Comments'),
        ];
    }
    
    public function  beforeSave($insert)
    {
       if (parent::beforeSave($insert)){
           $this->materials_id = (int) $this->materials_id;
           $this->came_to = (int) $this->came_to;

           if ($this->isNewRecord){
               if ($this->came_from == 1){
                   if ($material = Materials::findOne(['id' => $this->materials_id])){
                       $material->at_stock -= $this->qty;
                       $material->save();
                   }
               }

               if ($this->came_from == 0){
                   if ($material = Materials::findOne(['id' => $this->materials_id])){
                       $material->at_dept -= $this->qty;
                       $material->save();
                   }
               }
           }
           $reformatDate = explode('.', $this->trans_date);
           $this->trans_date = implode('-', array_reverse($reformatDate));
           return true;
           }else{
           return false;
       }
    }

    public  function beforeDelete()
    {
        $laterEntries = self::getLaterEntries($this->id, $this->materials_id);
        if (parent::beforeDelete() && !$laterEntries){
            $this->materials_id = (int) $this->materials_id;

            if ($this->came_from == 1){
                if ($material = Materials::findOne(['id' => $this->materials_id])){
                    $material->at_stock += $this->qty;
                    $material->save();
                }
            }

            if ($this->came_from == 0){
                if ($material = Materials::findOne(['id' => $this->materials_id])){
                    $material->at_dept += $this->qty;
                    $material->save();
                }
            }

            return true;
        }else{
            return false;
        }
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasOne(Materials::className(), ['id' => 'materials_id']);
    }

    public static function getLaterEntries ($id, $material){
        return self::find()->where(['>', 'id', $id])->andWhere(['materials_id' => $material])->one();
    }

    /**
     * @return array
     */
    public  function fromDropdown ()
    {
        return [
            0 => Yii::t('app', 'Department'),
            1 => Yii::t('app', 'Factory stock'),
            2 => Yii::t('app', 'Second hand'),
        ];
    }

    /**
     * @return array$
     */
    public  function purposeDropdown ()
    {
        return [
            0 => Yii::t('app', 'Repair'),
            1 => Yii::t('app', 'Modification'),
            2 => Yii::t('app', 'Test'),
            3 => Yii::t('app', 'Other'),
        ];
    }
}
