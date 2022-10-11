<?php

use yii\db\Migration;

/**
 * Class m221011_180834_create_table_tracks
 */
class m221011_180834_create_table_tracks extends Migration
{
    private const TABLE_NAME = 'tracks';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'load_date' => $this->timestamp()->notNull(),
            'track_date' => $this->dateTime()->notNull(),
            'name' => $this->string(255)->notNull(),
            'track_file' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221011_180834_create_table_tracks cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221011_180834_create_table_tracks cannot be reverted.\n";

        return false;
    }
    */
}
