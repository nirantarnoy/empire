<?php

use yii\db\Migration;

/**
 * Handles the creation of table `agent_price`.
 */
class m180331_013710_create_agent_price_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('agent_price', [
            'id' => $this->primaryKey(),
            'agent_id'=> $this->integer(),
            'product_id'=> $this->integer(),
            'min'=> $this->float(),
            'max'=> $this->float(),
            'price'=> $this->float(),
            'promotion_start_date'=> $this->float(),
            'promotion_expire_date'=> $this->float(),
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
    public function safeDown()
    {
        $this->dropTable('agent_price');
    }
}
