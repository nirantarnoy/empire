<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bom_line`.
 */
class m180402_101436_create_bom_line_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('bom_line', [
            'id' => $this->primaryKey(),
            'bom_id'=> $this->integer(),
            'product_id' => $this->integer(),
            'qty'=>$this->float(),
            'price'=> $this->float(),
            'total'=> $this->float(),
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
        $this->dropTable('bom_line');
    }
}
