<?php

use yii\db\Schema;
use yii\db\Migration;

class m150729_193303_carousel_item_images extends Migration
{
    public function up()
    {
        $this->createTable('{{%widget_carousel_item_images}}', [
            'id' => Schema::TYPE_PK,
            'item_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'path' => Schema::TYPE_STRING . ' NOT NULL',
            'base_url' => Schema::TYPE_STRING,
            'type' => Schema::TYPE_STRING,
            'name' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER
        ]);
        $this->addForeignKey(
            'fk_w_item_images',
            '{{%widget_carousel_item_images}}',
            'item_id',
            '{{%widget_carousel_item}}',
            'id',
            'cascade',
            'cascade'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk_w_item_images',
            '{{%widget_carousel_item_images}}'
        );

        $this->dropTable('{{%widget_carousel_item_images}}');
    }
}
