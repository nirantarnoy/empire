<?php

use yii\db\Migration;

/**
 * Class m180403_025428_add_column_to_bom_line_table
 */
class m180403_025428_add_column_to_bom_line_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('bom_line','parent_id',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->dropColumn('bom_line','parent_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180403_025428_add_column_to_bom_line_table cannot be reverted.\n";

        return false;
    }
    */
}
