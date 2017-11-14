<?php

use yii\db\Migration;

/**
 * Handles the creation of table `market`.
 */
class m171114_081459_create_market_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('market', [
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
        $this->dropTable('market');
    }
}
