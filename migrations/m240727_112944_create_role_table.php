<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role}}`.
 */
class m240727_112944_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%role}}', [
            'id' => $this->primaryKey(),
            'code'=>$this->string()->notNull()->unique(),
            'name'=>$this->string()->notNull(),
            
        ]);

        $this->insert('{{%role}}',
            [
                'code'=>'user',
                'name'=>'Пользователь',
            ]
        );
        $this->insert('{{%role}}',
            [
                'code'=>'admin',
                'name'=>'Администратор',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%role}}');
    }
}
