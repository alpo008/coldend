<?php
/**
 * Created by PhpStorm.
 * User: alpo
 * Date: 21.03.17
 * Time: 16:34
 */

namespace app\traits;


use app\models\Machines;
use app\models\Materials;

trait AutocompleteTrait
{
    /**
     * @return array
     */
    public function partsAutocompleteList()
    {
        $arr = Materials::find()
            ->select(['id as id', 'concat(id, "; " ,name, "; " ,model_ref, "; " ,sap) as value'])
            ->asArray()
            ->all();
        return array_column($arr, 'value', 'id');
    }

    /**
     * @param string $type
     * @return array
     */
    public function analogsAutocompleteList($type)
    {
        if (!!$type) {
            $arr = Materials::find()
                ->select(['id as id', 'concat(id, "; " ,name, "; " ,model_ref, "; " ,sap) as value'])
                ->where(['type' => $type])
                ->asArray()
                ->all();
            return array_column($arr, 'value', 'id');
        }else{
            return self::partsAutocompleteList();
        }

    }

    /**
     * @return array
     */
    public function machinesAutocompleteList()
    {
        $arr = Machines::find()
            ->select(['id as id', 'concat(id, "; " ,place, "; " ,name) as value'])
            ->asArray()
            ->all();
        return array_column($arr, 'value', 'id');
    }

    public function refreshAutocompleteField ($list, $attr)
    {
        if ($list == 'parts') {
            if (isset (self::partsAutocompleteList()[$this->{$attr}])) {
                return self::partsAutocompleteList()[$this->{$attr}];
            } elseif (!!$this->dirtyAttributes) {
                return ($this->dirtyAttributes[$attr]);
            }
        }
        if ($list == 'machines') {
            if (isset (self::machinesAutocompleteList()[$this->{$attr}])) {
                return self::machinesAutocompleteList()[$this->{$attr}];
            } elseif (!!$this->dirtyAttributes) {
                return ($this->dirtyAttributes[$attr]);
            }
        }
        return '';
    }
}