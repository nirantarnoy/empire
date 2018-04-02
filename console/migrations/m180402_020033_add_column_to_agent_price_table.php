<?php

use yii\db\Migration;

/**
 * Class m180402_020033_add_column_to_agent_price_table
 */
class m180402_020033_add_column_to_agent_price_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('agent_price','agent_id_list',$this->string());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->dropColumn('agent_price','agent_id_list');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180402_020033_add_column_to_agent_price_table cannot be reverted.\n";

        return false;
    }
    */
}
