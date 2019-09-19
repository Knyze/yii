<?php

use yii\db\Migration;


class m190915_181248_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users_tbl', [
            'user_id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'access_token' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        
        $this->addForeignKey('activities_fk1', 'activities_tbl', 'user_id', 'users_tbl', 'user_id', 'NO ACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('activities_fk1', 'activities_tbl');
        $this->dropTable('users_tbl');
    }
}
