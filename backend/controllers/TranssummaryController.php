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
            $Sdate = Yii::$app->request->get('Startdate');
            $Edate = Yii::$app->request->get('Enddate');
 //echo date_format($Sdate2,'d-m-Y');return;
            $x = "STR_TO_DATE(".$Sdate.",%d-%m-%Y)";

            if($Sdate != "" || $Edate != ""){
                $dataProvider->query->where(['>=','CAST(sale_date as CHAR(50))',$Sdate])->orderby(['create_date'=>SORT_DESC]);
               // $income = \backend\models\Transactionsum::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['>=','STR_TO_DATE(sale_date,"%d-%m-%Y")',$Sdate])->sum('in_amount');
               // $expense = \backend\models\Transactionsum::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['>=','sale_date',$Sdate])->sum('out_amount');
            }else{
               // $income = \backend\models\Transactionsum::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('in_amount');
               // $expense = \backend\models\Transactionsum::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('out_amount');
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