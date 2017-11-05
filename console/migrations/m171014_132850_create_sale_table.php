<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sale`.
 */
class m171014_132850_create_sale_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sale', [
            'id' => $this->primaryKey(),
            'sale_no'=>$this->string(),
            'sale_date'=>$this->integer(),
            'payment_type'=>$this->integer(),
            'require_ship_date'=>$this->integer(),
            'note'=>$this->string(),
            'payment_status'=>$this->integer(),
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
        $this->dropTable('sale');
    }
}
