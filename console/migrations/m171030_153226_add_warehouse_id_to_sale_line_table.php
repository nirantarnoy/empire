<?php

use yii\db\Migration;

/**
 * Class m171030_153226_add_warehouse_id_to_sale_line_table
 */
class m171030_153226_add_warehouse_id_to_sale_line_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('sale_line','warehouse_id',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('sale_line','warehouse_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171030_153226_add_warehouse_id_to_sale_line_table cannot be reverted.\n";

        return false;
    }
    */
}
