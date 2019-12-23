<?php
namespace app\controllers;
use app\models\Activity;
use yii\rest\ActiveController;

class ActivityRestController extends ActiveController
{
	public $modelClass=Activity::class;
	public function behaviors()
	{
		$beh = parent::behaviors();
		$beh['authenticator']=[
			'class'=>\yii\filters\auth\HttpBearerAuth::class
		];
		return $beh;
	}
}