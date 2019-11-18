<?php
namespace app\components;
use app\base\BaseComponent;
use app\models\Activity;
use phpDocumentor\Reflection\Types\Boolean;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
class ActivityComponent extends BaseComponent
{
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
		if ($activity->validate()) {

			return true;
		}
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