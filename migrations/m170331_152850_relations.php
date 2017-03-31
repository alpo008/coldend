<?php

use yii\db\Migration;

class m170331_152850_relations extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `coldendspares`.`relations` (
              `id` int(4) PRIMARY KEY NOT NULL UNIQUE AUTO_INCREMENT,
              `parent_id` int(4) DEFAULT NULL,
              `child_id` int(4) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF  EXISTS `coldendspares`.`relations`;
            ");
        echo "m170320_120306_relations cannot be reverted.\n";
        return false;
    }
}
