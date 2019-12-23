<?php
namespace app\widgets\meinWidget;
use yii\base\Widget;
class MeinCumpWidget extends Widget
{
	public function run()
	{
		return $this->render('index');
	}
}