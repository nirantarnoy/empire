<?php
namespace backend\models;
use yii\helpers\ArrayHelper;


class User extends \common\models\User
{
	public $password;

public function rules(){
	return ArrayHelper::merge(parent::Rules(),[
		[['password','username'],'string'],
    [['email'],'email'],
		]);
}

  public function getUsergroup(){
    return $this->hasOne(\backend\models\Usergroup::className(),['id'=>'group_id']);
  }
  public function getUserrole(){
    return $this->hasOne(\backend\models\Userrole::className(),['id'=>'role_id']);
  }
  public function getGroup(){
    return $this->hasOne(\backend\models\Usergroup::className(),['id'=>'group_id']);
  }
  public function findUserName($id){
    $model = User::find()->where(['id'=>$id])->one();
    return count($model)>0?$model->username:'';
  }
  public function findEmpid($id){
    $model = \backend\models\Employee::find()->where(['user_id'=>$id])->one();
    return count($model)>0?$model->id:0;
  }
  public function findUserGroup($id){
    $model = User::find()->where(['id'=>$id])->one();
    if($model){
      $group = \backend\models\Usergroup::find()->where(['id'=>$id])->one();
      return count($group)>0?$group->name:'';
    }else{
      return '';
    }
    
  }
}
