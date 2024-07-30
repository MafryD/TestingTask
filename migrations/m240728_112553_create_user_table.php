<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m240728_112553_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username'=>$this->string()->notNull()->unique(),
            'password'=>$this->string()->notNull(),
            'role_id'=>$this->integer()->defaultValue(1),
        ]);

        $this->createIndex(
            'idx-user-role_id',
            'user',
            'role_id'
        );

        $this->addForeignKey(
            'fk-user-role_id',
            'user',
            'role_id',
            'role',
            'id',
            'CASCADE'
        );
        //добавляем запись
        $this->insert('{{%user}}',
            [
                'username'=>'username',
                'password'=>md5('password'),
                'role_id'=>2,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
