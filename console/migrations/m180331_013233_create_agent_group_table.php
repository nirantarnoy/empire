<?php

use yii\db\Migration;

/**
 * Handles the creation of table `agent_group`.
 */
class m180331_013233_create_agent_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('agent_group', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'description'=> $this->string(),
            'group_rate'=>$this->float(),
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
        $this->dropTable('agent_group');
    }
}
