<?php

use yii\db\Migration;

class m170320_162116_machines extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `coldendspares`.`machines` (
              `id` int(3) NOT NULL,
              `name` varchar(24) DEFAULT NULL,
              `place` varchar(24) DEFAULT NULL,
              `status` int(1) NOT NULL,
              `to_do` text,
              `to_replace` int(3) DEFAULT NULL,
              `to_order` int(3) DEFAULT NULL,
              `unit_01` varchar(32) DEFAULT NULL,
              `unit_02` varchar(32) DEFAULT NULL,
              `unit_03` varchar(32) DEFAULT NULL,
              `unit_04` varchar(32) DEFAULT NULL,
              `unit_05` varchar(32) DEFAULT NULL,
              `unit_06` varchar(32) DEFAULT NULL,
              `unit_07` varchar(32) DEFAULT NULL,
              `unit_08` varchar(32) DEFAULT NULL,
              `unit_09` varchar(32) DEFAULT NULL,
              `unit_10` varchar(32) DEFAULT NULL,
              `unit_11` varchar(32) DEFAULT NULL,
              `unit_12` varchar(32) DEFAULT NULL,
              `unit_13` varchar(32) DEFAULT NULL,
              `unit_14` varchar(32) DEFAULT NULL,
              `unit_15` varchar(32) DEFAULT NULL,
              `unit_16` varchar(32) DEFAULT NULL,
              `comment` text
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF  EXISTS `coldendspares`.`machines`;
            ");
        echo "m170320_120306_machines cannot be reverted.\n";
        return false;
    }
}
