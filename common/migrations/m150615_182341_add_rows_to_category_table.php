<?php

use yii\db\Schema;
use yii\db\Migration;

class m150615_182341_add_rows_to_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->addColumn('{{%article_category}}','keywords','varchar(100) NULL DEFAULT NULL AFTER title');
        $this->addColumn('{{%article_category}}','description','varchar(250) NULL DEFAULT NULL AFTER keywords');
    }

    public function down()
    {
        echo "m150615_182341_add_rows_to_category_table cannot be reverted.\n";

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
