<?php

use yii\db\Migration;

class m170421_120333_orders extends Migration
{
    public function safeUp()
    {
        $this->execute(" 
        CREATE TABLE `coldendspares`.`orders` (
          `id` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
          `ref_doc` varchar(16) DEFAULT NULL,
          `responsible` varchar(64) NOT NULL,
          `created` datetime NOT NULL,
          `updated` datetime NOT NULL,
          `status` int(1) NOT NULL DEFAULT '0',
          `comment` text NOT NULL )
         ENGINE=InnoDB DEFAULT CHARSET=utf8;
         ");
    }

    public function safeDown()
    {
        $this->execute("
        DROP TABLE IF  EXISTS `coldendspares`.`orders`;
        ");
        echo "m170421_120333_orders cannot be reverted.\n";

        return false;
    }
}
