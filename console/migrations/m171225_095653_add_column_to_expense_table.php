<?php

use yii\db\Migration;

/**
 * Class m171225_095653_add_column_to_expense_table
 */
class m171225_095653_add_column_to_expense_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('expense','type_id',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('expense','type_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171225_095653_add_column_to_expense_table cannot be reverted.\n";

        return false;
    }
    */
}
