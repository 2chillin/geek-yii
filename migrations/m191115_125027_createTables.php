<?php

use yii\db\Migration;

/**
 * Class m191115_125027_createTables
 */
class m191115_125027_createTables extends Migration
{
    /**
     * {@inheritdoc}
     */
	public function safeUp()
	{
		$this->createTable('activity', [
			'id'=>$this->primaryKey(),
			'title'=> $this->string(150)->notNull(),
			'description'=>$this->text(),
			'dateStart'=>$this->dateTime()->notNull(),
			'isBlocked'=>$this->boolean()->notNull()->defaultValue(0),
			'email'=>$this->string(150),
			'createdAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
		]);

		$this->createTable('users', [
			'id'=>$this->primaryKey(),
			'email'=>$this->string(150),
			'passwordHash'=>$this->string(150),
			'authKey'=>$this->string(150),
			'token'=>$this->string(150),
			'createdAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
		]);

		$this->createIndex('emailUniqueInd','users','email',true);
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');
    }

}
