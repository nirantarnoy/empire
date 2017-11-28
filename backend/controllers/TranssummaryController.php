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
        $purch = 0;
    	$searchModel = new SummarydaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(Yii::$app->request->isGet){
            $Sdate = date('d-m-Y',strtotime(Yii::$app->request->get('Startdate')));
            $Edate = date('d-m-Y',strtotime(Yii::$app->request->get('Enddate')));
            $checkdate = date('Y',strtotime(Yii::$app->request->get('Startdate')));
 //echo date_format($Sdate2,'d-m-Y');return;

          
            if(($Sdate != "" && $checkdate !='1970') || ($Edate != "" && $checkdate !='1970')){
                $dataProvider->query->where(['>=','created_at',$Sdate])->andFilterWhere(['<=','created_at',$Edate])->orderby(['created_at'=>SORT_DESC]);
               $income = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','created_at',$Sdate],['<=','created_at',$Edate]])->sum('sale_amount');
               $purch = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','created_at',$Sdate],['<=','created_at',$Edate]])->sum('purchase_amount');
               $expense = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','created_at',$Sdate],['<=','created_at',$Edate]])->sum('expense_amount');
            }else{
               $income = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('sale_amount');
               $purch = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('purchase_amount');
               $expense = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('expense_amount');
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Sdate' => $Sdate,
            'Edate' => $Edate,
            'income' => $income,
            'expense' => $expense,
            'purch' => $purch,
        ]);
	}
	
}