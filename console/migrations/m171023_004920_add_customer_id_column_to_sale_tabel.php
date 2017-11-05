<?php

use yii\db\Migration;

/**
 * Class m171023_004920_add_customer_id_column_to_sale_tabel
 */
class m171023_004920_add_customer_id_column_to_sale_tabel extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('sale','customer_id',$this->integer());
        $this->addColumn('sale','discount',$this->float());
        $this->addColumn('sale','discount_per',$this->float());
        $this->addColumn('sale','sale_amount',$this->float());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->dropColumn('sale','customer_id');
       $this->dropColumn('sale','discount');
       $this->dropColumn('sale','discount_per');
       $this->dropColumn('sale','sale_amount');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171023_004920_add_customer_id_column_to_sale_tabel cannot be reverted.\n";

        return false;
    }
    */
}
