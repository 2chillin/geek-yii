<?php
namespace app\controllers;
use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\controllers\actions\activity\ViewAction;
use app\controllers\actions\activity\EditAction;

class CalendarController extends BaseController
{
	public function actions()
	{
		return [
			'create'=>['class'=>CreateAction::class],
			'view'=>['class'=>ViewAction::class]
		];
	}
}