<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 17.06.17
 * Time: 15:13
 */

namespace app\traits;


use yii;

trait DateTrait
{
    /**
     * @param $date string
     * @return $resultDate string
     */
    public function dateToRus ($date){
        $pattern = '/(19|20)\d\d-((0[1-9]|1[012])-(0[1-9]|[12]\d)|(0[13-9]|1[012])-30|(0[13578]|1[02])-31)/';
        if (preg_match($pattern, $date)){
            $reformatDate = explode('-', $date);
            $resultDate = implode('.', array_reverse($reformatDate));
        }else{
            $resultDate = date('d.m.Y');
        }
        return $resultDate;
    }

    /**
     * @param $date string
     * @return $resultDate string
     */
    public function dateToFra ($date){
        $pattern = '/(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d/';
        if (preg_match($pattern, $date)){
            $reformatDate = explode('.', $date);
            $resultDate = implode('-', array_reverse($reformatDate));
        }else{
            $resultDate = date('Y-m-d');
        }
        return $resultDate;
    }

    /**
     * @param $datetime string
     * @return $resultDatetime string
     */
    public function datetimeToRus ($datetime){
        $pattern = '/(19|20)\d\d-((0[1-9]|1[012])-(0[1-9]|[12]\d)|(0[13-9]|1[012])-30|(0[13578]|1[02])-31)/';
        $datetimeArray = explode(' ', $datetime);
        if (preg_match($pattern, $datetimeArray[0])) {
            $reformatDate = explode('-', $datetimeArray[0]);
            $resultDate = implode('.', array_reverse($reformatDate));
        }else{
            $resultDate = date('d.m.Y');
        }
        $resultDatetime = $resultDate . ' ' . $datetimeArray[1];
        return $resultDatetime;
    }
}