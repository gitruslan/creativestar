<?php

use yii\db\Schema;
use yii\db\Migration;

class m150622_211841_category_lang_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%article_category}}','lang_id','TINYINT NOT NULL DEFAULT 1 AFTER title');

    }

    public function down()
    {
        $this->dropColumn('{{%article_category}}','lang_id');

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
