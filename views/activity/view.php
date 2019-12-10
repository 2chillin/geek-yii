<?php
/**
 * @var $model \app\models\Activity
 * @var $this \yii\web\View
 */

?>

<?=\yii\helpers\Html::a('&larr; Вернуться', ['activity/index']);?>
<br>
<br>
<div class="row">
    <div class="col-md-4">
        <div><b>Событие:</b> <?=$model->title;?></div>
        <div><b>Дата начала:</b> <?=$model->dateStart;?></div>
        <div><b>Дата окончания:</b> <?=$model->dateEnd;?></div>
        <div><b>Описание:</b> <?=$model->description;?></div>
        <div><b>Блокирующее:</b> <?=$model->isBlocked?'Да':'Нет';?></div>
        <div><b>Повторяющееся:</b> <?=$model->isRepeat?'Да':'Нет';?></div>
	    <?php if ($model->file) {foreach ($model->file as $file) { ?>
        <div><b>Изображение:</b> <?=\yii\helpers\Html::img(Yii::getAlias('@filesWeb/'.$file->name),[
			    'width'=>300,'title'=>$model->title
		    ])?>
		    <?php } }?>
    </div>
</div>
<br>
<?= \Yii\helpers\Html::a('Редактировать активность',
		   ['activity/edit'], [
			   'data' => [
				   'method' => 'get',
				   'params' => [
					   'id' => $model->id
				   ],
			   ],
]) ?>
</div>

