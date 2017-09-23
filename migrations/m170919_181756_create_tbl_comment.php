<?php

use yii\db\Migration;

class m170919_181756_create_tbl_comment extends Migration
{
	public function safeUp()
	{
		$this->createTable('comment', [
			'id' => $this->primaryKey(),
			'date' => $this->date(),
			'post_id' => $this->integer(),
			'author_id' => $this->integer(),
			'text' => $this->text()
		]);
	}

	public function safeDown()
	{
		$this->dropTable('comment');
	}

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170919_181756_create_tbl_comment cannot be reverted.\n";

        return false;
    }
    */
}
