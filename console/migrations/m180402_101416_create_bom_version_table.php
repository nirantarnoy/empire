<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bom_version`.
 */
class m180402_101416_create_bom_version_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('bom_version', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer(),
            'bom_name' => $this->string(),
            'description' => $this->string(),
            'cost'=> $this->float(),
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
        $this->dropTable('bom_version');
    }
}
