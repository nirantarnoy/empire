<?php

use yii\db\Migration;

/**
 * Class m171112_061856_add_column_to_menu_table
 */
class m171112_061856_add_column_to_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('menu','parent_id',$this->integer());
        $this->addColumn('menu','line_number',$this->integer());
        $this->addColumn('menu','icon',$this->string());
        $this->addColumn('menu','controller',$this->string());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('menu','parent_id');
        $this->dropColumn('menu','line_number');
        $this->dropColumn('menu','icon');
        $this->dropColumn('menu','controller');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171112_061856_add_column_to_menu_table cannot be reverted.\n";

        return false;
    }
    */
}
