<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $ref_doc
 * @property string $responsible
 * @property string $created
 * @property string $updated
 * @property integer $status
 * @property string $comment
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['responsible', 'created', 'updated', 'comment'], 'required'],
            [['created', 'updated'], 'safe'],
            [['status'], 'integer'],
            [['comment'], 'string'],
            [['ref_doc'], 'string', 'max' => 16],
            [['responsible'], 'string', 'max' => 64],
            [['ref_doc'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ref_doc' => Yii::t('app', 'Ref Doc'),
            'responsible' => Yii::t('app', 'Responsible'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'status' => Yii::t('app', 'Status'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }
}
