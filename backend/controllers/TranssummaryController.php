<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\TransactionsumSearch;

class TranssummaryController extends Controller
{
	public function actionIndex()
    {
        $Sdate = "";
        $Edate = "";
        $income = 0;
        $expense = 0;
    	$searchModel = new TransactionsumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(Yii::$app->request->isGet){
            $Sdate = date('Y-m-d',strtotime(Yii::$app->request->get('Startdate')));
            $Edate = date('Y-m-d',strtotime(Yii::$app->request->get('Enddate')));
 //echo date_format($Sdate2,'d-m-Y');return;
          
            if($Sdate != "" || $Edate != ""){
                $dataProvider->query->where(['>=','sale_date',$Sdate])->andFilterWhere(['<=','sale_date',$Edate])->orderby(['create_date'=>SORT_DESC]);
               $income = \backend\models\Transactionsum::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','sale_date',$Sdate],['<=','sale_date',$Edate]])->sum('in_amount');
               $expense = \backend\models\Transactionsum::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','sale_date',$Sdate],['<=','sale_date',$Edate]])->sum('out_amount');
            }else{
               $income = \backend\models\Transactionsum::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('in_amount');
               $expense = \backend\models\Transactionsum::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('out_amount');
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Sdate' => $Sdate,
            'Edate' => $Edate,
            'income' => $income,
            'expense' => $expense,
        ]);
	}
	
}