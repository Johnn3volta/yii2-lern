<?php

use yii\db\Migration;

/**
 * Class m180417_082019_note
 */
class m180417_082019_note extends Migration{

    /**
     * {@inheritdoc}
     */
    public function safeUp(){
        $this->createTable('note', [
            'id'         => $this->primaryKey(),
            'text'       => $this->text()->notNull(),
            'creator_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(){
        $this->dropTable('note');

        return true;
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180417_082019_note cannot be reverted.\n";

        return false;
    }
    */
}
