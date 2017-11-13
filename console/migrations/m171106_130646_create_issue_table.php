<?php

use yii\db\Migration;

/**
 * Class m171106_130646_craete_issue_table
 */
class m171106_130646_create_issue_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('issue_table', [
            'id' => $this->primaryKey(),
            'issue_no' => $this->string(),
            'request_by' => $this->integer(),
            'require_date' => $this->integer(),
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
        $this->dropTable('issue_table');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171106_130646_craete_issue_table cannot be reverted.\n";

        return false;
    }
    */
}
