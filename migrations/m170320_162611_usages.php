<?php

use yii\db\Migration;

class m170320_162611_usages extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `coldendspares`.`usages` (
              `id` int(4) NOT NULL,
              `machines_id` int(3) NOT NULL,
              `unit_id` int(2) NOT NULL,
              `materials_id` int(3) NOT NULL,
              `unit_qty` int(3) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF  EXISTS `coldendspares`.`usages`;
            ");
        echo "m170320_120306_usages cannot be reverted.\n";
        return false;
    }
}
