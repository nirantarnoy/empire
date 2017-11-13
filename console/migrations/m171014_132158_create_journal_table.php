<?php

use yii\db\Migration;

/**
 * Handles the creation of table `journal`.
 */
class m171014_132158_create_journal_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('journal', [
            'id' => $this->primaryKey(),
            'journal_no'=>$this->string(),
            'transdate'=>$this->integer(),
            'trans_type_id'=>$this->integer(),
            'reference'=>$this->string(),
            'remark'=>$this->string(),
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
        $this->dropTable('journal');
    }
}
