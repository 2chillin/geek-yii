<?php
/**
 * Created by PhpStorm.
 * User: 2chillin
 * Date: 09.12.2019
 * Time: 22:41
 */

namespace app\models;


use yii\data\ActiveDataProvider;

class ActivitySearch extends Activity {

	public function search($params=[]): ActiveDataProvider {
		$query=Activity::find();
		$this->load($params);
		$provider=new ActiveDataProvider(
			[
				'query' => $query,
				'sort' => [
					'defaultOrder'=>[
						'dateStart'=>SORT_DESC
					]
				],
				'pagination' => [
					'pageSize' => 5
				]
			]
		);

		$query->with('user');

		$query->andFilterWhere(['title'=>$this->title]);

		return $provider;
	}
}