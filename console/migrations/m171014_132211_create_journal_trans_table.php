<?php

use yii\db\Migration;

/**
 * Handles the creation of table `journal_trans`.
 */
class m171014_132211_create_journal_trans_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('journal_trans', [
            'id' => $this->primaryKey(),
            'journal_id'=>$this->integer(),
            'product_id' => $this->integer(),
            'qty'=> $this->float(),
            'price'=> $this->float(),
            'total'=> $this->float(),
            'invent_type'=>$this->integer(),
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
        $this->dropTable('journal_trans');
    }
}
