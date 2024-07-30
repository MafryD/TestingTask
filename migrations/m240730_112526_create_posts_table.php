<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%posts}}`.
 */
class m240730_112526_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull(),
            'content'=>$this->string()->notNull(),
            'image'=>$this->string(),
            'author_id'=>$this->integer()->notNull(),
            'status'=>$this->integer()->notNull()->defaultValue(1),
            'create_at'=>$this->dateTime(),
        ]);

        $this->createIndex(
            'idx-posts-author_id',
            'posts',
            'author_id'
        );

        $this->addForeignKey(
            'fk-posts-author_id',
            'posts',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-posts-status_id',
            'posts',
            'status'
        );

        $this->addForeignKey(
            'fk-posts-status',
            'posts',
            'status',
            'status',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%posts}}');
    }
}
