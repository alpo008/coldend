<?php

namespace app\models;

use yii;
use app\traits\AutocompleteTrait;
use yii\web\UploadedFile;

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
 * @property string $unit_13
 * @property string $unit_14
 * @property string $unit_15
 * @property string $unit_16
 * @property string $comment
 */
class Machines extends \yii\db\ActiveRecord
{
    use AutocompleteTrait;
    public $photofile;
    public $schemafile;
    public $m_name;

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
            [['status', 'name'], 'required'],
            [['id', 'status'], 'integer'],
            [['to_replace', 'to_order'], 'safe'],
            [['to_do', 'comment', 'm_name'], 'string'],
            [['name', 'place'], 'string', 'max' => 24],
            [['unit_01', 'unit_02', 'unit_03', 'unit_04', 'unit_05', 'unit_06', 'unit_07', 'unit_08', 'unit_09', 'unit_10', 'unit_11', 'unit_12', 'unit_13', 'unit_14', 'unit_15', 'unit_16'], 'string', 'max' => 32],
            [['photofile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg', 'maxSize' => 512*1024],
            [['schemafile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf', 'maxSize' => 4096*1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Machine name'),
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
            'unit_13' => Yii::t('app', 'Unit 13'),
            'unit_14' => Yii::t('app', 'Unit 14'),
            'unit_15' => Yii::t('app', 'Unit 15'),
            'unit_16' => Yii::t('app', 'Unit 16'),
            'comment' => Yii::t('app', 'Comments'),
            'photofile' => Yii::t('app', 'Upload jpeg image'),
            'schemafile' => Yii::t('app', 'Upload schema')
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)){
            $this->to_order = (int)$this->to_order;
            $this->to_replace = (int)$this->to_replace;
            return true;
        }else{
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        $imagesStoragePath = Yii::getAlias('@app/web/photos_/');
        $schemasStoragePath = Yii::getAlias('@app/web/schemas/');
        if ($this->photofile = UploadedFile::getInstance($this, 'photofile')){
            $this->photofile->saveAs($imagesStoragePath . $this->id . '.' . $this->photofile->extension);
        }
        if ($this->schemafile = UploadedFile::getInstance($this, 'schemafile')){
            $this->schemafile->saveAs($schemasStoragePath . $this->id . '.' . $this->schemafile->extension);
        }
        return true;
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()){
            Usages::deleteAll(['machines_id' => $this->id]);
            return true;
        }else{
            return false;
        }
    }

    public function getUsages()
    {
        return $this->hasMany(Usages::className(), ['machines_id' => 'id']);
    }
    
    public function getMaterials()
    {
        return $this->hasMany(Materials::className(), ['id' => 'materials_id'])
            ->via('usages');
    }

    /**
     * This function returns materials usage data related to unique unit on the unique machine identified by their id's 
     * @param integer $machine
     * @param integer $unit
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getUnitUsages($machine, $unit){
        return Usages::find()
            ->where(['machines_id' => $machine])
            ->andWhere(['unit_id' => $unit])
            ->joinWith('materials')
            ->asArray()
            ->all();
    }

    /**
     * @return array
     */
    public function statusNames(){
        return [
            0 => Yii::t('app', 'Not used, defective'),
            1 => Yii::t('app', 'Not used, working state'),
            2 => Yii::t('app', 'Does not work'),
            3 => Yii::t('app', 'Needs parts replacement'),
            4 => Yii::t('app', 'Needs small repair'),
            5 => Yii::t('app', 'Works normally'),
        ];
    }

    public static function getTasksLists()
    {
        $tasksList = array();
        $tasksList ['to_do'] = self::find()
            ->where(['<>', 'to_do', ''])
            ->all();
        $tasksList ['to_replace'] = self::find()
            ->select (['machines.id', 'machines.name', 'machines.place', 'materials.name AS m_name'])
            ->where(['<>', 'to_replace', ''])
            ->innerJoin('materials', 'materials.id = machines.to_replace')
            ->all();
        $tasksList ['to_order'] = self::find()
            ->select (['machines.id', 'machines.name', 'machines.place', 'materials.name AS m_name'])
            ->innerJoin('materials', 'materials.id = machines.to_order')
            ->where(['<>', 'to_order', ''])
            ->all();
        return $tasksList;
    }
}
