<?php
/* @var $this \yii\web\View */
/* @var $model \app\models\Users */
?>

<div class="row">
	<div class="col-md-6">
        <?=\app\widgets\AuthForm\AuthFormWidget::widget(['title' => 'Авторизация', 'model' => $model])?>
        <b>Нет учетной записи?</b> <a href="/auth/sign-up">Зарегистрироваться</a>
	</div>
</div>