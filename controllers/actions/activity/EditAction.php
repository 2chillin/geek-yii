<?php
namespace app\controllers\actions\activity;
use app\base\BaseAction;
use app\models\Activity;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
class EditAction extends BaseAction
{
	//public $name;
	public function run() {

		if (!\Yii::$app->rbac->canCreateActivity()) {
			throw new HttpException( 403, 'Not Auth Action' );
		}

		$model = new Activity();
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
				return $this->controller->render('index',['model'=>$model]);
			}
			if(\Yii::$app->activity->editActivity($model)) {
				return $this->controller->redirect(['/activity/index','id'=>$model->id]);
			}
		}
		return $this->controller->render('edit',['model'=>$model]);
	}
}