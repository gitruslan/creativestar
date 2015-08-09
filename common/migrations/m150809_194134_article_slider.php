<?php

use yii\db\Schema;
use yii\db\Migration;

class m150809_194134_article_slider extends Migration
{
    public function up()
    {
        $this->createTable('{{%article_slider}}', [
            'id' => Schema::TYPE_PK,
            'article_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'path' => Schema::TYPE_STRING . ' NOT NULL',
            'base_url' => Schema::TYPE_STRING,
            'type' => Schema::TYPE_STRING,
            'size' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER
        ]);
        $this->addForeignKey(
            'fk_article_slider_article',
            '{{%article_slider}}',
            'article_id',
            '{{%article}}',
            'id',
            'cascade',
            'cascade'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk_article_slider_article',
            '{{%article_slider}}'
        );

        $this->dropTable('{{%article_slider}}');
    }

}
