<?php

use yii\db\Migration;

/**
 * Handles the creation of table `customer`.
 */
class m171023_011905_create_customer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('customer', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'description'=>$this->string(),
            'customer_type' => $this->integer(),
            'mobile' => $this->string(),
            'phone' => $this->string(),
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
        $this->dropTable('customer');
    }
}
