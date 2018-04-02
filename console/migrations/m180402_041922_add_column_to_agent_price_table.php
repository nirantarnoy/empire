<?php

use yii\db\Migration;

/**
 * Class m180402_041922_add_column_to_agent_price_table
 */
class m180402_041922_add_column_to_agent_price_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('agent_price','agent_type',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('agent_price','agent_type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180402_041922_add_column_to_agent_price_table cannot be reverted.\n";

        return false;
    }
    */
}
