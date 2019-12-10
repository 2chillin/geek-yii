<?php
namespace app\controllers;
use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;
use app\models\Activity;
use app\models\ActivitySearch;
use yii\web\HttpException;
class ActivityController extends BaseController
{
	public function actions()
	{
		return [
			'create'=>['class'=>CreateAction::class]
		];
	}

	public function actionIndex() {
		$model=new ActivitySearch();
		$provider=$model->search(\Yii::$app->request->getQueryParams());

		return $this->render('index', ['model'=>$model, 'provider'=>$provider]);
	}

	public function actionView($id){
		$model=Activity::findOne($id);
		if(!\Yii::$app->rbac->canViewActivity($model)){
			throw new HttpException(403,'No access to activity');
		}
		if(!$model){
			throw new HttpException(404,'Activity not found');
		}
		return $this->render('view',['model'=>$model]);
	}

	public function actionEdit($id){
		$model=Activity::findOne($id);
		if(!\Yii::$app->rbac->canViewActivity($model)){
			throw new HttpException(403,'No access to activity');
		}
		if(!$model){
			throw new HttpException(404,'Activity not found');
		}
		return $this->render('edit',['model'=>$model]);
	}

//    public function actionCreate()
//    {
//        return $this->render('create');
//    }
}