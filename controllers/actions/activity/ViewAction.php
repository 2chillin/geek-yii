<?php
namespace app\controllers\actions\activity;
use app\base\BaseAction;
use app\models\Activity;
use yii\web\Response;

class ViewAction extends BaseAction
{
	public function run() {
		$model = new Activity();
		return $this->controller->render('view',['model'=>$model]);
   }
}