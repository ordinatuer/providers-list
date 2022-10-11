<?php

use yii\db\Migration;

/**
 * Class m221011_180820_create_table_points
 */
class m221011_180820_create_table_points extends Migration
{
    private const TABLE_NAME = 'points';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'lat' => $this->double()->notNull(),
            'lon' => $this->double()->notNull(),
            'location' => $this->string()->notNull(),
            'track_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221011_180820_create_table_points cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221011_180820_create_table_points cannot be reverted.\n";

        return false;
    }
    */
}
