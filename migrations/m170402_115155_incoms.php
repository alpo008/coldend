<?php

use yii\db\Migration;

class m170402_115155_incoms extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `coldendspares`.`incoms` (
              `id` int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
              `materials_id` int(6) NOT NULL,
              `qty` decimal(10,0) NOT NULL,
              `came_from` int(2) NOT NULL,
              `came_to` int(2) NOT NULL,
              `responsible` varchar(64) NOT NULL,
              `trans_date` date NOT NULL,
              `ref_doc` varchar(16) DEFAULT NULL,
              `comment` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF  EXISTS `coldendspares`.`incoms`;
            ");
        echo "m170402_115155_incoms cannot be reverted.\n";
        return false;
    }
}
