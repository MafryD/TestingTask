<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m240728_113800_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'code'=>$this->string()->notNull()->unique(),
            'name'=>$this->string()->notNull(),
        ]);

        $this->insert('{{%status}}',
            [
                'code'=>'public',
                'name'=>'Опубликовано',
            ]
        );
        $this->insert('{{%status}}',
            [
                'code'=>'blocked',
                'name'=>'Заблокировано',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status}}');
    }
}
