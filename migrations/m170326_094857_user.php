<?php

use yii\db\Migration;

class m170326_094857_user extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `coldendspares`.`user` (
              `id` int(11) NOT NULL,
              `name` varchar(25) NOT NULL,
              `surname` varchar(35) NOT NULL,
              `email` varchar(50) NOT NULL,
              `password` varchar(256) NOT NULL,
              `role` varchar(30) NOT NULL,
              `created` date DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
      ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF  EXISTS `coldendspares`.`user`;
            ");
        echo "m170320_120306_user cannot be reverted.\n";
        return false;
    }
}
