<?php
namespace app\models;
use app\base\BaseModel;
class Activity extends ActivityBase
{
//    public $title;
//    public $description;
//    public $date;
//    public $startDateTime;
//    public $endDateTime;
//    public $isBlocked;
//    public $isRepeated;
//    public $repeatType;
	const DAY = 0;
	const WEEK = 1;
	const MONTH = 2;
	const REPEAT_TYPE = [self::DAY => 'Каждый день', self::WEEK => 'Каждую неделю',
	                     self::MONTH => 'Каждый месяц'];
	public $useNotification;
//  public $email;
//	public $repeatEmail;
//  public $files;
	public $ind;
	public function beforeValidate()
	{
		if (!empty($this->startDateTime)) {
			$date = \DateTime::createFromFormat('d-m-Y H:i', $this->startDateTime);
			if ($date) {
				$this->startDateTime = $date->format('Y-m-d H:i');
			}
		}
		if (!empty($this->endDateTime)) {
			$date = \DateTime::createFromFormat('d-m-Y H:i', $this->endDateTime);
			if ($date) {
				$this->endDateTime = $date->format('Y-m-d H:i');
			}
		}
		return parent::beforeValidate();
	}
	public function rules()
	{
		return array_merge([
			['title', 'trim'],
			[['title', 'description', 'dateStart', 'dateEnd'], 'required'],
			[['title', 'dateStart', 'dateEnd'], 'string'],
			[['dateStart', 'dateEnd'], 'date', 'format' => 'php:Y-m-d'],
			['description','string','max' => 300, 'min'=>1],
			[['isBlocked', 'notify', 'isRepeat'], 'boolean'],
//            ['repeatType', 'in', 'range' => array_keys(self::REPEAT_TYPE)],
			/*['email', 'email'],
			[['email', 'repeatEmail'], 'required', 'when' => function ($model) {
				return $model->useNotification;
			}],*/
			//['repeatEmail', 'compare', 'compareAttribute' => 'email'],
			[['file'], 'file', 'extensions' => ['jpg', 'png'], 'maxFiles' => 4]
		],parent::rules());
	}
	public function attributeLabels()
	{
		return [
			'title'=>'Заголовок активности',
			'description'=>'Описание',
			'dateStart'=>'Время начала',
			'dateEnd'=>'Время окончания',
			'isBlocked'=>'Блокирующая активность',
            //'isRepeated'=>'Повторяющееся',
            //'repeatType'=>'Частота повторения',
			//'email'=>'Ваш E-mail',
			//'repeatEmail'=>'Подтвердите E-mail',
			'useNotification'=>'Оповещать',
			'repeatType'=>'Тип повторения',
			'file'=>'Файлы',
			'isRepeat'=>'Повторять',
			'notify'=>'Оповещать'

		];
	}

	public function fields()
	{
		return [
			'id',
			'title',
			'dateStart' => function ($model) {
				return \Yii::$app->formatter->asDate($model->dateStart, 'd.m.Y');
			},
			'duration' => function () {
				return 0;
			},
		];
	}

	public function extraFields()
	{
		return [
			'user'=>function($model){
				return $model->user->email;
			}
		];
	}

}