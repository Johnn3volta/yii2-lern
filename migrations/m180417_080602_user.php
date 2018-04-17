<?php

use yii\db\Migration;

/**
 * Class m180417_080602_user
 */
class m180417_080602_user extends Migration{

    /**
     * {@inheritdoc}
     */
    public function safeUp(){
        $this->createTable('user', [
            'id'            => $this->primaryKey(),
            'username'      => $this->string(255)->notNull(),
            'name'          => $this->string(255)->notNull(),
            'surname'       => $this->string(255),
            'password_hash' => $this->string(255)->notNull(),
            'access_token'  => $this->string(255)->defaultValue('NULL'),
            'created_ad'    => $this->integer()->notNull(),
            'updated_ad'    => $this->integer()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(){
        $this->dropTable('user');

        return true;
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180417_080602_user cannot be reverted.\n";

        return false;
    }
    */
}
