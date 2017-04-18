<?php

namespace app\models;

use Yii;

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
class Outcomes extends \yii\db\ActiveRecord
{
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
            [['materials_id', 'qty', 'came_from', 'came_to', 'unit_id', 'responsible', 'trans_date', 'comment'], 'required'],
            [['materials_id', 'came_from', 'came_to', 'unit_id', 'purpose'], 'integer'],
            [['qty'], 'number'],
            [['trans_date'], 'safe'],
            [['comment'], 'string'],
            [['responsible'], 'string', 'max' => 64],
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
            'qty' => Yii::t('app', 'Qty'),
            'came_from' => Yii::t('app', 'Came From'),
            'came_to' => Yii::t('app', 'Came To'),
            'unit_id' => Yii::t('app', 'Unit ID'),
            'responsible' => Yii::t('app', 'Responsible'),
            'trans_date' => Yii::t('app', 'Trans Date'),
            'purpose' => Yii::t('app', 'Purpose'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }
}
