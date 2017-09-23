<?php

use yii\db\Migration;

class m170919_175453_create_tbl_post extends Migration
{
	public function safeUp()
	{
		$this->createTable('post', [
			'id' => $this->primaryKey(),
			'date' => $this->date(),
			'title' => $this->string(),
			'text' => $this->text(),
			'img' => $this->string(),
			'author_id' => $this->integer(),
			'iscomment' => $this->integer()->defaultValue(0)
		]);
	}

	public function safeDown()
	{
		$this->dropTable('post');
	}

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170919_175453_create_tbl_blog cannot be reverted.\n";

        return false;
    }
    */
}
