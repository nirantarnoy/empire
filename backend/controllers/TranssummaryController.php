<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
//use backend\models\TransactionsumSearch;
use backend\models\SummarydaySearch;

class TranssummaryController extends Controller
{
	public function actionIndex()
    {
        $checkdate = "";
        $Sdate = "";
        $Edate = "";
        $income = 0;
        $expense = 0;
    	$searchModel = new SummarydaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(Yii::$app->request->isGet){
            $Sdate = date('Y-m-d',strtotime(Yii::$app->request->get('Startdate')));
            $Edate = date('Y-m-d',strtotime(Yii::$app->request->get('Enddate')));
            $checkdate = date('Y',strtotime(Yii::$app->request->get('Startdate')));
 //echo date_format($Sdate2,'d-m-Y');return;

          
            if(($Sdate != "" && $checkdate !='1970') || ($Edate != "" && $checkdate !='1970')){
                $dataProvider->query->where(['>=','sale_date',$Sdate])->andFilterWhere(['<=','sale_date',$Edate])->orderby(['create_date'=>SORT_DESC]);
               $income = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','sale_date',$Sdate],['<=','sale_date',$Edate]])->sum('sale_amount');
               $expense = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','sale_date',$Sdate],['<=','sale_date',$Edate]])->sum('purchase_amount');
            }else{
               $income = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('sale_amount');
               $expense = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('purchase_amount');
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