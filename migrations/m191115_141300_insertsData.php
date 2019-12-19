<?php

use yii\db\Migration;

/**
 * Class m191115_141300_insertsData
 */
class m191115_141300_insertsData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->insert('users', [
	    	'id'=>1,
	    	'email'=>'test@test.ru',
		    'passwordHash'=>'1'

	    ]);

	    $this->insert('users', [
		    'id'=>2,
		    'email'=>'test2@test.ru',
		    'passwordHash'=>'1'

	    ]);

	    $this->batchInsert('activity',[
	    	'title','dateStart','isBlocked','userId'
	    ],[
	    	['title1',date('Y-m-d'),0,1],
		    ['title2',date('Y-m-d'),1,1],
		    ['title3',date('Y-m-d'),1,1],
		    ['title4',date('Y-m-d'),0,2],
		    ['title4','2019-11-10',0,2]
	    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->delete('users');
    }
}
