<?php

use yii\db\Migration;

/**
 * Handles the creation of table `agent`.
 */
class m180331_013247_create_agent_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('agent', [
            'id' => $this->primaryKey(),
            'agent_code'=> $this->string(),
            'name' => $this->string(),
            'agent_group'=>$this->integer(),
            'start_date'=>$this->integer(),
            'expire_date'=>$this->integer(),
            'score' => $this->float(),
            'amount' => $this->float(),
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
        $this->dropTable('agent');
    }
}
