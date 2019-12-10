<?php
namespace app\base;
use yii\web\Controller;
use yii\web\HttpException;
class BaseController extends Controller
{
	public function beforeAction($action)
	{
		if(\Yii::$app->user->isGuest){
			throw new HttpException(401,'Not Auth');
		}
		$this->view->params['lastPage'] = \Yii::$app->session->getFlash('lastPage');
		return parent::beforeAction($action);
	}
	public function afterAction($action, $result)
	{
		\Yii::$app->session->setFlash('lastPage',\Yii::$app->request->url);
		return parent::afterAction($action, $result);
	}
}