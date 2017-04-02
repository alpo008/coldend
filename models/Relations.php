<?php

namespace app\models;

use yii;
use app\traits\AutocompleteTrait;

/**
 * This is the model class for table "relations".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $child_id
 * @property integer $partType
 */
class Relations extends \yii\db\ActiveRecord
{
    use AutocompleteTrait;
    public $partType;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'child_id'], 'safe'],
            [['partType'], 'string'],
            [['partType'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'child_id' => Yii::t('app', 'Child ID'),
            'partType' => Yii::t('app', 'Relation type')
        ];
    }
    
    public function beforeSave($insert)
    {
        $this->parent_id = (int) $this->parent_id;
        $this->child_id = (int) $this->child_id;
        return true;
    }

    public function partTypes (){
        return [
            'parent' => Yii::t('app', 'Parent ID'),
            'child' => Yii::t('app', 'Child ID'),
        ];
    }
}
