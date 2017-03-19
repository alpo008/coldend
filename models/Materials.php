<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "materials".
 *
 * @property integer $id
 * @property string $name
 * @property string $model_ref
 * @property string $trade_mark
 * @property string $manufacturer
 * @property string $generic_usage
 * @property string $function
 * @property integer $sap
 * @property string $type
 * @property string $comment_1
 * @property string $comment_2
 */
class Materials extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'function'], 'required'],
            [['id', 'sap'], 'integer'],
            [['comment_2'], 'string'],
            [['name', 'generic_usage', 'function', 'comment_1'], 'string', 'max' => 64],
            [['model_ref'], 'string', 'max' => 40],
            [['trade_mark', 'type'], 'string', 'max' => 16],
            [['manufacturer'], 'string', 'max' => 32],
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
            'model_ref' => Yii::t('app', 'Model Ref'),
            'trade_mark' => Yii::t('app', 'Trade Mark'),
            'manufacturer' => Yii::t('app', 'Manufacturer'),
            'generic_usage' => Yii::t('app', 'Generic Usage'),
            'function' => Yii::t('app', 'Function'),
            'sap' => Yii::t('app', 'Sap'),
            'type' => Yii::t('app', 'Type'),
            'comment_1' => Yii::t('app', 'Comment 1'),
            'comment_2' => Yii::t('app', 'Comment 2'),
        ];
    }
}
