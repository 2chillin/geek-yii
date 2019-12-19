<?php
/**
 * Created by PhpStorm.
 * User: 2chillin
 * Date: 09.12.2019
 * Time: 22:16
 */

namespace app\widgets\AuthForm;


use yii\base\Widget;

class AuthFormWidget extends Widget {

	public $title;

	public $model;

	public function run(){

		return $this->render('form',['title'=>$this->title,'model'=>$this->model]);

	}
}