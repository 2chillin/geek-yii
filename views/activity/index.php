<div class="row">
	<div class="col-md-12">
		<?=\yii\helpers\Html::a('Создать активность', '/activity/create',['class'=>'btn btn-success']);?>
		<?=\yii\grid\GridView::widget([
			'dataProvider' => $provider,
			'filterModel' => $model,
			'tableOptions' => [
				'class' => 'table'
				],
			'rowOptions' => function($modelm, $key, $index, $grid) {
				$class=$index%2?'odd':'even';
				return['key'=>$key,'index'=>$index,'class'=>$class];
			},
			'columns' => [
				'id',
				'dateStart',
				[
					'attribute' => 'title',
					'label' => 'Название активности',
					'value' => function($model){
						return \yii\helpers\Html::a($model->title,['/activity/edit', 'id'=>$model->id]);
					},
					'format'=>'raw'
				],
				[
					'attribute' => 'user.email'
				]
			]
		]);?>
	</div>
</div>