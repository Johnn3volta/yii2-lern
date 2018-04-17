<?php

use yii\db\Migration;

/**
 * Class m180417_082033_access
 */
class m180417_082033_access extends Migration{

    /**
     * {@inheritdoc}
     */
    public function safeUp(){
        $this->createTable('access', [
            'id'      => $this->primaryKey(),
            'note_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            $this->addForeignKey('fx_access_user', 'access', ['user_id'], 'user', ['id']),
            $this->addForeignKey('fx_access_note', 'access', ['note_id'], 'note', ['id']),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(){
        $this->dropTable('access');

        return true;
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180417_082033_access cannot be reverted.\n";

        return false;
    }
    */
}
