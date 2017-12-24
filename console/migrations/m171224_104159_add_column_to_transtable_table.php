<?php

use yii\db\Migration;

/**
 * Class m171224_104159_add_column_to_transaction_table
 */
class m171224_104159_add_column_to_transtable_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('transtable','sale_ref',$this->integer());
        $this->addColumn('transtable','purchase_ref',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('transtable','sale_ref');
        $this->dropColumn('transtable','purchase_ref');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171224_104159_add_column_to_transaction_table cannot be reverted.\n";

        return false;
    }
    */
}
