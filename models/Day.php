<?php
/**
 * Created by PhpStorm.
 * User: 2chillin
 * Date: 10.11.2019
 * Time: 16:42
 */

namespace app\models;

use yii\base\Model;


class Day extends Model {
	public $date;
	public $isWeekend;
	public $activity;
}