<?php
/**
 * Created by PhpStorm.
 * User: alpo
 * Date: 21.03.17
 * Time: 16:34
 */

namespace app\traits;


use app\models\Materials;

trait AutocompleteTrait
{
    public function partsAutocompleteList(){
        $arr = Materials::find()
            ->select(['id as id', 'concat(id, "; " ,name, "; " ,model_ref, "; " ,sap) as value'])
            ->asArray()
            ->all();
        return array_column($arr, 'value', 'id');
    }

    public function analogsAutocompleteList($type){
        if (!!$type) {
            $arr = Materials::find()
                ->select(['id as id', 'concat(id, "; " ,name, "; " ,model_ref, "; " ,sap) as value'])
                ->where(['type' => $type])
                ->asArray()
                ->all();
        }else{
            $arr = Materials::find()
                ->select(['id as id', 'concat(id, "; " ,name, "; " ,model_ref, "; " ,sap) as value'])
                ->asArray()
                ->all();
        }
        return array_column($arr, 'value', 'id');
    }
}