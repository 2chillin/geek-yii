<?php
/**
 * @var $model \app\models\Activity
 * @var $this \yii\web\View
 */

?>

<?=\yii\helpers\Html::a('&larr; Вернуться в календарь', ['site/calendar']);?>

<br>
<br>
<div><b>Событие:</b> <?=$model->title;?></div>
<div><b>Автор:</b> <?=$model->author;?></div>
<div><b>Дата:</b> <?=$model->date;?></div>
<div><b>Время:</b> <?=$model->time;?></div>
<div><b>Описание:</b> <?=$model->description;?></div>
<div><b>Блокирующее:</b> <?=$model->isBlocked?'Да':'Нет';?></div>
<div><b>Повторяющееся:</b> <?=$model->isRepeat?'Да':'Нет';?></div>
<?php foreach ($model->file as $file) {?>
   <div><b>Изображение:</b> <?=\yii\helpers\Html::img(Yii::getAlias('@filesWeb/'.$file->name),[
		   'width'=>300,'title'=>$model->title
       ])?>
<?php } ?>
</div>
<br>

<?= \Yii\helpers\Html::a('Редактировать активность',
	['activity/edit'], [
		'data' => [
			'method' => 'post',
			'params' => [
				'activityId' => $model->id
			],
		],
	]) ?>

