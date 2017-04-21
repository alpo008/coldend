<?php

use yii\db\Migration;

class m170421_142648_lists extends Migration
{
    public function safeUp()
    {
        $this->execute(" 
        CREATE TABLE `coldendspares`.`lists` (
          `id` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
          `materials_id` int(6) NOT NULL,
          `orders_id` int(6) NOT NULL,
          `qty` decimal(5,2) DEFAULT '0.00'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    public function safeDown()
    {
        $this->execute("
        DROP TABLE IF  EXISTS `coldendspares`.`lists`;
        ");
        echo "m170421_142648_lists cannot be reverted.\n";

        return false;
    }
}
