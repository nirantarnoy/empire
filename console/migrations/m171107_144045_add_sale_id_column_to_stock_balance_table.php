<?php

use yii\db\Migration;

/**
 * Handles adding sale_id to table `stock_balance`.
 */
class m171107_144045_add_sale_id_column_to_stock_balance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('stockbalance','sale_id',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('stockbalance','sale_id');
    }
}
