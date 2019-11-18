<?php

use yii\db\Migration;

/**
 * Class m191118_141121_files
 */
class m191118_141121_files extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('files', [
		    'id'=>$this->primaryKey(),
		    'title'=> $this->string(150)->notNull(),
		    'filename'=> $this->string(50)->notNull(),
		    'createdAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
		    'activityId'=>$this->integer()->notNull()
	    ]);

	    $this->addForeignKey('activityFilesFK','files','activityId','activity','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropTable('files');
    }

}
