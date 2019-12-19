<?php

use yii\db\Migration;

/**
 * Class m191115_133349_AlterTables
 */
class m191115_133349_AlterTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('activity', 'userId', $this->integer()->notNull());
		$this->addForeignKey('activityUSerFK', 'activity','userId', 'users','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropForeignKey('activityUSerFK', 'activity');
		$this->dropColumn('activity','userId');

    }

}
