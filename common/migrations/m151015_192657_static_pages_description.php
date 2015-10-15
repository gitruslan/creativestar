<?php

use yii\db\Schema;
use yii\db\Migration;

class m151015_192657_static_pages_description extends Migration
{
    public function up()
    {
        $this->addColumn('{{%page}}','keywords','varchar(100) NULL DEFAULT NULL AFTER title');
        $this->addColumn('{{%page}}','description','varchar(250) NULL DEFAULT NULL AFTER keywords');
    }

    public function down()
    {
        $this->dropColumn('{{%page}}','keywords');
        $this->dropColumn('{{%page}}','description');
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
