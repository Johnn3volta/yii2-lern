<?php

use yii\db\Migration;

/**
 * Class m180417_075231_test
 */
class m180417_075231_test extends Migration{

    /**
     * {@inheritdoc}
     */
    public function safeUp(){
        $this->createTable('test',[
            'id' => $this->primaryKey(),
            'name' =>$this->string(255),
            'price' => $this->integer()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(){

        $this->dropTable('test');

        return true;
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180417_075231_test cannot be reverted.\n";

        return false;
    }
    */
}
