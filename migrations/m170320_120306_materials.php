<?php

use yii\db\Migration;

class m170320_120306_materials extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `coldendspares`.`materials` (
              `id` int(3) NOT NULL,
              `name` varchar(64) NOT NULL,
              `model_ref` varchar(40) DEFAULT NULL,
              `trade_mark` varchar(16) DEFAULT NULL,
              `manufacturer` varchar(32) DEFAULT NULL,
              `generic_usage` varchar(64) DEFAULT NULL,
              `function` varchar(64) NOT NULL,
              `sap` int(12) DEFAULT NULL,
              `type` varchar(16) DEFAULT NULL,
              `analog` int(3) DEFAULT NULL,
              `comment_1` varchar(64) DEFAULT NULL,
              `comment_2` text
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF  EXISTS `coldendspares`.`materials`;
            ");
        echo "m170320_120306_materials cannot be reverted.\n";
        return false;
    }
}
