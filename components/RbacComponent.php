<?php
namespace app\components;
use app\base\BaseComponent;
use app\models\Activity;
use app\rules\OwnerAcitivtyRule;
use yii\rbac\ManagerInterface;
class RbacComponent extends BaseComponent
{
	private function getManager(): ManagerInterface
	{
		return \Yii::$app->authManager;
	}
	public function generateRbac()
	{
		$manager = $this->getManager();
		$manager->removeAll();
		$admin = $manager->createRole('admin');
		$user = $manager->createRole('user');
		$manager->add($admin);
		$manager->add($user);
		$createActivity = $manager->createPermission('createActivity');
		$createActivity->description = 'Создание активностей';
		$manager->add($createActivity);
		$rule=new OwnerAcitivtyRule();
		$manager->add($rule);
		$viewOwnerActivity = $manager->createPermission('viewOwnerActivity');
		$viewOwnerActivity->description = 'Просмотр свой активности';
		$viewOwnerActivity->ruleName=$rule->name;
		$manager->add($viewOwnerActivity);
		$adminActivity = $manager->createPermission('adminActivity');
		$adminActivity->description = 'Доступ к любым активностям';
		$manager->add($adminActivity);
		$manager->addChild($user, $createActivity);
		$manager->addChild($user, $viewOwnerActivity);
		$manager->addChild($admin, $user);
		$manager->addChild($admin, $adminActivity);
		$manager->assign($user, 3);
		$manager->assign($admin, 4);
	}
	public function canCreateActivity(): bool
	{
		return \Yii::$app->user->can('createActivity');
	}
	public function canViewActivity(Activity $activity)
	{
		if (\Yii::$app->user->can('adminActivity')) {
			return true;
		}
		if (\Yii::$app->user->can('viewOwnerActivity',['activity'=>$activity])) {
			return true;
		}
		return false;
	}
}