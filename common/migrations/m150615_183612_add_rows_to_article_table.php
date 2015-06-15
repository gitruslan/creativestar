<?php

use yii\db\Schema;
use yii\db\Migration;

class m150615_183612_add_rows_to_article_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->addColumn('{{%article}}','keywords','varchar(100) NULL DEFAULT NULL AFTER title');
        $this->addColumn('{{%article}}','description','varchar(250) NULL DEFAULT NULL AFTER keywords');

    }

    public function down()
    {
        echo "m150615_183612_add_rows_to_article_table cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
