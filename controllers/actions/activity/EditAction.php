<?php
namespace app\controllers\actions\activity;
use app\base\BaseAction;
use app\models\Activity;
use app\components\ActivityComponent;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

class EditAction extends BaseAction
{
	//public $name;
	public function run() {

		$id = \Yii::$app->request->get('id');

		$model=Activity::findOne($id);
		if(!\Yii::$app->rbac->canViewActivity($model)){
			throw new HttpException(403,'No access to activity');
		}
		if(!$model){
			throw new HttpException(404,'Activity not found');
		}

		if (\Yii::$app->request->isPost){

			$model->load(\Yii::$app->request->post());
			if(\Yii::$app->request->isAjax){
				\Yii::$app->response->format=Response::FORMAT_JSON;
				return ActiveForm::validate($model);
			}
			if(!\Yii::$app->activity->editActivity($model)) {
				print_r($model->getErrors());
				die;
			} else {
				return $this->controller->render('edit',['model'=>$model]);
			}
		}
		return $this->controller->render('edit',['model'=>$model]);
	}
}