<?php

use yii\db\Migration;

/**
 * Handles the creation of table `issue_approve`.
 */
class m171114_051021_create_issue_approve_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('issue_approve', [
            'id' => $this->primaryKey(),
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
        $this->dropTable('issue_approve');
    }
}
