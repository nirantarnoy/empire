<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m171117_034749_create_task_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'task_interval'=> $this->integer(),
            'task_start_date'=> $this->integer(),
            'task_next_date' => $this->integer(),
            'task_last_date' => $this->integer(),
            'emp_id' => $this->integer(),
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
        $this->dropTable('task');
    }
}
