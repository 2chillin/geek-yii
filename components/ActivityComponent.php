<?php
namespace app\components;
use app\base\BaseComponent;
use app\models\Activity;
use phpDocumentor\Reflection\Types\Boolean;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
class ActivityComponent extends BaseComponent
{
	public $modelClass;
	public function getModel()
	{
		return new $this->modelClass;
	}
	public function addActivity(Activity $activity) : bool
	{
		$activity->file = UploadedFile::getInstances($activity, 'files');
		$activity->userId=\Yii::$app->user->getIdentity()->id;
		// валидация формы
		if ($activity->validate()) {
			// проверка наличия и сохранение файлов
			if ($activity->file) {
				$activity->file = \Yii::$app->file->saveFiles($activity->file);
				if (!$activity->file) {
					return false;
				}
			}else{
				$activity->file=null;
			}
			if($activity->save(false)){
				return true;
			} else {
				print_r($activity->getErrors());
				die;
			}
//            if (\Yii::$app->dao->insertActivity($activity)) {
//                return true;
//            }
		}
		// если валидация формы не прошла
		return false;
	}

	public function createActivity(Activity $activity)
	{
		$activity->file = UploadedFile::getInstances($activity, 'file');
		if ($activity->validate()) {
			if ($activity->file) {
				foreach ($activity->file as $file) {
				$file = $this->saveFile($file);
				if (!$file) {
					return false;
				   }
				}
			}
			return true;
		}
		return false;
	}

	public function editActivity(Activity $activity)
	{
		$activity->file = UploadedFile::getInstances($activity, 'files');
		$activity->userId=\Yii::$app->user->getIdentity()->id;
		// валидация формы
		if ($activity->validate()) {
			// проверка наличия и сохранение файлов
			if ($activity->file) {
				$activity->file = \Yii::$app->file->saveFiles($activity->file);
				if (!$activity->file) {
					return false;
				}
			}else{
				$activity->file=null;
			}
			if($activity->save(false)){
				return true;
			} else {
				print_r($activity->getErrors());
				die;
			}
		}
		// если валидация формы не прошла
		return false;
	}

	private function saveFile(UploadedFile $file): ?string
	{
		$name = $this->genFileName($file);
		$path = $this->getPathToSave() . $name;
		if ($file->saveAs($path)) {
			return $name;
		}
		return null;
	}
	private function getPathToSave()
	{
		$path = \Yii::getAlias('@webroot/files/');
		FileHelper::createDirectory($path);
		return $path;
	}
	private function genFileName(UploadedFile $file)
	{
		return $file->getBaseName() . '.' . $file->getExtension();
	}
}