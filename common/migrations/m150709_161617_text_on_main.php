<?php

use yii\db\Schema;
use yii\db\Migration;

class m150709_161617_text_on_main extends Migration
{
    public function up()
    {
        $this->insert('{{%widget_text}}', [
            'key'=>'main-page-text',
            'title'=>'Text on main page',
            'body'=>'<p>Не следует, однако забывать, что постоянный количественный рост и сфера нашей активности позволяет
                        выполнять важные задания по разработке существенных финансовых и административных условий.
                        Таким образом дальнейшее развитие различных форм деятельности требуют от нас анализа позиций,
                        занимаемых участниками в отношении поставленных задач. Не следует, однако забывать,
                        что укрепление и развитие структуры позволяет оценить значение систем массового участия.
                        Товарищи! реализация намеченных плановых заданий требуют определения и уточнения
                        существенных финансовых и административных условий.</p>',
            'status'=>1,
            'created_at'=> time(),
            'updated_at'=> time(),
        ]);
    }

    public function down()
    {
        echo "m150709_161617_text_on_main cannot be reverted.\n";

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
