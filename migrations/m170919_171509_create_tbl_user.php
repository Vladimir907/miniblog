<?php

use yii\db\Migration;

class m170919_171509_create_tbl_user extends Migration
{
	public function safeUp()
	{
		$this->createTable('user', [
			'id' => $this->primaryKey(),
			'name' => $this->string(),
			'email' => $this->string()->defaultValue(null),
			'password' => $this->string(),
            'isAdmin'=>$this->integer()->defaultValue(0)
		]);
	}

	public function safeDown()
	{
		$this->dropTable('user');
	}

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170919_171509_create_tbl_user cannot be reverted.\n";

        return false;
    }
    */
}
