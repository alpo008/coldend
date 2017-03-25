<?php

use yii\db\Migration;

class m170325_132415_mattypes extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `coldendspares`.`mattypes` (
              `id` int(3) NOT NULL,
              `type_name` varchar(16) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF  EXISTS `coldendspares`.`mattypes`;
            ");
        echo "m170320_120306_mattypes cannot be reverted.\n";
        return false;
    }
}
