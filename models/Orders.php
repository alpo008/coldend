<?php

namespace app\models;

use yii;
use app\traits\AutocompleteTrait;

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
    use AutocompleteTrait;
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
            [['responsible', 'created', 'updated'], 'required'],
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
            'responsible' => Yii::t('app', 'Created by'),
            'created' => Yii::t('app', 'Creation date'),
            'updated' => Yii::t('app', 'Updated'),
            'status' => Yii::t('app', 'Status'),
            'comment' => Yii::t('app', 'Comments'),
        ];
    }

    public function getLists()
    {
        return $this->hasMany(Lists::className(), ['orders_id' => 'id']);
    }

    public function getMaterials()
    {
        return $this->hasMany(Materials::className(), ['id' => 'materials_id'])
            ->via('lists');
    }
    
    public  function statusesDropdown ()
    {
        return [
            0 => Yii::t('app', 'Applied'),
            1 => Yii::t('app', 'Delayed'),
            2 => Yii::t('app', 'Confirmed'),
            3 => Yii::t('app', 'Paid'),
            4 => Yii::t('app', 'Completed'),
            5 => Yii::t('app', 'Cancelled'),
        ];
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()){
            Lists::deleteAll(['orders_id' => $this->id]);
            return true;
            }else{
            return false;
        }
    }
}
