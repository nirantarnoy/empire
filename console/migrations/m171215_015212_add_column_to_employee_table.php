<?php

use yii\db\Migration;

/**
 * Class m171215_015212_add_column_to_employee_table
 */
class m171215_015212_add_column_to_employee_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('employee','market_id',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->dropColumn('employee','marget_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171215_015212_add_column_to_employee_table cannot be reverted.\n";

        return false;
    }
    */
}
