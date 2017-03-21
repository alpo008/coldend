<?php

namespace app\models;

use yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use app\traits\AutocompleteTrait;

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
 * @property integer $analog
 * @property integer $minqty
 * @property string $comment_1
 * @property string $comment_2
 */
class Materials extends ActiveRecord
{
    use AutocompleteTrait;

    public $imagefile;
    public $docfile;
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
            [['name'], 'required'],
            [['id', 'sap', 'minqty'], 'integer'],
            [['function', 'comment_2'], 'string'],
            [['name', 'generic_usage', 'function', 'comment_1'], 'string', 'max' => 64],
            [['model_ref'], 'string', 'max' => 40],
            [['trade_mark', 'type'], 'string', 'max' => 16],
            [['analog'], 'safe'],
            [['manufacturer'], 'string', 'max' => 32],
            [['imagefile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg', 'maxSize' => 128*1024],
            [['docfile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => 1024*1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Material description'),
            'model_ref' => Yii::t('app', 'Suppliers Ref'),
            'trade_mark' => Yii::t('app', 'Trade Mark'),
            'manufacturer' => Yii::t('app', 'Manufacturer'),
            'generic_usage' => Yii::t('app', 'Generic Usage'),
            'function' => Yii::t('app', 'Function'),
            'sap' => Yii::t('app', 'Sap'),
            'type' => Yii::t('app', 'Type'),
            'analog' => Yii::t('app', 'Analog'),
            'minqty' => Yii::t('app', 'Minimal qty'),
            'comment_1' => Yii::t('app', 'Comment 1'),
            'comment_2' => Yii::t('app', 'Comment 2'),
            'imagefile' => Yii::t('app', 'Upload jpeg image'),
            'docfile' => Yii::t('app', 'Upload datasheet')
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)){
            $this->analog = (int)$this->analog;
            return true;
        }else{
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        $imagesStoragePath = Yii::getAlias('@app/web/photos/');
        $docsStoragePath = Yii::getAlias('@app/web/docs/');
        if ($this->imagefile = UploadedFile::getInstance($this, 'imagefile')){
            $this->imagefile->saveAs($imagesStoragePath . $this->id . '.' . $this->imagefile->extension);
        }
        if ($this->docfile = UploadedFile::getInstance($this, 'docfile')){
            $this->docfile->saveAs($docsStoragePath . $this->id . '.' . $this->docfile->extension);
        }
            return true;
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()){
            Usages::deleteAll(['materials_id' => $this->id]);
            return true;
        }else{
            return false;
        }
    }

    public function getUsages()
    {
        return $this->hasMany(Usages::className(), ['materials_id' => 'id']);
    }

    public function getMachines()
    {
        return $this->hasMany(Machines::className(), ['id' => 'machines_id'])
            ->via('usages');
    }
}
