<?php

use yii\db\Migration;

/**
 * Handles adding warehouse_id to table `journal_trans`.
 */
class m171030_140107_add_warehouse_id_column_to_journal_trans_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('journal_trans','warehouse_id',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('journal_trans','warehouse_id');
    }
}
