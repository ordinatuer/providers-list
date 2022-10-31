<?php

use yii\db\Migration;

/**
 * Class m221028_225902_create_table_addr_list
 */
class m221028_225902_create_table_addr_list extends Migration
{
    private const TABLE_NAME = 'addr_list';
    
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer()->notNull(),
            'city' => $this->string()->notNull(),
            'street' => $this->string()->notNull(),
            'house' => $this->string(),
            'build' => $this->string(),
            'address' => $this->text(),
            'lon' => $this->float(),
            'lat' => $this->float(),
            'operator' => $this->integer(),
            'api_response' => $this->text(),
        ]);

        // $this->execute("ALTER TABLE " . self::TABLE_NAME . " ADD COLUMN location geometry(Point, 4326)");

        $this->addForeignKey('fk_addr_to_file', self::TABLE_NAME, 'file_id', 'tracks', 'id');
    }

    public function safeDown()
    {
        // echo "m221028_225902_create_table_addr_list cannot be reverted.\n";

        // return false;

        $this->dropTable(self::TABLE_NAME);
    }
}
