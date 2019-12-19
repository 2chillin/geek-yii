<?php

use yii\db\Migration;

/**
 * Class m191118_145511_insertsFilesData
 */
class m191118_145511_insertsFilesData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->batchInsert('files',[
		    'title','filename','createdAt','activityId'
	    ],[
		    ['title1','file1.jpg',date('Y-m-d'),1],
		    ['title2','file2.jpg',date('Y-m-d'),1],
		    ['title3','file3.jpg',date('Y-m-d'),2],
		    ['title4','file4.jpg',date('Y-m-d'),2],
		    ['title5','file5.jpg',date('Y-m-d'),3],
		    ['title6','file6.jpg',date('Y-m-d'),3],
		    ['title7','file7.jpg',date('Y-m-d'),4],
		    ['title8','file8.jpg',date('Y-m-d'),4],
		    ['title9','file9.jpg',date('Y-m-d'),5],
		    ['title10','file10.jpg',date('Y-m-d'),5]
	    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->delete('files');
    }

}
