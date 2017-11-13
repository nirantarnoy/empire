<?php

use yii\db\Migration;

/**
 * Handles the creation of table `activity`.
 */
class m171014_132953_create_activity_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('activity', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'description'=>$this->string(),
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
        $this->dropTable('activity');
    }
}
