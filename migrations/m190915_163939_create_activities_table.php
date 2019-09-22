<?php

use yii\db\Migration;


class m190915_163939_create_activities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activities_tbl', [
            'activity_id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'title' => $this->string()->notNull(),
            'start_day' => $this->integer(),
            'end_day' => $this->integer(),
            'body' => $this->text(),
            'repeat' => $this->boolean(),
            'main' => $this->boolean(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('activities_tbl');
    }
}
