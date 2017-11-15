<?php

use yii\db\Migration;

/**
 * Class m171114_155419_add_market_id_to_warehouse_table
 */
class m171114_155419_add_market_id_to_warehouse_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('warehouse','market_id',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('warehouse','market_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171114_155419_add_market_id_to_warehouse_table cannot be reverted.\n";

        return false;
    }
    */
}
