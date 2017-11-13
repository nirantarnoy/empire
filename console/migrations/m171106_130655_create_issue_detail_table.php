<?php

use yii\db\Migration;

/**
 * Class m171106_130655_craete_issue_detail_table
 */
class m171106_130655_create_issue_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('issue_detail', [
            'id' => $this->primaryKey(),
            'issue_id' => $this->integer(),
            'product_id' => $this->integer(),
            'req_qty' => $this->integer(),
            'pre_qty' => $this->integer(),
            'issue_qty' => $this->integer(),
            'price' => $this->float(),
            'line_amount' => $this->float(),
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
        $this->dropTable('issue_detail');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171106_130655_craete_issue_detail_table cannot be reverted.\n";

        return false;
    }
    */
}
