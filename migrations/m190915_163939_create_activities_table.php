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
            'startDay' => $this->datetime(),
            'endDay' => $this->datetime(),
            'body' => $this->text(),
            'repeat' => $this->boolean(),
            'main' => $this->boolean(),
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
