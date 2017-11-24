<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_minstock`.
 */
class m171124_065140_create_product_minstock_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_minstock', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'warehouse_id'=> $this->integer(),
            'minstock' => $this->float(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_minstock');
    }
}
