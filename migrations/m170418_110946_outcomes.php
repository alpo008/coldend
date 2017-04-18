<?php

use yii\db\Migration;

class m170418_110946_outcomes extends Migration
{
    public function safeUp()
    {
        $this->execute(" 
        CREATE TABLE `coldendspares`.`outcomes` (
          `id` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE ,
          `materials_id` int(6) NOT NULL,
          `qty` decimal(5,2) NOT NULL,
          `came_from` int(2) NOT NULL,
          `came_to` int(3) NOT NULL,
          `responsible` varchar(64) NOT NULL,
          `trans_date` date NOT NULL,
          `purpose` int(2) DEFAULT NULL,
          `comment` text NOT NULL )
         ENGINE=InnoDB DEFAULT CHARSET=utf8;
         ");
    }

    public function safeDown()
    {
        $this->execute("
        DROP TABLE IF  EXISTS `coldendspares`.`outcomes`;
        ");
        echo "m170418_110946_outcomes cannot be reverted.\n";

        return false;
    }
}
