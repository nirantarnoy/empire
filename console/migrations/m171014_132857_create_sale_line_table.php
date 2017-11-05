<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sale_line`.
 */
class m171014_132857_create_sale_line_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sale_line', [
            'id' => $this->primaryKey(),
            'sale_id'=>$this->integer(),
            'product_id'=>$this->integer(),
            'qty'=>$this->float(),
            'price'=>$this->float(),
            'disc_amount'=>$this->float(),
            'disc_per'=>$this->float(),
            'line_amount'=>$this->float(),
            'note'=>$this->string(),
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
        $this->dropTable('sale_line');
    }
}
