<?php

use yii\db\Migration;

/**
 * Handles the creation of table `calendar_event`.
 */
class m171020_071657_create_calendar_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('calendar_event', [
            'id' => $this->primaryKey(),
            'event_id'=>$this->integer(),
            'title'=>$this->string(),
            'description'=>$this->string(),
            'start_date'=>$this->integer(),
            'end_date'=>$this->integer(),
            'note'=>$this->string(),
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
        $this->dropTable('calendar_event');
    }
}
