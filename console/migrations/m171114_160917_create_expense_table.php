<?php

use yii\db\Migration;

/**
 * Handles the creation of table `expense`.
 */
class m171114_160917_create_expense_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('expense', [
            'id' => $this->primaryKey(),
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
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
        $this->dropTable('expense');
    }
}
