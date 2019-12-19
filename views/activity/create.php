<?php
/**
 * @var $model \app\models\Activity
 */
?>
<?=\yii\helpers\Html::a('Вернуться к списку', '/activity/index',['class'=>'btn btn-primary']);?>
<h1>Создание активности</h1>
<div class="row">
    <div class="col-md-4">
		<?php $form = \yii\bootstrap\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
		<?= $form->field($model, 'title'); ?>
		<?= $form->field($model, 'description')->textarea(); ?>
		<?= $form->field($model, 'dateStart'); ?>
	    <?= $form->field($model, 'dateEnd'); ?>
		<?= $form->field($model, 'isBlocked')->checkbox(); ?>
		<?= $form->field($model, 'isRepeat')->checkbox(); ?>
		<?= $form->field($model, 'repeatType')->dropDownList($model::REPEAT_TYPE) ?>
		<?= $form->field($model, 'notify')->checkbox(); ?>
		<?=$form->field($model,'file[]')->fileInput(['multiple' => 'multiple'])?>
        <button type="submit" class="btn btn-success">Создать</button>
		<?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>