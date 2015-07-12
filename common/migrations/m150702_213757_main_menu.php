<?php

use yii\db\Schema;
use yii\db\Migration;

class m150702_213757_main_menu extends Migration
{
    public function up()
    {
        $this->insert('{{%widget_menu}}', [
            'key'=>'frontend-main-menu',
            'title'=>'Main menu',
            'items'=>json_encode([
                [
                    'multiLangLabel'=>['category'=>'frontend','message'=>'Home'],
                    'url'=>'/',
                    'options'=>['tag'=>'li'],
                    'template'=>'<a href="{url}">{label}</a>'
                ],
                [
                    'multiLangLabel'=>['category'=>'frontend','message'=>'Games'],
                    'url'=>'/games',
                    'options'=>['tag'=>'li'],
                    'template'=>'<a href="{url}">{label}</a>'
                ],
                [
                    'multiLangLabel'=>['category'=>'frontend','message'=>'About us'],
                    'url'=>'/about',
                    'options'=>['tag'=>'li'],
                    'template'=>'<a href="{url}">{label}</a>'
                ],
                [
                    'multiLangLabel'=>['category'=>'frontend','message'=>'Blog'],
                    'url'=>'/blog',
                    'options'=>['tag'=>'li'],
                    'template'=>'<a href="{url}">{label}</a>'
                ],
                [
                    'multiLangLabel'=>['category'=>'frontend','message'=>'Contact'],
                    'url'=>'/site/contact',
                    'options'=>['tag'=>'li'],
                    'template'=>'<a href="{url}">{label}</a>'
                ]

            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'status'=>\common\models\WidgetMenu::STATUS_ACTIVE
        ]);

    }

    public function down()
    {
        echo "m150702_213757_main_menu cannot be reverted.\n";

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
