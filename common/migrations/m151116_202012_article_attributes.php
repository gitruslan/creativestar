<?php

use yii\db\Schema;
use yii\db\Migration;

class m151116_202012_article_attributes extends Migration
{
    public function up()
    {
        $this->createTable('{{%article_attributes}}', [
            'id' => Schema::TYPE_PK,
            'article_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'tag' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING,
            'value' => Schema::TYPE_STRING,
        ]);
        $this->addForeignKey(
            'fk_article_attributes_article',
            '{{%article_attributes}}',
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
            'fk_article_attributes_article',
            '{{%article_attributes}}'
        );

        $this->dropTable('{{%article_attributes}}');
    }
}
