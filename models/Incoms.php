<?php

namespace app\models;

use Yii;

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
            [['materials_id', 'qty', 'came_from', 'came_to', 'responsible', 'trans_date'], 'required'],
            [['came_from', 'came_to'], 'integer'],
            [['qty'], 'number'],
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
            'materials_id' => Yii::t('app', 'Materials ID'),
            'qty' => Yii::t('app', 'Qty'),
            'came_from' => Yii::t('app', 'Came From'),
            'came_to' => Yii::t('app', 'Came To'),
            'responsible' => Yii::t('app', 'Responsible'),
            'trans_date' => Yii::t('app', 'Trans Date'),
            'ref_doc' => Yii::t('app', 'Ref Doc'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }
}
