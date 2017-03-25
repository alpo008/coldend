<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "mattypes".
 *
 * @property integer $id
 * @property string $type_name
 */
class Mattypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mattypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_name'], 'required'],
            [['id'], 'integer'],
            [['type_name'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_name' => Yii::t('app', 'Type Name'),
        ];
    }
}
