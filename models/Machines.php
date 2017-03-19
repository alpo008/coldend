<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "machines".
 *
 * @property integer $id
 * @property string $name
 * @property string $place
 * @property integer $status
 * @property string $to_do
 * @property integer $to_replace
 * @property integer $to_order
 * @property string $unit_01
 * @property string $unit_02
 * @property string $unit_03
 * @property string $unit_04
 * @property string $unit_05
 * @property string $unit_06
 * @property string $unit_07
 * @property string $unit_08
 * @property string $unit_09
 * @property string $unit_10
 * @property string $unit_11
 * @property string $unit_12
 * @property string $comment
 */
class Machines extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'machines';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status', 'to_replace', 'to_order'], 'integer'],
            [['to_do', 'comment'], 'string'],
            [['name', 'place'], 'string', 'max' => 24],
            [['unit_01', 'unit_02', 'unit_03', 'unit_04', 'unit_05', 'unit_06', 'unit_07', 'unit_08', 'unit_09', 'unit_10', 'unit_11', 'unit_12'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'place' => Yii::t('app', 'Place'),
            'status' => Yii::t('app', 'Status'),
            'to_do' => Yii::t('app', 'To Do'),
            'to_replace' => Yii::t('app', 'To Replace'),
            'to_order' => Yii::t('app', 'To Order'),
            'unit_01' => Yii::t('app', 'Unit 01'),
            'unit_02' => Yii::t('app', 'Unit 02'),
            'unit_03' => Yii::t('app', 'Unit 03'),
            'unit_04' => Yii::t('app', 'Unit 04'),
            'unit_05' => Yii::t('app', 'Unit 05'),
            'unit_06' => Yii::t('app', 'Unit 06'),
            'unit_07' => Yii::t('app', 'Unit 07'),
            'unit_08' => Yii::t('app', 'Unit 08'),
            'unit_09' => Yii::t('app', 'Unit 09'),
            'unit_10' => Yii::t('app', 'Unit 10'),
            'unit_11' => Yii::t('app', 'Unit 11'),
            'unit_12' => Yii::t('app', 'Unit 12'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }
}
