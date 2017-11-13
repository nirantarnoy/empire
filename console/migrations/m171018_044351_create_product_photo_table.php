<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_photo`.
 */
class m171018_044351_create_product_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_photo', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer(),
            'image'=>$this->string(),
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
        $this->dropTable('product_photo');
    }
}
